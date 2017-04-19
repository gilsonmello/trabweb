<?php
    session_start();
    include "../../includes/conexao.php";

        
    $usuario = filter_input(INPUT_POST,'nUsuario');
    $senha = filter_input(INPUT_POST,'nSenha');
    $sql = "SELECT * from funcionarios "
            ."WHERE login='".$usuario."' AND senha='".$senha."'";
    $resultado = $conn->query($sql);
    $row = $resultado->fetch_assoc();
    $usuario_id = $row['id'];
    $_SESSION['usuario']['id'] = $row['id'];
    $_SESSION['usuario']['nome'] = $row['nome'];
    $_SESSION['usuario']['email'] = $row['email'];
    $_SESSION['usuario']['cpf'] = $row['login'];
    $_SESSION['usuario']['cpf'] = $row['cpf'];
    $_SESSION['usuario']['rg'] = $row['rg'];
    $_SESSION['usuario']['data_nascimento'] = $row['data_nascimento'];
    $_SESSION['usuario']['data_cadastro'] = $row['data_cadastro'];
    $_SESSION['usuario']['data_atualizacao'] = $row['data_atualizacao'];
    $_SESSION['usuario']['data_exclusao'] = $row['data_exclusao'];
    $_SESSION['usuario']['cargo_id'] = $row['cargo_id'];

    $sql = "SELECT * FROM funcionarios_regras
    INNER JOIN funcionarios ON funcionarios.id = funcionarios_regras.funcionario_id
    INNER JOIN regras ON regras.id = funcionarios_regras.regra_id
    WHERE funcionarios.id = $usuario_id
    ";
    $resultado = $conn->query($sql);
    $row = $resultado->fetch_all(MYSQLI_ASSOC);
    var_dump($row);
die();
$conn->close();

    $redirecionar = "";
    if(count($row) == 0){
        header("location: ../web/autenticarAdm.php?code=0");
    }else{
        header("location: ../web/recuperarPedidoProjeto.php");
    }
?>