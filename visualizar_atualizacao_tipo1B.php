<?php
	require_once "includes/aplicacao.php"; 
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
   
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<style>
body{
	margin:0px;
	padding:0px;
	background-color:white;
    font-size:13px;
	color:#666;
    font-family: 'Tahoma','Arial';
}

@media print { 
	
	
}
#principal tr td{
	vertical-align:top;
}
.table-atualizacoes{
	margin-bottom:20px;
}
.table-atualizacoes p{
	margin:5px;
	padding:0;
	
}
.table-atualizacoes .table-titulo td {
	text-align:left;
	background-color:#FFF;
	font-weight:normal;
	padding-bottom:0px;
	border:0;
}
.totais{
	background-color:#DDD;
	font-weight:bold;
}
.table-atualizacoes tr td{
	vertical-align:middle !important;
	color:#666;
	padding:10px;
}
.borda-t{
	border-top: 1px solid #888;
}
.borda-l{
	border-left: 1px solid #888;
}
.borda-r{
	border-right: 1px solid #888;
}
.borda-b{
	border-bottom: 1px dotted #888;
}
.borda-bb{
	border-bottom: 1px solid #888;
}
.table-atualizacoes .explicativo{
	font-size:10px;
}
hr.estilo { 
	border: 0; 
	height: 1px; 
	background-image: 
	-webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
	background-image: -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
	background-image: -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
	background-image: -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
}
h3{
	margin:10px 0 0 30px;
	font-size:24px;
	font-weight:normal;
}
</style>
<body>
<?php //Controler da pagina
	include_once $pasta."controler/atualizacoes.ctrl.php";
?> 
<h3>Processo: <?=$consulta[0]->get('num_processo');?></h3>
<table id="principal" align="center" cellpadding="20" cellspacing="0" border="0">
<tr>
<td width="50%">

	<table class="table-atualizacoes" cellpadding="0" cellspacing="0" border="0">
		<tr class="table-titulo">
			<td colspan="4">
				<p><strong>a) Atualização dos valores</strong></p>
			</td>
		</tr>
		<tr>
			<td width="230px" align="right" class="borda-t borda-l borda-b">Valor original</td>
			<td width="100px" class="borda-t borda-b"><?=$Aplicacao->Data2String($consulta[0]->get('data_original')); ?></td>
			<td width="100px" class="borda-t borda-b borda-r">R$ <?=$Aplicacao->Bd2real($consulta[0]->get('valor_original')); ?></td>
			<td width="150px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="borda-l borda-b">Índice de atualização: <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></td>
			<td class="borda-b">
			<?php
				$parametros_indice['data_original'] = $consulta[0]->get('data_original');
				$parametros_indice['data_atualizar'] = $consulta[0]->get('data_atualizar');
				$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
				echo $indice;
			?>
			</td>
			<td class="borda-b borda-r">
			<?php
				$valor_atualizado = ($consulta[0]->get('valor_original') * $indice);
				echo "R$ ".$Aplicacao->Bd2real($valor_atualizado);
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($consulta[0]->get('valor_original'))." x ".$indice;
			?>			
			</td>
		</tr>
		<tr>
			<td align="right" class="borda-b borda-l">Juros de Mora<BR>
				de: <?=$Aplicacao->Data2String($consulta[0]->get('data_ajuizamento')); ?> 
				até: <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?>
			</td>
			<td class="borda-b">
			<?php
				//51,53%
				$parametros_juros['data_inicial'] = $consulta[0]->get('data_ajuizamento');
				$parametros_juros['data_final'] = $consulta[0]->get('data_atualizar');
				
				$percentual_juros_mora = $Aplicacao->getAtualizacoes()->CalculaPercentualJurosMora($parametros_juros);
				echo $percentual_juros_mora."%";
			?>
			</td>
			<td class="borda-b borda-r">
			<?php
				$valor_com_juros = ($valor_atualizado * $percentual_juros_mora)/100;
				echo "R$ ".$Aplicacao->Bd2real($valor_com_juros);
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($valor_atualizado)." x ".$percentual_juros_mora."%";
			?>			
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right" class="totais borda-bb borda-l">Total até a data atual:</td>
			<td class="totais borda-bb borda-r">
			<?php
				$total_com_juros = ($valor_atualizado + $valor_com_juros);
				echo "R$ ".$Aplicacao->Bd2real($total_com_juros);
			?>		
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($valor_atualizado)." + R$ ".$Aplicacao->Bd2real($valor_com_juros);
			?>			
			</td>
		</tr>
	</table>
<div class="space15"><hr class="estilo" /></div>
	
	<table class="table-atualizacoes" cellpadding="0" cellspacing="0" border="0">
		<tr class="table-titulo">
			<td colspan="4">
				<p><strong>c) Outros débitos homologados por Sentença (Custas e/ou Despesas processuais)</strong></p>
			</td>
		</tr>
		<tr>
			<td width="230px" align="right" class="borda-t borda-l borda-b">Nome das custas e/ou despesas</td>
			<td width="200px" colspan="2" class="borda-t borda-b borda-r">&nbsp;</td>
			<td width="150px">&nbsp;</td>
		</tr>
		<?php
		$parametros_custas['id_atualizacao'] = $consulta[0]->get('id');
		$consulta_custas = $Aplicacao->getAtualizacoes()->pegaCustas($parametros_custas);
		if(sizeof($consulta_custas)>0){
			for($index = 0; $index < sizeof( $consulta_custas); $index++) {
		?>
		<tr>
			<td align="right" class="borda-l borda-b"><?=$consulta_custas[$index]->get('nome_custa')." | Folhas dos Autos: ".$consulta_custas[$index]->get('folhas_custa');?></td>
			<td class="borda-b"><?=$Aplicacao->Data2String($consulta_custas[$index]->get('data_custa'));?></td>
			<td class="borda-b borda-r">R$ <?=$Aplicacao->Bd2real($consulta_custas[$index]->get('valor_custa'));?></td>
			<td class="explicativo"></td>
		</tr>
		<tr>
			<td align="right" class="borda-bb borda-l">índice de atualização: <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></td>
			<td class="borda-bb">
			<?php
				$parametros_indice['data_original'] = $consulta_custas[$index]->get('data_custa');
				$parametros_indice['data_atualizar'] = $consulta[0]->get('data_atualizar');
				$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
				echo $indice;
			?>
			</td>
			<td class="borda-bb borda-r">
			<?php
					$valor_atualizado = ($consulta_custas[$index]->get('valor_custa') * $indice);
					echo "R$ ".$Aplicacao->Bd2real($valor_atualizado);
					
					$total_custas = $total_custas + $valor_atualizado;
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($consulta_custas[$index]->get('valor_custa'))." x ".$indice;
			?>			
			</td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td colspan="2" align="right" class="totais borda-bb borda-l">Total das custas e/ou despesas:</td>
			<td class="totais borda-bb borda-r">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($total_custas);
			?>		
			</td>
			<td class="explicativo">		
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	
</td>
<td width="50%">

	<table class="table-atualizacoes" cellpadding="0" cellspacing="0" border="0">
		<tr class="table-titulo">
			<td colspan="4">
				<p><strong>b) Cálculo do Imposto de Renda</strong></p>
				<p>Número de meses para cálculo do Imposto de renda, considerando o "RRA": <?=$consulta[0]->get('num_meses'); ?> meses;<BR>
				Número de Dependentes para efeito do RRA: <?=$consulta[0]->get('num_dependentes'); ?> dependentes</p>
			</td>
		</tr>
		<tr>
			<td width="230px" align="right" class="borda-t borda-l borda-b">Base de Cálculo</td>
			<td width="200px" colspan="2" class="borda-t borda-b borda-r">
			<?php
				if($consulta[0]->get('valor_ir')>0){
					$valor_ir = $consulta[0]->get('valor_ir');
				}else{
					$valor_ir = ($consulta[0]->get('valor_original')*$consulta[0]->get('percentual_ir'))/100;
					
				}
				$valor_base = ($consulta[0]->get('valor_ir') -  $valor_dependentes);
				echo "R$ ".$Aplicacao->Bd2real($valor_ir);
			?>
			</td>
			<td width="150px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="borda-l borda-b">Dependentes</td>
			<td class="borda-b">
			<?php
				$valor_dependentes = ($consulta[0]->get('num_dependentes')*$consulta[0]->get('num_meses')*179.71);
				echo "R$ ".$Aplicacao->Bd2real($valor_dependentes);
			?>
			</td>
			<td class="borda-b borda-r">
			<?php
				$valor_base = ($valor_ir -  $valor_dependentes);
				echo "R$ ".$Aplicacao->Bd2real($valor_base);
			?>			
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($valor_ir)." - R$ ".$Aplicacao->Bd2real($valor_dependentes);
			?>			
			</td>
		</tr>
		<tr>
			<td align="right" class="borda-b borda-l">Alíquota aplicável</td>
			<td class="borda-b">
			<?php
				$parametros_aliquota['valor'] = $valor_base;
				$parametros_aliquota['num_meses'] = $consulta[0]->get('num_meses');
				$retorno = $Aplicacao->getAtualizacoes()->pegaAliquota($parametros_aliquota);
				
				if($retorno['percentual']<>'isento'){
					$valor_aliquota = number_format($retorno['percentual'],2,'.','');
					echo $valor_aliquota."%";
				}else{
					$valor_aliquota=0;
					echo $retorno['percentual'];
				}
			?>
			</td>
			<td class="borda-b borda-r">
			<?php
				$valor_apurado = ($valor_base * $valor_aliquota)/100;
				echo "R$ ".$Aplicacao->Bd2real($valor_apurado);
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($valor_base)." x ".$valor_aliquota."%";
			?>			
			</td>
		</tr>
		<tr>
			<td align="right" class="borda-b borda-l">Parcela a deduzir</td>
			<td class="borda-b">
			<?php
				$valor_parcela = $retorno['valor_parcela'];
				echo "R$ ".$Aplicacao->Bd2real($valor_parcela);
			?>
			</td>
			<td class="borda-b borda-r">
			<?php
				if($retorno['percentual']<>'isento'){
					$valor_apurado_ir = ($valor_apurado - $valor_parcela);
					echo "R$ ".$Aplicacao->Bd2real($valor_apurado_ir);
				}else{
					$valor_apurado_ir = 0;
					echo 'isento';
				}
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($valor_apurado)." - R$ ".$Aplicacao->Bd2real($valor_parcela);
			?>			
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right" class="totais borda-bb borda-l">Valor apurado Imposto Renda:</td>
			<td class="totais borda-bb borda-r">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($valor_apurado_ir);
			?>		
			</td>
			<td class="explicativo">		
			</td>
		</tr>
	</table>
<div class="space15"><hr class="estilo" /></div>


	
	<table class="table-atualizacoes" cellpadding="0" cellspacing="0" border="0">
		<tr class="table-titulo">
			<td colspan="4">
			<p><strong>d) Total apurado débito processual</strong></p>
			</td>
		</tr>
		<tr>
			<td width="230px" align="right" class="borda-t borda-l borda-b">Total apurado crédito do Reclamante</td>
			<td width="200px" colspan="2" class="borda-t borda-b borda-r"><?="R$ ".$Aplicacao->Bd2real($total_com_juros);?></td>
			<td width="150px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="borda-l borda-b">Imposto de Renda</td>
			<td class="borda-b"><?="R$ ".$Aplicacao->Bd2real($valor_apurado_ir);?></td>
			<td class="borda-b borda-r">
			<?php
				$credito_liquido = ($total_com_juros - $valor_apurado_ir);
				echo "R$ ".$Aplicacao->Bd2real($credito_liquido);
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($total_com_juros)." - R$ ".$Aplicacao->Bd2real($valor_apurado_ir);
			?>	
			</td>
		</tr>
		<tr>
			<td align="right" class="borda-l borda-b">Custas e/ou Despesas Procesuais</td>
			<td class="borda-b"><?="R$ ".$Aplicacao->Bd2real($total_custas);?></td>
			<td class="borda-b borda-r">
			<?php
				$total_pagar = ($credito_liquido + $total_custas);
				echo "R$ ".$Aplicacao->Bd2real($total_pagar);
			?>
			</td>
			<td class="explicativo">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($credito_liquido)." + R$ ".$Aplicacao->Bd2real($total_custas);
			?>	
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right" class="totais borda-bb borda-l">Total a ser pago no Processo:</td>
			<td class="totais borda-bb borda-r">
			<?php
				echo "R$ ".$Aplicacao->Bd2real($total_pagar);
			?>		
			</td>
			<td class="explicativo">				
			</td>
		</tr>
	</table>
</td>
</tr>
</table>
</body>