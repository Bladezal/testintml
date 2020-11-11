$(document).ready(function(){
    $('#addstatus').on('click',function(e) {
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: localStorage.baseurl+'/status/add',
            data:{'desc': $("#statusdesc").val(), 'code': $("#statuscode").val(), _token: _token},
            type: 'POST',
            success: function(data) {
                if (data.result) {
                    location.reload();
                }
            }
        });
    })
});