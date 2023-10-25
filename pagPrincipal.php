<?php
/* si va bien redirige a parametrosFormulario.php si va mal, mensaje de error */
$ciudades = array();
$error = "";
function validarNombre($a)
{
    trim($a);
    if (!ctype_upper($a[0]))
        return (false);
    if (strlen($a) > 12)
        return (false);
    return (true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["nombre"] == "") {
        $error .= "Recuerda rellenar el nombre ";
    } elseif (!validarNombre($_POST["nombre"])) {
        $error .= "nombre mal introducido ";
    }

    if ($_POST["email"] == "") {
        $error .= "El email es obligatorio";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error .= "Formato email incorrecto";
    }





    if (isset($error)) {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        echo $error;
    } else {
        header("Location: parametrosFormulario.php");
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Repintar formulario</title>
    <meta charset="UTF-8">
    <style>
        h2 {
            display: inline-block;
            color: #000;
            background: #fff;
            mix-blend-mode: multiply;
            position: relative;
        }

        h2:before {
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, red, yellow);
            mix-blend-mode: screen; //<-- atento a esta linea//
            position: absolute;
            top: 0;
            left: 0;
        }

        body {
            background-image: url('tren1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            opacity: 1;
        }

        center {
            text-align: center;
        }

        right {
            text-align: right;
        }

        #visor_imagenes {
            text-align: center;
        }


        form {
            background: linear-gradient(to bottom, #81005E, #2b598d);
            width: 30%;
            min-width: 400px;
            max-width: 1500px;
            padding-bottom: 10px;
            color: #FFFFFF;
            /* Color de texto blanco */
        }

        label {
            display: block;
            margin-top: 10px;
        }

        .mov {
            width: 100px;
        }

        .comu {
            width: 180px;
        }

        input[type="text"],
        .entradas {
            width: 33%;
            min-width: 100px;
        }




        input[type="range"] {
            width: 70%;
        }

        select {
            width: 80px;
            padding: 3px;
            border-radius: 3px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #81005E;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="checkbox"] {
            margin-right: 5px;
            padding: 10px 20px;
        }

        p {
            color: #FFFFFF;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h1>Train 2 Daw</h1>
    <form action="saludo.php" method="post">
        <left>

            <h3>CAMPOS DE TEXTO:</h3>
            <label for="nombre">Nombre:</label>
            <input value="<?php if (isset($nombre)) echo $nombre; ?>" class="entradas" id="entradas" name="nombre" type="text">
            <label for="email">Email:</label>
            <input value="<?php if (isset($email)) echo $email; ?>" id="entradas" name="email" type="email">

            <br>
            <label for="slider">Edad de fabricacion</label>
            <input type="range" id="slider" name="slider" min="1950" max="2023" step="1" value="2023" width="400px">
            <output for="slider" id="sliderValue">2023</output>
            <script>
                // Actualiza el valor del slider en tiempo real
                const slider = document.getElementById('slider');
                const sliderValue = document.getElementById('sliderValue');

                slider.addEventListener('input', function() {
                    sliderValue.textContent = slider.value;
                });
            </script>

            <br>

            <h3>Tipo tren:</h3>
            Ave<input type="radio" id="altaVelocidad" name="tren" value="ave" <?php if (isset($tren) && $tren === "ave") echo "checked"; ?>>
            Alvia<input type="radio" id="altaVelocidad" name="tren" value="alvia" <?php if (isset($tren) && $tren === "alvia") echo "checked"; ?>>
            Avant<input type="radio" id="altaVelocidad" name="tren" value="avant" <?php if (isset($tren) && $tren === "avant") echo "checked"; ?>>
            IRYO<input type="radio" id="altaVelocidad" name="tren" value="iryo" <?php if (isset($tren) && $tren === "iryo") echo "checked"; ?>>
            OIUGO<input type="radio" id="altaVelocidad" name="tren" value="oui" <?php if (isset($tren) && $tren === "oui") echo "checked"; ?>>
            <br>
            LD<input type="radio" id="trenes" name="tren" value="ld" <?php if (isset($tren) && $tren === "ld") echo "checked"; ?>>
            MD<input type="radio" id="trenes" name="tren" value="md" <?php if (isset($tren) && $tren === "md") echo "checked"; ?>>
            Cercanias/Rodalies<input type="radio" id="trenes" name="tren" value="naranja" <?php if (isset($tren) && $tren === "cerca") echo "checked"; ?>>
            AM<input type="radio" id="trenes" name="tren" value="am" <?php if (isset($tren) && $tren === "am") echo "checked"; ?>>
            <br>


            <br>
            <p>Posicion:</p>
            <select class="mov" name="movimiento">

                <option value="quieto" <?php if (isset($movimiento) && $movimiento === "quieto") echo "selected"; ?>>Quieto</option>
                <option value="moviendo" <?php if (isset($movimiento) && $movimiento === "moviendo") echo "selected"; ?>>Movimiento</option>
                <option value="reparando" <?php if (isset($movimiento) && $movimiento === "reparando") echo "selected"; ?>>Reparando</option>

            </select>

            <br>
            <p>Donde sacaste la foto </p>

            <select class="comu" name="comu" id="comu">

                <option value="Andalucía" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Andalucía") echo "selected"; ?>>Andalucía</option>
                <option value="Aragón" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Aragón") echo "selected"; ?>>Aragón</option>
                <option value="Asturias" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Asturias") echo "selected"; ?>>Asturias</option>
                <option value="Canarias" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Canarias") echo "selected"; ?>>Canarias</option>
                <option value="Cantabria" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Cantabria") echo "selected"; ?>>Cantabria</option>
                <option value="Castilla y León" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Castilla y León") echo "selected"; ?>>Castilla y León</option>
                <option value="Castilla-La Mancha" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Castilla-La Mancha") echo "selected"; ?>>Castilla-La Mancha</option>
                <option value="Cataluña" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Cataluña") echo "selected"; ?>>Cataluña</option>
                <option value="Extremadura" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Extremadura") echo "selected"; ?>>Extremadura</option>
                <option value="Galicia" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Galicia") echo "selected"; ?>>Galicia</option>
                <option value="Islas Baleares" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Islas Baleares") echo "selected"; ?>>Islas Baleares</option>
                <option value="La Rioja" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "La Rioja") echo "selected"; ?>>La Rioja</option>
                <option value="Madrid" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Madrid") echo "selected"; ?>>Madrid</option>
                <option value="Murcia" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Murcia") echo "selected"; ?>>Murcia</option>
                <option value="Navarra" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Navarra") echo "selected"; ?>>Navarra</option>
                <option value="País Vasco" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "País Vasco") echo "selected"; ?>>País Vasco</option>
                <option value="Valencia" <?php if (isset($comunidad_autonoma) && $comunidad_autonoma === "Valencia") echo "selected"; ?>>Comunidad Valenciana</option>

            </select>



            <br><label for="publicidad">porfi acepta que Santi tenga la total potestad sobre mis datos</label>
            <input type="checkbox" id="datos" name="datos" <?php if (isset($datos)) echo "checked"; ?>>
            <br><br>
            <p> <input type="submit"></p>
        </left>




    </form>
</body>

</html>