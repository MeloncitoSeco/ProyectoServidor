

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <style>
       
        body {
            background-color: #f0f0f0;
        }

        h3 {
            color: white;
        }
        .foroTitulo {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            height: auto;
            max-width: 50%;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-direction: row;
            margin: 20px auto;
        }

        .foro {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            height: auto;
            max-width: 50%;
            min-width: 20%;
            position: relative;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-direction: row;
            margin: 20px auto;
        }

        /* Estilos del texto dentro del div */
        .foro p {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
        }

        .imagen{
            max-width: 90%;
            max-height: 500px;
            flex-direction: row;
            padding: 10px;

        }

    </style>
    

</head>

<body>

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

            echo "<br><h3>$titulo[$key]</h3>";
            echo "<div class=\"foro\">";
            $consulta = "SELECT i.imgId from Imagen i where pubId=$value order by imgId asc ";
            $result = $mysqli->query($consulta);
            while ($row = $result->fetch_assoc()) {
                // TODO Aqui hay que poner para que muestre las fotos teniendo sus id`s  VVV
                $salida = $row['imgId'];
                $rutaImagen = "fotos/". $salida.".png"; 
                if (file_exists($rutaImagen)) {
                    echo '<img class= imagen src="' . $rutaImagen . '" alt="Imagen" >';
                }
            }
            echo "</div><br>";
            echo $modelo[$key] . ' => ' . $value . '<br>';
        }
    }

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

</body>

</html>