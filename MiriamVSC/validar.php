<?php

function validar($nombre, $descripcion) {
    $errores = array();

    if (!ctype_upper($nombre[0]) || strlen($nombre) > 20) {
        $errores[] = "Su nombre debe comenzar con una letra mayúscula y tener una longitud de hasta 20 caracteres.";
    }

    if (strlen($descripcion) <= 50) {
        $errores[] = "La descripción debe tener al menos 50 caracteres.";
    }

    if (!preg_match('/^[A-Za-z\- ]+$/', $nombre)) {
        $errores[] = "Su nombre no puede contener caracteres no válidos.";
    }

    if (empty($errores)) {
        return true;
    } else {
        return $errores;
    }
}

?>
