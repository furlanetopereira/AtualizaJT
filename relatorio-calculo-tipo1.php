<?php
	require_once "includes/aplicacao.php"; 
	$Aplicacao->VerificaLogado();
	$_POST[id]=1;
	if($_POST[id]==""){
		$Aplicacao->warp('incluir1-valores.php');
	}else{	
		$id = $_POST[id];
	}
	$parametros['id'] = $id;
	$consulta = $Aplicacao->getAtualizacoes()->pegaAtualizacoes($parametros);
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
   
   <link href="css/relatorio.css" rel="stylesheet" />
  


<script type='text/javascript'>//<![CDATA[ 
window.onload=function(){
//window.print();
}//]]>  

</script>


</head>
<body>
  <div class="book">
    <div class="page">
        <div class="subpage">
			<table cellpadding="0" style="margin-bottom:5px;" cellspacing="0" border="0">
				<tr>
					<td width="50px"><strong>Proc.: </strong></td>
					<td><?=$consulta[0]->get('num_processo'); ?></td>
				</tr>
				<tr>
					<td><strong>Vara.: </strong></td>
					<td><?=$consulta[0]->get('vara'); ?></td>
				</tr>
				<tr>
					<td><strong>Recte: </strong></td>
					<td><?=$consulta[0]->get('reclamante'); ?></td>
				</tr>
				<tr>
					<td><strong>Recda: </strong></td>
					<td><?=$consulta[0]->get('reclamada'); ?></td>
				</tr>
			</table>
			<table class="table-atualizacoes" cellpadding="2" cellspacing="0" border="0">
				<tr class="table-titulo">
					<td colspan="5">
						<p><strong>Atualização dos valores</strong></p>
					</td>
				</tr>
				<tr>
					<td width="400px" class="borda-t borda-l borda-b">Valor original para <?=$Aplicacao->Data2String($consulta[0]->get('data_original')); ?></td>
					<td width="20px" class="explicativo borda-t borda-b">R$</td>
					<td width="80px" class="borda-t borda-b borda-r"><?=$Aplicacao->Bd2real($consulta[0]->get('valor_original')); ?></td>
					<td width="150px">&nbsp;</td>
				</tr>
				<tr>
					<td class="borda-l borda-b">
						Índice de atualização para <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?> é 
						<?php
							$parametros_indice['data_original'] = $consulta[0]->get('data_original');
							$parametros_indice['data_atualizar'] = $consulta[0]->get('data_atualizar');
							$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
							echo $indice;
						?>
					</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r">
					<?php
						$valor_atualizado = ($consulta[0]->get('valor_original') * $indice);
						echo $Aplicacao->Bd2real($valor_atualizado);
					?>
					</td>
					<td class="explicativo">
					<?php
						echo "R$ ".$Aplicacao->Bd2real($consulta[0]->get('valor_original'))." x ".$indice;
					?>			
					</td>
				</tr>
				<tr>
					<td class="borda-b borda-l">Juros de Mora 
						de: <?=$Aplicacao->Data2String($consulta[0]->get('data_ajuizamento')); ?> 
						até: <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?> é 
						<?php
							//51,53%
							$parametros_juros['data_inicial'] = $consulta[0]->get('data_ajuizamento');
							$parametros_juros['data_final'] = $consulta[0]->get('data_atualizar');
							
							$percentual_juros_mora = $Aplicacao->getAtualizacoes()->CalculaPercentualJurosMora($parametros_juros);
							echo $percentual_juros_mora."%";
						?>
					</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r">
					<?php
						$valor_do_juros = ($valor_atualizado * $percentual_juros_mora)/100;
						echo $Aplicacao->Bd2real($valor_do_juros);
					?>
					</td>
					<td class="explicativo">
					<?php
						echo "R$ ".$Aplicacao->Bd2real($valor_atualizado)." x ".$percentual_juros_mora."%";
					?>			
					</td>
				</tr>
				<tr>
					<td class="totais borda-bb borda-l">Valor atualizado e com juros para <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></td>
					<td class="explicativo totais borda-bb">R$</td>
					<td class="totais borda-bb borda-r">
					<?php
						$total_com_juros = ($valor_atualizado + $valor_do_juros);
						echo $Aplicacao->Bd2real($total_com_juros);
					?>		
					</td>
					<td class="explicativo">
					<?php
						echo "R$ ".$Aplicacao->Bd2real($valor_atualizado)." + R$ ".$Aplicacao->Bd2real($valor_do_juros);
					?>			
					</td>
				</tr>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
				<tr class="table-titulo">
					<td colspan="5">
						<p><strong>Cálculo do Imposto de Renda</strong></p>
					</td>
				</tr>
				<tr>
					<td class="borda-t borda-l borda-b">Base de Cálculo:</td>
					<td class="explicativo borda-t borda-b">R$</td>
					<td class="borda-t borda-b borda-r">
					<?php
						if($consulta[0]->get('valor_ir')>0){
							$valor_ir = $consulta[0]->get('valor_ir');
						}else{
							$valor_ir = ($consulta[0]->get('valor_original')*$consulta[0]->get('percentual_ir'))/100;
							
						}
						$valor_base = ($consulta[0]->get('valor_ir') -  $valor_dependentes);
						echo $Aplicacao->Bd2real($valor_ir);
					?>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="borda-l borda-b">
						Dependentes:
						<?php
							echo $consulta[0]->get('num_dependentes')." x R$ ".$Aplicacao->Bd2real($consulta[0]->get('num_meses')*179.71)." = ";
							$valor_dependentes = ($consulta[0]->get('num_dependentes')*$consulta[0]->get('num_meses')*179.71);
							echo "R$ ".$Aplicacao->Bd2real($valor_dependentes);
						?>
					</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r">
					<?php
						$valor_base = ($valor_ir -  $valor_dependentes);
						echo $Aplicacao->Bd2real($valor_base);
					?>			
					</td>
					<td class="explicativo">
					<?php
						echo "R$ ".$Aplicacao->Bd2real($valor_ir)." - R$ ".$Aplicacao->Bd2real($valor_dependentes);
					?>			
					</td>
				</tr>
				<tr>
					<td class="borda-b borda-l">
						Alíquota aplicável: 
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
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r">
					<?php
						$valor_apurado = ($valor_base * $valor_aliquota)/100;
						echo $Aplicacao->Bd2real($valor_apurado);
					?>
					</td>
					<td class="explicativo">
					<?php
						echo "R$ ".$Aplicacao->Bd2real($valor_base)." x ".$valor_aliquota."%";
					?>			
					</td>
				</tr>
				<tr>
					<td class="borda-bb borda-l">Parcela a deduzir:</td>
					<td class="explicativo borda-bb">R$</td>
					<td class="borda-bb borda-r">
					<?php
						$valor_parcela = $retorno['valor_parcela'];
						echo $Aplicacao->Bd2real($valor_parcela);
					?>
					</td>
				</tr>
				<tr>
					<td class="totais borda-bb borda-l">Imposto de Renda a ser retido: </td>
					<td class="totais explicativo borda-bb">R$</td>
					<td class="totais borda-bb borda-r">
					<?php
						if($retorno['percentual']<>'isento'){
							$valor_apurado_ir = ($valor_apurado - $valor_parcela);
							echo $Aplicacao->Bd2real($valor_apurado_ir);
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
				<tr class="table-footer">
					<td colspan="4">
						<p class="explicativo">Número de meses para cálculo do Imposto de renda, considerando o "RRA": <?=$consulta[0]->get('num_meses'); ?> meses;<BR>
						Número de Dependentes para efeito do RRA: <?=$consulta[0]->get('num_dependentes'); ?> dependentes</p>
					</td>
				</tr>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
				<?php
				$parametros_custas['id_atualizacao'] = $consulta[0]->get('id');
				$consulta_custas = $Aplicacao->getAtualizacoes()->pegaCustas($parametros_custas);
				if(sizeof($consulta_custas)>0){
					for($index = 0; $index < sizeof( $consulta_custas); $index++) {
					if($index==0)$top="borda-t";
				?>
				<tr class="table-titulo">
					<td colspan="5">
						<p><strong>Outros débitos homologados por Sentença (Custas e/ou Despesas processuais)</strong></p>
					</td>
				</tr>
				<tr>
					<td class="<?=$top;?> borda-l borda-b">
						<?=$consulta_custas[$index]->get('nome_custa')." | Fl.: ".$consulta_custas[$index]->get('folhas_custa')." | Data: ".$Aplicacao->Data2String($consulta_custas[$index]->get('data_custa'));?>
					</td>
					<td class="explicativo <?=$top;?> borda-b">R$</td>
					<td class="<?=$top;?> borda-b borda-r"><?=$Aplicacao->Bd2real($consulta_custas[$index]->get('valor_custa'));?></td>
					<td class="explicativo"></td>
				</tr>
				<tr>
					<td class="borda-bb borda-l">
						Índice de atualização para <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?>
						é 
						<?php
							$parametros_indice['data_original'] = $consulta_custas[$index]->get('data_custa');
							$parametros_indice['data_atualizar'] = $consulta[0]->get('data_atualizar');
							$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
							echo $indice;
						?>
					</td>
					<td class="explicativo borda-bb">R$</td>
					<td class="borda-bb borda-r">
					<?php
							$valor_atualizado = ($consulta_custas[$index]->get('valor_custa') * $indice);
							echo $Aplicacao->Bd2real($valor_atualizado);
							
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
					<td class="totais borda-bb borda-l">Total das custas e/ou despesas já atualizadas:</td>
					<td class="totais explicativo borda-bb">R$</td>
					<td class="totais borda-bb borda-r">
					<?php
						echo $Aplicacao->Bd2real($total_custas);
					?>		
					</td>
					<td class="explicativo">		
					</td>
				</tr>
				<?php
				}
				?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
				<tr class="table-titulo">
					<td colspan="4">
					<p><strong>Crédito do Reclamante</strong></p>
					</td>
				</tr>
				<tr>
					<td class="borda-t borda-l borda-b">Crédito do Reclamante (Principal + Juros):</td>
					<td class="explicativo borda-t borda-b">R$</td>
					<td class="borda-t borda-b borda-r"><?=$Aplicacao->Bd2real($total_com_juros);?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="borda-l borda-b">Dedução do Imposto de Renda:</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r"><?=$Aplicacao->Bd2real($valor_apurado_ir);?></td>
				</tr>
				<tr>
					<td class="totais borda-l borda-bb">Valor Líquido do Reclamante:</td>
					<td class="totais explicativo borda-bb">R$</td>
					<td class="totais borda-bb borda-r">
					<?php
						$credito_liquido = ($total_com_juros - $valor_apurado_ir);
						echo $Aplicacao->Bd2real($credito_liquido);
					?>
					</td>
					<td class="explicativo">
					<?php
						echo "R$ ".$Aplicacao->Bd2real($total_com_juros)." - R$ ".$Aplicacao->Bd2real($valor_apurado_ir);
					?>	
					</td>
				</tr>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
				<tr class="table-titulo">
					<td colspan="4">
					<p><strong>Total apurado débito processual</strong></p>
					</td>
				</tr>
				<tr>
					<td class="borda-t borda-l borda-b">Valor Líquido do Reclamante:</td>
					<td class="explicativo borda-t borda-b">R$</td>
					<td class="borda-t borda-b borda-r"><?=$Aplicacao->Bd2real($credito_liquido);?></td>
					
				</tr>
				<tr>
					<td class="borda-l borda-b">Custas e/ou Despesas Procesuais:</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r"><?=$Aplicacao->Bd2real($total_custas);?></td>
				</tr>
				<tr>
					<td class="borda-l borda-b">Imposto de Renda:</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r"><?=$Aplicacao->Bd2real($valor_apurado_ir);?></td>
				</tr>
				<tr>
					<td class="borda-l borda-b">Contribuição Previdenciária Reclamante:</td>
					<td class="explicativo borda-b">R$</td>
					<td class="borda-b borda-r">à fazer</td>
				</tr>
				<tr>
					<td class="totais borda-bb borda-l">Total do Débito <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></td>
					<td class="totais explicativo borda-bb">R$</td>
					<td class="totais borda-bb borda-r">
					<?php
						$total_pagar = ($credito_liquido + $total_custas);
						echo $Aplicacao->Bd2real($total_pagar);
					?>
					</td>
				</tr>
			</table>
		</div>    
    </div>
    <!--<div class="page">
        <div class="subpage">Page 2/2</div>    
    </div>-->
</div>
  
</body>


</html>