<?php
/**
 * Created by PhpStorm.
 * User: Avner
 * Date: 17/07/2015
 * Time: 18:08
 */
/*
try
{
    $conexao = new \PDO("mysql:host=localhost;dbname=bd_site_simples", "admin", "kmy878");
} catch (\PDOException $e) {
    die("Erro código: ".$e->getCode().": ".$e->getMessage());
}
$id = "1";
$sql    = "SELECT * FROM tbpaginas WHERE id_pagina = :id";
$stmt   = $conexao->prepare($sql);
$stmt->bindValue("id", $id);
$stmt->execute();
$res    = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($res);

*/

function conectarDB()
{
    try {
        $config = include("config.php");
        if( !isset($config['db']) ) {
            throw new \InvalidArgumentException("Configuração do banco de dados não existe!");
        }

        extract($config['db']);

        if( !isset($host) ) {
            $host = null;
        }

        if( !isset($dbname) ) {
            $dbname = null;
        }

        if( !isset($user) ) {
            $user = null;
        }

        if( !isset($password) ) {
            $password = null;
        }

        return new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password);

    } catch(\PDOException $e) {

        echo $e->getMessage()."\n";
        echo $e->getTraceAsString()."\n";
    }
}