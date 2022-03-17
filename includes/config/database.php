<?php

function conectarDB(){
    $host='localhost';
    $user = 'root';
    $password='';
    $name='bienesraices';
    $db = new mysqli($host, $user, $password, $name);

    if(!$db){
        echo "Error!! No se pudo conectar a ta base de datos";
        exit();
    }else{
        return $db;
    }

    
}
