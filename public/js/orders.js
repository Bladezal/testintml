$(document).ready(function(){
    $('#modalDetalle').on('show.bs.modal',function(e) {
        /* e.preventDefault(); */
        var boton = $(e.relatedTarget);
        var orderId = boton.data('orderid');

        $.ajax({
            url: localStorage.baseurl+'/orderdetail/'+orderId,
            type: 'GET',
            success: function(data) {
                if (data.result) {
                    $('#orderBody').append(data.view);
                }
            }
        });
    });

    $('#modalDetalle').on('hide.bs.modal', function() {
        $('#orderBody').empty();
    });

    $("#saveOrderDetail").on('click',function() {
        $.ajax({
            url: localStorage.baseurl+'/orderupdate',
            type: 'POST',
            data: { _token : $("input[name='_token']").val(),
                    orderId: $("#orderid").val(),
                    notes: $("#ordernotes").val(),
                    status: $("#orderstatus").val()},
            success: function(data) {
                if (data.result) {
                    $('#modalDetalle').modal('hide');
                    location.reload();
                }
            }
        });
    });
});