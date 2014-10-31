<?php
	require_once "includes/aplicacao.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."controler/login.ctrl.php"; 
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="pt-br" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="pt-br" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="pt-br"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-cache, no-store" />
<meta http-equiv="Pragma" content="no-cache, no-store" />
<meta name="title" content="Furlaneto & Pereira">
<meta name="url" content="www.furlanetopereira.com.br">
<meta name="description" content="Assessoria, treinamentos e eventos como o curso de cálculos trabalhistas e o curso de perícia contábil">
<meta name="keywords" content="furlaneto pereira,curso de cálculos trabalhistas,cálculos trabalhistas,curso online,liquidação de sentença,vara trabalhista,contribuições previdenciárias e fiscais,curso de perícia contábil,justiça do trabalho,TRT,dimas costa pereira,jurídico,cálculos judiciais,curso excel,cálculos trabalhistas,São Paulo,São José do Rio Preto,cálculos de liquidação,www.furlanetopereira.com.br,execução de sentença,cálculos na inicial,Curso de Contribuição Previdenciária - SEFIP,Curso completo e prático de Departamento Pessoal,">
<meta name="charset" content="utf-8">
<meta name="autor" content="Paulo Afonso">
<meta name="company" content="Furlaneto & Pereira">
<meta name="revisit-after" content="5" />
<title>Furlaneto & Pereira</title>
<link href="img/logo_icone.png" rel="shortcut icon" />

   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   <script src="js/jquery-1.8.3.min.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <img class="center" alt="logo" src="img/logo.png">
        <!-- END LOGO -->
    </div>
	
    <form action="login.php" method="post" onSubmit="return ValidaLogin(this);">
		<div class="login-wrap">
			<div class="metro double-size navy-blue">
				<div class="input-append lock-input">
					<input type="text" class="" name="nome" id="nome" placeholder="Nome">
				</div>
			</div>
			<div class="metro double-size navy-blue">
				<div class="input-append lock-input">
					<input type="password" class="" name="senha" id="senha" placeholder="Senha">
				</div>
			</div>
			<div class="metro single-size deep-red login">
				<button type="submit" class="btn login-btn">
					Entrar
					<i class=" icon-long-arrow-right"></i>
				</button>
			</div>
		</div>
	</form>
<?php
if($result>0){		
?>
<div class="row-fluid" id="div_pesq">
	<div class="span12">
			<div class="alert alert-danger" id="alert-mensagem">
			<center><h3><?=$Mensagens[$result];?></h3></center>
			</div>
</div></div>
<script>
$(document).ready(function() {
    setTimeout(function(){
        $('#alert-mensagem').fadeOut();
    }, 10000);
});
</script>
<?php
}
if($_GET[acao]=='sair'){
	$_SESSION[ss_usuario] = null;
	$_SESSION[ss_senha] = null;
}
?>
	<script src="javascript/login.js"></script>
</body>
<!-- END BODY -->
</html>