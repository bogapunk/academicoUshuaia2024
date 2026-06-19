<?php
/**
 * Modal Bootstrap 3: confirmación de cierre de sesión (misma UX que panel rol común).
 * Incluir una sola vez por página; requiere $urlSalir (p. ej. definido en pie_institucional_cerrar_sesion.php).
 */
if (!empty($GLOBALS['__junta_modal_cerrar_sesion_incluido'])) {
    return;
}
if (!isset($urlSalir) || $urlSalir === '') {
    return;
}
$GLOBALS['__junta_modal_cerrar_sesion_incluido'] = true;
$urlSalirEsc = htmlspecialchars((string) $urlSalir, ENT_QUOTES, 'UTF-8');
?>
<style>
/*
 * z-index del diálogo por encima de #preload (p. ej. 9999) y del contenido.
 * No alterar .modal-backdrop: si queda por encima del .modal (1050 por defecto), la pantalla queda negra sin poder pulsar Salir/Cancelar.
 */
#juntaModalCerrarSesion.modal {
	z-index: 10600 !important;
}
#juntaModalCerrarSesion .junta-modal-salir-confirm {
	background-color: #d9534f;
	border-color: #d43f3a;
	color: #fff;
}
#juntaModalCerrarSesion .junta-modal-salir-confirm:hover,
#juntaModalCerrarSesion .junta-modal-salir-confirm:focus {
	background-color: #c9302c;
	border-color: #ac2925;
	color: #fff;
}
</style>
<div class="modal fade" id="juntaModalCerrarSesion" tabindex="-1" role="dialog" aria-labelledby="juntaModalCerrarSesionLabel" aria-hidden="true" data-backdrop="static" data-keyboard="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="juntaModalCerrarSesionLabel"><center>Salir del sistema</center></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar diálogo">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <p style="margin:0;">Salir del sistema. ¿Desea salir del sistema de Junta?</p>
        </center>
      </div>
      <div class="modal-footer">
        <a href="<?php echo $urlSalirEsc; ?>" class="btn junta-modal-salir-confirm">Salir</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
(function () {
	window.JUNTA_URL_SALIR = <?php echo json_encode((string) $urlSalir, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

	var el = document.getElementById('juntaModalCerrarSesion');
	if (el && el.parentNode !== document.body) {
		document.body.appendChild(el);
	}

	function buscarDisparadorSalir(nodo) {
		while (nodo && nodo !== document) {
			if (nodo.nodeType !== 1) {
				nodo = nodo.parentNode;
				continue;
			}
			if (nodo.getAttribute && nodo.getAttribute('data-target') === '#juntaModalCerrarSesion') {
				return nodo;
			}
			if (nodo.classList && nodo.classList.contains('junta-menu-salir')) {
				return nodo;
			}
			nodo = nodo.parentNode;
		}
		return null;
	}

	document.addEventListener('click', function (e) {
		var trigger = buscarDisparadorSalir(e.target);
		if (!trigger) return;
		if (trigger.getAttribute('data-toggle') === 'modal' || trigger.classList.contains('junta-menu-salir')) {
			if (typeof window.juntaAbrirModalCerrarSesion === 'function') {
				window.juntaAbrirModalCerrarSesion(e);
			}
			if (e.stopImmediatePropagation) e.stopImmediatePropagation();
		}
	}, true);
})();
</script>
