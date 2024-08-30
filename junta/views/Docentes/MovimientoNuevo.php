<?php
// Configuración de la base de datos anterior

/*
define('HOST', 'localhost'); // Host de la base de datos
define('BD', 'junta'); // Nombre de la base de datos
define('DB_USER', 'root'); // Usuario de la base de datos
define('PASS', ''); // Contraseña de la base de datos
define('CHARSET', 'utf8'); // Juego de caracteres de la base de datos

$dsn = "mysql:host=" . HOST . ";dbname=" . BD . ";charset=" . CHARSET;

try {
    // Crear una nueva conexión PDO
    $conn = new PDO($dsn, DB_USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // Verificar si los datos se han enviado a través de POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger el valor legajo de la URL
        $legajo = isset($_POST['legajo']) ? $_POST['legajo'] : '';

        // Verificar si el legajo está vacío
        if (empty($legajo)) {
            echo "El campo legajo está vacío.";
        } else {
            // Verificar si el legajo de la URL existe en la tabla _juntas_movimientos
            $sql_check = "SELECT COUNT(*) FROM _junta_movimientos WHERE legdoc = :legajo";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bindParam(':legajo', $legajo);
            $stmt_check->execute();
            $legdoc_exists = $stmt_check->fetchColumn();

            if ($legdoc_exists > 0) {
                // Recoger y validar los datos del formulario
                $anodoc = isset($_POST['anodoc']) ? $_POST['anodoc'] : 
                $codmod = isset($_POST['codmod']) ? $_POST['codmod'] : NULL;  
              
                $tipo = isset($_POST['tipoc']) ? $_POST['tipoc'] : NULL;  
                $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
                  // Formatear la fecha a día/mes/año
                            if ($fecha) {
                                $date = DateTime::createFromFormat('Y-m-d', $fecha);
                                if ($date) {
                                    $fecha = $date->format('d/m/Y');
                                } else {
                                    // Manejar el caso en el que la fecha no se pueda formatear correctamente
                                    echo "Error al formatear la fecha.";
                                    exit;
                                }
                            }
                $obs = isset($_POST['obs']) ? $_POST['obs'] : NULL;

                $horas = isset($_POST['horas']) ? $_POST['horas'] : NULL;
                $establecimiento = isset($_POST['coddep']) ? $_POST['coddep'] : NULL; 
                $codloc = isset($_POST['codloc']) ? $_POST['codloc'] : NULL;
                $excluido = isset($_POST['idexclu']) ? $_POST['idexclu']: NULL;
         
               
                    // Verifica si se ha enviado el puntaje total de la carga titular
                    if (isset($_POST['titular_puntajetotal'])) {
                        $puntajetotal = $_POST['titular_puntajetotal'];
                       // Procesa los datos de la carga comun
                    } elseif (isset($_POST['comun_puntajetotal'])) {
                        $puntajetotal = $_POST['comun_puntajetotal'];
                        
                    } else {
                        // En caso de que no se haya enviado ningún puntaje total
                        $puntajetotal = NULL;
                    }
                    
                    // Muestra el valor de puntajetotal para verificar si se ha recibido correctamente
                 
    
            
                $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;

                
                $otitulo = isset($_POST['otitulo']) ? $_POST['otitulo'] : NULL;
                
                $concepto = isset($_POST['concepto']) ? $_POST['concepto'] : NULL;
                
                $promedio = isset($_POST['promedio']) ? $_POST['promedio'] : NULL;
                
                $antiguedadgestion = isset($_POST['antiguedadgestion']) ? $_POST['antiguedadgestion'] : NULL;

                
                $antiguedadtitulo = isset($_POST['antiguedadtitulo']) ? $_POST['antiguedadtitulo'] : NULL;
                
                $serviciosprovincia = isset($_POST['serviciosprovincia']) ? $_POST['serviciosprovincia'] : NULL;
                
                $t_m_seccion = isset($_POST['t_m_seccion']) ? $_POST['t_m_seccion'] : NULL;
                
                $t_m_anio = isset($_POST['t_m_anio']) ? $_POST['t_m_anio'] : NULL;
               
                $t_m_grupo = isset($_POST['t_m_grupo']) ? $_POST['t_m_grupo'] : NULL;
                


                $t_m_ciclo = isset($_POST['t_m_ciclo']) ? $_POST['t_m_ciclo'] : NULL;
                
                $t_m_recupera = isset($_POST['t_m_recupera']) ? $_POST['t_m_recupera'] : NULL;
                
                $t_m_comple = isset($_POST['t_m_comple']) ? $_POST['t_m_comple'] : NULL;
               
                $t_m_biblio = isset($_POST['t_m_biblio']) ? $_POST['t_m_biblio'] : NULL;
                
                $t_m_gabinete = isset($_POST['t_m_gabinete']) ? $_POST['t_m_gabinete'] : NULL;
               

                $t_m_sec1 = isset($_POST['t_m_sec1']) ? $_POST['t_m_sec1'] : NULL;
                
                $t_m_sec2 = isset($_POST['t_m_sec2']) ? $_POST['t_m_sec2'] : NULL;
              
                $t_m_viced = isset($_POST['t_m_viced']) ? $_POST['t_m_viced'] : NULL;
                
                
                $t_d_pu = isset($_POST['t_d_pu']) ? $_POST['t_d_pu'] : NULL;
                
                $t_d_3 = isset($_POST['t_d_3']) ? $_POST['t_d_3'] : NULL;
                
                $t_d_2 = isset($_POST['t_d_2']) ? $_POST['t_d_2'] : NULL;
               
                $t_d_1 = isset($_POST['t_d_1']) ? $_POST['t_d_1'] : NULL;
                
                $t_d_biblio = isset($_POST['t_d_biblio']) ? $_POST['t_d_biblio'] : NULL;
                
                $t_d_gabi = isset($_POST['t_d_gabi']) ? $_POST['t_d_gabi'] : NULL;
                

                $t_d_seccoortec = isset($_POST['t_d_seccoortec']) ? $_POST['t_d_seccoortec'] : NULL;
                
                $t_d_supsectec = isset($_POST['t_d_supsectec']) ? $_POST['t_d_supsectec'] : NULL;
                
                $t_d_supesc = isset($_POST['t_d_supesc']) ? $_POST['t_d_supesc'] : NULL;
                
                $t_d_supgral = isset($_POST['t_d_supgral']) ? $_POST['t_d_supgral'] : NULL;
                
                $t_d_adic = isset($_POST['t_d_adic']) ? $_POST['t_d_adic'] : NULL;
                

                $otros_serv = isset($_POST['otros_serv']) ? $_POST['otros_serv'] : NULL;
                
                $o_g_a = isset($_POST['o_g_a']) ? $_POST['o_g_a'] : NULL;
                
                $o_g_b = isset($_POST['o_g_b']) ? $_POST['o_g_b'] : NULL;
                
                $o_g_c = isset($_POST['o_g_c']) ? $_POST['o_g_c'] : NULL;
               
                $o_g_d = isset($_POST['o_g_d']) ? $_POST['o_g_d'] : NULL;
               

                
                $residencia = isset($_POST['residencia']) ? $_POST['residencia'] : NULL;
               
                $publicaciones = isset($_POST['publicaciones']) ? $_POST['publicaciones'] : NULL;
                
                $otros_antec = isset($_POST['otros_antec']) ? $_POST['otros_antec'] : NULL;
                var_dump($otros_antec);
                exit;
                // Construir la consulta SQL para insertar los datos
                $sql_insert = "INSERT INTO _junta_movimientos (anodoc, legdoc, codmod, establecimiento, titulo, promedio, antiguedadgestion, antiguedadtitulo, serviciosprovincia, t_m_seccion, t_m_anio, t_m_grupo, t_m_ciclo,
                t_m_recupera, t_m_comple, t_m_biblio, t_m_gabinete,t_m_sec1, t_m_sec2, t_m_viced, t_d_pu,t_d_3, t_d_2, t_d_1, t_d_biblio,t_d_gabi, t_d_seccoortec, t_d_supsectec, t_d_supesc,t_d_supgral, t_d_adic, otros_serv, o_g_a,o_g_b, o_g_c, o_g_d,otrosservicios, residencia, publicaciones, otrosantecedentes, puntajetotal, codloc, tipo, horas, obs) 
                VALUES (:anodoc, :legdoc, :codmod, :establecimiento, :titulo, :promedio, :antiguedadgestion, :antiguedadtitulo, :serviciosprovincia, :t_m_seccion, :t_m_anio, :t_m_grupo, :t_m_ciclo,:t_m_recupera, :t_m_comple, :t_m_biblio, :t_m_gabinete,:t_m_sec1, :t_m_sec2, :t_m_viced, :t_d_pu,:t_d_3, :t_d_2, :t_d_1, :t_d_biblio,:t_d_gabi, :t_d_seccoortec, :t_d_supsectec, :t_d_supesc,:t_d_supgral, :t_d_adic, :otros_serv, :o_g_a,:o_g_b, :o_g_c, :o_g_d , :otros_serv, :residencia, :publicaciones, :otros_antec, :puntajetotal, :codloc, :tipo, :horas,:obs)";
                // Preparar la consulta
                $stmt_insert = $conn->prepare($sql_insert);

                // Vincular los parámetros
                $stmt_insert->bindParam(':legdoc', $legajo);
                $stmt_insert->bindParam(':anodoc', $anodoc);
                $stmt_insert->bindParam(':codmod', $codmod);
                $stmt_insert->bindParam(':establecimiento', $establecimiento);
                $stmt_insert->bindParam(':titulo', $titulo);
                $stmt_insert->bindParam(':promedio', $promedio);
                $stmt_insert->bindParam(':antiguedadgestion', $antiguedadgestion);
                $stmt_insert->bindParam(':antiguedadtitulo', $antiguedadtitulo);
                $stmt_insert->bindParam(':serviciosprovincia', $serviciosprovincia);
                $stmt_insert->bindParam(':t_m_seccion', $t_m_seccion);
                $stmt_insert->bindParam(':t_m_anio', $t_m_anio);
                $stmt_insert->bindParam(':t_m_grupo', $t_m_grupo);
                $stmt_insert->bindParam(':t_m_ciclo', $t_m_ciclo);
                $stmt_insert->bindParam(':t_m_recupera', $t_m_recupera);
                $stmt_insert->bindParam(':t_m_comple', $t_m_comple);
                $stmt_insert->bindParam(':t_m_biblio', $t_m_biblio);
                $stmt_insert->bindParam(':t_m_gabinete', $t_m_gabinete);
                $stmt_insert->bindParam(':t_m_sec1', $t_m_sec1);
                $stmt_insert->bindParam(':t_m_sec2', $t_m_sec2);
                $stmt_insert->bindParam(':t_m_viced', $t_m_viced);
                $stmt_insert->bindParam(':t_d_pu', $t_d_pu);
                $stmt_insert->bindParam(':t_d_3', $t_d_3);
                $stmt_insert->bindParam(':t_d_2', $t_d_2);
                $stmt_insert->bindParam(':t_d_1', $t_d_1);
                $stmt_insert->bindParam(':t_d_biblio', $t_d_biblio);
                $stmt_insert->bindParam(':t_d_gabi', $t_d_gabi);
                $stmt_insert->bindParam(':t_d_seccoortec', $t_d_seccoortec);
                $stmt_insert->bindParam(':t_d_supsectec', $t_d_supsectec);
                $stmt_insert->bindParam(':t_d_supesc', $t_d_supesc);
                $stmt_insert->bindParam(':t_d_supgral', $t_d_supgral);
                $stmt_insert->bindParam(':t_d_adic', $t_d_adic);
                $stmt_insert->bindParam(':otros_serv', $otros_serv);
                $stmt_insert->bindParam(':residencia', $residencia);
                $stmt_insert->bindParam(':publicaciones', $publicaciones);
                $stmt_insert->bindParam(':otros_antec', $otros_antec);
                $stmt_insert->bindParam(':puntajetotal', $puntajetotal);
                $stmt_insert->bindParam(':codloc', $codloc);
                $stmt_insert->bindParam(':tipo', $tipo);
                $stmt_insert->bindParam(':horas', $horas);
                $stmt_insert->bindParam(':obs', $obs);
                // Ejecutar la consulta
                if ($stmt_insert->execute()) {
                   // Mostrar alerta y redirigir a la página de registro con el legajo
                   echo "<script>
                   alert('Nuevo registro creado exitosamente.');
                   window.location.href = 'RegistroMovimiento.php?legajo=" . $legajo . "';
                 </script>";
                } else {
                    echo "Error al añadir el movimiento";
                }
            } else {
                echo "El legdoc no existe en la base de datos.";
            }
        }
    } else {
        echo "No se han enviado datos a través de POST.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos
$conn = null;

------------ hasta aca ----------

*/
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

    // Verificar si los datos se han enviado a través de POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger el valor legajo de la URL
        $legajo = isset($_POST['legajo']) ? $_POST['legajo'] : '';
        // Recoger el tipo de carga del formulario
        $tipoc = isset($_POST['tipoc']) ? $_POST['tipoc'] : '';

        // Verificar si el legajo está vacío
        if (empty($legajo)) {
            throw new Exception("El campo legajo está vacío.");
        } else {
            // Inicializar variables comunes a ambos tipos de carga
            $anodoc = isset($_POST['anodoc']) ? $_POST['anodoc'] : '';
            $codmod = isset($_POST['codmod']) ? $_POST['codmod'] : '';
            $establecimiento = isset($_POST['establecimiento']) ? $_POST['establecimiento'] : '';
            $codloc = isset($_POST['codloc']) ? $_POST['codloc'] : '';

            // Variables específicas para tipo de carga 'Interinatos y Suplencias', 'permanente' o 'Concurso de Titularidad'
            if ($tipoc === 'Interinatos' || $tipoc === 'permanente' || $tipoc === 'Concurso de Titularidad') {
                $titulo = isset($_POST['titulo2']) ? floatval($_POST['titulo2']) : 0;
                $promedio = isset($_POST['promedio2']) ? floatval($_POST['promedio2']) : 0;
                $antiguedadgestion = isset($_POST['antiguedadgestion2']) ? floatval($_POST['antiguedadgestion2']) : 0;
                $antiguedadtitulo = isset($_POST['antiguedadtitulo2']) ? floatval($_POST['antiguedadtitulo2']) : 0;
                $serviciosprovincia = isset($_POST['serviciosprovincia2']) ? floatval($_POST['serviciosprovincia2']) : 0;
                $otrosservicios = isset($_POST['otrosservicios2']) ? floatval($_POST['otrosservicios2']) : 0;
                $residencia = isset($_POST['residencia2']) ? floatval($_POST['residencia2']) : 0;
                $publicaciones = isset($_POST['publicaciones2']) ? floatval($_POST['publicaciones2']) : 0;
                $otrosantecedentes = isset($_POST['otrosantecedentes2']) ? floatval($_POST['otrosantecedentes2']) : 0;
               // $puntajetotal = isset($_POST['puntajetotal2']) ? floatval($_POST['puntajetotal2']) : 0;
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
                $otitulo = isset($_POST['otitulo2']) ? floatval($_POST['otitulo2']) : 0;
                $concepto = isset($_POST['concepto2']) ? floatval($_POST['concepto2']) : 0;

                // Calcular el puntaje total sumando los campos relevantes
                $puntajetotal = $titulo + $otitulo + $concepto + $promedio + $antiguedadgestion + $antiguedadtitulo + $serviciosprovincia + $otrosservicios + $residencia + $publicaciones + $otrosantecedentes;
                   
                // Convertir fecha al formato esperado por SQL Server (ejemplo: 'Y-m-d')
                if (!empty($fecha)) {
                    // Primero intentar crear un objeto DateTime desde el formato ISO (YYYY-MM-DD)
                    $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
                    // Si no se puede crear desde el formato ISO, intentar desde el formato esperado (d/m/Y)
                    if (!$fechaObj) {
                        $fechaObj = DateTime::createFromFormat('d/m/Y', $fecha);
                    }
                    if ($fechaObj) {
                        $fecha = $fechaObj->format('Y-m-d');
                    } else {
                        throw new Exception("Formato de fecha inválido. Debe ser 'd/m/Y'.");
                    }
                } else {
                    $fecha = null; // Asignar null si la fecha está vacía
                }

                // Definir la consulta SQL de inserción
                $sql_insert = "INSERT INTO _junta_movimientos 
                        (anodoc, legdoc, codmod, establecimiento, titulo, promedio, antiguedadgestion, antiguedadtitulo, serviciosprovincia, otrosservicios, residencia, publicaciones, otrosantecedentes, puntajetotal, codloc, tipo, T_m_comple, T_m_biblio, T_m_sec1, T_m_sec2, T_m_viced, obs, horas, fecha,otitulo,concepto) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CAST(? AS date),?,?)";

                $params_insert = array(
                    $anodoc, $legajo, $codmod, $establecimiento, $titulo, $promedio, $antiguedadgestion, $antiguedadtitulo, $serviciosprovincia, $otrosservicios, $residencia, $publicaciones, $otrosantecedentes, $puntajetotal, $codloc, $tipoc, $T_m_comple, $T_m_biblio, $T_m_sec1, $T_m_sec2, $T_m_viced, $obs, $horas, $fecha,$otitulo,$concepto
                );
                   
            } elseif ($tipoc === 'titulares') { // Variables específicas para tipo de carga 'titulares'
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
                $puntajetotal = $titulo + $otitulo + $concepto + $promedio + $antiguedadgestion + $antiguedadtitulo + $serviciosprovincia + $otrosservicios + $residencia + $publicaciones + $otrosantecedentes + $T_m_anio + $T_m_seccion + $T_m_grupo + $T_m_ciclo + $T_m_recupera + $T_d_pu + $T_d_3 + $T_d_2 + $T_d_1 + $T_d_biblio + $T_d_gabi + $T_d_seccoortec + $T_d_supsectec + $T_d_supesc + $T_d_supgral + $T_d_adic + $O_g_a + $O_g_b + $O_g_c + $O_g_d + $T_m_comple + $T_m_biblio + $T_m_gabinete + $T_m_sec1 + $T_m_sec2 + $T_m_viced;

               

                // Definir la consulta SQL de inserción
                $sql_insert = "INSERT INTO _junta_movimientos 
                        (anodoc, legdoc, codmod, establecimiento, puntajetotal, promedio, T_m_anio, T_m_seccion, T_m_grupo, T_m_ciclo, T_m_recupera, T_d_pu, T_d_3, T_d_2, T_d_1, T_d_biblio, T_d_gabi, T_d_seccoortec, T_d_supsectec, T_d_supesc, T_d_supgral, T_d_adic, O_g_a, O_g_b, O_g_c, O_g_d, codloc, tipo,obs,horas,otitulo,concepto,antiguedadgestion,antiguedadtitulo,titulo,serviciosprovincia,t_m_comple,t_m_biblio,t_m_gabinete,t_m_sec1,t_m_sec2,t_m_viced,otrosservicios,residencia,publicaciones,otrosantecedentes) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,? ,? ,? ,? ,? ,? ,? ,? ,?, ?, ?)";

                $params_insert = array(
                    $anodoc, $legajo, $codmod, $establecimiento, $puntajetotal, $promedio, $T_m_anio, $T_m_seccion, $T_m_grupo, $T_m_ciclo, $T_m_recupera, $T_d_pu, $T_d_3, $T_d_2, $T_d_1, $T_d_biblio, $T_d_gabi, $T_d_seccoortec, $T_d_supsectec, $T_d_supesc, $T_d_supgral, $T_d_adic, $O_g_a, $O_g_b, $O_g_c, $O_g_d, $codloc, $tipoc,$obs,$horas,$otitulo,$concepto,$antiguedadgestion,$antiguedadtitulo,$titulo,$serviciosprovincia, $T_m_comple, $T_m_biblio,$T_m_gabinete,$T_m_sec1,$T_m_sec2,$T_m_viced,$otrosservicios,$residencia,$publicaciones,$otrosantecedentes
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
                 echo "Datos insertados correctamente.";
                
                 // Mostrar mensaje y redireccionar después de 3 segundos
                 echo "<script>
                         // Mostrar mensaje por 5 segundos
                         setTimeout(function() {
                             alert('Los datos se han insertado correctamente.');
                             // Redireccionar a la página deseada
                             window.location.href = './VerInscripciones.php?legajo=".$legajo."';
                         }, 5000); // 3000 milisegundos = 3 segundos
                       </script>";
            }
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
sqlsrv_close($conn);
?>