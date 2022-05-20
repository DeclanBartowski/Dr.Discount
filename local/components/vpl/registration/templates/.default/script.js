function updateRegisterCaptcha() {
    BX.ajax.runComponentAction('vpl:registration',
        'getCaptcha', {
            mode: 'class'
        })
        .then(function (response) {
            $('#registerCaptchaImg').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + response.data);
            $('#registerCaptchaSid').val(response.data);
            grecaptcha.reset();
        });
}

$(document).on('submit', '#modal-reg-form', function (e) {
    e.preventDefault();
    var form = $(this);
    var $data = {};
    $.each(form.serializeArray(), function () {
        $data[this.name] = this.value;
    });
    BX.ajax.runComponentAction('vpl:registration',
        'register', {
            mode: 'class',
            data: $data
        })
        .then(function (response) {
            if (response.data.STATUS === 'SUCCESS') {
                location.reload();
                //location.href = '/';
                /*form.find('.tq-component-result')
                    .html('На вашу почту было отправлено сообщение для подтверждения регисртации.')
                    .addClass('success')
                    .show();*/
            } else {
                form.find('.tq-component-result')
                    .html(response.data.MESSAGE)
                    .addClass('error')
                    .show();
            }
            updateRegisterCaptcha();
        });
    return false;
});

