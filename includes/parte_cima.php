<?php
	require_once "aplicacao.php"; 
	$Aplicacao->VerificaLogado();
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
   <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
   <link href="css/timeline-component.css" rel="stylesheet"  type="text/css" />
	
   <script src="js/jquery-1.8.3.min.js"></script>
   
   
   <link href="assets/datepicker/jquery-ui.css" rel="stylesheet" />
   <script src="assets/datepicker/jquery-ui.js"></script>
   
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top noprint">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner">
           <div class="container-fluid">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box">
                   <div class="icon-reorder tooltips" data-placement="right" data-original-title="Menu"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
               <!-- BEGIN LOGO -->
               <a class="brand" href="index.php">
                   <img src="img/logo.png" alt="Furlaneto & Pereira" />
               </a>
               <!-- END LOGO -->
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <!-- BEGIN USER LOGIN DROPDOWN -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <span class="username" style="line-height:25px"><?=$_SESSION[ss_usuario];?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu extended logout">
                               <!--<li><a href="#"><i class="icon-user"></i> Meus dados</a></li>-->
                               <li><a href="login.php?acao=sair"><i class="icon-key"></i> Sair do Sistema</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar-scroll noprint">
        <div id="sidebar" class="nav-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->
          <ul class="sidebar-menu">
              <li class="sub-menu">
                  <a href="menu_atualizacoes.php" class="">
                      <i class="icon-usd"></i>
                      <span>Atualização de Valores</span>
                  </a>
              </li>
          </ul>
         <!-- END SIDEBAR MENU -->
		</div>
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT-->