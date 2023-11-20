<?php
/* si va bien redirige a parametrosFormulario.php si va mal, mensaje de error */
$ciudades = array();
function validarNombre($a)
{
    trim($a);
    if (!ctype_upper($a[0]))
        return (false);
    if (strlen($a) > 24)
        return (false);
    return (true);
}


$error = "Hay errores en: ";
// TODO Validar entradas de fotos
// TODO añadir titulo pub
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    } else {
        header("Location: contar.php");
    }
}
// 
?>

<! //TODO limpiar todos los formatos que no sirven>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Repintar formulario</title>
        <meta charset="UTF-8">

        <style>
            @font-face {
                font-family: 'Black Future';
                src: 'black-future.woff2' format('otf');
            }



            


            h1 {
                display: inline-block;
                color: #000;
                background: #fff;
                mix-blend-mode: multiply;
                position: relative;
            }

            h1:before {
                content: '';
                display: block;
                width: 100%;
                height: 100%;
                background: linear-gradient(to right, #81005E, #003380);
                mix-blend-mode: screen;
                text-align: center;
                position: absolute;
                top: 0;
                left: 0;
            }


            body {
                background-image: url('tren2.jpg');
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
                border-radius: 4px;
                margin-left: 6px;
                background: linear-gradient(120deg, #81005E, #2b598d);
                width: 30%;
                min-width: 400px;
                max-width: 1500px;
                padding-bottom: 10px;
                color: #FFFFFF;
                border-radius: 10px;
                /* Color de texto blanco */
            }

            label {
                margin-left: 6px;
                margin-top: 10px;
            }

            .espacio {
                display: block;
            }

            .margen {
                margin-left: 6px;
            }

            .mov {
                margin-left: 6px;
                width: 100px;
            }

            .comu {
                margin-left: 6px;
                width: 180px;
            }

            input[type="text"],
            .entradas {
                margin-left: 6px;
                width: 33%;
                min-width: 100px;
            }




            input[type="range"] {
                margin-left: 6px;
                width: 70%;
            }

            select {
                margin-left: 6px;
                width: 80px;
                padding: 3px;
                border-radius: 3px;
            }

            input[type="radio"] {
                margin-left: 6px;
                margin-right: 5px;
            }

            h3 {
                margin-left: 6px;
            }

            input[type="submit"] {
                margin-left: 6px;
                background-color: #81005E;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                float: right;
                margin-left: 20px;
            }

            input[type="checkbox"] {
                margin-left: 6px;
                margin-right: 5px;
                padding: 10px 20px;
            }

            h3 {

                margin-left: 10px;
            }

            p {
                margin-left: 10px;
            }

            .margenDerecha {
                margin-right: 15px;
            }

            p {
                margin-left: 6px;
                color: #FFFFFF;
                font-weight: bold;
                margin-top: 10px;
            }

            .margen-izquierdo-10px {
                margin-left: 10px;
            }
        </style>
    </head>

    <body>

        <h1>Train 2 Daw</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <left>
                <? //TODO hacer las subidas 
                ?>
                <h3>Usuario:</h3>
                <label for="email">Email:</label>
                <input value="<?php if (isset($email)) echo $email; ?>" id="entradas" name="email" type="email" class="margen" placeholder="Introduzca su email">
                <br><br>
                <label for="contra">Contraseña:</label>
                <input value="<?php if (isset($contra)) echo $contra; ?>" id="entradas" name="contra" type="password" class="margen" placeholder="Introduzca su contraseña">



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
                <input value="<?php if (isset($modelo)) echo $modelo; ?>" class="entradas" id="entradas" name="modelo" type="text" placeholder="Introduzce el modelo">

                <br><br>
                <label for="movimiento">Posicion:</label>
                <select class="mov" name="movimiento">

                    <option value="quieto" <?php if (isset($movimiento) && $movimiento === "quieto") echo "selected"; ?>>Quieto</option>
                    <option value="moviendo" <?php if (isset($movimiento) && $movimiento === "moviendo") echo "selected"; ?>>Movimiento</option>
                    <option value="reparando" <?php if (isset($movimiento) && $movimiento === "reparando") echo "selected"; ?>>Reparando</option>

                </select>

                <br><br>

                <label for="birthdaytime">Fecha de foto:</label>
                <input type="datetime-local" id="fecha" name="fecha" max="<?= date('Y-m-d\TH:i'); ?>" value="<?php if (isset($fecha)) echo $fecha; ?>">


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



                <br>
                <label for="publicidad" class="margen">Aceptas los terminos y condiciones</label>
                <input type="checkbox" id="datos" name="datos" class="margen" <?php if (isset($datos)) {
                                                                                    echo "checked";
                                                                                } else {
                                                                                    echo "2023";
                                                                                } ?>>

                <br>
                <label for="archivos">Selecciona archivos JPG:</label>
                <input type="file" name="archivos[]" class="margen" id="archivos" accept="image/jpeg" multiple>

            </left>

            
            <p> <input type="submit" class="margenDerecha"></p>
            <br><br>


        </form>

    </body>

    </html>