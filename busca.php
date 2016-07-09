<?php
/**
* Created by PhpStorm.
* User: Avner
* Date: 19/07/2015
* Time: 21:50
*/
require_once("header.php");
if( !isset($_POST) || empty($_POST['txtSearchBox'])) {
    echo "<script>alert('Por favor preencha o campo de pesquisa antes de buscar!');
window.location.href='/';</script>";
    exit;
} else {
    require_once("modelPaginas.php");
    $cPaginas 			        = new modelPaginas();

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
                <center></center><h3>Nao ha conteudo nas paginas com os dados buscados!!!</h3></center>
            </div>
        <?php
        } else {
        ?>
        <div class="well">
            <h1 class="text-center">Paginas encontradas</h1>
            <BR><BR>
            <ul class="list-group">
                <?php
                foreach($arrayPaginasEncontradas as $pagina) {
                    echo "<li class=\"list-group-item\"><a href='/";
                    if( $pagina['link_pagina'] != 'index' ) {
                      echo $pagina['link_pagina'];
                    }
                    echo "'><h4>{$pagina['nome_pagina']}</h4></a></li>";
                }
                ?>
            </ul>
        </div>
        </div>
        <?php
    }
}
require_once("footer.php");
?>
