<?php
/**
 * Título institucional: Junta (Tierra del Fuego). Antes de incluir, definir:
 * $JUNTA_CABECERA_IMG = '' | '../' | '../../'  (hasta /junta/ si /imagenes está en /junta/imagenes)
 */
if (!isset($JUNTA_CABECERA_IMG)) {
    $JUNTA_CABECERA_IMG = '';
}
$jlogo = $JUNTA_CABECERA_IMG . 'imagenes/aif-logo.png';
?>
<header class="junta-cabecera-institucional" role="banner">
  <div class="junta-cabecera-institucional-inner">
    <div class="junta-cabecera-logo-cel">
      <img class="junta-cabecera-logo-img" src="<?php echo htmlspecialchars($jlogo, ENT_QUOTES, 'UTF-8'); ?>" width="400" height="100" alt="Agencia de Innovación">
    </div>
    <?php include __DIR__ . '/leyenda_institucional_una_linea.php'; ?>
  </div>
</header>
