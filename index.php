<?php

require_once("modelPaginas.php");
$mPaginas 			= new modelPaginas();
$conteudo_pagina 	= null;
$requisicao_pagina 	= STR_REPLACE(".php", "", ( empty($_SERVER['REQUEST_URI']) ? 'index' : SUBSTR($_SERVER['REQUEST_URI'], 1, STRLEN($_SERVER['REQUEST_URI']))));

if( strpos($requisicao_pagina, "/") >= 0 ) {
    $arrayRequisicao    = explode("/", $requisicao_pagina);
    $requisicao_pagina  = ( empty($arrayRequisicao[1]) ? 'index' : $arrayRequisicao[1] );
}

$arrayPaginas 		= $mPaginas->listaPaginas();
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

	if( !empty($conteudo_pagina) ) {
		require_once("header.php");
		echo "<div class=\"content col-lg-12 col-md-12\">";
		echo html_entity_decode($conteudo_pagina);
		require_once("footer.php");
	} else {
		require_once("{$requisicao_pagina}.php");
	}