$(function () {
    const $form = $('#demoForm');
    const $submitButton = $form.find('.submit-button');
    const $themeButton = $('#themeButton');

    getPreferences();

    $themeButton.on('click', function () {
        setPreferences();
    });

    $form.on('submit', function (event) {
        event.preventDefault();
        evaluarFormulario();
    });

    $form.on('input change', 'input, select', function () {
        limpiarError($(this));
    });

    function evaluarFormulario() {
        const nombre = $.trim($('#nombre').val());
        const correo = $.trim($('#correo').val());
        const pais = $('#pais').val();
        const favLanguage = $('input[name="fav_language"]:checked').val() || '';
        const prueba = $('input[name="prueba[]"]').map(function () {
            return $.trim($(this).val());
        }).get();

        const camposFaltantes = [];
        limpiarErrores();

        if (!nombre) {
            camposFaltantes.push('nombre');
            marcarError($('#nombre'));
        }

        if (!correo) {
            camposFaltantes.push('correo');
            marcarError($('#correo'));
        } else if (!esCorreoValido(correo)) {
            camposFaltantes.push('correo');
            marcarError($('#correo'));
        }

        if (!pais) {
            camposFaltantes.push('país');
            marcarError($('#pais'));
        }

        if (!favLanguage) {
            camposFaltantes.push('lenguaje favorito');
            $('.radio-field').addClass('alert-label');
        }

        if (camposFaltantes.length > 0) {
            mostrarRespuesta({
                status: 'error',
                message: 'Complete los campos obligatorios: ' + camposFaltantes.join(', ') + '.',
                missing_fields: camposFaltantes,
            });
            return;
        }

        $submitButton.prop('disabled', true).addClass('is-loading');

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: {
                nombre: nombre,
                correo: correo,
                pais: pais,
                fav_language: favLanguage,
                prueba: prueba,
            },
        })
            .done(function (response) {
                mostrarRespuesta(response);
                console.log(JSON.stringify(response, null, 2));
            })
            .fail(function (xhr) {
                let response;

                try {
                    response = xhr.responseJSON || JSON.parse(xhr.responseText);
                } catch (error) {
                    response = {
                        status: 'error',
                        message: 'No fue posible procesar la respuesta del servidor.',
                    };
                }

                mostrarRespuesta(response);
                console.error(response);
            })
            .always(function () {
                $submitButton.prop('disabled', false).removeClass('is-loading');
            });
    }

    function mostrarRespuesta(response) {
        const isSuccess = response.status === 'success';
        const $panel = $('#responsePanel');

        $panel
            .removeClass('is-success is-error')
            .addClass(isSuccess ? 'is-success' : 'is-error')
            .attr('aria-hidden', 'false');

        $('#responseTitle').text(isSuccess ? 'Envío exitoso' : 'No se pudo enviar');
        $('#responseMessage').text(
            response.message || (isSuccess
                ? 'Tus datos se enviaron correctamente.'
                : 'Revise los datos del formulario.')
        );
        $('#responseJson').text(JSON.stringify(response, null, 2));

        $panel[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function marcarError($input) {
        $input.addClass('alert-input');
        $input.closest('.field-group').addClass('alert-label');
    }

    function limpiarError($input) {
        $input.removeClass('alert-input');
        $input.closest('.field-group').removeClass('alert-label');

        if ($input.is('[name="fav_language"]')) {
            $('.radio-field').removeClass('alert-label');
        }
    }

    function limpiarErrores() {
        $('.alert-input').removeClass('alert-input');
        $('.alert-label').removeClass('alert-label');
    }

    function esCorreoValido(correo) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);
    }

    function setPreferences() {
        const currentTheme = $('body').hasClass('dark-theme') ? 'dark' : 'light';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.cookie = 'theme=' + nextTheme + '; path=/; max-age=604800; SameSite=Lax';
        applyTheme(nextTheme);
    }

    function getPreferences() {
        let theme = '';

        if (document.cookie) {
            const cookies = document.cookie.split('; ');

            for (const cookie of cookies) {
                const separator = cookie.indexOf('=');
                const name = separator === -1 ? cookie : cookie.slice(0, separator);
                const value = separator === -1 ? '' : cookie.slice(separator + 1);

                if (name === 'theme') {
                    theme = decodeURIComponent(value);
                    break;
                }
            }
        }

        if (theme !== 'dark' && theme !== 'light') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        applyTheme(theme);
    }

    function applyTheme(theme) {
        const isDark = theme === 'dark';

        $('body')
            .toggleClass('dark-theme', isDark)
            .toggleClass('light-theme', !isDark);

        $themeButton.attr('aria-pressed', String(isDark));
        $themeButton.find('.theme-button__icon').text(isDark ? '☀️' : '🌙');
        $themeButton.find('.theme-button__text').text(isDark ? 'Tema claro' : 'Tema oscuro');
    }
});
