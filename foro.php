<?php
// TODO Datos entrada mysql VVV

$host = "127.0.0.1";
$tabla = "servidor";
$usuario = 'visual';
$clave = 'daw2324';

try {
    $mysqli = new mysqli($host, $usuario, $clave, $tabla);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
        echo "error";
    }
    //sqlExisteUser // TODO sen 4
    /*$consulta = " SELECT pubId FROM publicacion";
$brutoPubs;

 if ($stmt = $mysqli->prepare($consulta)) {
     if ($stmt->execute()) {
         $stmt->bind_result($brutoPubs);
         $stmt->fetch();
         if ($brutoPubs) {
            while($row = $brutoPubs){
                $salida[]= $row['pubId'];
            }
            print_r($salida);
         }
         
         $stmt->free_result();
         echo "$salida <br>";
     }
 }*/


    $query = "SELECT pubId FROM publicacion ";
    $result = $mysqli->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $correoUsu[] = $row['pubId'];
        }

    }
    print_r($correoUsu);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
