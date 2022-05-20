$(document).on('submit','#forgot-form',function (e) {
   e.preventDefault();
   var form = $(this);
   var $data = {};
    $.each(form.serializeArray(),function(){
        $data[this.name] = this.value;
    });
    BX.ajax.runComponentAction('vpl:forgotpassword',
        'restorePassword', {
            mode: 'class',
            data: $data
        })
        .then(function(response) {
            if(response.data.STATUS === 'SUCCESS'){
                form.find('.tq-component-result')
                    .html(response.data.MESSAGE)
                    .addClass('success')
                    .show();
            }else{
                form.find('.tq-component-result').html(response.data.MESSAGE).addClass('error').show();
            }
        });
    return false;
});
