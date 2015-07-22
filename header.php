<?php

require_once("controllerPaginas.php");
$cPaginas 			= new controllerPaginas();
$conteudo_pagina 	= null;
$requisicao_pagina 	= STR_REPLACE(".php", "", ( empty($_SERVER['REQUEST_URI']) ? 'index' : SUBSTR($_SERVER['REQUEST_URI'], 1, STRLEN($_SERVER['REQUEST_URI']))));

if( strpos($requisicao_pagina, "/") >= 0 ) {
    $arrayRequisicao    = explode("/", $requisicao_pagina);
    $requisicao_pagina  = ( empty($arrayRequisicao[1]) ? 'index' : $arrayRequisicao[1] );
}

$arrayPaginas 		= $cPaginas->listaPaginas();
foreach ( $arrayPaginas as $pagina ) {
    if( $pagina['link_pagina'] ==  strtolower($requisicao_pagina) ) {
        $conteudo_pagina = $pagina['conteudo_pagina'];
    }
}

/*
if( empty($conteudo_pagina) ) {
    echo "<script type='text/javascript'>window.location.href='error-page.html';</script>";
    exit;
}
*/
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="web-files/lib/bootstrap/dist/css/bootstrap.min.css" media="all">
        <link rel="stylesheet" href="web-files/css/themes/bootstrap.min.css" media="all">
        <link rel="stylesheet" href="web-files/css/styleWebsite.css" media="all">
        <link rel="stylesheet" href="web-files/css/estiloLogin.css" media="all">
        <script type="text/javascript" src="web-files/js/jquery.min.js"></script>
        <script type="text/javascript" src="web-files/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/php-area-administrativa/">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                      <?php
                          foreach ( $arrayPaginas as $pagina ) {
                              if( $pagina['in_menu'] == 'S' ) {
                                  $link = "<li";

                                  if ($pagina['link_pagina'] == strtolower($requisicao_pagina)) {
                                      $link .= " class='active'";
                                  }

                                  $link .= "><a href='" . ($pagina['link_pagina'] != 'index' ? $pagina['link_pagina'] : '/php-area-administrativa/') . "'>";
                                  if( $pagina['link_pagina'] == 'login' ) {
                                      $link .= "<span class='glyphicon glyphicon-lock'></span>";
                                  } else {
                                      $link .= $pagina['nome_pagina'];
                                  }

                                  $link .= "</a>";
                                  $link .= "</li>";
                                  echo $link;
                              }
                          }
                      ?>
                    </ul>
                    <div class="col-sm-4 col-md-4">
                        <form action="/php-area-administrativa/busca" method="POST" class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="txtSearchBox">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </nav>