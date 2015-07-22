<?php

/**
 * Created by PhpStorm.
 * User: Avner
 * Date: 21/07/2015
 * Time: 21:02
 */
require_once("conexao.php");
class controllerAcesso
{

    private $_db;

    public function __construct()
    {
        $this->_db = conectarDB();
    }

    public function logar($usuario, $senha)
    {
        $sql = "SELECT * FROM tbacesso WHERE  ";
        $sql .= " usuario = '{$usuario}'";
        $stmt  = $this->_db->query($sql);
        $retorno =  $stmt->fetch(PDO::FETCH_ASSOC);
        if( !empty($retorno) ) {
            if( !password_verify($senha, $retorno['senha_usuario']) ) {
                return FALSE;
            }

            if( !isset($_SESSION) ) {
                session_cache_expire(30);
                session_start();
            }
            $_SESSION['usuario']    = $usuario;
            $_SESSION['logado']     = 1;
            return TRUE;
        }
        return FALSE;
    }
}