$(document).ready(function() {
    $("#obtped").on("click", function() {
        var long = 0;
        var limite = 200;
        var offset = 0;
        var migrado = 0;
        var total = 0;
        $("#pbardiv").show();
        $("#obtped").hide();
        while (long < 100) {
            $("#progressbar").width(long+'%');
            $.ajax({
                url: ocalStorage.baseurl+'/getmlorders',
                type: 'GET',
                data: {
                    id_cuenta: $("#id_cuenta").val(),
                    offset: offset,
                    limite: limite,
                    migrado: migrado
                },
                success: function(data) {
                    if (data.result) {
                        total = data.total;
                    }
                }
            });
            if (long == 0) {
                long = (limite * 100)/total;
            }
            long += long;
            offset += (limite + 1);
            if ((total-long) < ((limite * 100)/total)) {
                migrado = 1;
            }
        }
    });
});