<?php if (!defined('JUNTA_SPINNER_LOADED')) { define('JUNTA_SPINNER_LOADED', true); ?>

<style>

#junta-spinner-overlay {

  position: fixed;

  top: 0; left: 0;

  width: 100%; height: 100%;

  background: rgba(255, 255, 255, 0.92);

  z-index: 99999;

  display: flex;

  flex-direction: column;

  align-items: center;

  justify-content: center;

  opacity: 1;

  transition: opacity 0.35s ease;

}

#junta-spinner-overlay.junta-spinner-hidden {

  opacity: 0;

  pointer-events: none;

  visibility: hidden;

}

.junta-spinner-ring {

  width: 60px;

  height: 60px;

  border: 5px solid #e2e8f0;

  border-top-color: #007bff;

  border-radius: 50%;

  animation: juntaSpinRing 0.85s linear infinite;

}

.junta-spinner-text {

  margin-top: 18px;

  font-size: 1.05rem;

  font-weight: 600;

  color: #374151;

  font-family: 'Roboto', 'Lucida Sans', Arial, sans-serif;

  letter-spacing: 0.01em;

}

@keyframes juntaSpinRing {

  to { transform: rotate(360deg); }

}

</style>

<div id="junta-spinner-overlay" class="junta-spinner-hidden" aria-live="polite" aria-label="Cargando" aria-hidden="true">

  <div class="junta-spinner-ring"></div>

  <span class="junta-spinner-text">Cargando&hellip;</span>

</div>

<script>

(function() {

  var overlay = document.getElementById('junta-spinner-overlay');

  var spinnerText = overlay ? overlay.querySelector('.junta-spinner-text') : null;

  var _fetchCount = 0;

  var _shownAt = 0;

  var _failsafeTimer = null;



  function juntaSpinnerUrlSinOverlay(url) {

    if (!url) return false;

    var u = String(url);

    return u.indexOf('sesion_inactividad.php') !== -1

      || u.indexOf('buscar_docente.php') !== -1

      || u.indexOf('check_legajo.php') !== -1;

  }



  function juntaSpinnerClearFailsafe() {

    if (_failsafeTimer) {

      clearTimeout(_failsafeTimer);

      _failsafeTimer = null;

    }

  }



  function juntaSpinnerScheduleFailsafe() {

    juntaSpinnerClearFailsafe();

    _failsafeTimer = setTimeout(function() {

      juntaSpinnerHide();

    }, 12000);

  }



  window.juntaSpinnerShow = function(texto) {

    if (!overlay) return;

    if (texto && spinnerText) spinnerText.textContent = texto;

    else if (spinnerText) spinnerText.innerHTML = 'Cargando&hellip;';

    overlay.classList.remove('junta-spinner-hidden');

    overlay.setAttribute('aria-hidden', 'false');

    _shownAt = Date.now();

    juntaSpinnerScheduleFailsafe();

  };



  window.juntaSpinnerHide = function() {

    if (!overlay) return;

    overlay.classList.add('junta-spinner-hidden');

    overlay.setAttribute('aria-hidden', 'true');

    juntaSpinnerClearFailsafe();

  };



  window.addEventListener('pageshow', juntaSpinnerHide);

  document.addEventListener('DOMContentLoaded', function() {

    setTimeout(juntaSpinnerHide, 50);

  });

  window.addEventListener('load', function() {

    setTimeout(juntaSpinnerHide, 100);

  });



  function hookJqueryAjax() {
    if (typeof jQuery === 'undefined') return;
    var _ajaxCount = 0;
    jQuery(document).ajaxSend(function(event, jqXHR, settings) {
      if (settings && juntaSpinnerUrlSinOverlay(settings.url)) return;
      _ajaxCount++;
      juntaSpinnerShow('Procesando\u2026');
    }).ajaxComplete(function(event, jqXHR, settings) {
      if (settings && juntaSpinnerUrlSinOverlay(settings.url)) return;
      _ajaxCount--;
      if (_ajaxCount <= 0) {
        _ajaxCount = 0;
        juntaSpinnerHide();
      }
    });
  }



  if (typeof jQuery !== 'undefined') {

    hookJqueryAjax();

  } else {

    document.addEventListener('DOMContentLoaded', hookJqueryAjax);

  }



  if (window.fetch) {

    var _origFetch = window.fetch;

    window.fetch = function(input, init) {

      var url = typeof input === 'string' ? input : (input && input.url ? input.url : '');

      var silencioso = juntaSpinnerUrlSinOverlay(url);

      if (!silencioso) {

        _fetchCount++;

        juntaSpinnerShow('Procesando\u2026');

      }

      return _origFetch.apply(this, arguments).finally(function() {

        if (!silencioso) {

          _fetchCount--;

          if (_fetchCount <= 0) {

            _fetchCount = 0;

            juntaSpinnerHide();

          }

        }

      });

    };

  }



  document.addEventListener('DOMContentLoaded', function() {

    var links = document.querySelectorAll('#menu_gral a, #menu_gral2 a');

    for (var i = 0; i < links.length; i++) {

      links[i].addEventListener('click', function() {

        if (this.getAttribute('data-toggle') === 'modal') return;

        if (this.classList && this.classList.contains('junta-menu-salir')) return;

        var url = this.getAttribute('href');

        if (!url || url === '#' || url.indexOf('javascript:') === 0) return;

        juntaSpinnerShow('Cargando\u2026');

      });

    }



    document.addEventListener('submit', function(e) {

      var form = e.target;

      if (!form || form.tagName !== 'FORM') return;

      var action = form.getAttribute('action');

      if (!action || action === '#' || action.indexOf('javascript:') === 0) return;

      if (form.getAttribute('data-junta-confirm-submit') === '1'
          && form.getAttribute('data-junta-submit-confirmed') !== '1') {
        return;
      }

      juntaSpinnerShow('Cargando\u2026');

    }, true);

  });

})();

</script>

<?php } ?>


