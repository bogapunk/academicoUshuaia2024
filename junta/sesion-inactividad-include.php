<?php
if (!defined('JUNTA_SESION_INACTIVIDAD_LOADED')) {
    define('JUNTA_SESION_INACTIVIDAD_LOADED', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once __DIR__ . '/views/seguridad_inactividad.php';

    if (!junta_session_es_autenticado()) {
        if (defined('JUNTA_SESSION_DEBUG') && JUNTA_SESSION_DEBUG) {
            echo "<!-- Juntas: control de inactividad inactivo. Debe iniciar sesión primero. -->\n";
        }
        return;
    }

    $script = $_SERVER['SCRIPT_NAME'] ?? '';
    if (preg_match('#^(.*)/views/#', $script, $m)) {
        $juntaAppBase = $m[1];
    } else {
        $juntaAppBase = rtrim(dirname($script), '/\\');
        if ($juntaAppBase === '' || $juntaAppBase === '.') {
            $juntaAppBase = '';
        }
    }

    $juntaSesionApiUrl = rtrim($juntaAppBase, '/') . '/sesion_inactividad.php';
    $juntaLoginUrl = rtrim($juntaAppBase, '/') . '/index.php';
    $juntaLogoutInactividadUrl = rtrim($juntaAppBase, '/') . '/MiCuenta.php?logoutInactividad=1';
    $juntaWarningLabel = JUNTA_SESSION_WARNING_SEC >= 60
        ? (int) floor(JUNTA_SESSION_WARNING_SEC / 60) . ' minuto' . (JUNTA_SESSION_WARNING_SEC >= 120 ? 's' : '')
        : (int) JUNTA_SESSION_WARNING_SEC . ' segundos';
    ?>
<script>
(function () {
  var cfg = {
    timeoutMs: <?php echo (int) JUNTA_SESSION_TIMEOUT_SEC * 1000; ?>,
    warningMs: <?php echo (int) JUNTA_SESSION_WARNING_SEC * 1000; ?>,
    warningLabel: <?php echo json_encode($juntaWarningLabel, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>,
    apiUrl: <?php echo json_encode($juntaSesionApiUrl, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>,
    loginUrl: <?php echo json_encode($juntaLoginUrl, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>,
    logoutUrl: <?php echo json_encode($juntaLogoutInactividadUrl, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>,
    debug: <?php echo (defined('JUNTA_SESSION_DEBUG') && JUNTA_SESSION_DEBUG) ? 'true' : 'false'; ?>
  };

  var warningTimer = null;
  var logoutTimer = null;
  var warningVisible = false;
  var lastPingAt = 0;
  var lastResetAt = 0;
  var activityEvents = ['mousedown', 'keydown', 'touchstart', 'click'];

  function logDebug() {
    if (!cfg.debug || !window.console || !console.log) {
      return;
    }
    console.log.apply(console, arguments);
  }

  function clearTimers() {
    if (warningTimer) {
      clearTimeout(warningTimer);
      warningTimer = null;
    }
    if (logoutTimer) {
      clearTimeout(logoutTimer);
      logoutTimer = null;
    }
  }

  function scheduleTimersFromRemaining(remainingMs) {
    clearTimers();

    if (remainingMs <= 0) {
      finalizarSesion();
      return;
    }

    var warnDelay = Math.max(0, remainingMs - cfg.warningMs);
    warningTimer = setTimeout(showWarning, warnDelay);
    logoutTimer = setTimeout(finalizarSesion, remainingMs);

    logDebug(
      '[Juntas Sesión] Temporizador activo. Aviso en',
      Math.round(warnDelay / 1000),
      's. Cierre en',
      Math.round(remainingMs / 1000),
      's.'
    );
  }

  function scheduleTimers() {
    scheduleTimersFromRemaining(cfg.timeoutMs);
  }

  function pingServer(action) {
    var url = cfg.apiUrl + (cfg.apiUrl.indexOf('?') >= 0 ? '&' : '?') + 'action=' + encodeURIComponent(action || 'ping');
    return new Promise(function(resolve, reject) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.withCredentials = true;
      xhr.onreadystatechange = function() {
        if (xhr.readyState !== 4) return;
        if (xhr.status >= 200 && xhr.status < 300) {
          try {
            resolve(JSON.parse(xhr.responseText));
          } catch (err) {
            reject(err);
          }
        } else {
          reject(new Error('HTTP ' + xhr.status));
        }
      };
      xhr.onerror = function() { reject(new Error('Network error')); };
      xhr.send();
    });
  }

  function finalizarSesion() {
    warningVisible = false;
    clearTimers();
    logDebug('[Juntas Sesión] Cerrando sesión por inactividad.');
    window.location.href = cfg.logoutUrl;
  }

  function extenderSesion() {
    return pingServer('extend').then(function (data) {
      if (!data || !data.ok || data.expired) {
        finalizarSesion();
        return;
      }
      warningVisible = false;
      var remaining = (data.expiresIn != null) ? data.expiresIn * 1000 : cfg.timeoutMs;
      scheduleTimersFromRemaining(remaining);
    }).catch(function () {
      finalizarSesion();
    });
  }

  function showWarning() {
    if (warningVisible) {
      return;
    }
    warningVisible = true;
    logDebug('[Juntas Sesión] Mostrando aviso previo al cierre.');

    if (typeof Swal !== 'undefined' && Swal.fire) {
      Swal.fire({
        title: 'Sesión por expirar',
        html: 'Su sesión finalizará en <b>' + cfg.warningLabel + '</b> por inactividad.<br>¿Desea continuar trabajando?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Continuar sesión',
        cancelButtonText: 'Cerrar sesión',
        confirmButtonColor: '#2698f3',
        cancelButtonColor: '#6c757d',
        reverseButtons: true,
        allowOutsideClick: false,
        timer: cfg.warningMs,
        timerProgressBar: true
      }).then(function (result) {
        if (result.isConfirmed) {
          extenderSesion();
          return;
        }
        if (result.dismiss === Swal.DismissReason.timer) {
          finalizarSesion();
          return;
        }
        finalizarSesion();
      });
      return;
    }

    if (window.confirm('Su sesión finalizará por inactividad. ¿Desea continuar trabajando?')) {
      extenderSesion();
    } else {
      finalizarSesion();
    }
  }

  function onActividadUsuario() {
    if (warningVisible) {
      return;
    }

    var now = Date.now();
    if (now - lastResetAt < 5000) {
      return;
    }
    lastResetAt = now;
    scheduleTimers();

    if (now - lastPingAt < 60000) {
      return;
    }
    lastPingAt = now;

    pingServer('ping').then(function (data) {
      if (!data || !data.ok || data.expired) {
        finalizarSesion();
      }
    }).catch(function () {
      /* Sin red: los timers locales siguen vigentes. */
    });
  }

  function onVisibilidad() {
    if (document.visibilityState !== 'visible' || warningVisible) {
      return;
    }

    pingServer('status').then(function (data) {
      if (!data || !data.ok || data.expired) {
        finalizarSesion();
      }
    }).catch(function () {});
  }

  activityEvents.forEach(function (eventName) {
    document.addEventListener(eventName, onActividadUsuario, { passive: true });
  });

  document.addEventListener('visibilitychange', onVisibilidad);

  logDebug('[Juntas Sesión] Control de inactividad cargado.', cfg);

  pingServer('ping').then(function (data) {
    if (!data || !data.ok || data.expired) {
      logDebug('[Juntas Sesión] Sin sesión válida en el servidor.', data);
      finalizarSesion();
      return;
    }
    var remaining = (data.expiresIn != null) ? data.expiresIn * 1000 : cfg.timeoutMs;
    scheduleTimersFromRemaining(remaining);
  }).catch(function (err) {
    logDebug('[Juntas Sesión] No se pudo contactar al servidor. Usando temporizador local.', err);
    scheduleTimers();
  });
})();
</script>
<?php
}
