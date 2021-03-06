<?php
include_once "../../includes/conexao.php";
session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <link href="../../css/loginAdm.css" rel="stylesheet" type="text/css"/>
    </head>
        
    <body>
        <div class="container">
            <?php
                include "../../includes/header.html";
                if(isset($_GET['code']) && $_GET['code'] == 0){
            ?>
            <div class="alert alert-danger" style="text-align: center;font-size: 110%;">
                <strong>Usuário ou Senha incorreta, tente novamente.</strong>
            </div>
            <?php }elseif(isset($_GET['code']) && $_GET['code'] == 1){?>
            <div class="alert alert-danger" style="text-align: center;font-size: 110%;">
                <strong>Você não tem permissão para acessar essa área.</strong>
            </div>
            <?php }?>
            <div id="area">
            <h2 class="titulo1">Área protegida</h2>
            <h3 class="titulo2">Digite seu usuário e senha</h3>
            <div id="login">
                <form action="../php/validarLogin.php" method="POST" name="frmlogin">
                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" class="form-control" name="nUsuario" id="usuario" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="nSenha" id="senha" placeholder="Senha de 8 dígitos">
                </div>
                <button type="submit" class="btn btn-default">Validar</button>
            </form>
                </div>
            </div>
            
            <?php
                include "../../includes/footer.html";
            ?>
        </div>
    </body>
</html>
