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
        

        body {
            background-image: url('tren1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            opacity: 1;
        }

        left {
            text-align: left;
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

        input[type="text"],
        entradas {
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
            background-color: #0074D9;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        p {
            color: #FFFFFF;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <form action="saludo.php" method="post">
        <left>
            <h1>Train 2 Daw</h1>
            <h3>CAMPOS DE TEXTO:</h3>
            <label for="nombre">Nombre:</label>
            <input value="<?php if (isset($nombre)) echo $nombre; ?>" id="entradas" name="nombre" type="text">
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
            Cercanias/Rodalies<input type="radio" id="trenes" name="cerca" value="naranja" <?php if (isset($tren) && $tren === "cerca") echo "checked"; ?>>
            AM<input type="radio" id="trenes" name="tren" value="am" <?php if (isset($tren) && $tren === "am") echo "checked"; ?>>
            <br>


            <br>
            <p>Posicion:</p>
            <select name="movimiento">

                <option value="quieto" <?php if (isset($movimiento) && $movimiento === "quieto") echo "selected"; ?>>Quieto</option>

                <option value="moviendo" <?php if (isset($movimiento) && $movimiento === "moviendo") echo "selected"; ?>>Movimiento</option>

                <option value="reparando" <?php if (isset($movimiento) && $movimiento === "reparando") echo "selected"; ?>>Reparando</option>

            </select>

                <br>
                <p>Donde sacaste la foto </p>

            <select name="comunidad_autonoma">
                <option value="Andalucía">Andalucía</option>
                <option value="Aragón">Aragón</option>
                <option value="Asturias">Asturias</option>
                <option value="Canarias">Canarias</option>
                <option value="Cantabria">Cantabria</option>
                <option value="Castilla y León">Castilla y León</option>
                <option value="Castilla-La Mancha">Castilla-La Mancha</option>
                <option value="Cataluña">Cataluña</option>
                <option value="Extremadura">Extremadura</option>
                <option value="Galicia">Galicia</option>
                <option value="Islas Baleares">Islas Baleares</option>
                <option value="La Rioja">La Rioja</option>
                <option value="Madrid">Madrid</option>
                <option value="Murcia">Murcia</option>
                <option value="Navarra">Navarra</option>
                <option value="País Vasco">País Vasco</option>
                <option value="Valencia">Comunidad Valenciana</option>
            </select>



            <br><br>
            <input type="submit">
            <p> </p>
        </left>

        <label for="publicidad">Quiero recibir publicidad</label>
        <input type="checkbox" id="publicidad" name="publicidad" <?php if (isset($publicidad)) echo "checked"; ?>>
    </form>
</body>

</html>