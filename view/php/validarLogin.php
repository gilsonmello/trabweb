<?php
    include "../php/funcoes.php";
    $usuario = filter_input(INPUT_POST,'nUsuario');
    $senha = filter_input(INPUT_POST,'nSenha');
    login($usuario, $senha);
?>