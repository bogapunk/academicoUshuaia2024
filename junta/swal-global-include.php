<?php if (!defined('JUNTA_SWAL_LOADED')) { define('JUNTA_SWAL_LOADED', true); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
(function() {
  var defaultColors = {
    confirm: '#2698f3',
    cancel:  '#6c757d',
    danger:  '#dc3545'
  };

  window.juntaAlert = function(mensaje, tipo) {
    tipo = tipo || 'info';
    var iconMap = { info: 'info', success: 'success', error: 'error', warning: 'warning' };
    return Swal.fire({
      text: mensaje,
      icon: iconMap[tipo] || 'info',
      confirmButtonText: 'Aceptar',
      confirmButtonColor: defaultColors.confirm
    });
  };

  window.juntaSuccess = function(titulo, mensaje) {
    return Swal.fire({
      title: titulo || '¡Operación exitosa!',
      text: mensaje || '',
      icon: 'success',
      confirmButtonText: 'Aceptar',
      confirmButtonColor: defaultColors.confirm
    });
  };

  window.juntaError = function(titulo, mensaje) {
    return Swal.fire({
      title: titulo || 'Error',
      text: mensaje || '',
      icon: 'error',
      confirmButtonText: 'Aceptar',
      confirmButtonColor: defaultColors.confirm
    });
  };

  window.juntaConfirm = function(mensaje, callbackSi, callbackNo) {
    Swal.fire({
      title: '¿Está seguro?',
      text: mensaje,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, continuar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: defaultColors.confirm,
      cancelButtonColor: defaultColors.cancel,
      reverseButtons: true
    }).then(function(result) {
      if (result.isConfirmed) {
        if (typeof callbackSi === 'function') callbackSi();
      } else {
        if (typeof callbackNo === 'function') callbackNo();
      }
    });
  };

  window.juntaConfirmDanger = function(mensaje, callbackSi, callbackNo) {
    Swal.fire({
      title: '¿Está seguro?',
      text: mensaje,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: defaultColors.danger,
      cancelButtonColor: defaultColors.cancel,
      reverseButtons: true
    }).then(function(result) {
      if (result.isConfirmed) {
        if (typeof callbackSi === 'function') callbackSi();
      } else {
        if (typeof callbackNo === 'function') callbackNo();
      }
    });
  };

  window.juntaInfoModal = function(titulo, htmlContenido, textoBoton) {
    return Swal.fire({
      title: titulo || 'Información',
      html: htmlContenido || '',
      icon: 'info',
      confirmButtonText: textoBoton || 'Aceptar',
      confirmButtonColor: defaultColors.confirm,
      allowOutsideClick: false,
      allowEscapeKey: false
    });
  };

  window.juntaConfirmDescargaPdf = function(callbackSi, callbackNo) {
    var mensaje = '¿Desea descargar el archivo PDF generado?';
    if (typeof Swal === 'undefined') {
      if (window.confirm(mensaje)) {
        if (typeof callbackSi === 'function') callbackSi();
      } else if (typeof callbackNo === 'function') {
        callbackNo();
      }
      return;
    }
    Swal.fire({
      title: 'Confirmar descarga',
      text: mensaje,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No',
      confirmButtonColor: defaultColors.confirm,
      cancelButtonColor: defaultColors.cancel,
      reverseButtons: true
    }).then(function(result) {
      if (result.isConfirmed) {
        if (typeof callbackSi === 'function') callbackSi();
      } else if (typeof callbackNo === 'function') {
        callbackNo();
      }
    });
  };

  window.juntaAbrirModalCerrarSesion = function(e) {
    if (e) {
      if (e.preventDefault) e.preventDefault();
      if (e.stopPropagation) e.stopPropagation();
    }
    var modal = document.getElementById('juntaModalCerrarSesion');
    var urlSalir = window.JUNTA_URL_SALIR || '';
    if (modal) {
      var linkSalir = modal.querySelector('.junta-modal-salir-confirm');
      if (linkSalir && linkSalir.getAttribute('href')) {
        urlSalir = linkSalir.getAttribute('href');
      }
      if (modal.parentNode !== document.body) {
        document.body.appendChild(modal);
      }
      if (typeof jQuery !== 'undefined' && jQuery.fn && jQuery.fn.modal) {
        jQuery(modal).modal('show');
        return false;
      }
    }
    if (!urlSalir) {
      urlSalir = '../../MiCuenta.php?logoutSubmit=1';
    }
    var mensaje = 'Salir del sistema. ¿Desea salir del sistema de Junta?';
    if (typeof window.juntaConfirm === 'function') {
      window.juntaConfirm(mensaje, function() {
        window.location.href = urlSalir;
      });
    } else if (window.confirm(mensaje)) {
      window.location.href = urlSalir;
    }
    return false;
  };
})();
</script>
<?php include __DIR__ . '/sesion-inactividad-include.php'; ?>
<?php } ?>
