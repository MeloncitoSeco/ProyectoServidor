<?php

function validarNombre($a)
{
    trim($a);
    if (!ctype_upper($a[0]))
        return (false);
    if (strlen($a) > 24)
        return (false);
    return (true);
}

function validarContra($a)
{
    $patron = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/";
    
    if (strlen($a) > 240) {
        return false;
    }
    $a = trim($a);
    if (!preg_match($patron, $a)) {
        return false;
    }
    return true;
}

function validarModelo($a)
{
    $patron = "/^[a-zA-Z0-9\s\-]+$/";
    
    if (strlen($a) > 24){
        return (false);
    }
    trim($a);
    if (!preg_match($patron, $a)) {
        return false;
    }
    return (true);
}

function validarTitulo($a)
{
    if (strlen($a) > 24)
        return (false);
    return (true);
}
