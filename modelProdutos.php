<?php

/**
 * Created by PhpStorm.
 * User: Avner
 * Date: 18/07/2015
 * Time: 20:45
 */
require_once("conexao.php");
class modelProdutos
{
    private $_db;

    public function __construct()
    {
        $this->_db = conectarDB();
    }

    public function listaProdutos($id_produto = null, $nome_produto = null)
    {
        $sql = "SELECT * FROM tbProdutos WHERE 1=1 ";

        if( !empty($id_produto) ) {
            $sql .= " AND id_produto = ':id_produto'";
        }

        if( !empty($nome_produto) ) {
            $sql .= " AND nome_produto LIKE '%:$nome_produto%'";
        }

        $stmt  = $this->_db->prepare($sql);

        if( !empty($id_produto) ) {
            $stmt->bindValue("id_produto", $id_produto);
        }

        if( !empty($nome_produto) ) {
            $stmt->bindValue("nome_produto", $nome_produto);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}