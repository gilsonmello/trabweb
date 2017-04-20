<?php
/**
 * Created by PhpStorm.
 * User: Junnyor
 * Date: 19/04/2017
 * Time: 18:33
 */

include "../../includes/conexao.php";

/**
 * Função para retornar a conexão feita com o banco
 * @return mixed
 */
if(!function_exists('conexao')){
    function conexao(){
        return conectar();
    }
}

/**
 * Função para fazer login
 * @param string $login
 * @param string $senha
 */
if(!function_exists('login')){
    function login($login, $senha){
        //Abrindo conexão com o banco
        $conn = conexao();
        //Recuperando os dados
        $dados = buscar_usuario($login, $senha);
        //Se não encontrei usuário cadastrado, retorna erro 0
        if(count($dados) == 0){
            header("location: ../web/autenticarAdm.php?code=0");
        }
        $usuario_id = $dados['id'];
        //Salvando sessao do usuário
        salvar_login($dados);

        //Fazendo busca das permissões do usuário
        $dados = retornar_permissoes($usuario_id);
        if(count($dados) > 0){
            foreach($dados as $permissoes) {
                if(strpos(retornar_url_anterior(), $permissoes['url']) < 0 ) {
                    $conn->close();
                    header("location: ../web/autenticarAdm.php?code=1");
                }
            }
        }else{
            $conn->close();
            header("location: ../web/autenticarAdm.php?code=1");
        }
        $conn->close();
        if(count($dados) == 0){
            header("location: ../web/autenticarAdm.php?code=1");
        }else{
            header("location: ../web/recuperarPedidoProjeto.php");
        }
    }
}

if(!function_exists('retornar_url')){
    function retornar_url(){
        return $_SERVER['PHP_SELF'];
    }
}

if(!function_exists('retornar_url_anterior')){
    function retornar_url_anterior(){
        return $_SERVER['HTTP_REFERER'];
    }
}

if(!function_exists('salvar_login')){
    function salvar_login($dados = []){
        session_start();
        $_SESSION['usuario']['id'] = $dados['id'];
        $_SESSION['usuario']['nome'] = $dados['nome'];
        $_SESSION['usuario']['email'] = $dados['email'];
        $_SESSION['usuario']['cpf'] = $dados['login'];
        $_SESSION['usuario']['cpf'] = $dados['cpf'];
        $_SESSION['usuario']['rg'] = $dados['rg'];
        $_SESSION['usuario']['data_nascimento'] = $dados['data_nascimento'];
        $_SESSION['usuario']['data_cadastro'] = $dados['data_cadastro'];
        $_SESSION['usuario']['data_atualizacao'] = $dados['data_atualizacao'];
        $_SESSION['usuario']['data_exclusao'] = $dados['data_exclusao'];
    }
}

if(!function_exists('retornar_permissoes')){
    function retornar_permissoes($id){
        $conn = conexao();
        $sql = "SELECT * FROM regras_permissoes
        inner join regras on regras.id = regras_permissoes.regra_id
        inner join permissoes on permissoes.id = regras_permissoes.permissao_id
        inner join usuarios_regras on usuarios_regras.regra_id = regras.id
        inner join usuarios on usuarios.id = usuarios_regras.usuario_id
        WHERE usuarios.id = $id";

        $resultado = $conn->query($sql);
        $conn->close();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}

if(!function_exists('buscar_usuario')){
    function buscar_usuario($login, $senha){
        //Abrindo conexão com o banco
        $conn = conexao();
        //Fazendo busca do usuário no banco
        $sql = "SELECT * from usuarios "
            ."WHERE login='".$login."' AND senha='".$senha."'";
        //Executando a query
        $resultado = $conn->query($sql);
        //Recuperando os dados
        $dados = $resultado->fetch_assoc();
        $conn->close();
        return $dados;
    }
}
