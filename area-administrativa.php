<?php
/**
 * Created by PhpStorm.
 * User: Avner
 * Date: 22/07/2015
 * Time: 08:40
 */
require_once("modelAcesso.php");
require_once("modelPaginas.php");
if( !isset($_SESSION) ) {
    session_start();
}

$cAcesso    = new modelAcesso();
$mPaginas   = new modelPaginas();

if( !$cAcesso->verificarSessao($_SESSION['usuario']) ) {
    echo "<script type='text/javascript'>alert('Você não tem permissão para acessar esta área!Redirecionando....');window.location.href='/php-area-administrativa/';";
    exit;
}

$arrayPaginas = $mPaginas->listaPaginas();


//Definindo páginas dentro da área administrativa
$arrayURL = explode("/", $_GET['url']);



?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/php-area-administrativa/web-files/lib/bootstrap/dist/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="/php-area-administrativa/web-files/css/themes/bootstrap.min.css" media="all">
    <!--<link rel="stylesheet" href="/php-area-administrativa/web-files/css/styleWebsite.css" media="all">-->
    <link rel="stylesheet" href="/php-area-administrativa/web-files/css/estiloAreaAdministrativa.css" media="all">

    <script type="text/javascript" src="/php-area-administrativa/web-files/js/jquery.min.js"></script>
    <script type="text/javascript" src="/php-area-administrativa/web-files/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/php-area-administrativa/web-files/lib/ckeditor/ckeditor.js"></script>

    <script type="text/javascript">
        $(document).ready( function() {
            $('.navbar-toggle-sidebar').click(function () {
                $('.navbar-nav').toggleClass('slide-in');
                $('.side-body').toggleClass('body-slide-in');
                $('#search').removeClass('in').addClass('collapse').slideUp(200);
            });

            $('#search-trigger').click(function () {
                $('.navbar-nav').removeClass('slide-in');
                $('.side-body').removeClass('body-slide-in');
                $('.search-input').focus();
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
                MENU
            </button>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <?=ucfirst($_SESSION['usuario']);?>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-off"></span></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid main-container">
    <div class="col-md-2 sidebar">
        <div class="row">
            <!-- uncomment code for absolute positioning tweek see top comment in css -->
            <div class="absolute-wrapper"> </div>
            <!-- Menu -->
            <div class="side-menu">
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Main Menu -->
                    <div class="side-menu-container">
                        <ul class="nav navbar-nav">
                            <!-- Dropdown-->
                            <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl1">
                                    <span class="glyphicon glyphicon-pencil"></span> Paginas <span class="caret"></span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-lvl1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <?php
                                                foreach ( $arrayPaginas as $pagina ) {
                                                    if( $pagina['in_menu'] == 'S' && ($pagina['link_pagina'] != 'contato' && $pagina['link_pagina'] != 'login') ) {
                                                        echo "<li><a href='/php-area-administrativa/area-administrativa/area/{$pagina['link_pagina']}'>{$pagina['nome_pagina']}</a></li>";
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>

            </div>
        </div>  		</div>
    <div class="col-md-10 content">
        <?php
            if( isset($arrayURL[1]) ) {
                switch ($arrayURL[1]) {
                    case 'area':
        ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Pagina <?= ucfirst($arrayURL[2]); ?>
                            </div>
                            <div class="panel-body">
                                <form name="formAlteraConteudoPagina" method="POST"
                                      action="/php-area-administrativa/area-administrativa/salvarPagina"
                                      class="form-horizontal col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="linkPagina" value="<?=$arrayURL[2]?>">
                                        <textarea name="txtConteudoPagina" id="txtConteudoPagina" rows="10" cols="80">
                                            <?php
                                            if (isset($arrayURL[2]) && !empty($arrayURL[2])) {
                                                foreach ($arrayPaginas as $pagina) {
                                                    if ($pagina['link_pagina'] == $arrayURL[2]) {
                                                        echo html_entity_decode($pagina['conteudo_pagina']);
                                                    }
                                                }
                                            }
                                            ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="btnSalvarPagina" value="Salvar Pagina"
                                               class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>

        <?php
                        break;
                    case 'salvarPagina':
                        if( isset($_POST['btnSalvarPagina']) ) {
                            extract($_POST);

                            $retorno = $mPaginas->alterarConteudoPagina($txtConteudoPagina, $linkPagina);
                            if( $retorno ) {

        ?>

                                <div class="alert alert-dismissible alert-success">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <h4>Alerta!</h4>
                                    <p>Pagina <?=ucfirst($linkPagina);?> atualizada com sucesso!</p>
                                </div>
        <?php

                            } else {

        ?>
                                <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <h4>Alerta!</h4>
                                    <p>Erro ao atualizar pagina <?=ucfirst($linkPagina);?></p>
                                </div>
        <?php

                            }
                        }
                        break;
                    default:

                }
            }
        ?>
    </div>

    <footer class="pull-left footer">
        <p class="col-md-12">
        <hr class="divider">
        Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a>
        </p>
    </footer>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'txtConteudoPagina' );
</script>
</body>
</html>
