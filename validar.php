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
    trim($a);
    if (strlen($a) > 240)
        return (false);
    return (true);
}

function validarModelo($a)
{
    trim($a);
    if (strlen($a) > 24)
        return (false);
    return (true);
}

function validarTitulo($a)
{
    trim($a);
    if (strlen($a) > 24)
        return (false);
    return (true);
}
