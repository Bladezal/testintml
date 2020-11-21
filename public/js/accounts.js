$(document).ready(function() {
    $("#obtped").on("click", function() {
        var long = 0;
        var limite = 50;
        var offset = 0;
        var migrado = 0;
        var total = 0;
        var tmp = 0;
        $("#obtped").prop('disabled', true)
                    .empty()
                    .append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Cargando...');
        while (long < 100) {

            $.ajax({
                url: localStorage.baseurl+'/getmlorders',
                type: 'GET',
                async: false,
                data: {
                    id_cuenta: $("#id_cuenta").val(),
                    offset: offset,
                    limite: limite,
                    migrado: migrado
                },
                success: function(data) {
                    if (data.result) {
                        total = data.total;
                        if (data.errores) {
                            console.log(data.errores);
                            long = 100;
                        }
                    }
                }
            });
            if (tmp == 0) {
                tmp = (limite * 100)/total;
                offset = 1;
            }
            long += tmp;
            offset += limite;
            if ((total-offset) <= limite) {
                migrado = 1;
            }
        }
    });
});