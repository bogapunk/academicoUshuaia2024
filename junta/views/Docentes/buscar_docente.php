<?php
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

// Construcción de la tabla con los resultados
echo '<table class="table table-bordered">
        <thead>
            <tr>
                
            </tr>
        </thead>
        <tbody>';

if (sqlsrv_has_rows($stmt)) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo '<tr>
                <td><center style="font-size:1em">' . htmlspecialchars($row['Legajo']) . '</center></td>
                <td><center style="font-size:1em">' . htmlspecialchars($row['dni']) . '</center></td>
                <td><center style="font-size:1em">' . htmlspecialchars($row['ApellidoyNombre']) . '</center></td>
                <td><center style="font-size:1em">' . (is_null($row['lugarinsc']) || trim($row['lugarinsc']) === '' ? '<span style="color: red;">No disponible</span>' : htmlspecialchars($row['lugarinsc'])) . '</center></td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-success" href="?action=editar&id2=' . htmlspecialchars($row['id2']) . '" title="Editar legajos"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        <a class="btn btn-sm btn-danger" href="?action=eliminar&id2=' . htmlspecialchars($row['id2']) . '" title="Borrar legajo" onclick="return confirm(\'¿Seguro que deseas eliminar este registro?\');"><i class="glyphicon glyphicon-trash"></i> Borrar</a>
                        <a class="btn btn-custom btn-sm" href="VerInscripciones.php?legajo=' . htmlspecialchars($row['Legajo']) . '" title="Ver Inscripcion legajos"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>
                        <a class="btn btn-sm btn-primary" href="RegistroMovimiento.php?legajo=' . htmlspecialchars($row['Legajo']) . '" title="Agregar Inscripcion"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
                    </center>
                </td>
            </tr>';
    }
} else {
    // Si no se encontraron resultados, agregar una fila con un mensaje
    echo '<tr><td colspan="5" class="text-center" style="color:red;">No se encontraron resultados</td></tr>';
    
}

echo '</tbody></table>';


?>
