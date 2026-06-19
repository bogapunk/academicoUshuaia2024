<?php
/**
 * Pie: tarjeta (estilo login) con AIF, logo y cierre de sesión + copyright.
 * Antes de incluir, definir $JUNTA_PIE_BASE: ruta relativa hacia /junta/ (p. ej. '../', '../../').
 * Opcional: $JUNTA_PIE_SESION_DIRECT = true en la vista antes del footer para ir a MiCuenta (logout) sin modal.
 */
if (!isset($JUNTA_PIE_BASE)) {
    $JUNTA_PIE_BASE = '../';
}
$imgPie = rtrim($JUNTA_PIE_BASE, '/') . '/imagenes/pie_footer.png';
$urlSalir = rtrim($JUNTA_PIE_BASE, '/') . '/MiCuenta.php?logoutSubmit=1';
$navId = !empty($JUNTA_PIE_NAV_ID) ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $JUNTA_PIE_NAV_ID) : 'menu_gral2';
$juntaPieSesionDirecta = !empty($JUNTA_PIE_SESION_DIRECT);
?>
<footer class="junta-pie-sistema" role="contentinfo">
  <div class="junta-pie-contenedor">
    <div class="junta-pie-cerrar-tarjeta">
      <div class="junta-pie-superior">
        <div class="junta-pie-identidad">
          <a href="https://www.aif.gob.ar/" target="_blank" rel="noopener noreferrer" class="junta-pie-aif-link">Agencia de Innovación</a>
          <div class="junta-pie-logo-bloque">
            <img src="<?php echo htmlspecialchars($imgPie, ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50" alt="Agencia de innovación" class="junta-pie-img">
          </div>
        </div>
        <nav id="<?php echo htmlspecialchars($navId, ENT_QUOTES, 'UTF-8'); ?>" class="junta-pie-cerrar-nav" aria-label="Cerrar sesión">
          <div class="junta-pie-boton-sesion">
            <?php if ($juntaPieSesionDirecta): ?>
              <a href="<?php echo htmlspecialchars($urlSalir, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">Cerrar sesión</a>
            <?php else: ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#juntaModalCerrarSesion">Cerrar sesión</button>
            <?php endif; ?>
          </div>
        </nav>
      </div>
    </div>
    <p class="junta-pie-copyright-leyenda">
      &copy; <?php echo (int) date('Y'); ?> - Todos los derechos reservados | Las Islas Malvinas son argentinas.
    </p>
  </div>
</footer>
<?php include __DIR__ . '/modal_cerrar_sesion_junta.php'; ?>
