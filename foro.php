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

    


    $consulta = "SELECT * FROM Publicacion p  join Tren t on p.trenId=t.trenId join Usuario u on u.email=p.email  join tipoTren tt on tt.tipoTren = t.tipoTren order by pubId asc ";
    $result = $mysqli->query($consulta);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $pubId[] = $row['pubId'];
            $titulo[] = $row['titulo'];
            $modelo[] = $row['modelo'];
            $nombre[] = $row['nombre'];
            $posicion[] = $row['posicion'];
            $fechaFabricacion[] = $row['fechaFabricacion'];
            $email[] = $row['email'];
            $comAuto[] = $row['comAuto'];


        }

        foreach ($pubId as $key => $value) {
            echo "<div class='caja'>";
            echo"<br>$titulo[$key] / $modelo[$key] ::::";
            $consulta = "SELECT i.imgId from Imagen i where pubId=$value order by imgId asc ";
            $result = $mysqli->query($consulta);
            while ($row = $result->fetch_assoc()) {
                // TODO Aqui hay que poner para que muestre las fotos teniendo sus id`s
                $salida = $row['imgId'];
                echo "$salida <br>";
                
            }
            echo "<br>";
            echo $modelo[$key] . ' => ' . $value . '<br>';
            echo "</div>";

        }
    }

    
    

    // For each para el pintado de datos
    /*foreach ($pubId as  $value) {
        $consulta = "SELECT * from Publicacion p  join Tren t on p.trenId=t.trenId join Usuario u on u.email=p.email  join tipoTren tt on tt.tipoTren = t.tipoTren order by pubId asc";
        if ($stmt = $mysqli->prepare($consulta)) {
            if ($stmt->execute()) {
                $stmt->bind_result($sqlTipoTren);
                $stmt->fetch();
                $stmt->free_result();
            }
        }
        echo  $value . '<br>';
    }
 echo "<br>_____________<br>";
    foreach ($correoUsu as  $value) {
        $consulta = "SELECT * from Publicacion p  join Tren t on p.trenId=t.trenId join Usuario u on u.email=p.email  join tipoTren tt on tt.tipoTren = t.tipoTren order by pubId asc";
        if ($stmt = $mysqli->prepare($consulta)) {

            $stmt->bind_param('s', $nombreTipoTren);
            if ($stmt->execute()) {
                $stmt->bind_result($sqlTipoTren);
                $stmt->fetch();
                $stmt->free_result();
            }
        }
        echo  $value . '<br>';


    }*/


    /*
// Primer intento
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
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    
</body>
</html>