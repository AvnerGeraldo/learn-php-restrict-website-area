<?php
    require_once("header.php");
?>
<div class="content col-lg-12 col-md-12">
<div class="row">
    <?php
    if( isset($_POST['txtUser'], $_POST['txtPassword']) ) {
        if( !empty($_POST['txtUser']) && !empty($_POST['txtPassword']) ) {
            require_once("modelAcesso.php");
            extract($_POST);

            $cAcesso = new modelAcesso();
            $retorno = $cAcesso->logar($txtUser, $txtPassword);
            if( $retorno ) {
    ?>
                <div class="alert alert-success bg-success">
                    <a class="close" data-dismiss="alert" href="#">X</a>Validando dados....
                </div>
                <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href='/php-area-administrativa/area-administrativa';
                    }, 3000);

                </script>
    <?php
            } else {
    ?>
                <div class="alert alert-error bg-danger">
                    <a class="close" data-dismiss="alert" href="#">X</a>Usuario ou senha invalidos!
                </div>
    <?php
            }
        } else {
    ?>
            <div class="alert alert-error bg-danger">
                <a class="close" data-dismiss="alert" href="#">X</a>Preencha os campos corretamente!
            </div>
    <?php

        }
    }
    ?>
</div>
<div class="col-sm-4 col-md-4 col-md-offset-4 col-sm-offset-4">
    <h1 class="text-center login-title">Entrar na area restrita</h1>
    <div class="account-wall">
        <img class="profile-img" src="web-files/images/icon/user.png" alt="user logo">
        <form method="POST" action="/php-area-administrativa/login" class="form-signin">
            <input name='txtUser' type="text" maxlength="30" value="<?=( isset($_POST['txtUser']) ? $_POST['txtUser'] : '')?>" class="form-control" placeholder="Usuario" required autofocus>
            <input name='txtPassword' type="password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Logar</button>
            <span class="clearfix"></span>
        </form>
    </div>
</div>
<?php
    require_once("footer.php");
?>
