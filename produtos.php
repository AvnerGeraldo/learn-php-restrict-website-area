
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="web-files/lib/bootstrap/dist/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="web-files/css/themes/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="web-files/css/styleWebsite.css" media="all">
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
                <a class="navbar-brand" href="">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">

                </ul>
            </div>
        </div>
    </nav>
<?php
	require_once("controllerProdutos.php");
	$cProdutos = new controllerProdutos();
	$listaProdutos = $cProdutos->listaProdutos();
?>

<div class="content col-lg-12 col-md-12">
    <h2>Pagina de Produtos</h2>
    <br>
    <?php
        foreach($listaProdutos as $produto) {
    ?>
        <div id="list-products" class="col-sm-4 col-md-4">
            <div class="thumbnail">
                <div class="img-responsive"></div>
                <div class="caption">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <h3><?=$produto['nome_produto']?></h3>
                        </div>
                        <div class="col-md-6 col-xs-6 price">
                            <h3>
                                <label>R$ <?=number_format($produto['valor_produto'], 2, ",", ".");?></label></h3>
                        </div>
                    </div>
                    <p><?=nl2br($produto['descricao_produto']);?></p>
                    <p></p>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <?php
    $anoAtual = date("Y");
    ?>
    <div class="footer col-lg-12 col-md-12">
        <span>&copy;Todos os direitos reservados - <?=$anoAtual;?></span>
    </div>

</div>
</body>
</html>