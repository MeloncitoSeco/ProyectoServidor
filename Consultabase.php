<?PHP

$consulta = "SELECT tipoTren FROM tipoTren WHERE nombre = ?";
    if ($stmt = $mysqli->prepare($consulta)) {

        $stmt->bind_param('s', $nombreTipoTren);
        if($stmt->execute()){
            $stmt->bind_result($sqlTipoTren);
            $stmt->fetch();
            $stmt->free_result();
        }
    }
//_______________________________________________________________
    $consulta = "SELECT * FROM publicacion ";
    $result = $mysqli->query($consulta);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $pubId[] = $row['pubId'];
            $correoUsu[] = $row['email'];
            $modelo[] = $row['titulo'];

        }
    }

    for($i = 0; $i < count($pubId) ; $i++){
        echo "$pubId[$i], $correoUsu[$i] ,$modelo[$i]  <br><br>";
    }



    ?>