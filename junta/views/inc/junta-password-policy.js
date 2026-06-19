(function (window) {
    'use strict';

    var REQUISITOS = [
        { id: 'len', label: 'Mínimo 8 caracteres', test: function (p) { return p.length >= 8; } },
        { id: 'upper', label: 'Al menos una letra mayúscula', test: function (p) { return /[A-Z]/.test(p); } },
        { id: 'lower', label: 'Al menos una letra minúscula', test: function (p) { return /[a-z]/.test(p); } },
        { id: 'digit', label: 'Al menos un número', test: function (p) { return /[0-9]/.test(p); } },
        { id: 'special', label: 'Al menos un carácter especial (@, #, $, %, &, *, etc.)', test: function (p) { return /[^A-Za-z0-9]/.test(p); } }
    ];

    function validar(password) {
        var errores = [];
        REQUISITOS.forEach(function (req) {
            if (!req.test(password || '')) {
                errores.push(req.label);
            }
        });
        return {
            ok: errores.length === 0,
            errores: errores
        };
    }

    function renderChecklist(container, password) {
        if (!container) {
            return;
        }
        var html = '<ul class="junta-password-checklist" style="margin:8px 0 0;padding-left:18px;font-size:12px;line-height:1.6;">';
        REQUISITOS.forEach(function (req) {
            var ok = req.test(password || '');
            html += '<li style="color:' + (ok ? '#16a34a' : '#6b7280') + ';">' +
                (ok ? '&#10003; ' : '&#9675; ') + req.label + '</li>';
        });
        html += '</ul>';
        container.innerHTML = html;
    }

    function bindPolicy(input, checklistContainer, optional) {
        if (!input) {
            return function () { return true; };
        }

        function refresh() {
            renderChecklist(checklistContainer, input.value);
        }

        input.addEventListener('input', refresh);
        refresh();

        return function () {
            if (optional && !input.value) {
                return { ok: true, errores: [] };
            }
            return validar(input.value);
        };
    }

    window.JuntaPasswordPolicy = {
        requisitos: REQUISITOS,
        validar: validar,
        renderChecklist: renderChecklist,
        bindPolicy: bindPolicy
    };
})(window);
