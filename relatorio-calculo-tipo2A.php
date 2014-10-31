<?php
	require_once "includes/aplicacao.php"; 
	$Aplicacao->VerificaLogado();
	
	if($_POST[id]==""){
		$Aplicacao->warp('incluir1-valores.php');
	}else{	
		$id = $_POST[id];
	}
	$parametros['id'] = $id;
	$consulta = $Aplicacao->getAtualizacoes()->pegaAtualizacoes($parametros);
	$consulta = $consulta[0];
	$parametros1['id_atualizacao'] = $consulta->get('id');
	$consulta_depositos = $Aplicacao->getAtualizacoes()->pegaDepositos($parametros1);
	$consulta_custas = $Aplicacao->getAtualizacoes()->pegaCustas($parametros1);
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
   
   <link href="css/relatorio1.css" rel="stylesheet" />
  


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
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="right" width="80px">Proc.:</td>
					<td> &nbsp; &nbsp;<?=$consulta->get('num_processo'); ?></td>
				</tr>
				<tr>
					<td align="right">Vara.:</td>
					<td> &nbsp; &nbsp;<?=$consulta->get('vara'); ?></td>
				</tr>
				<tr>
					<td align="right">Recte:</td>
					<td> &nbsp; &nbsp;<?=$consulta->get('reclamante'); ?></td>
				</tr>
				<tr>
					<td align="right">Recda:</td>
					<td> &nbsp; &nbsp;<?=$consulta->get('reclamada'); ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
			
			<table cellpadding="5" cellspacing="0" border="0">
				<?php 
					if(sizeof($consulta_depositos)>0){
						$data_atualizacao = $consulta_depositos[0]->get('data_deposito');
					}else{
						$data_atualizacao = $consulta->get('data_atualizar');
					}
				?>
				<tr>
					<td colspan="6"><strong>Crédito ao Reclamante</strong></td>
				<tr>
					<td class="borda-t borda-l">&nbsp; </td>
					<td class="borda-t borda-b titulo" width="440px" colspan="2">
						Valor Principal homologado, líquido de INSS, para 
						<?php echo $Aplicacao->Data2String($consulta->get('data_original')); ?>:</td>
					<td class="borda-t borda-b explicativo">R$</td>
					<td class="borda-t borda-b" align="center" width="90px"><?php echo $Aplicacao->Bd2real($consulta->get('valor_original')); ?></td>
					<td class="borda-t borda-r">&nbsp; </td>
				</tr>
				<?php 
					if(sizeof($consulta_depositos)>0){
						for($i=0;$i<sizeof($consulta_depositos);$i++){
						
							if($i==0){
								$data_original = $consulta->get('data_original');
								$data_ajuizamento = $consulta->get('data_ajuizamento');
								$valor_original = $consulta->get('valor_original');
							}else{
								$data_original = $data_atualizacao;
								$data_ajuizamento = $data_atualizacao;//// VERIFICAR SE É ISSO MESMO!!!!!!!!!!!
								
								$valor_original = $principal;//// VERIFICAR QUAL QUE É
							}
						
							$data_atualizacao = $consulta_depositos[$i]->get('data_deposito');
							$valor_liberado = $consulta_depositos[$i]->get('valor_deposito');
							
							
							$parametros_indice['data_original'] = $data_original;
							$parametros_indice['data_atualizar'] = $data_atualizacao;
							$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
							$valor_atualizado = ($valor_original * $indice);
							echo "<!-- indice deposito ".($i+1).": de ".$data_original." ate ".$data_atualizacao . " = " .$indice.  "-->";
							//echo $Aplicacao->Bd2real($valor_atualizado);
							//echo $indice;
							
							$parametros_juros['data_inicial'] = $data_ajuizamento;
							$parametros_juros['data_final'] = $data_atualizacao;
							$percentual_juros_mora = $Aplicacao->getAtualizacoes()->CalculaPercentualJurosMora($parametros_juros);
							$valor_do_juros = ($valor_atualizado * $percentual_juros_mora)/100;
							//echo $Aplicacao->Bd2real($valor_do_juros);
							//echo $percentual_juros_mora."%";
							
							$total_com_juros = ($valor_atualizado + $valor_do_juros);
							//echo $Aplicacao->Bd2real($total_com_juros);
							
							$total_menos_liberado = ($total_com_juros - $valor_liberado);
							
							$percentual_principal = (($valor_atualizado*100)/$total_com_juros);
							$principal = ($total_menos_liberado * $percentual_principal)/100;
							
							$percentual_juros = (($valor_do_juros*100)/$total_com_juros);
							$juros = ($total_menos_liberado * $percentual_juros)/100;
							
				?>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-bb">Valor atualizado  para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
							<td class="" width="10px"></td>
							<td class="borda-b explicativo" rowspan="2">R$</td>
							<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_atualizado); ?></td>
							<td class="borda-r"></td>
						</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-b explicativo">
								<?php echo "Índice: ".$Aplicacao->Bd2Indice($indice)." &nbsp; &nbsp; | &nbsp; &nbsp; Cálculo: R$ ".$Aplicacao->Bd2real($valor_original)." x ".$Aplicacao->Bd2Indice($indice); ?>
							</td>
							<td class="borda-b"></td>
							<td class="borda-r"></td>
						</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-bb">
							<?php echo "Juros de Mora: de  ".$Aplicacao->Data2String($data_ajuizamento).
								" a ".$Aplicacao->Data2String($data_atualizacao)." = ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%";?>
						</td>
						<td width="10px"></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_do_juros); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." x ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%"; ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-bb">Total apurado para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
							<td width="10px"></td>
							<td class="borda-b explicativo" rowspan="2">R$</td>
							<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($total_com_juros); ?></td>
							<td class="borda-r"></td>
						</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-b explicativo"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." + R$ ".$Aplicacao->Bd2real($valor_do_juros);?></td>
							<td class="borda-b"></td>
							<td class="borda-r"></td>
						</tr>
					<tr>
						<td class="borda-l">&nbsp; </td>
						<td class="borda-bb titulo" colspan="2">Valor liberado ao autor da ação em <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2">-<?php echo $Aplicacao->Bd2real($valor_liberado); ?></td>
						<td class="borda-r">&nbsp; </td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo"><?php echo $consulta_depositos[$i]->get('obs_deposito'); ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-bb">Diferença devida:</td>
							<td class="" width="10px"></td>
							<td class="borda-b explicativo" rowspan="2">R$</td>
							<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($total_menos_liberado); ?></td>
							<td class="borda-r"></td>
						</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-b explicativo"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($total_com_juros)." - R$ ".$Aplicacao->Bd2real($valor_liberado); ?></td>
							<td class="borda-b"></td>
							<td class="borda-r"></td>
						</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-bb titulo" colspan="2">Principal:
							<span style="float:right;">
							<?php
								echo "R$ ".$Aplicacao->Bd2real($valor_atualizado)." x 100.00% ÷ R$ ".$Aplicacao->Bd2real($total_com_juros)." = ".
								number_format($percentual_principal,3,'.','')."% x R$ ".$Aplicacao->Bd2real($total_menos_liberado)." = ";
							?>
							</span></td>
						<td class="borda-bb explicativo">R$</td>
						<td class="borda-bb" align="center"><?php echo $Aplicacao->Bd2real($principal); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b titulo" colspan="2">Juros:
							<span style="float:right;">
							<?php
								echo "R$ ".$Aplicacao->Bd2real($valor_do_juros)." x 100.00% ÷ R$ ".$Aplicacao->Bd2real($total_com_juros)." = ".
								$Aplicacao->Bd2percentual3($percentual_juros)."% x R$ ".$Aplicacao->Bd2real($total_menos_liberado)." = ";
							?>
							</span></td>
						<td class="borda-b explicativo">R$</td>
						<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($juros); ?></td>
						<td class="borda-r"></td>
					</tr>
				<?php
							$data_original = $consulta_depositos[$i]->get('data_deposito');
						}
					}else{
						$principal = $consulta->get('valor_original');
						$data_original = $consulta->get('data_original');
						$data_ajuizamento = $consulta->get('data_ajuizamento');
					}
					$data_atualizacao = $consulta->get('data_atualizar');
					
							
					$parametros_indice['data_original'] = $data_original;
					$parametros_indice['data_atualizar'] = $data_atualizacao;
					$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
					$valor_atualizado = ($principal * $indice);
					echo "<!-- indice final: de ".$data_original." ate ".$data_atualizacao . " = " .$Aplicacao->Bd2Indice($indice). "-->";
					//echo $Aplicacao->Bd2real($valor_atualizado);
					//echo $indice;
					
					$parametros_juros['data_inicial'] = $data_ajuizamento;
					$parametros_juros['data_final'] = $data_atualizacao;
					$percentual_juros_mora = $Aplicacao->getAtualizacoes()->CalculaPercentualJurosMora($parametros_juros);
					$valor_do_juros = ($valor_atualizado * $percentual_juros_mora)/100;
					//echo $Aplicacao->Bd2real($valor_do_juros);
					//echo $percentual_juros_mora."%";
					
					$total_com_juros = ($valor_atualizado + $valor_do_juros);
					//echo $Aplicacao->Bd2real($total_com_juros);
				?>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-bb">Atualização do Principal para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
						<td width="10px"></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_atualizado); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo">
							<?php echo "Índice: ".$Aplicacao->Bd2indice($indice)." &nbsp; &nbsp; | &nbsp; &nbsp; Cálculo:  R$ ".$Aplicacao->Bd2real($principal)." x ".$indice; ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb">
						<?php echo "Juros de Mora: de  ".$Aplicacao->Data2String($data_ajuizamento).
							" a ".$Aplicacao->Data2String($data_atualizacao)." = ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%";?>
					</td>
					<td width="10px"></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_do_juros); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." x ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%"; ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
					<tr class="total">
						<td class="borda-l"></td>
						<td class="borda-bb">Valor Total apurado para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
						<td width="10px"></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($total_com_juros); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-b borda-l"></td>
						<td class="borda-b explicativo"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." + R$ ".$Aplicacao->Bd2real($valor_do_juros);?></td>
						<td class="borda-b"></td>
						<td class="borda-b borda-r"></td>
					</tr>
					
				<tr>
					<td></td>
				<tr>
				<tr>
					<td colspan="6"><strong>Contribuição Previdenciária (INSS)</strong></td>
				<tr>
				
			</table>
		</div>    
    </div>
</div>
  
</body>


</html>