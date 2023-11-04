<?php
include("validar.php");
$nombreError = $edadError = $descripcionError = $telefonoError = $comunidadAutonomaError = "";
error_reporting(E_ERROR | E_PARSE);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nombre"])) {
        $nombreError = "Indique su nombre.";
    }

    if (empty($_POST["edad"])) {
        $edadError = "Indique su edad.";
    }

    if (empty($_POST["telefono"])) {
        $telefonoError = "Indique su teléfono.";
    }

    if (empty($_POST["email"])) {
        $emailError = "Indique su email.";
    }

    if (empty($_POST["descripcion"])) {
        $descripcionError = "Indique qué busca en una silla gaming.";
    }

    if (!isset($_POST["comunidadAutonoma"])) {
        $comunidadAutonomaError = "Debe indicar la comunidad autónoma en la que vive.";
    }

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $validando = validar($nombre, $descripcion);

    if (!empty($errors)) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $comunidadAutonoma = $_POST["comunidadAutonoma"];
        $telefono = $_POST["telefono"];
    } else {

        if ($validando === true) {
            header("Location: hola.php"); //pagina que devuelve una hoja con todos los registros
            exit();
        } else {
            foreach ($validando as $error) {
                echo "Error: " . $error . "<br>";
            }
        }
    }
}
//required
//paleta de colores:
#F2CEEC
#7048C8
#F479AD
#9C8AE0
#783DAC
/*

https://colorpalette.imageonline.co/es/
https://www.jotform.com/build/233032800000331#preview
        .formcontainer {
        text-align: left;
        margin: 24px 50px 12px;
         }

        .container {
        padding: 16px 0;
        text-align:left;
        }
        */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugerencias cyberthrone: Sillas Gaming 3000</title>

    <style>
        @font-face {
            font-family: 'MavenPro';
            src: url('http://localhost/DAW2/Servidor/Ejercicios/Practica_Evaluable/MavenPro-VariableFont_wght.ttf') format('truetype');
        }

        body {
            font-family: 'MavenPro', sans-serif;
            background: linear-gradient(to left, #7048C7, #783DAC);
            margin: 0;
            padding: 0;
        }

        img {
            margin-top: 30px;
            margin-bottom: 5px;
            width: 20%;

        }

        form {
            margin-bottom: 50px;
            margin-top: 10px;
            margin-left: 550px;
            margin-right: 550px;
            border-radius: 24px;
            background-color: #fff;
            padding: 5px;
            box-shadow: 0 0 20px rgba(244, 121, 173, 1);

        }

        .silla {
            float: left;
            margin-top: 20px;
            margin-left: 20px;
            width: 30%;
        }

        .linea {
            border-top: 1px solid #F479AD;
            height: 2px;
            width: 90%;
            padding: 0;
            margin: 24px auto 0 auto;
            margin-bottom: 13px;
            opacity: 50%;

        }

        .espacio {
            height: 250px;
        }

        .titulos {
            margin-top: 120px;
            margin-right: 610px;
            font-size: 90%;
            color: #743CAC;
        }

        center {
            text-align: center;
        }

        h3 {
            color: #F479AD;
            font-size: 180%;
            font-weight: bold;
        }

        h2 {
            color: #F479AD;
            font-size: 150%;
            font-weight: bold;
            float: left;
            margin-left: 35px;
        }


        p {
            color: #608334;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: #5534ad;
        }

        input[type="text"] {
            width: 20%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #A8CA7E;
            border-radius: 5px;
            outline-color: #608334;
            background-color: #F6F6DB;
            color: #608334;
        }

        select {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #A8CA7E;
            border-radius: 5px;
            background-color: #F6F6DB;
            outline-color: #608334;
            color: #608334;
            cursor: pointer;
        }

        input[type="file"] {
            width: 100%;
            margin: 10px 0;
            color: #608334;

        }

        input[type="submit"] {
            background-color: #F6F6DB;
            color: #608334;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        select:hover {
            background-color: #ECEBC9;
        }

        select option {
            color: #A7D489;
        }

        select option:hover {
            background-color: #608334;
        }

        input[type="submit"]:hover {
            background-color: #A7D489;
        }
    </style>

</head>

<body>
    <center><img src="IconoLetrasBorde.png" /></center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <center>
            <h3> Sugerencias para CyberThrone </h3>

            <img src="silla (1).png" class="silla" alt="imagen_silla">
            <div class="espacio"></div>
            <div class="linea"></div>


            <h2> Formulario </h3>


                <label for="nombre" class="titulos"> Tu nombre </label>
                <input value="<?php if (isset($_POST["nombre"]))
                                    echo $_POST["nombre"]; ?>" id="nombre" name="nombre" type="text">
                <span class="error">
                    <?php echo $nombreError; ?>
                </span>

                <label for="edad" class="titulos"> Edad </label>
                <input value="<?php if (isset($_POST["edad"]))
                                    echo $_POST["edad"]; ?>" id="edad" name="edad" type="text">
                <span class="error">
                    <?php echo $edadError; ?>
                </span>

                <label for="telefono" class="titulos"> Teléfono </label>
                <input value="<?php if (isset($_POST["telefono"]))
                                    echo $_POST["telefono"]; ?>" id="telefono" name="telefono" type="text">
                <span class="telefono">
                    <?php echo $telefonoError; ?>
                </span>

                <label for="email" class="titulos"> Email </label>
                <input value="<?php if (isset($_POST["email"]))
                                    echo $_POST["email"]; ?>" id="email" name="email" type="text">
                <span class="error">
                    <?php echo $emailError; ?>
                </span>

                <label for="comunidadAutonoma" class="titulos"> Indica tu comunidad autónoma </label>
                <select name="comunidadAutonoma" id="comunidadAutonoma" size="18">
                    <option value="Andalucía" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Andalucía")
                                                    echo "selected"; ?>>Andalucía
                    </option>
                    <option value="Aragón" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Aragón")
                                                echo "selected"; ?>>Aragón
                    </option>
                    <option value="Asturias" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Asturias")
                                                    echo "selected"; ?>>Asturias
                    </option>
                    <option value="Canarias" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Canarias")
                                                    echo "selected"; ?>>Canarias
                    </option>
                    <option value="Cantabria" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Cantabria")
                                                    echo "selected"; ?>>Cantabria
                    </option>
                    <option value="Castilla y León" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Castilla y León")
                                                        echo "selected"; ?>>Castilla y León
                    </option>
                    <option value="Castilla-La Mancha" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Castilla-La Mancha")
                                                            echo "selected"; ?>>Castilla-La Mancha
                    </option>
                    <option value="Cataluña" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Cataluña")
                                                    echo "selected"; ?>>Cataluña
                    </option>
                    <option value="Comunidad de Madrid" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Comunidad de Madrid")
                                                            echo "selected"; ?>>Comunidad de Madrid
                    </option>
                    <option value="Comunidad Foral de Navarra" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Comunidad Foral de Navarra")
                                                                    echo "selected"; ?>>Comunidad Foral de
                        Navarra
                    </option>
                    <option value="Comunidad Valenciana" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Comunidad Valenciana")
                                                                echo "selected"; ?>>Comunidad Valenciana
                    </option>
                    <option value="Extremadura" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Extremadura")
                                                    echo "selected"; ?>>Extremadura
                    </option>
                    <option value="Galicia" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Galicia")
                                                echo "selected"; ?>>Galicia
                    </option>
                    <option value="Islas Baleares" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Islas Baleares")
                                                        echo "selected"; ?>>Islas Baleares
                    </option>
                    <option value="La Rioja" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "La Rioja")
                                                    echo "selected"; ?>>La Rioja
                    </option>
                    <option value="Murcia" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "Murcia")
                                                echo "selected"; ?>>Murcia
                    </option>
                    <option value="País Vasco" <?php if (isset($comunidadAutonoma) && $comunidadAutonoma === "País Vasco")
                                                    echo "selected"; ?>>País Vasco
                    </option>
                </select>
                <span class="error">
                    <?php echo $comunidadAutonomaError; ?>
                </span>


                <input type="file" name="fichero" accept=".jpg, .jpeg, .png" />

                <center><input type="submit"></center>

        </center>
    </form>
</body>

</html>