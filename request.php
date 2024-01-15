<link rel="stylesheet" href="./fonts/Open Sans/opensans.css">
<link rel="stylesheet" href="./css/reset.css">
<link rel="stylesheet" href="./css/styles.css">
<script src="https://kit.fontawesome.com/34c8c46ca5.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<?php
include ('config.php');




if (isset($_POST['tabla'])) {
    $selectedTable = $_POST['tabla'];

    // Consulta solo la columna "Alimento" (columna 2)
    $query = "SELECT Alimento FROM $selectedTable";

    $result = $conn0->query($query);

    if ($result) {

        echo "<div class='input-2__search-bar'>";
            echo "<select name='tabla' id='tablaSelect2' class='search-bar__bar'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option>" . $row['Alimento'] . "</option>";
            }
            echo "</select>";
        echo "</div>";

        echo "<div class='info-btn__calc-btn'>";
        echo "<input type='button' id='add' class='btn__calc' value='Agregar'>";
        echo "</div>";

        //echo "<div id='listaElementos'></div>";

        echo "<div class='info-btn__calc-btn'>";
        echo "<input type='button' id='enviarButton' class='btn__calc' value='Resultados'>";
        echo "</div>";
            
        $result->close();
    } else {
        echo "Error al ejecutar la consulta: " . $conn0->error;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idDiv']) && isset($_POST['texto']) && isset($_POST['valorInput1'])) {
    $idsDiv = $_POST['idDiv'];
    $textos = $_POST['texto'];
    $valoresInput1 = $_POST['valorInput1'];

    // Array con los nombres de las tablas a buscar
    $tablas = array("carnes", "carnesag", "cereales", "frutas", "grasas", "huevo", "leche", "misc", "pescados", "pescadosag", "prodaz", "vegetales");

    // Variables para almacenar los totales
    $totalGramos = 0;
    $totalEnergiaKJ = 0;
    $totalProteinas = 0;
    $totalGrasaTotal = 0;
    $totalCarbohidratosTotales = 0;
    $totalSodio = 0;

    // Iterar sobre los arrays para trabajar con los datos
    for ($i = 0; $i < count($idsDiv); $i++) {
        $texto = $textos[$i];
        $inputValue = $valoresInput1[$i];

        $encontrado = false;
        foreach ($tablas as $tabla) {
            // Realizar la consulta para obtener la información del alimento correspondiente en la tabla actual
            $consulta = $conn0->prepare("SELECT * FROM $tabla WHERE Alimento = ?");
            $consulta->bind_param('s', $texto);
            $consulta->execute();
            $resultado = $consulta->get_result()->fetch_assoc();

            if ($resultado) {

                // Guardar los valores de las columnas específicas en variables
                $energiaKJ = $resultado['Energia_KJ'];
                $proteinas = $resultado['Proteinas'];
                $grasaTotal = $resultado['Grasa_Total'];
                $carbohidratosTotales = $resultado['Carbohidratos_Totales'];
                $sodio = $resultado['Sodio'];

                // Calcular los nuevos valores basados en la cantidad ingresada
                $proporcionEnergiaKJ = ($energiaKJ * $inputValue) / 100;
                $proporcionProteinas = ($proteinas * $inputValue) / 100;
                $proporcionGrasaTotal = ($grasaTotal * $inputValue) / 100;
                $proporcionCarbohidratosTotales = ($carbohidratosTotales * $inputValue) / 100;
                $proporcionSodio = ($sodio * $inputValue) / 100;

                // Sumar a los totales
                $totalGramos += $inputValue;
                $totalEnergiaKJ += $proporcionEnergiaKJ;
                $totalProteinas += $proporcionProteinas;
                $totalGrasaTotal += $proporcionGrasaTotal;
                $totalCarbohidratosTotales += $proporcionCarbohidratosTotales;
                $totalSodio += $proporcionSodio;

                // Mostrar el nombre del alimento y los nuevos valores calculados
                //echo "<br>Alimento: $texto<br>";
                //echo "Proporción de Energía (KJ) a $inputValue gramos: $proporcionEnergiaKJ KJ<br>";
                //echo "Proporción de Proteínas a $inputValue gramos: $proporcionProteinas g<br>";
                //echo "Proporción de Grasa Total a $inputValue gramos: $proporcionGrasaTotal g<br>";
                //echo "Proporción de Carbohidratos Totales a $inputValue gramos: $proporcionCarbohidratosTotales g<br>";
                //echo "Proporción de Sodio a $inputValue gramos: $proporcionSodio g<br>";

                $encontrado = true;
                break; // Terminar el bucle ya que se encontró el resultado
            }
        }

        
        
        if (!$encontrado) {
            // Manejar el caso en que no se encuentre el resultado en ninguna tabla
            echo "El alimento '$texto' no se encontró en ninguna tabla.";
        }
    }

    // Calcular los nuevos valores basados en la cantidad ingresada a 100g
    $totalEnergiaKJ100g = number_format((100 * $totalEnergiaKJ) / $totalGramos, 2, ',','');
    $totalProteinas100g = number_format((100 * $totalProteinas) / $totalGramos, 2, ',','');
    $totalGrasaTotal100g = number_format((100 * $totalGrasaTotal) / $totalGramos, 2, ',','');
    $totalCarbohidratosTotales100g = number_format((100 * $totalCarbohidratosTotales) / $totalGramos, 2, ',','');
    $totalSodio100g = number_format((100 * $totalSodio) / $totalGramos, 2, ',','');

    // Mostrar el total de cada nutriente
    //echo "<br>Total de gramos del producto: $totalGramos g<br>";
    //echo "<br>Total de Energía (KJ): $totalEnergiaKJ KJ<br>";
    //echo "Total de Proteínas: $totalProteinas g<br>";
    //echo "Total de Grasa Total: $totalGrasaTotal g<br>";
    //echo "Total de Carbohidratos Totales: $totalCarbohidratosTotales g<br>";
    //echo "Total de Sodio: $totalSodio g<br>";
}


?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaSelect2').select2(); // Inicializar Select2 en el primer select
    });
</script>

<script>

    var addButton = document.getElementById('add');
    var selectElement = document.getElementById('tablaSelect2');
    var listaElementos = document.getElementById('listaElementos');

    var contador = 0;

    addButton.addEventListener('click', function() {
        // Obtener el valor y el texto seleccionado del select
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var text = selectedOption.textContent;

        // Crear un nuevo div para contener el contenido
        var divItem = document.createElement('div');
        divItem.classList.add('info-btn__rectangle'); // Reemplaza 'miClase' con el nombre de la clase que desees asignar
        divItem.id = contador;


        // Crear un nuevo span para el texto seleccionado
        var spanItem = document.createElement('span');
        spanItem.textContent = text;
        spanItem.classList.add('rectangle__title');

        // Crear dos elementos input
        var input1 = document.createElement('input');
        input1.type = 'number'; // Tipo de input numerico
        input1.classList.add('rectangle__total-info');
        var input2 = document.createElement('input');
        //input2.type = 'number'; // Tipo de input numerico
        //input2.classList.add('rectangle__percent');

        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.classList.add('delete-btn');

        // Agregar un evento al botón para eliminar el div
        deleteButton.addEventListener('click', function() {
            divItem.remove(); // Elimina el div cuando se hace clic en el botón de eliminar
        });

        // Agregar el span y los inputs al div
        divItem.appendChild(spanItem);
        divItem.appendChild(input1);
        //divItem.appendChild(input2);
        
        // Agregar el botón de eliminar al div
        divItem.appendChild(deleteButton);

        // Agregar el div al contenedor listaElementos
        listaElementos.appendChild(divItem);
        contador++;
    });


    enviarButton.addEventListener('click', function() {
    var elementos = document.querySelectorAll('.info-btn__rectangle');
    var datos = [];

    elementos.forEach(function(elemento) {
        var texto = elemento.querySelector('.rectangle__title').textContent;
        var valorInput1 = elemento.querySelector('.rectangle__total-info').value;
        var idDiv = elemento.id; // Obtener el ID del div

        datos.push({
            idDiv: idDiv,
            texto: texto,
            valorInput1: valorInput1
        });
    });

    // Crear un formulario y agregar datos como inputs ocultos
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = ''; // Dejar en blanco para enviar al mismo archivo PHP

    datos.forEach(function(dato) {
        Object.keys(dato).forEach(function(key) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = key + '[]'; // Usar corchetes para recibir un array en PHP
            input.value = dato[key];
            form.appendChild(input);
        });
    });

    document.body.appendChild(form);
    form.submit();
    });




    /*var enviarButton = document.getElementById('enviarButton'); // Suponiendo que tienes un botón con el ID 'enviarButton'

    enviarButton.addEventListener('click', function() {
    // Obtener todos los divs con la clase 'info-btn__rectangle'
    var divs = document.querySelectorAll('.info-btn__rectangle');

    var dataToSend = [];

    // Recorrer cada div y obtener la información
    divs.forEach(function(div) {
        var id = div.id;
        var text = div.querySelector('.rectangle__title').textContent;
        var input1Value = div.querySelector('.rectangle__total-info').value;

        // Agregar la información al arreglo dataToSend
        dataToSend.push({
            id: id,
            text: text,
            input1Value: input1Value
        });
    });

    // Mostrar en la consola la información a enviar
    console.log('Datos a enviar:');
    console.log(dataToSend);

    // Convertir la información a JSON para enviarla
    var jsonData = JSON.stringify(dataToSend);

    // Enviar los datos a través de una solicitud XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'other.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Datos enviados correctamente a request.php');
            } else {
                console.error('Hubo un error al enviar los datos.');
            }
        }
    };

    // Enviar la información JSON al archivo PHP
    xhr.send(jsonData);
});*/


</script>