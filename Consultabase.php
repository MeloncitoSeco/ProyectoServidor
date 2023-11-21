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
    ?>