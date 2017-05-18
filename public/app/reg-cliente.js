/**
 * Created by David Leonardo V on 15/05/2017.
 */

function asignarEventos() {
    $("#pais").change( function(){ getEstados() });
    $("#departamento").change( function(){ getCiudades() });
}

function getEstados() {
    var pais = $("#pais").val();
    if( pais != '' ) {
        $.ajax({
            url: "/api/get-estados?pais="+pais,
            beforeSend: function(){
                bloquear();
            }
        })
        .done(function( data ) {
            desbloquear();
            var sel = $("#departamento");
            if( data.length > 0 ) {
                sel.replaceWith('<select name="departamento" id="departamento" ><option>-seleccione-</option></select>');
                sel = $("#departamento");
                for (var i=0; i < data.length; i++) {
                    if( data[i] != '[]' ) {
                        if( IsJsonString(data[i]) ) {
                            var jsonData = JSON.parse(data[i]);
                        } else {
                            var jsonData = data[i];
                        }
                        sel.append('<option value="' + jsonData.id + '">' + jsonData.nombre + '</option>');
                    }
                }
            } else { //volver un input
                sel.replaceWith('<input type="text" name="departamento" id="departamento">');
                reemplazarCiudad();
            }
            $("#departamento").change( function(){ getCiudades() });
        });
    }
}

function getCiudades() {
    if( $("#departamento").is('select') ) {
        getCiudadesFromSelect();
    } else {
        reemplazarCiudad();
    }
}

function getCiudadesFromSelect() {
    var estado = $("#departamento").val();
    if( estado != '' ) {
        $.ajax({
            url: "/api/get-ciudades?estado="+estado,
            beforeSend: function(){
                bloquear();
            }
        })
        .done(function( data ) {
            desbloquear();
            var sel = $("#ciudad");
            if( data.length > 0 ) {
                sel.replaceWith('<select name="ciudad" id="ciudad" ><option>-seleccione-</option></select>');
                sel = $("#ciudad");
                for (var i=0; i<data.length; i++) {
                    if( IsJsonString(data[i]) ) {
                        var jsonData = JSON.parse(data[i]);
                    } else {
                        var jsonData = data[i];
                    }
                    console.log(jsonData);
                    sel.append('<option value="' + jsonData.id + '">' + jsonData.nombre + '</option>');
                }
            } else { //volver un input
                sel.replaceWith('<input type="text" name="ciudad" id="ciudad">');
            }
        });
    }
}

function reemplazarCiudad() {
    $("#ciudad").replaceWith('<input type="text" name="ciudad" id="ciudad">');
}

function guardarCliente() {

    var data = {
        "nit": $("#nit").val(),
        "nombre": $("#nombreCompleto").val(),
        "direccion": $("#direccion").val(),
        "telefono": $("#telefono").val(),
        "pais": $("#pais").val(),
        "departamento": $("#departamento").val(),
        "ciudad": $("#ciudad").val(),
        "cupo": $("#cupo").val()
    };
    console.log( data );

    $.ajax({
        url: "/api/cliente",
        method: "POST",
        data: data,
        beforeSend: function(){
            bloquear();
            limpiarError();
        }
    })
    .error(function( data ) {
        console.error(data);
        desbloquear();
    })
    .done(function( data ) {
        if( data.error != undefined ) {
            error( data );
            desbloquear();
        } else {
            limpiarError();
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
