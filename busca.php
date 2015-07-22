<?php
/**
* Created by PhpStorm.
* User: Avner
* Date: 19/07/2015
* Time: 21:50
*/

if( !isset($_POST) || empty($_POST['txtSearchBox'])) {
    echo "<script>alert('Por favor preencha o campo de pesquisa antes de buscar!');
window.location.href='http://localhost/php-site-simples-bd/';</script>";
    exit;
} else {
    require_once("controllerPaginas.php");
    $cPaginas 			        = new controllerPaginas();

    $palavrasBuscadas           = htmlentities($_POST['txtSearchBox'], ENT_QUOTES, 'UTF-8');
    $arrayPaginasEncontradas    = $cPaginas->buscaConteudoPesquisa($palavrasBuscadas);

    ?>
    <div class="row">
        <h4>Resultados encontrados:</h4>

    </div>
    <div class="row">
        <?php
        if( empty($arrayPaginasEncontradas) ) {
        ?>
            <div class="well">
                <center><h3>Nao ha conteudo nas paginas com os dados buscados!!!</h3></center>
            </div>
        <?php
        } else {
        ?>
        <div class="well">
            <h1 class="text-center">Paginas encontradas</h1>
            <BR><BR>
            <div class="list-group">
                <?php
                foreach($arrayPaginasEncontradas as $pagina) {
                    echo "<a href='http://localhost/php-site-simples-bd/";
                    if( $pagina['link_pagina'] != 'index' ) {
                      echo $pagina['link_pagina'];
                    }
                    echo "' class=\"list-group-item\">";
                ?>
                    <div class="col-md-9">
                        <h4 class="list-group-item-heading"><?=$pagina['nome_pagina']?></h4>
                    </div>
                </a>
                <?php
                }
                ?>
            </div>
        </div>
        </div>
        <?php
    }
}
?>
