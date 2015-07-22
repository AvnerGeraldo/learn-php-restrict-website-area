<?php
	$anoAtual = date("Y");
	require_once("header.php");

	$erro = 0;
	if( isset($_POST['txtNome'], $_POST['txtEmail'], $_POST['cboAssunto'], $_POST['txtMensagem']) ) {
		extract($_POST);

		if( empty($txtNome) || empty($txtEmail) || empty($cboAssunto) ||  empty($txtMensagem) ){
			$erro++;
		}
	}

    if( $erro > 0 ) { ?>

    <div class="alert alert-dismissible alert-warning">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <h4>Alerta!</h4>
      <p>Por favor preencha os campos corretamente!</p>
    </div>
    <?php } elseif( isset($_POST['txtNome']) ) { ?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <h4>Dados enviados com sucesso!</h4>
      <p>Abaixo seguem os dados que você enviou.</p>
      <?php
        echo "<p>Nome:{$txtNome}</p><BR>";
        echo "<p>Email:{$txtEmail}</p><BR>";
        echo "<p>Assunto:".str_replace("_", " ", $cboAssunto). "</p><BR>";
        echo "<p>Mensagem:{$txtMensagem}</p><BR>";

        unset($txtNome);
        unset($txtEmail);
        unset($cboAssunto);
        unset($txtMensagem);
      ?>
    </div>
    <?php }  ?>
    <div class="banner col-lg-5 col-sm-5 col-md-5">
        <img src="web-files/images/banner.jpg" alt="thumbnail" class="img-thumbnail">
    </div>
    <div class="col-lg-7 col-sm-7 col-md-7">
        <form name='formContato' action="http://localhost/php-site-simples-bd/contato" method="POST" class="form-horizontal">
          <fieldset>
            <legend>Contato</legend>
            <div class="form-group">
              <label for="inputNome" class="col-lg-2 control-label">Nome</label>
              <div class="col-lg-10">
                <input type="text" name="txtNome" id="inputNome" value="<?=( isset($txtNome) ? $txtNome : '')?>" class="form-control" placeholder="Nome">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-lg-2 control-label">Email</label>
              <div class="col-lg-10">
                <input type="text" name="txtEmail"id="inputEmail" value="<?=( isset($txtEmail) ? $txtEmail : '')?>" class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
                <label for="cboAssunto" class="col-lg-2 control-label">Assunto</label>
                <div class="col-lg-10">
                    <select name="cboAssunto" id="cboAssunto" class="form-control">
                      <option value='Assunto_1' <?=( isset($cboAssunto) && $cboAssunto == 'Assunto_1' ? 'selected' : '')?>>Assunto 1</option>
                      <option value='Assunto_2' <?=( isset($cboAssunto) && $cboAssunto == 'Assunto_2' ? 'selected' : '')?>>Assunto 2</option>
                      <option value='Assunto_3' <?=( isset($cboAssunto) && $cboAssunto == 'Assunto_3' ? 'selected' : '')?>>Assunto 3</option>
                      <option value='Assunto_4' <?=( isset($cboAssunto) && $cboAssunto == 'Assunto_4' ? 'selected' : '')?>>Assunto 4</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
              <label for="textArea" class="col-lg-2 control-label">Mensagem</label>
              <div class="col-lg-10">
                <textarea  name="txtMensagem" rows="3" id="textArea" class="form-control">
                    <?=( isset($txtMensagem) ? $txtMensagem : '')?>
                </textarea>
                <span class="help-block">Por favor insira aqui suas dúvidas ou comentários.</span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" value="Limpar" class="btn btn-default">Limpar</button>
              </div>
            </div>
          </fieldset>
        </form>
    </div>
