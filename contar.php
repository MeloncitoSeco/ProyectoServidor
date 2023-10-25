<?php
if(!isset($_COOKIE['visitas'])){
    setcookie('visitas',1,time()+3600*24);
    echo "hello 4 first time";
}else{
    $visitas = (int) $_COOKIE['visitas'];
    $visitas++;
    setcookie('visitas',$visitas,time()+3600*24);
    echo "Ya llevas $visitas sal a la calle o algo";
}


?>