<?php
/* si va bien redirige a parametrosFormulario.php si va mal, mensaje de error */

function validarNombre($a)
{
    trim($a);
    if (!ctype_upper($a[0]))
        return (false);
    if (strlen($a) > 24)
        return (false);
    return (true);
}
// TODO Datos entrada mysql VVV

$host = "127.0.0.1";
$tabla = "servidor";
$usuario = 'visual';
$clave = 'daw2324';


// TODO Validar entradas de fotos
// TODO añadir titulo pub
$error = "Hay errores en: ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$modelo = $_POST["modelo"];
    @$email = $_POST["email"];
    @$contra = $_POST["contra"];
    @$slider = $_POST["slider"];
    @$tren = $_POST["tren"];
    @$movimiento = $_POST["movimiento"];
    @$comu = $_POST["comu"];
    @$datos = $_POST["datos"];


    if (@$_POST["modelo"] == "") {
        $error .=  "Rellenar el modelo ";
    } elseif (!validarNombre($_POST["modelo"])) {
        $error .=  "modelo";
    }

    if (@$_POST["email"] == "") {
        $error .=  ", email ";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error .=  ", email";
    }
    if (@$_POST["slider"] == "") {
        $error .=  ", el slider es obligatorio";
    }
    if (@$_POST["tren"] == "") {
        $error .= ", el tren es obligatorio";
    }
    if (@$_POST["movimiento"] == "") {
        $error .=  " , el movimiento es obligatorio";
    }
    if (@$_POST["comu"] == "") {
        $error .= ", la comunidad";
    }
    if (@$_POST["datos"] == "") {
        $error .= " y datos ";
    }
    // TODO Sesion   VVV
    session_start();
    $sessionID = session_id();
    @$_SESSION['email'] = $email;










    

    // TODO Depuracion, guardado y recuperacion de archivos
    $fotos = $_FILES['fotos'];
    $dirFotos = [];
    for ($i = 0; $i < count($fotos["name"]); $i++) {
        $nombreFoto = $fotos["name"][$i];
        $tipoFoto = $fotos["type"][$i];
        $tmpName = $fotos["tmp_name"][$i];

        if ($tipoFoto === "image/png") {
            $nombreGuardado = "$sessionID-$i.png";
            move_uploaded_file($tmpName, "fotos/" . $nombreGuardado);
        }
    }
    session_destroy();

    // TODO HECHO Manejo errores

    if ($error != "Hay errores en: ") {
        @$modelo = $_POST["modelo"];
        @$email = $_POST["email"];
        @$contra = $_POST["contra"];
        @$slider = $_POST["slider"];
        @$tren = $_POST["tren"];
        @$movimiento = $_POST["movimiento"];
        @$comu = $_POST["comu"];
        @$datos = $_POST["datos"];
        echo "<script>alert('$error');</script>";
    } else { // si no hay errores lñega hasta aqui y ahora vamos a introducir los datos

        try {
            $mysqli = new mysqli($host, $usuario, $clave, $tabla);
            if ($mysqli->connect_error) {
                die("Error de conexión: " . $mysqli->connect_error);
                echo "error";
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        echo "LLeago"; // TODO BORRAR ESTO

        //header("Location: contar.php");
    }
}

?>

<! //TODO limpiar todos los formatos que no sirven VV>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Repintar formulario</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css">

    </head>

    <body>

        <h1>Train 2 Daw</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <left>
                <? //TODO hacer las subidas 
                ?>
                <h3>Usuario:</h3>
                <label for="email">Email:</label>
                <input value="<?php if (isset($email)) echo $email; ?>" id="entradas" name="email" type="email" class="margen" placeholder="Introduzca su email" required>
                <br><br>
                <label for="contra">Contraseña:</label>
                <input value="<?php if (isset($contra)) echo $contra; ?>" id="entradas" name="contra" type="password" class="margen" placeholder="Introduzca su contraseña" required>



                <br>
                <label for="slider" class="espacio">Fecha de fabricacion</label>
                <input type="range" id="slider" name="slider" class="margen" min="1950" max="2023" step="1" value="<?php if (isset($slider)) {
                                                                                                                        echo $slider;
                                                                                                                    } else {
                                                                                                                        echo "2023";
                                                                                                                    } ?>" width="400px">
                <output for="slider" id="sliderValue"><?PHP if (isset($slider)) {
                                                            echo $slider;
                                                        } else {
                                                            echo "2023";
                                                        }  ?></output>
                <script>
                    // Actualiza el valor del slider en tiempo real
                    const slider = document.getElementById('slider');
                    const sliderValue = document.getElementById('sliderValue');

                    slider.addEventListener('input', function() {
                        sliderValue.textContent = slider.value;
                    });
                </script>



                <h3>Tren:</h3>
                Ave<input type="radio" class="margen" id="altaVelocidad" name="tren" value="1" <?php if (isset($tren) && $tren === "1") echo "checked"; ?>>
                Alvia<input type="radio" class="margen" id="altaVelocidad" name="tren" value="2" <?php if (isset($tren) && $tren === "2") echo "checked"; ?>>
                Avant<input type="radio" class="margen" id="altaVelocidad" name="tren" value="3" <?php if (isset($tren) && $tren === "3") echo "checked"; ?>>
                IRYO<input type="radio" class="margen" id="altaVelocidad" name="tren" value="4" <?php if (isset($tren) && $tren === "4") echo "checked"; ?>>
                OUIGO<input type="radio" class="margen" id="altaVelocidad" name="tren" value="5" <?php if (isset($tren) && $tren === "5") echo "checked"; ?>>
                <br>
                LD<input type="radio" class="margen" id="trenes" name="tren" value="6" <?php if (isset($tren) && $tren === "6") echo "checked"; ?>>
                MD<input type="radio" class="margen" id="trenes" name="tren" value="7" <?php if (isset($tren) && $tren === "7") echo "checked"; ?>>
                Cercanias/Rodalies<input type="radio" class="margen" id="trenes" name="tren" value="8" <?php if (isset($tren) && $tren === "8") echo "checked"; ?>>
                AM<input type="radio" class="margen" id="trenes" name="tren" value="9" <?php if (isset($tren) && $tren === "am") echo "9"; ?>>
                <br><br>
                <label for="modelo">Modelo:</label>
                <input value="<?php if (isset($modelo)) echo $modelo; ?>" class="entradas" id="entradas" name="modelo" type="text" placeholder="Introduzce el modelo" required>

                <br><br>
                <label for="movimiento">Posicion:</label>
                <select class="mov" name="movimiento" required>

                    <option value="quieto" <?php if (isset($movimiento) && $movimiento === "quieto") echo "selected"; ?>>Quieto</option>
                    <option value="moviendo" <?php if (isset($movimiento) && $movimiento === "moviendo") echo "selected"; ?>>Movimiento</option>
                    <option value="reparando" <?php if (isset($movimiento) && $movimiento === "reparando") echo "selected"; ?>>Reparando</option>

                </select>

                <br><br>

                <label for="birthdaytime">Fecha de foto:</label>
                <input type="datetime-local" id="fecha" name="fecha" max="<?= date('Y-m-d\TH:i'); ?>" value="<?php if (isset($fecha)) echo $fecha; ?>" required>


                <br><br>


                <label for="comu">Donde sacaste la foto</label>

                <select class="comu" name="comu" id="comu" required>

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




                <br><br>
                <label for="fotos">Selecciona archivos png:</label>
                <input type="file" name="fotos[]" class="margen" display="block" id="fotos" accept="image/png" multiple required>
                <br>
                <label for="publicidad" class="margen">Aceptas los terminos y condiciones</label>

                <input type="checkbox" id="datos" name="datos" class="margen" <?php if (isset($datos)) {
                                                                                    echo "checked";
                                                                                } else {
                                                                                    echo "2023";
                                                                                } ?>>
                


            </left>


            <p> <input type="submit" class="btn"></p>



            <br><br>


        </form>

    </body>

    </html>