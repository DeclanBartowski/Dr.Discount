$(document).on('submit','#login-form',function (e) {
   e.preventDefault();
   var form = $(this);
   var $data = {};
    $.each(form.serializeArray(),function(){
        $data[this.name] = this.value;
    });
    BX.ajax.runComponentAction('vpl:auth',
        'auth', {
            mode: 'class',
            data: {data:$data}
        })
        .then(function(response) {
            if(response.data.STATUS === 'SUCCESS'){
                location.reload();
                //location.href = '/';
                /*form.find('.tq-component-result')
                    .html('Вы успешно авторизованы')
                    .addClass('success')
                    .show();*/
            }else{
                form.find('.tq-component-result').html(response.data.MESSAGE).addClass('error').show();
            }
        });
    return false;
});
