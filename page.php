<?php

if ( isset($_GET['page']) && !empty($_GET['page']) ) {
	extract($_GET);

	if( !isset($_SESSION) ){
		session_start();
	}

	$_SESSION['redirecionaPagina'] = $page;
	header("location: {$page}.php");
	exit;

} else {
	require("error-page.html");
	exit;
}