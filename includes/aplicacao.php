<?php
	$pasta = "./";
	$pasta = "";
	require_once $pasta."aplicacao/Aplicacao.php"; 
	$Aplicacao = new Aplicacao();
	$Mensagens = $Aplicacao->getMensagens();
?>