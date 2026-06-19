<?php
/**
 * Ítem de navegación "Usuario" (submenú: Usuarios solo admin, Cambiar Contraseña, Salir).
 *
 * Requiere que el encabezado de la vista incluya seguridad_rol.php antes de cualquier salida HTML.
 *
 * Variables opcionales antes de incluir:
 *   $juntaNavRel = '../';              // ruta relativa hacia /views/
 *   $juntaNavUsuariosHref = '...';     // por defecto: {juntaNavRel}Usuarios/ListarUsuarios.php
 */
if (!isset($juntaEsAdmin)) {
    trigger_error(
        'menu_usuario_nav.php requiere seguridad_rol.php en el encabezado antes de enviar HTML.',
        E_USER_WARNING
    );
    $juntaEsAdmin = false;
}

if (!isset($juntaNavRel)) {
    $juntaNavRel = '';
}

$juntaNavJoin = function ($path) use ($juntaNavRel) {
    $path = ltrim((string) $path, '/');
    $rel = rtrim((string) $juntaNavRel, '/');
    if ($rel === '' || $rel === '.') {
        return $path;
    }
    return $rel . '/' . $path;
};

if (!isset($juntaNavUsuariosHref)) {
    $juntaNavUsuariosHref = $juntaNavJoin('Usuarios/ListarUsuarios.php');
}

$cambiarPasswordHref = $juntaNavJoin('cambiar_password.php');
?>
            <li>
              <div class="card-body d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary">Usuario</a>
              </div>
              <ul>
                <?php if (!empty($juntaEsAdmin)) : ?>
                <li><a href="<?php echo htmlspecialchars($juntaNavUsuariosHref, ENT_QUOTES, 'UTF-8'); ?>">Usuarios</a></li>
                <?php endif; ?>
                <li><a href="<?php echo htmlspecialchars($cambiarPasswordHref, ENT_QUOTES, 'UTF-8'); ?>">Cambiar Contraseña</a></li>
                <li><a href="#" class="junta-menu-salir" role="button" data-toggle="modal" data-target="#juntaModalCerrarSesion" onclick="return typeof window.juntaAbrirModalCerrarSesion === 'function' && window.juntaAbrirModalCerrarSesion(event);">Salir</a></li>
              </ul>
            </li>
