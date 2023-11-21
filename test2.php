<?php
$host = "127.0.0.1";
$tabla = "servidor";
$usuario = 'visual';
$clave = 'daw2324';

$sqlTipoTren; // sen 1 id del tren de abajo
$inputTipoTren = 'AVE';

$sqlTren; // sen 2 id del ultimo tren subido

$sqlPubId;// sen 3 id ultima publicacion


$sqlExisteUser;// sen 4   sacar si existe esa persona en booleano
$inputExisteUser = "santiago@gmail.com";





try {
    $mysqli = new mysqli($host, $usuario, $clave, $tabla);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
        echo "error";
    }

    // Sacar tipò tren // TODO sen 1
    $consulta = "SELECT tipoTren FROM tipoTren WHERE nombre = ?";
    if ($stmt = $mysqli->prepare($consulta)) {

        $stmt->bind_param('s', $nombreTipoTren);
        if($stmt->execute()){
            $stmt->bind_result($sqlTipoTren);
            $stmt->fetch();
            echo "$sqlTipoTren a <br>";
            $stmt->free_result();
        }
    }

    // Sacar ultimo tren // TODO sen 2
    $consulta_sacarId = "SELECT max(trenId) FROM tren";
    if ($stmt = $mysqli->prepare($consulta_sacarId)) {

        if($stmt->execute()){
            $stmt->bind_result($sqlTren);
            $stmt->fetch();
            $stmt->free_result();
            echo "$sqlTren <br>";
        }
    }

     // Sacar ultima pub // TODO sen 3
    $consulta = "SELECT max(pubId) FROM publicacion";
    if ($stmt = $mysqli->prepare($consulta)) {
        if($stmt->execute()){
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
        if($stmt->execute()){
            $stmt->bind_result($sqlExisteUser);
            $stmt->fetch();
            $stmt->free_result();
            echo "$sqlExisteUser <br>";
        }
    }

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
/** INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (1, 'Ave');

INSERT INTO `servidor`.`Tren` (`trenId`, `modelo`, `tipoTren`, `fechaFabricacion`) VALUES (1, 'Civia', 6, 2003);

INSERT INTO `servidor`.`Usuario` (`email`, `contra`) VALUES ('santiago@gmail.com', '12345');

INSERT INTO `servidor`.`Publicacion` (`pubId`, `email`, `trenId`, `titulo`, `posicion`, `comAuto`) VALUES (1, 'santiago@gmail.com', 1, 'Primer Civia', 'Quieto', 'Andalucía');

INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`, `sesion`, `num`) VALUES ('2023-11-11', 1, 'santi', 0);

 */
