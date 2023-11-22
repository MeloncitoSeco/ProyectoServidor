

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style2.css">
    <style>
       
        
    </style>
    

</head>

<body>
<h1 >Train 2 Daw</h1> <p><a href="main.php"> Volver</a></p>
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

            echo "<br><div class = \"foroTitulo\"><h3>$titulo[$key]</h3></div><br>";
            echo "<div class=\"foro\">";

            echo"<p>Modelo: $modelo[$key]</p><p>Tipo: $modelo[$key]</p><br>";
            echo"<p>Estaba: $posicion[$key]</p><p>Del anio: $fechaFabricacion[$key]</p><br>";
            $consulta = "SELECT * from Imagen i where pubId=$value order by imgId asc ";
            $result = $mysqli->query($consulta);
            while ($row = $result->fetch_assoc()) {
                // TODO Aqui hay que poner para que muestre las fotos teniendo sus id`s  VVV
                $salida = $row['imgId'];
                $fechaFoto = $row['fecha'];
                $rutaImagen = "fotos/". $salida.".png"; 
                if (file_exists($rutaImagen)) {
                    echo '<img class= imagen src="' . $rutaImagen . '" alt="Imagen" >';
                }

            }
            echo"<br><p>Fecha de la foto: $fechaFoto</p><br>";
            echo"<p>Creador: $email[$key]</p><p>Foto tomada en: $comAuto[$key]</p><br>";
            echo "</div><br>";
        }
    }

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

</body>

</html>