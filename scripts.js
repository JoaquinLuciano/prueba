$(document).ready(function () {
    $("#tablaSelect").change(function () {
        var selectedTable = $("#tablaSelect").val();
        
        $.post("request.php", { tabla: selectedTable }, function (data) {
            $("#tablaResultado").html(data);
        });

        const formulario = document.querySelector('.tablaResultado');
        formulario.style.display = 'block';

    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Realizar la solicitud POST cuando la página se carga
    const tablaResultado = document.getElementById('tablaResultado');

    // Realizar la solicitud POST con AJAX usando jQuery
    $.post("request.php", { tabla: 'carnes' }, function(data) {
        // Colocar la respuesta dentro del elemento con el ID "tablaResultado"
        $(tablaResultado).html(data);
    });
});
