<?php
	require_once "includes/aplicacao.php"; 
	$Aplicacao->VerificaLogado();
	//$_POST[id]=1;
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
<script src="js/jquery-1.8.3.min.js"></script>
   <link href="css/relatorio2.css" rel="stylesheet" />
  
</head>
<body onLoad="monta3()">
 <script>
	function monta3(){
		var tam = 0;
		for(var i=1; i<=5 ; i++){
			tam = (tam + $('#resultado'+i).height());
			
			if(tam>1040){
				tam=0;
				$('#print').html($('#print').html() + '<div style="page-break-after: always;"></div><div style="height:15mm; width:100%"></div>');
			}
			$('#print').html($('#print').html() + $('#resultado'+i).html());
			
		}
		
		$('#naoprint').css('display','none');
		$('#pagina').css('display','');
	}
 </script>
<div id="pagina" style="display:none;" class="book">
    <div class="page">
        <div class="subpage" id="print">
		
		</div>
	</div>
</div>

<div class="book" id="naoprint">
    <div class="page">
        <div class="subpage">
			<div id="resultado1" style="background-color:red;">
			<table id="tabela" cellpadding="0" cellspacing="0" border="0">
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
							<td class="borda-bb alinha-b">Valor atualizado  para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
							<td class=""></td>
							<td class="borda-b explicativo" rowspan="2">R$</td>
							<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_atualizado); ?></td>
							<td class="borda-r"></td>
						</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-b explicativo alinha-t">
								<?php echo "Índice: ".$Aplicacao->Bd2Indice($indice)." &nbsp; &nbsp; &nbsp; &nbsp; Cálculo: R$ ".$Aplicacao->Bd2real($valor_original)." x ".$Aplicacao->Bd2Indice($indice); ?>
							</td>
							<td class="borda-b"></td>
							<td class="borda-r"></td>
						</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-bb alinha-b">
							<?php echo "Juros de Mora: de  ".$Aplicacao->Data2String($data_ajuizamento).
								" a ".$Aplicacao->Data2String($data_atualizacao)." = ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%";?>
						</td>
						<td></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_do_juros); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." x ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%"; ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-bb alinha-b">Total apurado para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
							<td></td>
							<td class="borda-b explicativo" rowspan="2">R$</td>
							<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($total_com_juros); ?></td>
							<td class="borda-r"></td>
						</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." + R$ ".$Aplicacao->Bd2real($valor_do_juros);?></td>
							<td class="borda-b"></td>
							<td class="borda-r"></td>
						</tr>
					<tr>
						<td class="borda-l">&nbsp; </td>
						<td class="borda-bb alinha-b">Valor liberado ao autor da ação em <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
						<td class=""></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2">-<?php echo $Aplicacao->Bd2real($valor_liberado); ?></td>
						<td class="borda-r">&nbsp; </td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo alinha-t"><?php echo $consulta_depositos[$i]->get('obs_deposito'); ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-bb alinha-b">Diferença devida:</td>
							<td class=""></td>
							<td class="borda-b explicativo" rowspan="2">R$</td>
							<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($total_menos_liberado); ?></td>
							<td class="borda-r"></td>
						</tr>
						<tr>
							<td class="borda-l"></td>
							<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($total_com_juros)." - R$ ".$Aplicacao->Bd2real($valor_liberado); ?></td>
							<td class="borda-b"></td>
							<td class="borda-r"></td>
						</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-bb" colspan="2">Principal:
							<span class="explicativo" style="float:right;">
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
						<td class="borda-b" colspan="2">Juros:
							<span class="explicativo" style="float:right;">
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
						<td class="borda-bb alinha-b">Atualização do Principal para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
						<td></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_atualizado); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo alinha-t">
							<?php echo "Índice: ".$Aplicacao->Bd2indice($indice)." &nbsp; &nbsp; &nbsp; &nbsp; Cálculo:  R$ ".$Aplicacao->Bd2real($principal)." x ".$indice; ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Juros de Mora: de  ".$Aplicacao->Data2String($data_ajuizamento).
							" a ".$Aplicacao->Data2String($data_atualizacao)." = ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_do_juros); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." x ".$Aplicacao->Bd2percentual($percentual_juros_mora)."%"; ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
					<tr class="total">
						<td class="borda-l"></td>
						<td class="borda-bb alinha-b">Valor Total apurado para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
						<td></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($total_com_juros); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-b borda-l"></td>
						<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_atualizado)." + R$ ".$Aplicacao->Bd2real($valor_do_juros);?></td>
						<td class="borda-b"></td>
						<td class="borda-b borda-r"></td>
					</tr>
				<tr>
					<td></td><!--Quebra-->
				<tr>
			</table>
			</div>
			<div id="resultado2">
			<table cellpadding="5" cellspacing="0" border="0">
				<?php
					if($consulta->get('valor_ir')>0){
						$valor_ir = $consulta->get('valor_ir');
					}else{
						$valor_ir = ($consulta->get('valor_original')*$consulta->get('percentual_ir'))/100;
					}
				
					$parametros_indice['data_original'] = $consulta->get('data_original');
					$parametros_indice['data_atualizar'] = $data_atualizacao;
					$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
					$ir_atualizado = ($valor_ir * $indice);
					echo "<!-- indice final: de ".$consulta->get('data_original')." ate ".$data_atualizacao . " = " .$Aplicacao->Bd2Indice($indice). "-->";
					
					
					$parametros_aliquota['valor'] = $valor_ir;
					$parametros_aliquota['num_meses'] = $consulta->get('num_meses');
					$retorno = $Aplicacao->getAtualizacoes()->pegaAliquota($parametros_aliquota);
					
					if($retorno['percentual']<>'isento'){
						$valor_aliquota = $retorno['percentual'];
						//echo $valor_aliquota."%";
					}else{
						$valor_aliquota=0;
						//echo $retorno['percentual'];
					}
					
					$valor_parcela = $retorno['valor_parcela'];
					
					$ir_atualizado_com_aliquota = ($ir_atualizado * $valor_aliquota)/100;
				
					if($retorno['percentual']<>'isento'){
						$valor_apurado_ir = ($ir_atualizado_com_aliquota - $valor_parcela);
					}else{
						$valor_apurado_ir = 0;
					}
				?>
				<tr>
					<td colspan="6"><strong>Imposto de Renda</strong></td>
				<tr>
				
				<tr>
					<td class="borda-t borda-l">&nbsp; </td>
					<td class="borda-t borda-b titulo" width="440px" colspan="2">
						Valor da base tributável Imposto de Renda, em  
						<?php echo $Aplicacao->Data2String($consulta->get('data_original')); ?>:</td>
					<td class="borda-t borda-b explicativo">R$</td>
					<td class="borda-t borda-b" align="center" width="90px">
					<?php
						echo $Aplicacao->Bd2real($valor_ir);
					?>	
					</td>
					<td class="borda-t borda-r">&nbsp; </td>
				</tr>
				
					<tr>
						<td class="borda-l"></td>
						<td class="borda-bb alinha-b">
							<?php echo "Base atualizada  para ".$Aplicacao->Data2String($data_atualizacao).": ";?>
						</td>
						<td></td>
						<td class="borda-b explicativo" rowspan="2">R$</td>
						<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($ir_atualizado); ?></td>
						<td class="borda-r"></td>
					</tr>
					<tr>
						<td class="borda-l"></td>
						<td class="borda-b explicativo alinha-t"><?php echo "Índice: ".$Aplicacao->Bd2Indice($indice)." &nbsp; &nbsp; &nbsp; &nbsp; Cálculo:  R$ ".$Aplicacao->Bd2real($valor_ir)." x ".$Aplicacao->Bd2Indice($indice); ?></td>
						<td class="borda-b"></td>
						<td class="borda-r"></td>
					</tr>
					
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor apurado antes da dedução considerando alíquota de ".$Aplicacao->Bd2percentual($valor_aliquota)."%";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($ir_atualizado_com_aliquota); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($ir_atualizado)." x ".$Aplicacao->Bd2percentual($valor_aliquota)."%"; ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<tr class="total">
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">Valor do Imposto de Renda considerando a dedução de R$ <?php echo $Aplicacao->Bd2real($valor_parcela); ?></td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_apurado_ir); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-b borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($ir_atualizado_com_aliquota)." - R$ ".$Aplicacao->Bd2real($valor_parcela);?></td>
					<td class="borda-b"></td>
					<td class="borda-b borda-r"></td>
				</tr>
				
				<tr>
					<td></td><!--Quebra-->
				<tr>
			</table>
			</div>
			<div id="resultado3">
			<table cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td colspan="6"><strong>Contribuição Previdenciária</strong></td>
				<tr>
				<?php
				
					if($consulta->get('forma_atualizar')==0){
						$parametros_indice['data_original'] = $consulta->get('data_original');
						$parametros_indice['data_atualizar'] = $data_atualizacao;
						$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
					}else{///PEGAR OUTRO INDICE AQUI VERIFICAR!!!
						$parametros_indice['data_original'] = $consulta->get('data_original');
						$parametros_indice['data_atualizar'] = $data_atualizacao;
						$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
					}
					if($consulta->get('inss_reclamante')>0 || $consulta->get('inss_reclamada')>0){
						$inss_atualizado_reclamante = ($consulta->get('inss_reclamante') * $indice);
						$inss_atualizado_reclamada = ($consulta->get('inss_reclamada') * $indice);
						$total_inss = ($inss_atualizado_reclamante + $inss_atualizado_reclamada);
				?>
				
				<tr>
					<td class="borda-l borda-t"></td>
					<td class="borda-bb borda-t" width="440px">
						<?php echo "Valor da Contribuição Previdenciária, cota parte Reclamante:";?>
					</td>
					<td class="borda-t"></td>
					<td class="borda-bb borda-t explicativo">R$</td>
					<td class="borda-bb borda-t" align="center" width="90px"><?php echo $Aplicacao->Bd2real($consulta->get('inss_reclamante')); ?></td>
					<td class="borda-r borda-t"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo"><?php echo "Índice: ".$Aplicacao->Bd2Indice($indice)." &nbsp; &nbsp; &nbsp; &nbsp; Cálculo:  R$ ".$Aplicacao->Bd2real($consulta->get('inss_reclamante'))." x ".$Aplicacao->Bd2Indice($indice); ?></td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($inss_atualizado_reclamante); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb">
						<?php echo "Valor da Contribuição Previdenciária, cota parte Reclamada:";?>
					</td>
					<td class=""></td>
					<td class="borda-bb explicativo">R$</td>
					<td class="borda-bb" align="center"><?php echo $Aplicacao->Bd2real($consulta->get('inss_reclamada')); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo"><?php echo "Índice: ".$Aplicacao->Bd2Indice($indice)." &nbsp; &nbsp; &nbsp; &nbsp; Cálculo:  R$ ".$Aplicacao->Bd2real($consulta->get('inss_reclamada'))." x ".$Aplicacao->Bd2Indice($indice); ?></td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($inss_atualizado_reclamada); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr class="total">
					<td class="borda-l borda-b"></td>
					<td class="borda-b">Valor Total apurado INSS atualizado para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($total_inss); ?></td>
					<td class="borda-r borda-b"></td>
				</tr>
				<?php
					}else{ // Não tiver valores inss
						$taxa_inss_atualizado_reclamante = ($consulta->get('taxa_inss_reclamante') * $indice);
						
						$valor_taxa_inss_empregador = ($consulta->get('valor_tributavel') * $consulta->get('taxa_inss_empregador'))/100;
						$valor_taxa_inss_atualizado_empregador = ($valor_taxa_inss_empregador * $indice);
						$valor_taxa_inss_sat = ($consulta->get('valor_tributavel') * $consulta->get('taxa_inss_sat'))/100;
						$valor_taxa_inss_atualizado_sat = ($valor_taxa_inss_sat * $indice);
						$valor_taxa_inss_terceiros = ($consulta->get('valor_tributavel') * $consulta->get('taxa_inss_terceiros'))/100;
						$valor_taxa_inss_atualizado_terceiros = ($valor_taxa_inss_terceiros * $indice);
						
						$total_inss = ($inss_atualizado_reclamante + $valor_taxa_inss_atualizado_empregador + 
							$valor_taxa_inss_atualizado_sat + $valor_taxa_inss_atualizado_terceiros);
						
						
				?>
				
				<tr	>
					<td class="borda-l borda-t"></td>
					<td class="borda-b borda-t" width="440px">Base de Cálculo da Contribuição Previdenciária Empregador, em <?php echo $Aplicacao->Data2String($consulta->get('data_original')); ?>:</td>
					<td class="borda-b borda-t"></td>
					<td class="borda-b borda-t explicativo">R$</td>
					<td class="borda-b borda-t" align="center"><?php echo $Aplicacao->Bd2real($consulta->get('valor_tributavel')); ?></td>
					<td class="borda-r borda-t"></td>
				</tr>
				
				<?php if($consulta->get('taxa_inss_empregador') > 0){ ?>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor da Contribuição Previdenciária Empregador - alíquota: ".$Aplicacao->Bd2percentual($consulta->get('taxa_inss_empregador'))."%";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_taxa_inss_empregador); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($consulta->get('valor_tributavel'))." x ".$Aplicacao->Bd2percentual($consulta->get('taxa_inss_empregador'))."%"; ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor Atualizado para ".$Aplicacao->Data2String($data_atualizacao).":";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_taxa_inss_atualizado_empregador); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_taxa_inss_empregador)." x ".$Aplicacao->Bd2Indice($indice); ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<?php } ?>
				<?php if($consulta->get('taxa_inss_sat') > 0){ ?>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor da Contribuição Previdenciária SAT - alíquota: ".$Aplicacao->Bd2percentual($consulta->get('taxa_inss_sat'))."%";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2" width="90px"><?php echo $Aplicacao->Bd2real($valor_taxa_inss_sat); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($consulta->get('valor_tributavel'))." x ".$Aplicacao->Bd2percentual($consulta->get('taxa_inss_sat'))."%"; ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor Atualizado para ".$Aplicacao->Data2String($data_atualizacao).":";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_taxa_inss_atualizado_sat); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_taxa_inss_sat)." x ".$Aplicacao->Bd2Indice($indice); ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<?php } ?>
				<?php if($consulta->get('taxa_inss_terceiros') > 0){ ?>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor da Contribuição Previdenciária Terceiros - alíquota: ".$Aplicacao->Bd2percentual($consulta->get('taxa_inss_terceiros'))."%";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_taxa_inss_terceiros); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($consulta->get('valor_tributavel'))." x ".$Aplicacao->Bd2percentual($consulta->get('taxa_inss_terceiros'))."%"; ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb alinha-b">
						<?php echo "Valor Atualizado para ".$Aplicacao->Data2String($data_atualizacao).":";?>
					</td>
					<td></td>
					<td class="borda-b explicativo" rowspan="2">R$</td>
					<td class="borda-b" align="center" rowspan="2"><?php echo $Aplicacao->Bd2real($valor_taxa_inss_atualizado_terceiros); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Cálculo:  R$ ".$Aplicacao->Bd2real($valor_taxa_inss_terceiros)." x ".$Aplicacao->Bd2Indice($indice); ?></td>
					<td class="borda-b"></td>
					<td class="borda-r"></td>
				</tr>
				<?php } ?>
				
				<tr>
					<td class="borda-l"></td>
					<td class="borda-bb">
						<?php echo "Valor da Contribuição Previdenciária, cota parte Reclamante:";?>
					</td>
					<td class=""></td>
					<td class="borda-bb explicativo">R$</td>
					<td class="borda-bb" align="center"><?php echo $Aplicacao->Bd2real($consulta->get('taxa_inss_reclamante')); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo"><?php echo "Índice: ".$Aplicacao->Bd2Indice($indice)." &nbsp; &nbsp; &nbsp; &nbsp; Cálculo:  R$ ".$Aplicacao->Bd2real($consulta->get('taxa_inss_reclamante'))." x ".$Aplicacao->Bd2Indice($indice); ?></td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($taxa_inss_atualizado_reclamante); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr class="total">
					<td class="borda-l borda-b"></td>
					<td class="borda-b">Valor Total apurado INSS atualizado para <?php echo $Aplicacao->Data2String($data_atualizacao); ?>:</td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($total_inss); ?></td>
					<td class="borda-r borda-b"></td>
				</tr>
				<?php
					}
				?>
				
				<tr>
					<td></td><!--Quebra-->
				<tr>
			</table>
			</div>
			<div id="resultado4">
			<table cellpadding="5" cellspacing="0" border="0">
				<?php
					if(sizeof($consulta_custas)>0){
					
					$parametros_indice['data_original'] = $consulta->get('data_original');
					$parametros_indice['data_atualizar'] = $data_atualizacao;
					$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
				?>
					
				<tr>
					<td colspan="6"><strong>Custas e/ou Despesas Processuais</strong></td>
				<tr>
				<?php
					for($c=0;$c<sizeof($consulta_custas);$c++){
						$custa_atualizada = ($consulta_custas[$c]->get('valor_custa') * $indice);
						if($c==0)$borda_t = "borda-t"; else $borda_t="";
						$total_custas = ($total_custas + $custa_atualizada);
				?>	
				<tr>
					<td class="borda-l <?=$borda_t;?>"></td>
					<td class="borda-bb explicativo <?=$borda_t;?>" width="440px">
						<?php 
						echo $consulta_custas[$c]->get('nome_custa').
						", fl. ".$consulta_custas[$c]->get('folhas_custa').
						", R$ ".$Aplicacao->Bd2real($consulta_custas[$c]->get('valor_custa'))." x ".$Aplicacao->Bd2Indice($indice);
						?>
					</td>
					<td class="<?=$borda_t;?>"></td>
					<td class="borda-bb <?=$borda_t;?> explicativo">R$</td>
					<td class="borda-bb <?=$borda_t;?>" align="center" width="90px"><?php echo $Aplicacao->Bd2real($custa_atualizada); ?></td>
					<td class="borda-r <?=$borda_t;?>"></td>
				</tr>
				<?php
					}
				?>
				
				<tr class="total">
					<td class="borda-l borda-b"></td>
					<td class="borda-b">Total das Custas e/ou Despesas Processuais, <?php echo $Aplicacao->Data2String($data_atualizacao); ?></td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($total_custas); ?></td>
					<td class="borda-r borda-b"></td>
				</tr>
				<?php
					}
				?>
				<tr>
					<td></td><!--Quebra-->
				<tr>
			</table>
			</div>
			<div id="resultado5">
			<table cellpadding="5" cellspacing="0" border="0">
				
				<?php
					
					$total_liquido = $total_com_juros - $valor_apurado_ir;
					$Resultado_Final = ($total_liquido + $valor_apurado_ir + $total_inss + $total_custas);
				?>
					
				<tr>
					<td colspan="6"><strong>Total do débito no processo trabalhista</strong></td>
				<tr>
				<tr>
					<td class="borda-l borda-t"></td>
					<td class="borda-bb borda-t alinha-b" width="440px">Valor Líquido devido ao Reclamante</td>
					<td class=" borda-t"></td>
					<td class="borda-b borda-t explicativo" rowspan="2">R$</td>
					<td class="borda-b borda-t" align="center" rowspan="2" width="90px"><?php echo $Aplicacao->Bd2real($total_liquido); ?></td>
					<td class="borda-r borda-t"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b explicativo alinha-t"><?php echo "Principal + Juros:  R$ ".$Aplicacao->Bd2real($total_com_juros)." - Imposto de Renda: ".$Aplicacao->Bd2real($valor_apurado_ir); ?></td>
					<td class="borda-b"></td> 
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b">Imposto de Renda a ser recolhido pela Reclamada</td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($valor_apurado_ir); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b">Contribuição Previdenciária a ser recolhida pela Reclamada</td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($total_inss); ?></td>
					<td class="borda-r"></td>
				</tr>
				<tr>
					<td class="borda-l"></td>
					<td class="borda-b">Custas e/ou Despesas Processuais</td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($total_custas); ?></td>
					<td class="borda-r"></td>
				</tr>
				
				
				<tr class="total">
					<td class="borda-l borda-b"></td>
					<td class="borda-b">Total do débito apurado, <?php echo $Aplicacao->Data2String($data_atualizacao); ?></td>
					<td class="borda-b"></td>
					<td class="borda-b explicativo">R$</td>
					<td class="borda-b" align="center"><?php echo $Aplicacao->Bd2real($Resultado_Final); ?></td>
					<td class="borda-r borda-b"></td>
				</tr>
				<tr>
					<td></td><!--Quebra-->
				<tr>
			</table>
			</div>
		</div>    
    </div>
</div>
  
</body>


</html>