<?php
$host = "127.0.0.1";
$tabla = "servidor";
$usuario = 'visual';
$clave = 'daw2324';

$inputTipoTren = 'MD';
$inputExisteUser = "yuri@gmail.com";
$sqlModelo="H37";
$sqlFechaFabricacion="2003";
$sqlContra="yuriguapo";
$sqlTitulo="Un tren super chulo";
$sqlPosicion="Quieto";
$sqlComAuto="Palencia";
$sqlFecha="2011-7-2";
$sqlSesion="sderkjhg86ef";
$sqlNum="7";


$sqlTipoTren; // sen 1 id del tren de abajo
$inputTipoTren;

$sqlTrenId; // sen 2 id del ultimo tren subido

$sqlPubId; // sen 3 id ultima publicacion


$sqlExisteUser; // sen 4   sacar si existe esa persona en booleano
$inputExisteUser; // _______________________
$sqlEmail=$inputExisteUser;




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
            echo "$sqlTipoTren <br>";
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
            echo "$sqlTrenId <br>";
        }
    }

    // Sacar ultima pub // TODO sen 3
    $consulta = "SELECT max(pubId) FROM publicacion limit 1";
    if ($stmt = $mysqli->prepare($consulta)) {
        if ($stmt->execute()) {
            $stmt->bind_result($sqlPubId);
            $stmt->fetch();
            echo "$sqlPubId <br>";
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
            echo "$sqlExisteUser <br>";
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




    
//insertar datos fotos

//$sqlFecha
//$sqlSesion
//$sqlNum

    $stmt = $mysqli->prepare("INSERT INTO Imagen (fecha, pubId, sesion, num) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $sqlFecha, $sqlPubId, $sqlSesion, $sqlNum);
    $stmt->execute();
    
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
 //INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (1, 'Ave');

//INSERT INTO `servidor`.`Tren` (`trenId`, `modelo`, `tipoTren`, `fechaFabricacion`) VALUES (1, 'Civia', 6, 2003);

//INSERT INTO `servidor`.`Usuario` (`email`, `contra`) VALUES ('santiago@gmail.com', '12345');

//INSERT INTO `servidor`.`Publicacion` (`pubId`, `email`, `trenId`, `titulo`, `posicion`, `comAuto`) VALUES (1, 'santiago@gmail.com', 1, 'Primer Civia', 'Quieto', 'Andalucía');

//INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`, `sesion`, `num`) VALUES ('2023-11-11', 1, 'santi', 0);
