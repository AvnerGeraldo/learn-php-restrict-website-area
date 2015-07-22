<?php

/**
 * Created by PhpStorm.
 * User: Avner
 * Date: 17/07/2015
 * Time: 20:11
 */

require_once("conexao.php");
class controllerPaginas
{
    private $_db;

    public function __construct()
    {
        $this->_db = conectarDB();
    }

    public function listaPaginas($link = null)
    {
        $sql = "SELECT * FROM tbPaginas WHERE 1=1 ";

        if( !empty($link) ) {
            $sql = " AND link_pagina = ':link'";
        }
        $stmt  = $this->_db->prepare($sql);
        if( !empty($link) ) {
            $stmt->bindValue("link", $link);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaConteudoPesquisa($texto)
    {

        $sql  = "SELECT * FROM tbPaginas WHERE conteudo_pagina LIKE '%{$texto}%'";

        $query = $this->_db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}