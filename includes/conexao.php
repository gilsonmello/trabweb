<?php

if(!function_exists('conectar')){
    function conectar(){
        $conn = new mysqli("localhost", "root", "", "karina");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            return $conn;
        }
    }
}

    