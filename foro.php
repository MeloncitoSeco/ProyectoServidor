

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
        /** //TODO formato titulo */
        .foroTitulo { 
            background: linear-gradient(120deg, #81005e, #2b598d);;
            border: 1px solid #ffffff;
            border-radius: 8px;
            height: auto;
            max-width: 30%; 
            min-width: 10%;
            position: relative;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-direction: row;
            margin: 10px ;
            display: inline-block;
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
            margin: 10px ;
            display: inline-block;
        }

        /* Estilos del texto dentro del div */
        .foro p {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            padding-left: 30px;
            flex-direction: row;
            display: inline-block;
        }
        .foro h5 {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            padding-left: 30px;
            flex-direction: row;
            display: inline-block;
        }

        
        .imagen{
            max-width: 90%;
            max-height: 500px;
            flex-direction: row;
            padding: 10px;

        }
        .dato{
            font-weight: bold;
            padding-left: 5px;
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
                $rutaImagen = "fotos/". $salida.".jpg"; 
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