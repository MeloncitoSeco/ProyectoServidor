<?php
try {
    $mysqli = new mysqli($host, $usuario, $clave, $tabla);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    $consulta_sacarId = "SELECT tipoTren FROM tipoTren WHERE nombre = ?";
    
    if ($stmt = $mysqli->prepare($consulta_sacarId)) {
        $nombreTipoTren = 'Avant'; // Valor que buscas en la consulta
        $stmt->bind_param('s', $nombreTipoTren); // 's' indica que es un string
        
        if ($stmt->execute()) {
            $stmt->store_result();
            $numeroFilas = $stmt->num_rows;

            if ($numeroFilas > 0) {
                echo "Se encontró el tipo de tren 'Avant'";
            } else {
                echo "No se encontró el tipo de tren 'Avant'";
            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
    }

    $mysqli->close();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>