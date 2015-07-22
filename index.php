<?php
	require_once("header.php");
?>

<div class="content col-lg-12 col-md-12">
	<?php
		if( !empty($conteudo_pagina) ) {
			echo html_entity_decode($conteudo_pagina);
		} else {
			require_once("{$requisicao_pagina}.php");
		}
	?>
</div>
<?php
	require_once("footer.php");
?>
</div>