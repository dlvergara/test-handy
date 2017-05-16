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
        })
        .done(function( data ) {
            var sel = $("#departamento");
            if( data.length > 0 && data[0] != '[]' ) {
                sel.replaceWith('<select name="departamento" id="departamento" ><option>-seleccione-</option></select>');
                sel = $("#departamento");
                //sel.empty();
                for (var i=0; i<data.length; i++) {
                    var jsonData = JSON.parse(data[i]);
                    sel.append('<option value="' + jsonData.id + '">' + jsonData.nombre + '</option>');
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
        })
        .done(function( data ) {
            var sel = $("#ciudad");
            if( data.length > 0 ) {
                sel.replaceWith('<select name="ciudad" id="ciudad" ><option>-seleccione-</option></select>');
                sel = $("#ciudad");
                for (var i=0; i<data.length; i++) {
                    //var jsonData = JSON.parse(data[i]);
                    sel.append('<option value="' + data[i].id + '">' + data[i].nombre + '</option>');
                }
            } else { //volver un input
                sel.replaceWith('<input type="text" name="ciudad" id="ciudad">');
            }
        });
    }
}

function reemplazarCiudad() {
    $("#ciudad").replaceWith('<input type="text" name="departamento" id="departamento">');
}

function guardarCliente() {
    
}