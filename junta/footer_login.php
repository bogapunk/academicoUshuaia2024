<?php
/**
 * Pie mínimo para pantalla de inicio de sesión.
 * REVERTIR diseño moderno: en index.php usar include('footer.php') en lugar de este archivo.
 */
$imgPie = 'imagenes/pie_footer.png';
?>
</main>
<footer class="junta-login-footer" role="contentinfo">
  <div class="junta-login-footer-inner">
    <a href="https://www.aif.gob.ar/" target="_blank" rel="noopener noreferrer" class="junta-login-footer-link">Agencia de Innovación</a>
    <img src="<?php echo htmlspecialchars($imgPie, ENT_QUOTES, 'UTF-8'); ?>" width="44" height="44" alt="Agencia de innovación" class="junta-login-footer-logo">
    <p class="junta-login-footer-copy">&copy; <?php echo (int) date('Y'); ?> — Todos los derechos reservados | Las Islas Malvinas son argentinas.</p>
  </div>
</footer>
</body>
</html>
