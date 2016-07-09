<?php

/**
 * Created by PhpStorm.
 * User: Avner
 * Date: 17/07/2015
 * Time: 20:11
 */

require_once("conexao.php");
class modelPaginas
{
    private $_db;

    public function __construct()
    {
        $this->_db = conectarDB();
    }

    public function listaPaginas($link = null)
    {
        $sql = "SELECT * FROM tbpaginas WHERE 1=1 ";

        if( !empty($link) ) {
            $sql .= " AND link_pagina = '{$link}'";
        }

        $stmt  = $this->_db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaConteudoPesquisa($texto)
    {

        $sql  = "SELECT * FROM tbpaginas WHERE conteudo_pagina LIKE '%{$texto}%'";

        $query = $this->_db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterarConteudoPagina($conteudoPagina, $linkPagina)
    {
        $listaPagina = $this->listaPaginas($linkPagina);

        if( !empty($listaPagina) ) {
            extract($listaPagina[0]);
            if( isset($id_pagina) && !empty($id_pagina) ) {
                //$conteudoPagina = htmlentities($conteudoPagina, ENT_QUOTES, 'ISO-8859-1');

                $sql  = "UPDATE tbpaginas SET conteudo_pagina = '{$conteudoPagina}' ";
                $sql .= " WHERE id_pagina ={$id_pagina}";
                $stmt  = $this->_db->prepare($sql);
                return $stmt->execute();
            }
        }
        return FALSE;
    }
}