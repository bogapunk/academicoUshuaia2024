<?php 
require_once 'movimientos.entidad.php';
require_once 'movimientos.model.php';
include('header2.php');


// Logica
$mov = new Movimiento();
$model = new MovimientosModel();

if(isset($_REQUEST['action']))
{
  switch($_REQUEST['action'])
  {
    case 'actualizar':
      $mov->__SET('tipo', $_REQUEST['tipo']);
      $mov->__SET('id2', $_REQUEST['id2']);
      $mov->__SET('t_m_seccion', $_REQUEST['t_m_seccion']);
      $mov->__SET('t_m_anio', $_REQUEST['t_m_anio']);
      $mov->__SET('t_m_grupo', $_REQUEST['t_m_grupo']);
      $mov->__SET('t_m_ciclo', $_REQUEST['t_m_ciclo']);
      $mov->__SET('t_m_recupera', $_REQUEST['t_m_recupera']);
      $mov->__SET('t_d_pu', $_REQUEST['t_d_pu']);
      $mov->__SET('t_d_3', $_REQUEST['t_d_3']);
      $mov->__SET('t_d_2', $_REQUEST['t_d_2']);
      $mov->__SET('t_d_1', $_REQUEST['t_d_1']);
      $mov->__SET('t_d_biblio', $_REQUEST['t_d_biblio']);
      $mov->__SET('t_d_gabi', $_REQUEST['t_d_gabi']);
      $mov->__SET('t_d_seccoortec', $_REQUEST['t_d_seccoortec']);
      $mov->__SET('t_d_supsectec', $_REQUEST['t_d_supsectec']);
      $mov->__SET('t_d_supesc', $_REQUEST['t_d_supesc']);
      $mov->__SET('t_d_supgral', $_REQUEST['t_d_supgral']);
      $mov->__SET('t_d_adic', $_REQUEST['t_d_adic']);
      $mov->__SET('o_g_a', $_REQUEST['o_g_a']);
      $mov->__SET('o_g_b', $_REQUEST['o_g_b']);
      $mov->__SET('o_g_c', $_REQUEST['o_g_c']);
      $mov->__SET('o_g_d', $_REQUEST['o_g_d']);
      $mov->__SET('concepto', $_REQUEST['concepto']);
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
      $mov->__SET('t_m_biblio', $_REQUEST['t_m_biblio']);
      $mov->__SET('t_m_sec1', $_REQUEST['t_m_sec1']);
      $mov->__SET('t_m_sec2', $_REQUEST['t_m_sec2']);
      $mov->__SET('t_m_viced', $_REQUEST['t_m_viced']);
      $mov->__SET('t_m_gabinete', $_REQUEST['t_m_gabinete']);
      $mov->__SET('obs', $_REQUEST['obs']);
      $mov->__SET('horas', $_REQUEST['horas']);
      $mov->__SET('legvinc', $_REQUEST['legvinc']);
      $mov->__SET('hijos', $_REQUEST['hijos']);
      $mov->__SET('excluido', $_REQUEST['excluido']);
      $mov->__SET('fecha', $_REQUEST['fecha']);
      $mov->__SET('trial513', $_REQUEST['trial513']);

  
      $model->ActualizarMovimiento($mov);
     // header('Location: index.php');
      break;

    case 'registrar':
      $mov->__SET('tipo', $_REQUEST['tipo']);
      $mov->__SET('id2', $_REQUEST['id2']);
      $mov->__SET('t_m_seccion', $_REQUEST['t_m_seccion']);
      $mov->__SET('t_m_anio', $_REQUEST['t_m_anio']);
      $mov->__SET('t_m_grupo', $_REQUEST['t_m_grupo']);
      $mov->__SET('t_m_ciclo', $_REQUEST['t_m_ciclo']);
      $mov->__SET('t_m_recupera', $_REQUEST['t_m_recupera']);
      $mov->__SET('t_d_pu', $_REQUEST['t_d_pu']);
      $mov->__SET('t_d_3', $_REQUEST['t_d_3']);
      $mov->__SET('t_d_2', $_REQUEST['t_d_2']);
      $mov->__SET('t_d_1', $_REQUEST['t_d_1']);
      $mov->__SET('t_d_biblio', $_REQUEST['t_d_biblio']);
      $mov->__SET('t_d_gabi', $_REQUEST['t_d_gabi']);
      $mov->__SET('t_d_seccoortec', $_REQUEST['t_d_seccoortec']);
      $mov->__SET('t_d_supsectec', $_REQUEST['t_d_supsectec']);
      $mov->__SET('t_d_supesc', $_REQUEST['t_d_supesc']);
      $mov->__SET('t_d_supgral', $_REQUEST['t_d_supgral']);
      $mov->__SET('t_d_adic', $_REQUEST['t_d_adic']);
      $mov->__SET('o_g_a', $_REQUEST['o_g_a']);
      $mov->__SET('o_g_b', $_REQUEST['o_g_b']);
      $mov->__SET('o_g_c', $_REQUEST['o_g_c']);
      $mov->__SET('o_g_d', $_REQUEST['o_g_d']);
      $mov->__SET('concepto', $_REQUEST['concepto']);
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
      $mov->__SET('t_m_biblio', $_REQUEST['t_m_biblio']);
      $mov->__SET('t_m_sec1', $_REQUEST['t_m_sec1']);
      $mov->__SET('t_m_sec2', $_REQUEST['t_m_sec2']);
      $mov->__SET('t_m_viced', $_REQUEST['t_m_viced']);
      $mov->__SET('t_m_gabinete', $_REQUEST['t_m_gabinete']);
      $mov->__SET('obs', $_REQUEST['obs']);
      $mov->__SET('horas', $_REQUEST['horas']);
      $mov->__SET('legvinc', $_REQUEST['legvinc']);
      $mov->__SET('hijos', $_REQUEST['hijos']);
      $mov->__SET('excluido', $_REQUEST['excluido']);
      $mov->__SET('fecha', $_REQUEST['fecha']);
      $mov->__SET('trial513', $_REQUEST['trial513']);
      
      $model->RegistrarMovimiento($id2);
      //header('Location:ListarModalidades.php');
      break;

    case 'eliminar':
      $model->EliminarMovimiento($_REQUEST['id2']);
      //header('Location:ListarModalidades.php');
      break;

    case 'editar':
     $mov = $model->ObtenerMovimiento($_REQUEST['id2']);

    case 'modificar':
     $mov = $model->ObtenerMovimiento($_REQUEST['id2']);
    
      break;
  }
}

function traenombremodalidad($cual) {
                $sqlNroNota = "SELECT * FROM _junta_modalidades WHERE codmod = $cual ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traenombremodalidad = "No existe a descripcion para esta modalidad :" . $cual;
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traenombremodalidad = $row["nommod"];
                }

                mysqli_close($con);

                return $traenombremodalidad;
              }

              function traeestablecimiento($cual) {
                $sqlNroNota = "SELECT * FROM _junta_dependencias WHERE coddep = $cual ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traeestablecimiento = " - ";
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traeestablecimiento = $row["nomdep"];
                }

                mysqli_close($con);

                return $traeestablecimiento;
              }

              function traenombredoc($doc) {
                $sqlNroNota = "SELECT * FROM _junta_docentes WHERE legajo =$mov ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traenombredoc = "No existe el docente :" .$mov;
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traenombredoc = $row["ApellidoyNombre"];
                }

                mysqli_close($con);

                return $traenombredoc;
              }

              function traepuntaje($anio, $modalidad,$mov, $esc, $eltipo) {
                $sqlNroNota = "SELECT puntajetotal FROM _junta_movimientos WHERE legdoc =$mov AND anodoc = $anio AND codmod = $modalidad AND establecimiento = $esc AND tipo = '$eltipo' ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traepuntaje = "No existe el docente :" .$mov;
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traepuntaje = $row["puntajetotal"]; // Cast to integer if needed
                }

                mysqli_close($con);

                return $traepuntaje;
              }

function junta_inscripcion_es_antartida($codloc) {
    $c = strtoupper(trim((string) $codloc));
    if ($c === '') {
        return false;
    }
    return in_array($c, ['ANT', 'ANT1', 'ANTARTIDA'], true) || strpos($c, 'ANT') === 0;
}

function junta_inscripcion_es_excluido($row, $tipoNorm, $puntaje) {
    if ($puntaje == 0) {
        return true;
    }
    if (in_array($tipoNorm, ['excluido', 'excluidos'], true)) {
        return true;
    }
    $ex = isset($row['excluido']) ? trim((string) $row['excluido']) : '';
    if ($ex === '' || $ex === '23' || strcasecmp($ex, 'no') === 0) {
        return false;
    }
    return true;
}

function junta_inscripcion_normalizar_tipo($tipoRaw) {
    $tipo = strtolower(trim((string) $tipoRaw));
    if ($tipo === 'listado permanentes' || $tipo === 'permanente') {
        return 'permanente';
    }
    if ($tipo === 'titular' || $tipo === 'titulares') {
        return 'titulares';
    }
    if (in_array($tipo, ['interino', 'interinos', 'suplente', 'suplencia', 'interino y suple.', 'transitorio'], true)) {
        return 'transitorio';
    }
    if (strpos($tipo, 'concurso') !== false) {
        return 'concurso';
    }
    if (in_array($tipo, ['excluido', 'excluidos'], true)) {
        return 'excluido';
    }
    return $tipo;
}

function junta_inscripcion_clasificar_tipo($row) {
    $tipoRaw = isset($row['tipo']) ? $row['tipo'] : '';
    $tipoNorm = junta_inscripcion_normalizar_tipo($tipoRaw);

    switch ($tipoNorm) {
        case 'permanente':
            return [
                'label' => 'Permanentes',
                'badge' => 'ins-badge ins-badge--permanente',
                'row' => 'ins-row--permanente',
                'accent' => '#64748b',
                'filtro' => 'permanente',
            ];
        case 'titulares':
            return [
                'label' => 'Titulares',
                'badge' => 'ins-badge ins-badge--titulares',
                'row' => 'ins-row--titulares',
                'accent' => '#ca8a04',
                'filtro' => 'titulares',
            ];
        case 'transitorio':
            return [
                'label' => 'Interinatos y Suplencias',
                'badge' => 'ins-badge ins-badge--transitorio',
                'row' => 'ins-row--interino',
                'accent' => '#8b5cf6',
                'filtro' => 'transitorio',
            ];
        case 'concurso':
            return [
                'label' => 'Concurso de Titularidad',
                'badge' => 'ins-badge ins-badge--concurso',
                'row' => 'ins-row--concurso',
                'accent' => '#0ea5e9',
                'filtro' => 'concurso',
            ];
        case 'excluido':
            return [
                'label' => 'Excluidos',
                'badge' => 'ins-badge ins-badge--default',
                'row' => 'ins-row--default',
                'accent' => '#94a3b8',
                'filtro' => 'excluido_tipo',
            ];
        default:
            return [
                'label' => $tipoRaw !== '' ? (string) $tipoRaw : 'Sin categoría',
                'badge' => 'ins-badge ins-badge--default',
                'row' => 'ins-row--default',
                'accent' => '#94a3b8',
                'filtro' => $tipoNorm !== '' ? $tipoNorm : 'default',
            ];
    }
}

function junta_inscripcion_estado($row) {
    $tipoNorm = junta_inscripcion_normalizar_tipo($row['tipo'] ?? '');
    $puntaje = floatval($row['puntajetotal'] ?? 0);
    if (junta_inscripcion_es_excluido($row, $tipoNorm, $puntaje)) {
        return [
            'label' => 'Excluido',
            'badge' => 'ins-badge ins-badge--estado-excluido',
            'filtro' => 'excluido',
        ];
    }
    return [
        'label' => 'Activo',
        'badge' => 'ins-badge ins-badge--estado-activo',
        'filtro' => 'activo',
    ];
}

function junta_inscripcion_localidad($codloc) {
    $c = strtoupper(trim((string) $codloc));
    $map = [
        'USH' => ['label' => 'Ushuaia', 'filtro' => 'ush', 'badge' => 'ins-badge ins-badge--loc-ush'],
        'RGD' => ['label' => 'Río Grande', 'filtro' => 'rgd', 'badge' => 'ins-badge ins-badge--loc-rgd'],
        'TOL' => ['label' => 'Tolhuin', 'filtro' => 'tol', 'badge' => 'ins-badge ins-badge--loc-tol'],
        'ANT' => ['label' => 'Antártida', 'filtro' => 'ant', 'badge' => 'ins-badge ins-badge--loc-ant'],
        'ANT1' => ['label' => 'Antártida', 'filtro' => 'ant', 'badge' => 'ins-badge ins-badge--loc-ant'],
    ];
    if (isset($map[$c])) {
        return $map[$c];
    }
    if ($c !== '' && strpos($c, 'ANT') === 0) {
        return $map['ANT'];
    }
    return [
        'label' => $c !== '' ? $c : 'Sin asignar',
        'filtro' => 'sin',
        'badge' => 'ins-badge ins-badge--loc-sin',
    ];
}

function junta_inscripcion_anterior($legvinc) {
    $v = trim((string) $legvinc);
    if ($v === '' || $v === '0' || $v === '0.0' || floatval($v) == 0) {
        return [
            'label' => 'No',
            'badge' => 'ins-badge ins-badge--anterior-no',
            'filtro' => 'no',
        ];
    }
    return [
        'label' => 'Sí',
        'badge' => 'ins-badge ins-badge--anterior-si',
        'filtro' => 'si',
    ];
}

function junta_inscripcion_texto_establecimiento($row, $tipoFiltro = '')
{
    $tiposSinEstablecimiento = ['permanente', 'transitorio', 'concurso'];
    if (in_array($tipoFiltro, $tiposSinEstablecimiento, true)) {
        return ['texto' => '-', 'muted' => true];
    }

    $nomdep = isset($row['nomdep']) ? trim((string) $row['nomdep']) : '';
    $establecimiento = isset($row['establecimiento']) ? $row['establecimiento'] : 0;

    if ($nomdep === '' || $nomdep === '-' || $establecimiento == 0) {
        return ['texto' => '-', 'muted' => true];
    }

    if (preg_match('/no\s+tiene\s+establecimiento/i', $nomdep)) {
        return ['texto' => '-', 'muted' => true];
    }

    return ['texto' => $nomdep, 'muted' => false];
}

function junta_inscripcion_clasificar($row) {
    return junta_inscripcion_clasificar_tipo($row);
}

?>
<!-- Begin Page Content -->

<style type="text/css">


  

.nav>li>a {
    position: relative;
    display: block;
    padding: 7px 15px;
}

thead{

    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
}
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
* {
    margin: 0;
    padding: 0;
    border: o none;
    position: relative;
}
#menu_gral {
    font-family: verdana, sans sherif;
    width: 80%;
    margin: 1.5rem auto;
}
#menu_gral ul {
    list-style-type: none; 
    text-align: left;
    font-size: 0;
}
#menu_gral > ul li {
    display: inline-block;
    width: 25%;
    position: relative;
    background: #ffffff;
}
#menu_gral li a {
    display: block;
    text-decoration: none;
    font-size: 2rem;
    font-family: 'Roboto', sans-serif;
    background-color: #2698f3;
    font-size: 18px;
    line-height: 4rem;
    color: #fff;
}
#menu_gral li:hover a, #menu_gral li a:focus {
    background: #e55916;
    color: #fff;
}

#menu_gral li ul {
    position: absolute;
    width: 0;
    overflow: hidden;
}
#menu_gral li:hover ul, #menu_gral li:focus ul {
    width: 110%;
    margin: 0 -4rem -4rem -4rem;
    padding: 0 4rem 4rem 4rem;
   
    z-index: 5;
}
#menu_gral li li {
    display: block;
    width: 130%;
}
#menu_gral li:hover li a, #menu_gral li:focus li a {
    font-family: monospace;
    font-size: .9rem;
    line-height: 1.7rem;
    border-top: 1px solid #e5e5e5;
    background: #e55916;
}
#menu_gral li li a:hover, #menu_gral li li a:focus {
    background: #8AA9B8; 
}
.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}

.btn-flotante {
  font-size: 10px; /* Cambiar el tamaño de la tipografia */
  text-transform: uppercase; /* Texto en mayusculas */
  font-weight: bold; /* Fuente en negrita o bold */
  color: #FFFFFF; /* Color del texto */
  border-radius: 5px; /* Borde del boton */
  letter-spacing: 2px; /* Espacio entre letras */
  background-color: #2698f3; /* Color de fondo */
  padding: 15px 15px; /* Relleno del boton */
  position: fixed;
  bottom: 5px;
  right: 20px;
  transition: all 300ms ease 0ms;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  z-index: 99;
}
.btn-flotante:hover {
  background-color: #e55916; /* Color de fondo al pasar el cursor */
  box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
  transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
  .btn-flotante {
    font-size: 5px;
    padding: 12px 20px;
    bottom: 20px;
    right: 20px;
  }
}

/* —— Listado de Inscripciones (solo presentación) —— */
.ins-list-shell {
  --ins-primary: #004481;
  --ins-primary-light: #2b8fd9;
  --ins-navy: #003366;
  --ins-muted: #6b7280;
  --ins-surface: #f3f5f9;
  --ins-card: #ffffff;
  --ins-radius: 16px;
  --ins-shadow: 0 12px 40px rgba(15, 23, 42, 0.1);
  --ins-border: rgba(15, 23, 42, 0.06);
  background: var(--ins-surface);
  padding: clamp(1.75rem, 3vw, 2.5rem) 0 clamp(2.5rem, 4vw, 3.25rem);
  margin: 0 -15px;
  padding-left: clamp(6px, 1.5vw, 20px);
  padding-right: clamp(6px, 1.5vw, 20px);
  box-sizing: border-box;
}
.ins-list-card {
  width: 100%;
  max-width: min(1900px, calc(100vw - 12px));
  margin: 0 auto;
  background: var(--ins-card);
  border-radius: var(--ins-radius);
  box-shadow: var(--ins-shadow);
  border: 1px solid var(--ins-border);
  padding: clamp(2rem, 3.2vw, 2.85rem) clamp(1.75rem, 3.8vw, 2.85rem) clamp(2.5rem, 3.8vw, 3.15rem);
}
.ins-list-header {
  text-align: center;
  margin-bottom: clamp(1.5rem, 2.8vw, 2.35rem);
  padding-bottom: clamp(1.1rem, 2vw, 1.5rem);
  border-bottom: 1px solid rgba(30, 74, 140, 0.12);
}
.ins-list-title {
  display: inline-block;
  font-size: clamp(2rem, 3.2vw, 2.75rem);
  font-weight: 700;
  color: var(--ins-primary);
  margin: 0 0 0.65rem;
  letter-spacing: -0.02em;
  line-height: 1.15;
  padding-bottom: 0.55rem;
  border-bottom: 5px solid var(--ins-primary-light);
}
.ins-list-subtitle {
  font-size: clamp(1.08rem, 1.5vw, 1.22rem);
  color: var(--ins-muted);
  margin: 0.5rem 0 0;
  font-weight: 400;
  max-width: min(72rem, 100%);
  margin-left: auto;
  margin-right: auto;
  line-height: 1.5;
}
.ins-docente-card {
  display: flex;
  align-items: center;
  gap: 1.15rem;
  padding: clamp(1.15rem, 2.1vw, 1.45rem) clamp(1.2rem, 2.2vw, 1.55rem);
  margin-bottom: clamp(1.35rem, 2.5vw, 1.85rem);
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
}
.ins-docente-avatar {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  background: linear-gradient(145deg, var(--ins-primary-light), var(--ins-navy));
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.35rem;
  flex-shrink: 0;
}
.ins-docente-label {
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--ins-muted);
  margin: 0 0 0.25rem;
}
.ins-docente-name {
  font-size: clamp(1.28rem, 2.1vw, 1.55rem);
  font-weight: 700;
  color: #111827;
  margin: 0;
  line-height: 1.25;
}
.ins-toolbar {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 1.25rem 1.5rem;
  margin-bottom: clamp(1.35rem, 2.5vw, 1.85rem);
}
.ins-toolbar-actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 12px;
}
.ins-toolbar-filter {
  display: none;
}
.ins-filters-panel {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 0.85rem 1rem;
  margin: 0 0 clamp(1rem, 2vw, 1.35rem);
  padding: 1rem 1.1rem;
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
  border: 1px solid var(--ins-border);
  border-radius: 12px;
}
.ins-filter-item {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
  min-width: 0;
}
.ins-filter-item label {
  margin: 0;
  font-weight: 600;
  color: #374151;
  font-size: 0.88rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.ins-filter-select {
  width: 100% !important;
  min-width: 0;
  border-radius: 10px !important;
  border: 1px solid #d1d5db !important;
  padding: 0.55rem 2rem 0.55rem 0.75rem !important;
  min-height: 44px;
  height: auto !important;
  font-size: 0.95rem;
  line-height: 1.3;
  font-weight: 500;
  color: #1f2937;
  background-color: #fff;
}
.ins-filter-select option {
  font-size: 0.95rem;
}
.ins-table-wrap {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  border-radius: 12px;
  border: 1px solid var(--ins-border);
}
.ins-dashboard-table {
  table-layout: fixed;
  width: 100%;
  min-width: 1280px;
  margin: 0;
  border-collapse: separate;
  border-spacing: 0;
  font-size: clamp(1.15rem, 1.5vw, 1.3rem);
  border: none !important;
}
/* Reparto de anchos (11 columnas) */
.ins-dashboard-table thead th:nth-child(1),
.ins-dashboard-table tbody td:nth-child(1) { width: 3.5%; }
.ins-dashboard-table thead th:nth-child(2),
.ins-dashboard-table tbody td:nth-child(2) { width: 4.5%; }
.ins-dashboard-table thead th:nth-child(3),
.ins-dashboard-table tbody td:nth-child(3) { width: 16%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(4),
.ins-dashboard-table tbody td:nth-child(4) { width: 13%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(5),
.ins-dashboard-table tbody td:nth-child(5) { width: 5%; }
.ins-dashboard-table thead th:nth-child(6),
.ins-dashboard-table tbody td:nth-child(6) { width: 11%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(7),
.ins-dashboard-table tbody td:nth-child(7) { width: 7%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(8),
.ins-dashboard-table tbody td:nth-child(8) { width: 8%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(9),
.ins-dashboard-table tbody td:nth-child(9) { width: 6%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(10),
.ins-dashboard-table tbody td:nth-child(10) { width: 7%; min-width: 0; }
.ins-dashboard-table thead th:nth-child(11),
.ins-dashboard-table tbody td:nth-child(11) {
  width: 19%;
  min-width: 210px;
}
.ins-dashboard-table thead th:nth-child(6) {
  font-size: clamp(1rem, 1.25vw, 1.15rem);
}
.ins-dashboard-table thead th {
  background: linear-gradient(180deg, #0f5494, #004481) !important;
  color: #fff !important;
  font-weight: 700;
  text-align: center !important;
  vertical-align: middle !important;
  padding: clamp(1.05rem, 1.6vw, 1.3rem) clamp(0.72rem, 1.28vw, 1.08rem) !important;
  font-size: clamp(1.1rem, 1.3vw, 1.2rem);
  line-height: 1.35;
  border: none !important;
  white-space: nowrap;
  cursor: default;
}
.ins-dashboard-table thead th:first-child {
  border-radius: 11px 0 0 0;
}
.ins-dashboard-table thead th:last-child {
  border-radius: 0 11px 0 0;
}
.ins-dashboard-table thead th i.glyphicon {
  display: inline-block;
  position: relative;
  top: -0.11em;
  vertical-align: middle;
  line-height: 1;
  width: 1.1em;
  height: 1em;
  margin: 0 0.45rem 0 0;
  padding: 0;
  opacity: 0.95;
  font-size: 0.92em;
  text-align: center;
  -webkit-font-smoothing: antialiased;
}
.ins-dashboard-table tbody td {
  font-weight: 700;
  font-size: clamp(1.1rem, 1.4vw, 1.25rem);
  padding: clamp(1.05rem, 1.5vw, 1.25rem) clamp(0.72rem, 1.22vw, 1.08rem) !important;
  vertical-align: middle !important;
  text-align: center !important;
  border-bottom: 1px solid #e8ecf2 !important;
  border-top: none !important;
  border-left: none !important;
  border-right: none !important;
}
.ins-dashboard-table tbody tr {
  transition: background 0.15s ease, box-shadow 0.15s ease;
}
/* Fondo de fila por tipo de inscripción / estado (sustituye el zebra genérico) */
.ins-dashboard-table tbody tr.ins-row--concurso td {
  background-color: #e3f2fd !important;
}
.ins-dashboard-table tbody tr.ins-row--permanente td {
  background-color: #eceff1 !important;
}
.ins-dashboard-table tbody tr.ins-row--titulares td {
  background-color: #fffde7 !important;
}
.ins-dashboard-table tbody tr.ins-row--interino td {
  background-color: #f5f3ff !important;
}
.ins-dashboard-table tbody tr.ins-row--antartida td {
  background-color: #e0f7fa !important;
}
.ins-dashboard-table tbody tr.ins-row--puntaje0 td,
.ins-dashboard-table tbody tr.ins-row--excluido td {
  background-color: #fee2e2 !important;
}
.ins-dashboard-table tbody tr.ins-row--default td {
  background-color: #f8fafc !important;
}
.ins-dashboard-table tbody tr.ins-row--concurso:hover td {
  background-color: #bbdefb !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr.ins-row--permanente:hover td {
  background-color: #cfd8dc !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr.ins-row--titulares:hover td {
  background-color: #fff9c4 !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr.ins-row--interino:hover td {
  background-color: #ddd6fe !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr.ins-row--antartida:hover td {
  background-color: #b2ebf2 !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr.ins-row--puntaje0:hover td,
.ins-dashboard-table tbody tr.ins-row--excluido:hover td {
  background-color: #fecaca !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr.ins-row--default:hover td {
  background-color: #e2e8f0 !important;
  box-shadow: none;
}
.ins-dashboard-table tbody tr:last-child td {
  border-bottom: none !important;
}
.ins-row-accent {
  box-shadow: inset 4px 0 0 0 var(--accent, #94a3b8);
}
.ins-cell-establecimiento {
  max-width: 100%;
  min-width: 0;
  text-align: center !important;
  overflow-wrap: break-word;
  word-break: break-word;
  hyphens: auto;
  line-height: 1.45;
  max-height: 10em;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
}
.ins-cell-desc {
  min-width: 0 !important;
  max-width: 100%;
  overflow-wrap: break-word;
  word-break: break-word;
  hyphens: auto;
  line-height: 1.45;
  max-height: 10em;
  overflow-y: auto;
  overflow-x: hidden;
  -webkit-overflow-scrolling: touch;
  text-align: center !important;
}
.ins-cell-desc-inner {
  display: block;
  width: 100%;
  font-weight: 700;
}
.ins-cell-tipo {
  min-width: 0 !important;
  max-width: 100%;
  overflow-wrap: break-word;
  word-break: break-word;
  vertical-align: middle !important;
  text-align: center !important;
  font-size: clamp(1.22rem, 1.55vw, 1.38rem);
}
.ins-dashboard-table .ins-cell-tipo .ins-badge,
.ins-dashboard-table .ins-cell-estado .ins-badge,
.ins-dashboard-table .ins-cell-localidad .ins-badge,
.ins-dashboard-table .ins-cell-anterior .ins-badge {
  max-width: 100%;
  white-space: normal;
  word-break: break-word;
  display: inline-block;
  vertical-align: middle;
  text-align: center;
  box-sizing: border-box;
  font-weight: 700;
  font-size: clamp(0.88rem, 1.1vw, 0.98rem);
  padding: 0.25rem 0.55rem;
}
.ins-dashboard-table .acciones-inscripciones .btn,
.ins-dashboard-table .acciones-inscripciones a.btn,
.ins-dashboard-table .acciones-inscripciones button.btn {
  height: 28px !important;
  min-height: 28px !important;
  max-height: 28px !important;
  padding: 0 4px !important;
  font-size: 10px !important;
  gap: 3px !important;
}
.ins-dashboard-table .acciones-inscripciones .btn .acciones-inscripciones-label {
  font-size: 10px !important;
}
.ins-dashboard-table .acciones-inscripciones .btn .glyphicon,
.ins-dashboard-table .acciones-inscripciones .btn i.glyphicon {
  font-size: 10px !important;
}
.ins-dashboard-table .acciones-inscripciones {
  gap: 4px !important;
}
.ins-cell-acciones {
  min-width: 210px !important;
  width: 19% !important;
  white-space: normal !important;
  vertical-align: middle !important;
  position: sticky;
  right: 0;
  z-index: 2;
  box-shadow: -8px 0 14px -10px rgba(15, 23, 42, 0.18);
  overflow-x: visible;
  overflow-y: visible;
}
.ins-dashboard-table tbody tr.ins-row--concurso td.ins-cell-acciones {
  background: #e3f2fd !important;
}
.ins-dashboard-table tbody tr.ins-row--permanente td.ins-cell-acciones {
  background: #eceff1 !important;
}
.ins-dashboard-table tbody tr.ins-row--titulares td.ins-cell-acciones {
  background: #fffde7 !important;
}
.ins-dashboard-table tbody tr.ins-row--interino td.ins-cell-acciones {
  background: #f5f3ff !important;
}
.ins-dashboard-table tbody tr.ins-row--antartida td.ins-cell-acciones {
  background: #e0f7fa !important;
}
.ins-dashboard-table tbody tr.ins-row--puntaje0 td.ins-cell-acciones,
.ins-dashboard-table tbody tr.ins-row--excluido td.ins-cell-acciones {
  background: #fee2e2 !important;
}
.ins-dashboard-table tbody tr.ins-row--default td.ins-cell-acciones {
  background: #f8fafc !important;
}
.ins-dashboard-table tbody tr.ins-row--concurso:hover td.ins-cell-acciones {
  background: #bbdefb !important;
}
.ins-dashboard-table tbody tr.ins-row--permanente:hover td.ins-cell-acciones {
  background: #cfd8dc !important;
}
.ins-dashboard-table tbody tr.ins-row--titulares:hover td.ins-cell-acciones {
  background: #fff9c4 !important;
}
.ins-dashboard-table tbody tr.ins-row--interino:hover td.ins-cell-acciones {
  background: #ddd6fe !important;
}
.ins-dashboard-table tbody tr.ins-row--antartida:hover td.ins-cell-acciones {
  background: #b2ebf2 !important;
}
.ins-dashboard-table tbody tr.ins-row--puntaje0:hover td.ins-cell-acciones,
.ins-dashboard-table tbody tr.ins-row--excluido:hover td.ins-cell-acciones {
  background: #fecaca !important;
}
.ins-dashboard-table tbody tr.ins-row--default:hover td.ins-cell-acciones {
  background: #e2e8f0 !important;
}
.ins-dashboard-table thead th:last-child {
  position: sticky;
  right: 0;
  z-index: 3;
  box-shadow: -10px 0 18px -12px rgba(0, 0, 0, 0.18);
}
.ins-fecha-cell {
  min-width: 0;
  overflow-wrap: break-word;
  word-break: break-word;
  line-height: 1.35;
  max-height: 4.2em;
  overflow-y: auto;
}
.ins-dashboard-table .ins-cell-muted,
.ins-cell-muted {
  color: var(--ins-muted);
  font-size: 1.15rem;
  font-style: italic;
  font-weight: 700;
}
.ins-fecha-cell i {
  margin-right: 0.35rem;
  color: var(--ins-muted);
  font-size: 1.1rem;
}
.ins-badge {
  display: inline-block;
  padding: 0.3rem 0.78rem;
  border-radius: 999px;
  font-size: 1.05rem;
  font-weight: 700;
  line-height: 1.25;
}
.ins-badge--titulares {
  background: #fef9c3;
  color: #854d0e;
  border: 1px solid rgba(133, 77, 14, 0.12);
}
.ins-badge--permanente {
  background: #e2e8f0;
  color: #334155;
  border: 1px solid rgba(51, 65, 85, 0.12);
}
.ins-badge--permanente-low {
  background: #ede9fe;
  color: #5b21b6;
  border: 1px solid rgba(91, 33, 182, 0.12);
}
.ins-badge--concurso {
  background: #dbeafe;
  color: #1e40af;
  border: 1px solid rgba(30, 64, 175, 0.12);
}
.ins-badge--transitorio {
  background: #ede9fe;
  color: #5b21b6;
  border: 1px solid rgba(91, 33, 182, 0.12);
}
.ins-badge--antartida {
  background: #cffafe;
  color: #0e7490;
  border: 1px solid rgba(14, 116, 144, 0.18);
  font-weight: 700;
}
.ins-badge--excluido,
.ins-badge--puntaje0 {
  background: #fecaca;
  color: #991b1b;
  border: 1px solid rgba(153, 27, 27, 0.18);
  font-weight: 800;
}
.ins-badge--estado-activo {
  background: #d1fae5;
  color: #065f46;
  border: 1px solid rgba(6, 95, 70, 0.15);
}
.ins-badge--estado-excluido {
  background: #fecaca;
  color: #991b1b;
  border: 1px solid rgba(153, 27, 27, 0.18);
  font-weight: 700;
}
.ins-badge--loc-ush {
  background: #e0e7ff;
  color: #3730a3;
  border: 1px solid rgba(55, 48, 163, 0.12);
}
.ins-badge--loc-rgd {
  background: #fce7f3;
  color: #9d174d;
  border: 1px solid rgba(157, 23, 77, 0.12);
}
.ins-badge--loc-tol {
  background: #f3e8ff;
  color: #6b21a8;
  border: 1px solid rgba(107, 33, 168, 0.12);
}
.ins-badge--loc-ant {
  background: #cffafe;
  color: #0e7490;
  border: 1px solid rgba(14, 116, 144, 0.18);
}
.ins-badge--loc-sin {
  background: #f3f4f6;
  color: #6b7280;
  border: 1px solid rgba(107, 114, 128, 0.12);
}
.ins-badge--anterior-si {
  background: #fef3c7;
  color: #92400e;
  border: 1px solid rgba(146, 64, 14, 0.15);
}
.ins-badge--anterior-no {
  background: #f3f4f6;
  color: #4b5563;
  border: 1px solid rgba(75, 85, 99, 0.12);
}
.ins-badge--default {
  background: #f3f4f6;
  color: #4b5563;
  border: 1px solid rgba(75, 85, 99, 0.12);
}
.ins-tipo-leyenda {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin: 0 0 clamp(1rem, 2vw, 1.35rem);
  padding: 0.85rem 1.1rem;
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
  border: 1px solid var(--ins-border);
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
}
.ins-leyenda-grupo {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 0.5rem 0.65rem;
}
.ins-leyenda-grupo-titulo {
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--ins-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  min-width: 7.5rem;
}
.ins-leyenda-titulo {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--ins-primary);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-right: 0.25rem;
}
.ins-leyenda-titulo .glyphicon {
  font-size: 0.95em;
  opacity: 0.9;
}
.ins-leyenda-lista {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 0.5rem 0.75rem;
  list-style: none;
  margin: 0;
  padding: 0;
}
.ins-leyenda-lista li {
  margin: 0;
  padding: 0;
}
.ins-leyenda-lista button.ins-badge {
  border: none;
  font-family: inherit;
}
.ins-leyenda-lista .ins-badge {
  font-size: 0.92rem;
  padding: 0.28rem 0.72rem;
  cursor: pointer;
  transition: transform 0.12s ease, box-shadow 0.12s ease;
}
.ins-leyenda-lista .ins-badge:hover,
.ins-leyenda-lista .ins-badge:focus {
  transform: translateY(-1px);
  box-shadow: 0 2px 6px rgba(15, 23, 42, 0.12);
  outline: none;
}
.ins-leyenda-lista .ins-badge.ins-leyenda-activa {
  box-shadow: 0 0 0 2px var(--ins-primary-light);
}
.ins-list-card > p {
  margin: 0.85rem 0;
  padding: 0.9rem 1.15rem;
  border-radius: 10px;
  background: #f8fafc;
  color: #475569;
  border: 1px solid var(--ins-border);
  font-size: 1.05rem;
}

@media (max-width: 1400px) {
  .ins-dashboard-table thead th:nth-child(11),
  .ins-dashboard-table tbody td:nth-child(11),
  .ins-cell-acciones {
    min-width: 108px !important;
    width: 108px !important;
    max-width: 108px !important;
    vertical-align: middle !important;
  }
  .ins-dashboard-table thead th:nth-child(11) {
    white-space: normal;
    line-height: 1.2;
    font-size: clamp(0.95rem, 1.1vw, 1.05rem);
    padding-left: 0.35rem !important;
    padding-right: 0.35rem !important;
  }
}

@media (min-width: 1401px) and (max-width: 1799px) {
  .ins-dashboard-table thead th:nth-child(11),
  .ins-dashboard-table tbody td:nth-child(11),
  .ins-cell-acciones {
    min-width: 120px !important;
    width: 120px !important;
    max-width: 120px !important;
    vertical-align: middle !important;
  }
  .ins-dashboard-table thead th:nth-child(11) {
    white-space: normal;
    line-height: 1.2;
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
  }
}

@media (max-width: 767px) {
  .ins-list-card {
    padding: 1.35rem 1.1rem;
  }
  .ins-list-title {
    font-size: clamp(1.55rem, 6vw, 1.95rem);
  }
  .ins-toolbar {
    flex-direction: column;
    align-items: stretch;
  }
  .ins-toolbar-actions,
  .ins-filters-panel {
    grid-template-columns: 1fr 1fr;
  }
  .ins-tipo-leyenda {
    flex-direction: column;
    align-items: flex-start;
  }
  .ins-leyenda-lista {
    width: 100%;
  }
  .ins-toolbar-actions,
  .ins-toolbar-actions.junta-btn-group {
    width: 100%;
    justify-content: center !important;
    flex-wrap: nowrap !important;
  }
  .ins-toolbar-actions .ins-btn,
  .ins-toolbar-actions .btn.ins-btn {
    flex: 0 0 auto !important;
    min-width: 0;
    justify-content: center;
  }
  .ins-list-shell .btn.ins-btn .ins-btn-label {
    font-size: 13px !important;
  }
  .ins-btn .glyphicon {
    font-size: 11px !important;
  }
  .ins-filters-panel {
    grid-template-columns: 1fr;
  }
  .ins-filter-select {
    font-size: 0.92rem;
    min-height: 42px;
  }
  .ins-dashboard-table {
    min-width: 640px;
  }
  .ins-cell-acciones {
    min-width: 108px !important;
    width: 108px !important;
    position: static;
    box-shadow: none;
  }
}

</style>
<button class="btn-flotante" onclick="topFunction()" title='Subir'>Subir</button>


  <div class="container-fluid">
  <script>
        // Get the button
        let myButton = document.querySelector(".btn-flotante");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                myButton.style.display = "block";
            } else {
                myButton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>


    <div class="ins-list-shell">
    <div class="ins-list-card">
    <header class="ins-list-header">
      <h1 class="ins-list-title">Listado de Inscripciones</h1>
      <p class="ins-list-subtitle">Gestione las inscripciones asignadas a su cargo.</p>
    </header>
<?php
$legajo = isset($_GET['legajo']) ? $_GET['legajo'] : '';

$serverName = "10.1.9.113";
$connectionInfo = array(
    "Database" => "junta",
    "Uid"      => "SA",
    "PWD"      => 'Davinci2024#',
    "TrustServerCertificate" => true,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$queryData = "SELECT j_doc.apellidoynombre, j_doc.legajo, j_mov.legdoc, j_mov.anodoc, j_mov.codmod, j_mov.establecimiento, j_mod.nommod, j_dep.coddep, j_dep.nomdep, j_mov.puntajetotal, j_mov.tipo, j_mov.fecha, j_mov.obs, j_mov.horas, j_mov.id2,j_mov.excluido,j_mov.codloc,j_mov.hijos,j_mov.legvinc
FROM _junta_docentes j_doc
INNER JOIN _junta_movimientos j_mov ON j_doc.legajo = j_mov.legdoc
LEFT JOIN _junta_modalidades j_mod ON j_mov.codmod = j_mod.codmod 
LEFT JOIN _junta_dependencias j_dep ON j_mov.establecimiento = j_dep.coddep
WHERE j_doc.legajo = '$legajo'
ORDER BY j_mov.anodoc desc";
?>

   <?php

  if(isset($_SESSION['message'])){
    ?>
    <div class="alert alert-info text-center" style="margin-top:20px;">
      <?php echo $_SESSION['message']; ?>
    </div>
    <?php

    unset($_SESSION['message']);
  }
?>
<?php

if (isset($_GET['legajo'])) {
    // Asignar el valor de legajo a la variable
    $legajo = $_GET['legajo'];

    // Consulta para obtener el nombre del docente
    $queryNombreDocente = "SELECT apellidoynombre FROM _junta_docentes WHERE legajo = '$legajo'";
    $resultNombreDocente = sqlsrv_query($conn, $queryNombreDocente);

    // Verificar si se encontró el nombre del docente
    if (sqlsrv_has_rows($resultNombreDocente)) {
        $rowNombreDocente = sqlsrv_fetch_array($resultNombreDocente, SQLSRV_FETCH_ASSOC);
        $nombreDocente = $rowNombreDocente['apellidoynombre'];

        // Tarjeta resumen docente (solo presentación)
        $nombreDocenteEsc = htmlspecialchars((string) $nombreDocente, ENT_QUOTES, 'UTF-8');
        echo "<div class='ins-docente-card' role='group' aria-label='Datos del docente'>";
        echo "<div class='ins-docente-avatar' aria-hidden='true'><i class='glyphicon glyphicon-user'></i></div>";
        echo "<div><p class='ins-docente-label'>Docente</p><p class='ins-docente-name'>" . $nombreDocenteEsc . "</p></div>";
        echo "</div>";

        $resultData = sqlsrv_query($conn, $queryData);
              if ($resultData === false) {
                  die(print_r(sqlsrv_errors(), true)); // Imprimir errores si la consulta falla
              }

              echo "<div class='ins-toolbar'>";
              echo "<div class='ins-toolbar-actions junta-btn-group'>";
              echo "<a href='javascript:void(0);' onclick='history.go(-1); location.reload();' class='btn ins-btn ins-btn-refresh' title='Actualizar tabla'><i class='glyphicon glyphicon-refresh'></i><span class='ins-btn-label'>Actualizar tabla</span></a>";
              echo "<a href='RegistroMovimiento.php?legajo=" . urlencode($legajo) . "' class='btn ins-btn ins-btn-new' title='Nuevo movimiento'><i class='glyphicon glyphicon-plus'></i><span class='ins-btn-label'>Nuevo movimiento</span></a>";
              echo "<a href='./ListarDocentes.php?restaurar=1' class='btn ins-btn ins-btn-back' title='Volver atrás'><i class='glyphicon glyphicon-arrow-left'></i><span class='ins-btn-label'>Volver atrás</span></a>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"ins-filters-panel\" role=\"search\" aria-label=\"Filtros de inscripciones\">";
              echo "<div class=\"ins-filter-item\"><label for=\"filtroTipo\">Tipo de Inscripción</label>";
              echo "<select id=\"filtroTipo\" class=\"form-control ins-filter-select\">";
              echo "<option value=\"\">Todos los tipos</option>";
              echo "<option value=\"permanente\">Permanentes</option>";
              echo "<option value=\"titulares\">Titulares</option>";
              echo "<option value=\"transitorio\">Interinatos y Suplencias</option>";
              echo "<option value=\"concurso\">Concurso de Titularidad</option>";
              echo "<option value=\"default\">Otros</option>";
              echo "</select></div>";
              echo "<div class=\"ins-filter-item\"><label for=\"filtroEstado\">Estado de Inscripción</label>";
              echo "<select id=\"filtroEstado\" class=\"form-control ins-filter-select\">";
              echo "<option value=\"\">Todos los estados</option>";
              echo "<option value=\"activo\">Activo</option>";
              echo "<option value=\"excluido\">Excluido</option>";
              echo "</select></div>";
              echo "<div class=\"ins-filter-item\"><label for=\"filtroLocalidad\">Localidad</label>";
              echo "<select id=\"filtroLocalidad\" class=\"form-control ins-filter-select\">";
              echo "<option value=\"\">Todas las localidades</option>";
              echo "<option value=\"ush\">Ushuaia</option>";
              echo "<option value=\"rgd\">Río Grande</option>";
              echo "<option value=\"tol\">Tolhuin</option>";
              echo "<option value=\"ant\">Antártida</option>";
              echo "<option value=\"sin\">Sin asignar</option>";
              echo "</select></div>";
              echo "<div class=\"ins-filter-item\"><label for=\"filtroAnterior\">Inscripción Anterior</label>";
              echo "<select id=\"filtroAnterior\" class=\"form-control ins-filter-select\">";
              echo "<option value=\"\">Todas</option>";
              echo "<option value=\"si\">Sí</option>";
              echo "<option value=\"no\">No</option>";
              echo "</select></div>";
              echo "</div>";

              echo "<div class=\"ins-tipo-leyenda\" role=\"note\" aria-label=\"Leyenda visual de inscripciones\">";
              echo "<div class=\"ins-leyenda-grupo\"><span class=\"ins-leyenda-grupo-titulo\">Tipo</span>";
              echo "<span class=\"ins-badge ins-badge--permanente\">Permanentes</span>";
              echo "<span class=\"ins-badge ins-badge--titulares\">Titulares</span>";
              echo "<span class=\"ins-badge ins-badge--transitorio\">Interinatos y Suplencias</span>";
              echo "<span class=\"ins-badge ins-badge--concurso\">Concurso de Titularidad</span></div>";
              echo "<div class=\"ins-leyenda-grupo\"><span class=\"ins-leyenda-grupo-titulo\">Estado</span>";
              echo "<span class=\"ins-badge ins-badge--estado-activo\">Activo</span>";
              echo "<span class=\"ins-badge ins-badge--estado-excluido\">Excluido</span></div>";
              echo "<div class=\"ins-leyenda-grupo\"><span class=\"ins-leyenda-grupo-titulo\">Localidad</span>";
              echo "<span class=\"ins-badge ins-badge--loc-ush\">Ushuaia</span>";
              echo "<span class=\"ins-badge ins-badge--loc-rgd\">Río Grande</span>";
              echo "<span class=\"ins-badge ins-badge--loc-tol\">Tolhuin</span>";
              echo "<span class=\"ins-badge ins-badge--loc-ant\">Antártida</span></div>";
              echo "<div class=\"ins-leyenda-grupo\"><span class=\"ins-leyenda-grupo-titulo\">Insc. anterior</span>";
              echo "<span class=\"ins-badge ins-badge--anterior-si\">Sí</span>";
              echo "<span class=\"ins-badge ins-badge--anterior-no\">No</span></div>";
              echo "</div>";
          
      // Filtro por Tipo de Inscripción
         
   
              // Ejecutar la consulta original y mostrar los resultados en la tabla
              if (sqlsrv_has_rows($resultData)) {
                  echo "<div class='ins-table-wrap'><table class='ins-dashboard-table'>";
                  echo "<thead><tr>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-calendar'></i> Año</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-list-alt'></i> Cód. modalidad</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-file'></i> Descripción</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-home'></i> Establecimiento</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-star'></i> Puntaje total</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-tag'></i> Tipo inscripción</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-flag'></i> Estado</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-map-marker'></i> Localidad</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-link'></i> Insc. anterior</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-calendar'></i> Fecha</th>";
                  echo "<th scope='col'><i class='glyphicon glyphicon-cog'></i> Acciones</th>";
                  echo "</tr></thead><tbody>";

                 while ($row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC)) {
    $tipo = strtolower(trim($row['tipo']));
    $insTipo = junta_inscripcion_clasificar_tipo($row);
    $insEstado = junta_inscripcion_estado($row);
    $codloc = isset($row['codloc']) ? $row['codloc'] : '';
    $insLoc = junta_inscripcion_localidad($codloc);
    $insAnt = junta_inscripcion_anterior($row['legvinc'] ?? '');

    $rowTipoClass = $insTipo['row'];
    $accent = $insTipo['accent'];
    $tipoFiltroAttr = $insTipo['filtro'];
    if (!in_array($tipoFiltroAttr, ['permanente', 'titulares', 'transitorio', 'concurso'], true)) {
        $tipoFiltroAttr = 'default';
    }

                      echo "<tr class=\"tipoFila ins-row-accent " . htmlspecialchars($rowTipoClass, ENT_QUOTES, 'UTF-8') . "\""
                        . " data-tipo=\"" . htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8') . "\""
                        . " data-tipo-filtro=\"" . htmlspecialchars($tipoFiltroAttr, ENT_QUOTES, 'UTF-8') . "\""
                        . " data-categoria-filtro=\"" . htmlspecialchars($tipoFiltroAttr, ENT_QUOTES, 'UTF-8') . "\""
                        . " data-estado-filtro=\"" . htmlspecialchars($insEstado['filtro'], ENT_QUOTES, 'UTF-8') . "\""
                        . " data-localidad-filtro=\"" . htmlspecialchars($insLoc['filtro'], ENT_QUOTES, 'UTF-8') . "\""
                        . " data-anterior-filtro=\"" . htmlspecialchars($insAnt['filtro'], ENT_QUOTES, 'UTF-8') . "\""
                        . " style=\"--accent: " . htmlspecialchars($accent, ENT_QUOTES, 'UTF-8') . ";\">";
                      echo "<td>" . htmlspecialchars((string) $row['anodoc'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars((string) $row['codmod'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td class=\"ins-cell-desc\"><span class=\"ins-cell-desc-inner\">" . htmlspecialchars((string) $row['nommod'], ENT_QUOTES, 'UTF-8') . "</span></td>";
                      $insEst = junta_inscripcion_texto_establecimiento($row, $insTipo['filtro']);
                      $estText = $insEst['texto'];
                      echo "<td class=\"ins-cell-establecimiento" . ($insEst['muted'] ? ' ins-cell-muted' : '') . "\">" . htmlspecialchars($estText, ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars(number_format($row['puntajetotal'], 2, '.', ','), ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td class=\"ins-cell-tipo\"><span class=\"" . htmlspecialchars($insTipo['badge'], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($insTipo['label'], ENT_QUOTES, 'UTF-8') . "</span></td>";
                      echo "<td class=\"ins-cell-estado\"><span class=\"" . htmlspecialchars($insEstado['badge'], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($insEstado['label'], ENT_QUOTES, 'UTF-8') . "</span></td>";
                      echo "<td class=\"ins-cell-localidad\"><span class=\"" . htmlspecialchars($insLoc['badge'], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($insLoc['label'], ENT_QUOTES, 'UTF-8') . "</span></td>";
                      echo "<td class=\"ins-cell-anterior\"><span class=\"" . htmlspecialchars($insAnt['badge'], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($insAnt['label'], ENT_QUOTES, 'UTF-8') . "</span></td>";

                      echo "<td class=\"ins-fecha-cell\">";
                      if ($row['fecha'] !== null) {
                          echo "<i class='glyphicon glyphicon-calendar' aria-hidden='true'></i><span>" . htmlspecialchars($row['fecha']->format('d-m-Y'), ENT_QUOTES, 'UTF-8') . "</span>";
                      } else {
                          echo "<span class=\"ins-cell-muted\">Fecha no disponible</span>";
                      }
                      echo "</td>";

                    if (empty($nomdep)) {
                      $encodedNomdep = urlencode("No tiene establecimiento asignado");
                    } else {
                      $encodedNomdep = urlencode($nomdep);
                    }
                                    echo "<td class=\"ins-cell-acciones\"><div class='acciones-inscripciones'>";
                                    echo "<a class='btn btn-sm btn-danger movimientoBorrado' href='#' data-id2='" . htmlspecialchars($row['id2'], ENT_QUOTES, 'UTF-8') . "' title='Eliminar'><i class='glyphicon glyphicon-trash'></i><span class='acciones-inscripciones-label'>Eliminar</span></a>";


                                    // Asegúrate de que las variables sean cadenas antes de aplicar urlencode
                                    $encodedNomdep = isset($row['nomdep']) ? urlencode((string) $row['nomdep']) : '';
                                    $encodedObs = isset($row['obs']) ? urlencode((string) $row['obs']) : '';
                                    //$encodedFecha = isset($row['fecha']) ? urlencode((string) $row['fecha']) : ''; // Suponiendo que también necesitas codificar $row['fecha']
                                      
                                    $encodedFecha = isset($row['fecha']) && $row['fecha'] instanceof DateTime? urlencode($row['fecha']->format('Y-m-d H:i:s')) : '';

                                     
                                    // Codificar otros valores en la URL
                                    $encodedLegajo = isset($legajo) ? urlencode((string) $legajo) : '';
                                    $encodedCodmod = isset($row['codmod']) ? urlencode((string) $row['codmod']) : '';
                                    $encodedTipo = isset($row['tipo']) ? urlencode((string) $row['tipo']) : '';
                                    $encodedHoras = isset($row['horas']) ? urlencode((string) $row['horas']) : '';
                                    $encodedAnodoc = isset($row['anodoc']) ? urlencode((string) $row['anodoc']) : '';
                                    $encodedId2 = isset($row['id2']) ? urlencode((string) $row['id2']) : '';
                                    $encodedexcluido = isset($row['excluido']) && !empty($row['excluido']) ? urlencode((string) $row['excluido']) : urlencode('no');

                                    $hijos = isset($row['hijos']) ? $row['hijos'] : 0;
                                    $encodedHijos = urlencode($hijos);
                                    $encodedLegvinc = isset($row['legvinc']) ? urlencode((string) $row['legvinc']) : '0'; // Si 'legvinc' está vacío, se asigna '0'nc'] : '0';

                                    $codloc = isset($row['codloc']) ? $row['codloc'] : '';
                                    // Asegúrate de que $codloc esté correctamente asignado antes de codificarlo
                                    $encodedCodloc = urlencode($codloc);
                                    // El resto del código
                                   // Generación del enlace con los parámetros codificados
                                      echo "<a href='Inscripcion.php?legajo=" . $encodedLegajo . 
                                      "&codmod=" . $encodedCodmod . 
                                      "&tipo=" . $encodedTipo . 
                                      "&nomdep=" . $encodedNomdep . 
                                      "&obs=" . $encodedObs . 
                                      "&horas=" . $encodedHoras . 
                                      "&anodoc=" . $encodedAnodoc . 
                                      "&id2=" . $encodedId2 . 
                                      "&fecha=" . $encodedFecha . 
                                      "&excluido=" . $encodedexcluido . 
                                      "&hijos=" . $encodedHijos . 
                                      "&codloc=" . $encodedCodloc . 
                                      "&legvinc=" . $encodedLegvinc . 
                                      "' class='btn btn-success btn-sm' title='Modificar'>";

                                    echo "<span class='glifo glifo-lápiz'></span><i class='glyphicon glyphicon-pencil'></i><span class='acciones-inscripciones-label'>Modificar</span>";
                                    echo "</a>";
                                    
                                    $encodedCodloc = urlencode($codloc); // Codificar correctamente el valor de codloc

                                    echo "<a href='Duplicar.php?legajo=" . $encodedLegajo . 
                                    "&codmod=" . $encodedCodmod . 
                                    "&tipo=" . $encodedTipo . 
                                    "&nomdep=" . $encodedNomdep . 
                                    "&obs=" . $encodedObs . 
                                    "&horas=" . $encodedHoras . 
                                    "&anodoc=" . $encodedAnodoc . 
                                    "&id2=" . $encodedId2 . 
                                    "&fecha=" . $encodedFecha . 
                                    "&excluido=" . $encodedexcluido . 


                                    "&codloc=" . $encodedCodloc . "' 
                                    class='btn btn-warning btn-sm' title='Duplicar'>";
                                    echo "<span class='glifo glifo-lápiz' style='margin-right: 8px;'></span><i class='glyphicon glyphicon-copy'></i><span class='acciones-inscripciones-label'>Duplicar</span>";
                                    echo "</a>";
                                    echo "</div>";
                

                echo "</tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<p>No se encontraron registros para el apellido y nombre.</p>";
        }
    } else {
        echo "<p>No se encontró el nombre del docente.</p>";
    }

} else {
    // Si legajo no está definido, mostrar un mensaje de error
    echo "<p>El parámetro legajo no está definido.</p>";
}
echo "</div></div>";
echo "<script>
function juntaAplicarFiltrosInscripciones() {
    var filtroTipo = (document.getElementById('filtroTipo') || {}).value || '';
    var filtroEstado = (document.getElementById('filtroEstado') || {}).value || '';
    var filtroLocalidad = (document.getElementById('filtroLocalidad') || {}).value || '';
    var filtroAnterior = (document.getElementById('filtroAnterior') || {}).value || '';
    var filas = document.querySelectorAll('.tipoFila');

    filas.forEach(function(fila) {
        var okTipo = !filtroTipo || fila.getAttribute('data-tipo-filtro') === filtroTipo;
        var okEstado = !filtroEstado || fila.getAttribute('data-estado-filtro') === filtroEstado;
        var okLocalidad = !filtroLocalidad || fila.getAttribute('data-localidad-filtro') === filtroLocalidad;
        var okAnterior = !filtroAnterior || fila.getAttribute('data-anterior-filtro') === filtroAnterior;
        fila.style.display = (okTipo && okEstado && okLocalidad && okAnterior) ? '' : 'none';
    });
}

['filtroTipo', 'filtroEstado', 'filtroLocalidad', 'filtroAnterior'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) {
        el.addEventListener('change', juntaAplicarFiltrosInscripciones);
    }
});
</script>";

//javascript para borrado de movimiento

echo "<script>

jQuery(document).ready(function($) {
  $(document).on('click.juntaMovimientoBorrado', '.movimientoBorrado', function(e) {
      e.preventDefault();
      e.stopPropagation();

      var id2 = $(this).data('id2');
      
      juntaConfirmDanger('¿Desea eliminar el movimiento?', function() {
          jQuery.ajax({
              type: 'POST',
              url: 'eliminar_movimiento.php',
              data: { id2: id2 },
              success: function(response) {
                  Swal.fire({icon: 'info', title: 'Resultado', text: response}).then(function() {
                      location.reload();
                  });
              },
              error: function(xhr, status, error) {
                  juntaError('Error', 'Error al intentar eliminar el movimiento. Por favor, inténtalo de nuevo.');
                  console.error(xhr.responseText);
              }
          });
      });
  });
});

</script>";




// Cerrar la conexión
sqlsrv_close($conn);

// Determina el color según el valor de 'tipo'
function determinarColor($tipo) {
    switch ($tipo) {
        case 'Interino y Suple.':
            return '#ede9fe'; // Violeta pastel claro
        case 'concurso':
            return '#B3E5FC'; // Celeste pastel claro
        case 'titulares':
            return '#FFF9C4'; // Amarillo pastel claro
        case 'permanente':
            return '#E0E0E0'; // Gris claro pastel
        case 'excluidos':
            return '#fecaca'; // Naranja pastel claro
        default:
            return '#FFFFFF'; // Blanco por defecto
    }
}


?>
  </div>

<?php include('footer2.php');?>