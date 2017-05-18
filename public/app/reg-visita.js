/**
 * Created by David Leonardo V on 15/05/2017.
 */
var procentajeVisita = 0;

function asignarEventos() {
    $("#valor_neto").keyup(function() {
        var neto = ($(this).val() * procentajeVisita)/100;
        console.log(neto);
        $("#valor_visita").val( neto );
    });
}

function guardarData() {

    var data = {
        "fecha": $("#fecha").val(),
        "vendedor": $("#vendedor").val(),
        "valor_neto": $("#valor_neto").val(),
        "valor_visita": $("#valor_visita").val(),
        "observaciones": $("#observaciones").val(),
        "idCliente": idCliente
    };

    $.ajax({
        url: "/api/visita",
        method: "POST",
        data: data,
        beforeSend: function(){
            bloquear();
            limpiarError();
        }
    })
    .error(function( data ) {
        desbloquear();
    })
    .done(function( data ) {
        if( data.error != undefined ) {
            error( data );
            desbloquear();
        } else {
            limpiarError();
            $("#save").val("Exito!");
            var html = 'Exito! '+JSON.stringify(data);
            $("#success").append(html);
            $("#success").show();
        }
    });
}

function error( data ) {
    var html = '';
    html += "<ul>";
    $.each(data.error, function (index1, item1) {
        html += "<li>" + item1 + "</li>";
    });
    html+="</ul>";

    $("#error").append(html);
    $("#error").show();
}

function limpiarError() {
    $("#error").html('');
    $("#error").hide();
}

function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function desbloquear(){
    $("#save").removeAttr('disabled');
    $("#save").val("Guardar");
}

function bloquear() {
    $("#save").attr({'disabled': 'disabled'});
    $("#save").val("Cargando...");
}
