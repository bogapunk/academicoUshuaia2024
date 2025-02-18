<?php
// Definición de variables
$anodoc = '';
$legdoc = '';
$codmod = '';

$promedio = '';
$antiguedadgestion = '';
$antiguedadtitulo = '';
$serviciosprovincia = '';
$otrosservicios = '';
$residencia = '';
$publicaciones = '';
$otrosantecedentes = '';

$codloc = '';
$tipo = '';
$tipocarga = '';
$id2 = '';
$T_m_seccion = '';
$T_m_anio = '';
$T_m_grupo = '';
$T_m_ciclo = '';
$T_m_recupera = '';
$T_d_pu = '';
$T_d_3 = '';
$T_d_2 = '';
$T_d_1 = '';
$T_d_biblio = '';
$T_d_gabi = '';
$T_d_seccoortec = '';
$T_d_supsectec = '';
$T_d_supesc = '';
$T_d_supgral = '';
$T_d_adic = '';
$O_g_a = '';
$O_g_b = '';
$O_g_c = '';
$O_g_d = '';
$concepto = '';
$otitulo = '';
$T_m_comple = '';
$T_m_biblio = '';
$T_m_sec1 = '';
$T_m_sec2 = '';
$T_m_viced = '';
$obs = '';
$horas = '';
$legvinc = '';
$hijos = '';
$excluido = '';

// Definición de constantes
define('HOST', '10.1.9.113'); // Host de la base de datos
define('BD', 'junta'); // Nombre de la base de datos
define('DB_USER', 'SA'); // Usuario de la base de datos
define('PASS', 'Davinci2024#'); // Contraseña de la base de datos

$serverName = HOST;
$connectionOptions = array(
    "Database" => BD,
    "Uid" => DB_USER,
    "PWD" => PASS,
    "TrustServerCertificate"=>True,
    "CharacterSet" => 'UTF-8'
);

try {
    // Crear una nueva conexión PDO
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        throw new Exception("Error de conexión: " . print_r(sqlsrv_errors(), true));
    }

    if (isset($_POST['legajo'])) { // Verificación del legajo
        $legajo = $_POST['legajo'];
    } else {
        // Manejo de error
        throw new Exception("El campo 'legajo' es obligatorio.");
    }
    
    // Verificar si los datos se han enviado a través de POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger el valor legajo de la URL
        $legajo = isset($_POST['legajo']) ? $_POST['legajo'] : '';
        // Recoger el tipo de carga del formulario
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
          
        // Verificar si el legajo está vacío
        if (empty($legajo)) {
            throw new Exception("El campo legajo está vacío.");
        }

        // Inicializar variables comunes a ambos tipos de carga
        $anodoc = isset($_POST['anodoc']) ? $_POST['anodoc'] : '';
        $codmod = isset($_POST['codmod']) ? $_POST['codmod'] : '';
        $establecimiento = isset($_POST['establecimiento']) ? $_POST['establecimiento'] : '';
        $codloc = isset($_POST['codloc']) ? $_POST['codloc'] : '';

        // Variables específicas para tipo de carga 'Interinatos y Suplencias', 'permanente' o 'Concurso de Titularidad'
        if ($tipo === 'transitorio' || $tipo === 'permanente' || $tipo === 'concurso' || $tipo === 'Transitorio' || $tipo === 'Permanente' || $tipo === 'Concurso') {
            $titulo = isset($_POST['titulo2']) ? floatval($_POST['titulo2']) : 0;
            $promedio = isset($_POST['promedio2']) ? floatval($_POST['promedio2']) : 0;
            $antiguedadgestion = isset($_POST['antiguedadgestion2']) ? floatval($_POST['antiguedadgestion2']) : 0;
            $antiguedadtitulo = isset($_POST['antiguedadtitulo2']) ? floatval($_POST['antiguedadtitulo2']) : 0;
            $serviciosprovincia = isset($_POST['serviciosprovincia2']) ? floatval($_POST['serviciosprovincia2']) : 0;
            $otrosservicios = isset($_POST['otrosservicios2']) ? floatval($_POST['otrosservicios2']) : 0;
            $residencia = isset($_POST['residencia2']) ? floatval($_POST['residencia2']) : 0;
            $publicaciones = isset($_POST['publicaciones2']) ? floatval($_POST['publicaciones2']) : 0;
            $otrosantecedentes = isset($_POST['otrosantecedentes2']) ? floatval($_POST['otrosantecedentes2']) : 0;
            $concepto = isset($_POST['concepto2']) ? floatval($_POST['concepto2']) : 0;
            $otitulo = isset($_POST['otitulo']) ? floatval($_POST['otitulo']) : 0;
            $T_m_comple = isset($_POST['T_m_comple']) ? floatval($_POST['T_m_comple']) : 0;
            $T_m_biblio = isset($_POST['T_m_biblio']) ? floatval($_POST['T_m_biblio']) : 0;
            $T_m_sec1 = isset($_POST['T_m_sec1']) ? floatval($_POST['T_m_sec1']) : 0;
            $T_m_sec2 = isset($_POST['T_m_sec2']) ? floatval($_POST['T_m_sec2']) : 0;
            $T_m_viced = isset($_POST['T_m_viced']) ? floatval($_POST['T_m_viced']) : 0;
            $obs = isset($_POST['obs']) ? $_POST['obs'] : '';
            $horas = isset($_POST['horas']) ? floatval($_POST['horas']) : 0;
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

            // Calcular el puntaje total sumando los campos relevantes
            $puntajetotal = $titulo + $otitulo + $concepto + $promedio + $antiguedadgestion + $antiguedadtitulo + $serviciosprovincia + $otrosservicios + $residencia + $publicaciones + $otrosantecedentes;
                   
            // Convertir fecha al formato esperado por SQL Server (ejemplo: 'Y-m-d')
            if (!empty($fecha)) {
                $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
                if (!$fechaObj) {
                    $fechaObj = DateTime::createFromFormat('d/m/Y', $fecha);
                }
                if ($fechaObj) {
                    $fecha = $fechaObj->format('Y-m-d');
                } else {
                    throw new Exception("Formato de fecha inválido. Debe ser 'd/m/Y'.");
                }
            } else {
                $fecha = null;
            }

            // Verificar el tipo de carga
            if (!in_array($tipo, ['transitorio', 'permanente', 'concurso', 'Permanente', 'Concurso'])) {
                throw new Exception("Tipo de carga inválido.");
            }

            // Definir la consulta SQL de inserción
            $sql_insert = "INSERT INTO _junta_movimientos 
                        (anodoc, legdoc, codmod, establecimiento, titulo, promedio, antiguedadgestion, antiguedadtitulo, serviciosprovincia, otrosservicios, residencia, publicaciones, otrosantecedentes, puntajetotal, codloc, tipo, T_m_comple, T_m_biblio, T_m_sec1, T_m_sec2, T_m_viced, obs, horas, fecha, otitulo, concepto) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CAST(? AS date), ?, ?)";

            $params_insert = array(
                $anodoc, $legajo, $codmod, $establecimiento, $titulo, $promedio, $antiguedadgestion, $antiguedadtitulo, $serviciosprovincia, $otrosservicios, $residencia, $publicaciones, $otrosantecedentes, $puntajetotal, $codloc, $tipo, $T_m_comple, $T_m_biblio, $T_m_sec1, $T_m_sec2, $T_m_viced, $obs, $horas, $fecha, $otitulo, $concepto
            );
        } elseif ($tipo === 'titulares' || $tipo === 'Titulares' ) { // Variables específicas para tipo de carga 'titulares'
            //$puntajetotal = isset($_POST['puntajetotal']) ? floatval($_POST['puntajetotal']) : 0;
            $promedio = isset($_POST['promedio']) ? floatval($_POST['promedio']) : 0;
            $T_m_anio = isset($_POST['t_m_anio']) ? floatval($_POST['t_m_anio']) : 0;
            $T_m_seccion = isset($_POST['t_m_seccion']) ? floatval($_POST['t_m_seccion']) : 0;
            $T_m_grupo = isset($_POST['t_m_grupo']) ? floatval($_POST['t_m_grupo']) : 0;
            $T_m_ciclo = isset($_POST['t_m_ciclo']) ? floatval($_POST['t_m_ciclo']) : 0;
            $T_m_recupera = isset($_POST['t_m_recupera']) ? floatval($_POST['t_m_recupera']) : 0;
            $T_d_pu = isset($_POST['t_d_pu']) ? floatval($_POST['t_d_pu']) : 0;
            $T_d_3 = isset($_POST['t_d_3']) ? floatval($_POST['t_d_3']) : 0;
            $T_d_2 = isset($_POST['t_d_2']) ? floatval($_POST['t_d_2']) : 0;
            $T_d_1 = isset($_POST['t_d_1']) ? floatval($_POST['t_d_1']) : 0;
            $T_d_biblio = isset($_POST['t_d_biblio']) ? floatval($_POST['t_d_biblio']) : 0;
            $T_d_gabi = isset($_POST['t_d_gabi']) ? floatval($_POST['t_d_gabi']) : 0;
            $T_d_seccoortec = isset($_POST['t_d_seccoortec']) ? floatval($_POST['t_d_seccoortec']) : 0;
            $T_d_supsectec = isset($_POST['t_d_supsectec']) ? floatval($_POST['t_d_supsectec']) : 0;
            $T_d_supesc = isset($_POST['t_d_supesc']) ? floatval($_POST['t_d_supesc']) : 0;
            $T_d_supgral = isset($_POST['t_d_supgral']) ? floatval($_POST['t_d_supgral']) : 0;
            $T_d_adic = isset($_POST['t_d_adic']) ? floatval($_POST['t_d_adic']) : 0;
            $O_g_a = isset($_POST['o_g_a']) ? floatval($_POST['o_g_a']) : 0;
            $O_g_b = isset($_POST['o_g_b']) ? floatval($_POST['o_g_b']) : 0;
            $O_g_c = isset($_POST['o_g_c']) ? floatval($_POST['o_g_c']) : 0;
            $O_g_d = isset($_POST['o_g_d']) ? floatval($_POST['o_g_d']) : 0;
            $obs = isset($_POST['obs']) ? $_POST['obs'] : '';
            $horas = isset($_POST['horas']) ? floatval($_POST['horas']) : 0;
            $otitulo = isset($_POST['otitulo']) ? floatval($_POST['otitulo']) : 0;
            $concepto = isset($_POST['concepto']) ? floatval($_POST['concepto']) : 0;
            $antiguedadgestion = isset($_POST['antiguedadgestion']) ? floatval($_POST['antiguedadgestion']) : 0;
            $antiguedadtitulo = isset($_POST['antiguedadtitulo']) ? floatval($_POST['antiguedadtitulo']) : 0;
            $titulo = isset($_POST['titulo']) ? floatval($_POST['titulo']) : 0;
             
            $serviciosprovincia =isset($_POST['serviciosprovincia']) ? floatval($_POST['serviciosprovincia']) : 0;
            $T_m_comple = isset($_POST['t_m_comple']) ? floatval($_POST['t_m_comple']) : 0;
            $T_m_biblio = isset($_POST['t_m_biblio']) ? floatval($_POST['t_m_biblio']) : 0;
            $T_m_gabinete = isset($_POST['t_m_gabinete']) ? floatval($_POST['t_m_gabinete']) : 0;
            $T_m_sec1 = isset($_POST['t_m_sec1']) ? floatval($_POST['t_m_sec1']) : 0;

            $T_m_sec2 = isset($_POST['t_m_sec2']) ? floatval($_POST['t_m_sec2']) : 0;
            $T_m_viced = isset($_POST['t_m_viced']) ? floatval($_POST['t_m_viced']) : 0;
            $otrosservicios = isset($_POST['otrosservicios']) ? floatval($_POST['otrosservicios']) : 0;
            $residencia = isset($_POST['residencia']) ? floatval($_POST['residencia']) : 0;
            $publicaciones = isset($_POST['publicaciones']) ? floatval($_POST['publicaciones']) : 0;
            $otrosantecedentes = isset($_POST['otrosantecedentes']) ? floatval($_POST['otrosantecedentes']) : 0;
             
           // Calcular el puntaje total sumando los campos relevantes
            //$puntajetotal = $titulo + $otitulo + $concepto + $promedio + $antiguedadgestion + $antiguedadtitulo + $serviciosprovincia + $otrosservicios + $residencia + $publicaciones + $otrosantecedentes + $T_m_anio + $T_m_seccion + $T_m_grupo + $T_m_ciclo + $T_m_recupera + $T_d_pu + $T_d_3 + $T_d_2 + $T_d_1 + $T_d_biblio + $T_d_gabi + $T_d_seccoortec + $T_d_supsectec + $T_d_supesc + $T_d_supgral + $T_d_adic + $O_g_a + $O_g_b + $O_g_c + $O_g_d + $T_m_comple + $T_m_biblio + $T_m_gabinete + $T_m_sec1 + $T_m_sec2 + $T_m_viced;

            $puntajetotal = $titulo + $otitulo + $concepto + $promedio + $antiguedadgestion +
                           $antiguedadtitulo + $serviciosprovincia + $residencia + $publicaciones +
                           $otrosantecedentes + $otrosservicios;

            // Definir la consulta SQL de inserción
            $sql_insert = "INSERT INTO _junta_movimientos 
                    (anodoc, legdoc, codmod, establecimiento, puntajetotal, promedio, T_m_anio, T_m_seccion, T_m_grupo, T_m_ciclo, T_m_recupera, T_d_pu, T_d_3, T_d_2, T_d_1, T_d_biblio, T_d_gabi, T_d_seccoortec, T_d_supsectec, T_d_supesc, T_d_supgral, T_d_adic, O_g_a, O_g_b, O_g_c, O_g_d, codloc, tipo,obs,horas,otitulo,concepto,antiguedadgestion,antiguedadtitulo,titulo,serviciosprovincia,t_m_comple,t_m_biblio,t_m_gabinete,t_m_sec1,t_m_sec2,t_m_viced,otrosservicios,residencia,publicaciones,otrosantecedentes) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,? ,? ,? ,? ,? ,? ,? ,? ,?, ?, ?)";

            $params_insert = array(
                $anodoc, $legajo, $codmod, $establecimiento, $puntajetotal, $promedio, $T_m_anio, $T_m_seccion, $T_m_grupo, $T_m_ciclo, $T_m_recupera, $T_d_pu, $T_d_3, $T_d_2, $T_d_1, $T_d_biblio, $T_d_gabi, $T_d_seccoortec, $T_d_supsectec, $T_d_supesc, $T_d_supgral, $T_d_adic, $O_g_a, $O_g_b, $O_g_c, $O_g_d, $codloc, $tipo,$obs,$horas,$otitulo,$concepto,$antiguedadgestion,$antiguedadtitulo,$titulo,$serviciosprovincia, $T_m_comple, $T_m_biblio,$T_m_gabinete,$T_m_sec1,$T_m_sec2,$T_m_viced,$otrosservicios,$residencia,$publicaciones,$otrosantecedentes
            );  
            
        } else {
            throw new Exception("Tipo de carga inválido.");
          }

            // Ejecutar la consulta de inserción
            $stmt_insert = sqlsrv_query($conn, $sql_insert, $params_insert);
            if ($stmt_insert === false) {
                throw new Exception("Error al insertar datos: " . print_r(sqlsrv_errors(), true));
            } else {
                  // Datos insertados correctamente
    echo "<div id='mensaje-exito' style='
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 128, 0, 0.2);
    z-index: 9999;
'>
Los datos se han duplicado correctamente!!!
</div>";

echo "<script>
setTimeout(function() {
    // Ocultar el mensaje de éxito
    document.getElementById('mensaje-exito').style.display = 'none';

    // Crear mensaje de alerta
    var mensajeAlerta = document.createElement('div');
    mensajeAlerta.innerHTML = '¡Atención! El movimiento del docente se registró correctamente.';
    mensajeAlerta.style.position = 'fixed';
    mensajeAlerta.style.top = '20px';
    mensajeAlerta.style.left = '50%';
    mensajeAlerta.style.transform = 'translateX(-50%)';
    mensajeAlerta.style.backgroundColor = '#FF9800';
    mensajeAlerta.style.color = 'white';
    mensajeAlerta.style.padding = '15px';
    mensajeAlerta.style.borderRadius = '5px';
    mensajeAlerta.style.fontSize = '16px';
    mensajeAlerta.style.fontWeight = 'bold';
    mensajeAlerta.style.textAlign = 'center';
    mensajeAlerta.style.boxShadow = '0 4px 8px rgba(255, 165, 0, 0.6)';
    mensajeAlerta.style.zIndex = '9999';

    // Agregar el mensaje al body
    document.body.appendChild(mensajeAlerta);

    // Ocultar el mensaje de alerta y redirigir después de 2 segundos
    setTimeout(function() {
        mensajeAlerta.style.display = 'none';
        window.location.href = './VerInscripciones.php?legajo=".$legajo."';
    }, 2000);
}, 2000);
</script>";
            }
        }
    } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
sqlsrv_close($conn);
?>
