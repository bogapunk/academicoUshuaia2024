<?php
require_once __DIR__ . '/../seguridad_requiere_login.php';
// Conexión a la base de datos
$serverName = "10.1.9.113";
$connectionOptions = array(
    "Database" => "Junta",
    "Uid" => "SA",
    "PWD" => "Davinci2024#",
    "TrustServerCertificate" => true,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Recibir parámetros de búsqueda
$legajo = isset($_GET['legajo']) ? trim($_GET['legajo']) : '';
$dni = isset($_GET['dni']) ? trim($_GET['dni']) : '';
$ApellidoyNombre = isset($_GET['ApellidoyNombre']) ? trim($_GET['ApellidoyNombre']) : '';

// Verificar si el campo `legajo` está vacío
if (empty($legajo) && empty($dni) && empty($ApellidoyNombre)) {
    echo "<center><p style='color:red;'>¡Debe ingresar al menos un criterio de búsqueda!</p></center>";
    exit;
}

// Construcción de la consulta SQL dinámicamente
$params = [];
$sql = "SELECT id2, Legajo, dni, ApellidoyNombre, lugarinsc FROM _junta_docentes WHERE 1=1 ";

if ($legajo !== '') {
    $sql .= " AND Legajo = ?";
    $params[] = $legajo;
}
if ($dni !== '') {
    $sql .= " AND dni = ?";
    $params[] = $dni;
}
if ($ApellidoyNombre !== '') {
    $sql .= " AND ApellidoyNombre LIKE ?";
    $params[] = "%$ApellidoyNombre%";
}

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Solo filas <tr> para insertar en #resultBody (evita tabla anidada y layout roto)
if (sqlsrv_has_rows($stmt)) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $id2 = htmlspecialchars($row['id2']);
        $legajoVal = htmlspecialchars($row['Legajo']);
        $lugarInsc = is_null($row['lugarinsc']) || trim($row['lugarinsc']) === ''
            ? '<span style="color: red;">No disponible</span>'
            : htmlspecialchars($row['lugarinsc']);

        echo '<tr>
                <td class="text-center">' . htmlspecialchars($row['Legajo']) . '</td>
                <td class="text-center">' . htmlspecialchars($row['dni']) . '</td>
                <td class="text-center">' . htmlspecialchars($row['ApellidoyNombre']) . '</td>
                <td class="text-center">' . $lugarInsc . '</td>
                <td class="text-center acciones-docentes-cell">
                    <div class="junta-acciones acciones-docentes">
                        <a class="btn btn-sm btn-success" href="?action=editar&id2=' . $id2 . '" title="Editar legajos">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
                        </a>
                        <a class="btn btn-sm btn-danger" href="?action=eliminar&id2=' . $id2 . '" title="Eliminar" onclick="event.preventDefault(); var url=this.href; juntaConfirmDanger(\'¿Seguro que deseas eliminar este registro?\', function(){ window.location.href=url; });">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar
                        </a>
                        <a class="btn btn-custom btn-sm" href="VerInscripciones.php?legajo=' . $legajoVal . '" title="Ver Inscripcion legajos">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver
                        </a>
                        <a class="btn btn-sm btn-primary" href="RegistroMovimiento.php?legajo=' . $legajoVal . '" title="Agregar Inscripcion">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
                        </a>
                    </div>
                </td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="5" class="text-center" style="color:red;">No se encontraron resultados</td></tr>';
}

?>
