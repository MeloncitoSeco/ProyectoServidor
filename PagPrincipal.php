<?php
/* si va bien redirige a parametrosFormulario.php si va mal, mensaje de error */
include('validar.php');
// TODO Datos entrada mysql VVV
include('datosInicioSql.php');


// TODO añadir titulo pub VVV
$error = "Hay errores en: ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$modelo = $_POST["modelo"];
    @$titulo = $_POST["titulo"];
    @$fecha = $_POST["fecha"];
    @$email = $_POST["email"];
    @$contra = $_POST["contra"];
    @$slider = $_POST["slider"];
    @$tren = $_POST["tren"];
    @$movimiento = $_POST["movimiento"];
    @$comu = $_POST["comu"];
    @$datos = $_POST["datos"];
    @$fotos = $_FILES['fotos'];

    if (@$_POST["modelo"] == "") {
        $error .=  ", el modelo es obligatorio";
    } elseif (!validarModelo(@$_POST["modelo"])) {
        $error .=  ", error en el modelo ";
    }

    if (@$_POST["titulo"] == "") {
        $error .=  "Rellenar el titulo ";
    } elseif (!validarTitulo(@$_POST["titulo"])) {
        $error .=  ", titulo muy largo";
    }
    if (@$_POST["contra"] == "") {
        $error .=  "Rellenar el contra ";
    } elseif (!validarContra(@$_POST["contra"])) {
        $error .=  ", La contraseña debe tener al menos 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. NO puede tener otros símbolos.";
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

 // TODO Comprobar al menos hay una imagen que se va a guardar VVV

    $numFotosGuardadas=0;

            for ($i = 0; $i < count($fotos["name"]); $i++) {

                $nombreFoto = $fotos["name"][$i];
                $tipoFoto = $fotos["type"][$i];
                $tmpName = $fotos["tmp_name"][$i];

                if ($tipoFoto === "image/png") {
                    $numFotosGuardadas++;
                }
            }

    if (!($numFotosGuardadas < 11)  ) {
            $error .= " Demasiadas fotos "; 
    }elseif($numFotosGuardadas==0){
        $error .= " Hay que subir al menos una foto valida, revise que el formato sea png ";
    }elseif($error != "Hay errores en: "){
            @$modelo = $_POST["modelo"];
            @$titulo = $_POST["titulo"];
            @$fecha = $_POST["fecha"];
            @$email = $_POST["email"];
            @$contra = $_POST["contra"];
            @$slider = $_POST["slider"];
            @$tren = $_POST["tren"];
            @$movimiento = $_POST["movimiento"];
            @$comu = $_POST["comu"];
            @$datos = $_POST["datos"];
            echo "<script>alert('$error');</script>";
        }else{

        // TODO Sesion   VVV
        session_start();
        $sessionID = session_id();
        @$_SESSION['email'] = $email;

        // TODO insertar datos en base de datos VVV
        @$inputTipoTren = $tren;
        @$inputExisteUser = $email;
        @$sqlEmail = $email;
        @$sqlModelo = $modelo;
        @$sqlFechaFabricacion = $slider;
        @$sqlContra = $contra;
        @$sqlTitulo = $titulo; // TODO crear un inser llamado titulo VVV
        @$sqlPosicion = $movimiento;
        @$sqlComAuto = $comu;
        @$sqlFecha = $fecha;
        @$sqlSesion = $sessionID;
        @$sqlNum = "1";

        try {
            $mysqli = new mysqli($host, $usuario, $clave, $tabla);
            if ($mysqli->connect_error) {
                die("Error de conexión: " . $mysqli->connect_error);
                echo "error";
            }

            // Sacar tipò tren // TODO sen 1
            $consulta = "SELECT tipoTren FROM tipoTren WHERE nombre = ?";
            if ($stmt = $mysqli->prepare($consulta)) {

                $stmt->bind_param('s', $inputTipoTren);
                if ($stmt->execute()) {
                    $stmt->bind_result($sqlTipoTren);
                    $stmt->fetch();
                    $stmt->free_result();
                }
            }

            // Sacar ultimo tren // TODO sen 2
            $consulta_sacarId = "SELECT max(trenId) FROM tren limit 1";
            if ($stmt = $mysqli->prepare($consulta_sacarId)) {

                if ($stmt->execute()) {
                    $stmt->bind_result($sqlTrenId);
                    $stmt->fetch();
                    $stmt->free_result();
                }
            }

            // Sacar ultima pub // TODO sen 3
            $consulta = "SELECT max(pubId) FROM publicacion limit 1";
            if ($stmt = $mysqli->prepare($consulta)) {
                if ($stmt->execute()) {
                    $stmt->bind_result($sqlPubId);
                    $stmt->fetch();
                    $stmt->free_result();
                }
            }

            //sqlExisteUser // TODO sen 4
            $consulta = " SELECT COUNT( email) > 0 FROM usuario WHERE email=? limit 1";

            if ($stmt = $mysqli->prepare($consulta)) {

                $stmt->bind_param('s', $inputExisteUser);
                if ($stmt->execute()) {
                    $stmt->bind_result($sqlExisteUser);
                    $stmt->fetch();
                    $stmt->free_result();
                }
            }
            //PREPARACION DE DATOS

            // necesito la id del tren que es la sen 2 y el tipo tren que es la sen 1
            //$sqlTipoTren;
            $sqlTrenId++;
            //$sqlModelo
            //$sqlFechaFabricacion

            $stmt = $mysqli->prepare("INSERT INTO Tren (trenId, modelo, tipoTren, fechaFabricacion) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isii", $sqlTrenId, $sqlModelo, $sqlTipoTren, $sqlFechaFabricacion);
            $stmt->execute();
            // ver si existe el usuario
            //$sqlContra

            if ($sqlExisteUser != 1) {
                $stmt = $mysqli->prepare("INSERT INTO Usuario (email, contra) VALUES (?, ?)");
                $stmt->bind_param("ss", $sqlEmail, $sqlContra);
                $stmt->execute();
            }

            //Insertar en la publicacion
            //$sqlTitulo
            //$sqlPosicion
            //$sqlComAuto
            $sqlPubId++;
            $stmt = $mysqli->prepare("INSERT INTO Publicacion (pubId, email, trenId, titulo, posicion, comAuto) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isisss", $sqlPubId, $sqlEmail, $sqlTrenId, $sqlTitulo, $sqlPosicion, $sqlComAuto);
            $stmt->execute();

            // TODO Depuracion, guardado y recuperacion de archivos  VVV
            
            // $dirFotos = [];
            $sqlLastIdImg;
            $numFotosGuardadas;

            for ($i = 0; $i < count($fotos["name"]); $i++) {

                $nombreFoto = $fotos["name"][$i];
                $tipoFoto = $fotos["type"][$i];
                $tmpName = $fotos["tmp_name"][$i];

                if ($tipoFoto === "image/png") {
                    $consulta = " SELECT max(imgId) FROM imagen";

                    if ($stmt = $mysqli->prepare($consulta)) {
                        if ($stmt->execute()) {
                            $stmt->bind_result($sqlLastIdImg);
                            $stmt->fetch();
                            $stmt->free_result();
                            $sqlLastIdImg++;
                        }
                    }

                    $nombreGuardado = "$sqlLastIdImg.png";
                    move_uploaded_file($tmpName, "fotos/" . $nombreGuardado);
                    //insertar datos fotos

                    //$sqlFecha
                    //$sqlSesion
                    //$sqlNum

                    $stmt = $mysqli->prepare("INSERT INTO Imagen (fecha, pubId, sesion, num) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("sisi", $sqlFecha, $sqlPubId, $sqlSesion, $sqlNum);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // TODO Manejo errores  VVV

    // si no hay errores lñega hasta aqui y ahora vamos a introducir los datos

        if(!($error != "Hay errores en: ")){
            header("Location: foroPrimeroNuevo.php");
        }
        

}
?>
<! //TODO limpiar todos los formatos que no sirven VVV>
    <!DOCTYPE html>
    <html>
    <html lang="es">

    <head>
        <title>Train to DAW</title>

        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css">
    </head>

    <body>
        <h1>Train 2 Daw</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <left>
                <? //TODO hacer las subidas VVV 
                ?>
                <h3>Usuario:</h3>
                <label for="email">Email:</label>
                <input value="<?php if (isset($email)) echo $email; ?>" id="entradas" name="email" type="email" class="margen" placeholder="Introduzca su email" required>
                <br><br>
                <label for="contra">Contraseña:</label>
                <input value="<?php if (isset($contra)) echo $contra; ?>" id="entradas" name="contra" type="password" class="margen" placeholder="Introduzca su contraseña" required>

                <br>


                <h3>Publicacion:</h3>
                <label for="titulo">Titulo:</label>
                <input value="<?php if (isset($titulo)) echo $titulo; ?>" class="entradas" id="entradas" name="titulo" type="text" placeholder="Introduzce el titulo" required>

                <br><br>
                Ave<input type="radio" class="margen" id="altaVelocidad" name="tren" value="Ave" <?php if (isset($tren) && $tren === "Ave") echo "checked"; ?>>
                Alvia<input type="radio" class="margen" id="altaVelocidad" name="tren" value="Alvia" <?php if (isset($tren) && $tren === "Alvia") echo "checked"; ?>>
                Avant<input type="radio" class="margen" id="altaVelocidad" name="tren" value="Avant" <?php if (isset($tren) && $tren === "Avant") echo "checked"; ?>>
                IRYO<input type="radio" class="margen" id="altaVelocidad" name="tren" value="IRYO" <?php if (isset($tren) && $tren === "IRYO") echo "checked"; ?>>
                OUIGO<input type="radio" class="margen" id="altaVelocidad" name="tren" value="OUIGO" <?php if (isset($tren) && $tren === "OUIGO") echo "checked"; ?>>
                <br>
                LD<input type="radio" class="margen" id="trenes" name="tren" value="LD" <?php if (isset($tren) && $tren === "LD") echo "checked"; ?>>
                MD<input type="radio" class="margen" id="trenes" name="tren" value="MD" <?php if (isset($tren) && $tren === "MD") echo "checked"; ?>>
                Cercanias/Rodalies<input type="radio" class="margen" id="trenes" name="tren" value="Cercanias/Rodalies" <?php if (isset($tren) && $tren === "Cercanias/Rodalies") echo "checked"; ?>>
                AM<input type="radio" class="margen" id="trenes" name="tren" value="AM" <?php if (isset($tren) && $tren === "AM") echo "checked"; ?>>

                <br><br>
                <label for="modelo">Modelo:</label>
                <input value="<?php if (isset($modelo)) echo $modelo; ?>" class="entradas" id="entradas" name="modelo" type="text" placeholder="Introduzce el modelo" required>
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
            <p class="right"><a href="foroPrimeroNuevo.php"> Ir al foro</a></p>
            <p> <input type="submit" class="btn"></p>
            <br>

            <br>
        </form>
    </body>

    </html>