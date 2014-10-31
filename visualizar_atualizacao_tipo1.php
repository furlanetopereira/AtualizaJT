<?php
	include_once $pasta."includes/parte_cima.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."controler/atualizacoes.ctrl.php";
?> 
<style>
.table-atualizacoes tr th{
	text-align:center;
	vertical-align:bottom;
}
.table-atualizacoes tr td{
	text-align:center;
	background-color:#F9F9F9;
	vertical-align:middle;
}
.table-atualizacoes .table-titulo th {
	text-align:left;
	background-color:#FFF;
	font-weight:normal;
	padding-bottom:0px;
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
</style>
<div class="row-fluid">
	<div class="span12">
		<h3 class="page-title">Processo: <?=$consulta[0]->get('num_processo');?></h3>
	</div>
</div>
	<div class="row-fluid">
		<form action="visualizar_atualizacao_tipo1B.php" target="_blank" method="post">
			<input type="hidden" name="pesq" value="atualizacoes_tipo1" />
			<input type="hidden" name="pesq_id" value="<?=$consulta[0]->get('id');?>" />
			<p style="text-align:right;">
				<button class="btn btn-large btn-inverse">
					<i class="icon-print icon-white"></i> Imprimir</button>
				<a href="pesquisar_atualizacoes_tipo1.php" class="btn btn-large">
					<i class="icon-undo icon-white"></i> Voltar</a>
			</p>
		</form>
	</div>
<div class="row-fluid">
	<div class="span12">
	<table class="table table-atualizacoes table-form"   align="center" id="table-a">
	<thead>
		<tr class="table-titulo">
			<th colspan="9">
				<strong>a) Atualização dos valores (atualização monetária e juros desde o ajuizamento da ação)</strong>
				<p>Data do ajuizamento da ação: <?=$Aplicacao->Data2String($consulta[0]->get('data_ajuizamento')); ?></p>
			</th>
		</tr>
		<tr>
			<th width="150px">Valor<BR>original para<BR><?=$Aplicacao->Data2String($consulta[0]->get('data_original')); ?></th>
			<th width="10px"></th>
			<th width="150px">índice de<BR>atualização<BR><?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></th>
			<th width="10px"></th>
			<th width="150px">Valor<BR>atualizado<BR>para<BR><?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></th>
			<th width="10px"></th>
			<th width="150px">Juros de Mora<BR>de: <?=$Aplicacao->Data2String($consulta[0]->get('data_ajuizamento')); ?>
					<BR>até: <?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?><BR>
					<?php
					//51,53%
					$parametros_juros['data_inicial'] = $consulta[0]->get('data_ajuizamento');
					$parametros_juros['data_final'] = $consulta[0]->get('data_atualizar');
					
					$percentual_juros_mora = $Aplicacao->getAtualizacoes()->CalculaPercentualJurosMora($parametros_juros);
					echo $percentual_juros_mora."%";
					?>
					
					</th>
			<th width="10px"></th>
			<th width="150px">Valor atualizado<BR>e com<BR>Juros para<BR><?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></th>
		</tr>	
	</thead>
	<tbody>
		<tr class="">
			<td>R$ <?=$Aplicacao->Bd2real($consulta[0]->get('valor_original')); ?></td>
			<td>x</td>
			<td>
			<?php
				$parametros_indice['data_original'] = $consulta[0]->get('data_original');
				$parametros_indice['data_atualizar'] = $consulta[0]->get('data_atualizar');
				$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
				echo $indice;
			?>
			</td>
			<td>=</td>
			<td>
			<?php
				$valor_atualizado = ($consulta[0]->get('valor_original') * $indice);
				echo "R$ ".$Aplicacao->Bd2real($valor_atualizado);
			?>
			</td>
			<td>+</td>
			<td>
			<?php
				$valor_com_juros = ($valor_atualizado * $percentual_juros_mora)/100;
				echo "R$ ".$Aplicacao->Bd2real($valor_com_juros);
			?>
			</td>
			<td>=</td>
			<td>
			<?php
				$total_com_juros = ($valor_atualizado + $valor_com_juros);
				echo "R$ ".$Aplicacao->Bd2real($total_com_juros);
			?>
			</td>
		</tr>
		
	</tbody>
	</table>
	</div>
</div>
<div class="space15"><hr class="estilo" /></div>
<div class="row-fluid">
	<div class="span12">
	<table class="table table-atualizacoes table-form"   align="center" id="table-a">
	<thead>
		<tr class="table-titulo">
			<th colspan="9">
				<strong>b) Cálculo do Imposto de Renda</strong>
				<p>Número de meses para cálculo do Imposto de renda, considerando o "RRA": <?=$consulta[0]->get('num_meses'); ?> meses;<BR>
				Número de Dependentes para efeito do RRA: <?=$consulta[0]->get('num_dependentes'); ?> dependentes</p>
			</th>
		</tr>
		<tr>
			<th width="150px">Base de Cálculo do Imposto Renda</th>
			<th width="10px"></th>
			<th width="150px">Dependentes do Imposto Renda</th>
			<th width="10px"></th>
			<th width="150px">Base de Tributável Líquida</th>
			<th width="10px"></th>
			<th width="150px">Alíquota aplicável</th>
			<th width="10px"></th>
			<th width="150px">Valor apurado antes da dedução</th>
			<th width="10px"></th>
			<th width="150px">Parcela a deduzir</th>
			<th width="10px"></th>
			<th width="150px">Valor apurado Imposto Renda</th>
		</tr>	
	</thead>
	<tbody>
		<tr class="">
			<td>
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
			<td>-</td>
			<td>
			<?php
				$valor_dependentes = ($consulta[0]->get('num_dependentes')*$consulta[0]->get('num_meses')*179.71);
				echo "R$ ".$Aplicacao->Bd2real($valor_dependentes);
			?>
			</td>
			<td>=</td>
			<td>
			<?php
				$valor_base = ($valor_ir -  $valor_dependentes);
				echo "R$ ".$Aplicacao->Bd2real($valor_base);
			?>
			</td>
			<td>x</td>
			<td>
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
			<td>=</td>
			<td>
			<?php
				$valor_apurado = ($valor_base * $valor_aliquota)/100;
				echo "R$ ".$Aplicacao->Bd2real($valor_apurado);
			?>
			</td>
			<td>-</td>
			<td>
			<?php
				$valor_parcela = $retorno['valor_parcela'];
				echo "R$ ".$Aplicacao->Bd2real($valor_parcela);
			?>
			</td>
			<td>=</td>
			<td>
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
		</tr>
		
	</tbody>
	</table>
	</div>
</div>
<div class="space15"><hr class="estilo" /></div>
<div class="row-fluid">
	<div class="span12">
	<table class="table table-atualizacoes table-form"  align="center" id="table-a">
	<thead>
		<tr class="table-titulo">
			<th colspan="9">
				<p><strong>c) Outros débitos homologados por Sentença (Custas e/ou Despesas processuais)</strong></p>
			</th>
		</tr>
		<tr>
			<th width="250px" style="text-align:left;">Nome das custas e/ou despesas</th>
			<th width="10px"></th>
			<th width="150px">Data da Custa e/ou Despesa Processual</th>
			<th width="10px"></th>
			<th width="150px">Valor da Custa e/ou Despesa Processual</th>
			<th width="10px"></th>
			<th width="150px">índice de atualização<BR><?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar'));?></th>
			<th width="10px"></th>
			<th width="150px">Valor atualizado</th>
		</tr>	
	</thead>
	<tbody>
		<?php
		$parametros_custas['id_atualizacao'] = $consulta[0]->get('id');
		$consulta_custas = $Aplicacao->getAtualizacoes()->pegaCustas($parametros_custas);
		if(sizeof($consulta_custas)>0){
			for($index = 0; $index < sizeof( $consulta_custas); $index++) {
		?>
		<tr class="">
			<td style="text-align:left;"><?=$consulta_custas[$index]->get('nome_custa')." | Folhas dos Autos: ".$consulta_custas[$index]->get('folhas_custa');?></td>
			<td></td>
			<td><?=$Aplicacao->Data2String($consulta_custas[$index]->get('data_custa'));?></td>
			<td></td>
			<td>R$ <?=$Aplicacao->Bd2real($consulta_custas[$index]->get('valor_custa'));?></td>
			<td>x</td>
			<td>
			<?php
				$parametros_indice['data_original'] = $consulta_custas[$index]->get('data_custa');
				$parametros_indice['data_atualizar'] = $consulta[0]->get('data_atualizar');
				$indice = $Aplicacao->getAtualizacoes()->pegaIndice($parametros_indice);
				echo $indice;
			?>
			</td>
			<td>=</td>
			<td>
			<?php
					$valor_atualizado = ($consulta_custas[$index]->get('valor_custa') * $indice);
					echo "R$ ".$Aplicacao->Bd2real($valor_atualizado);
					
					$total_custas = $total_custas + $valor_atualizado;
			?>
			</td>
		</tr>
	</tbody>
		<?php
			}
		?>
	<thead>
		<tr>
			<th colspan="8" style="text-align:right;"><strong>Total das custas e/ou despesas:</strong></th>
			<th style="text-align:center;">R$ <?=$Aplicacao->Bd2real($total_custas);?></th>
		</tr>
	</thead>
		<?php
		}
		
		?>
	</table>
	</div>
</div>
<div class="space15"><hr class="estilo" /></div>
<div class="row-fluid">
	<div class="span12">
	<table class="table table-atualizacoes table-form"  align="center" id="table-a">
	<thead>
		<tr class="table-titulo">
			<th colspan="9">
				<p><strong>d) Total apurado débito processual</strong></p>
			</th>
		</tr>
		<tr>
			<th width="150px">Total apurado crédito do Reclamante</th>
			<th width="10px"></th>
			<th width="150px">Imposto de Renda</th>
			<th width="10px"></th>
			<th width="150px">Valor atualizado crédito líquido<BR><?=$Aplicacao->Data2String($consulta[0]->get('data_atualizar')); ?></th>
			<th width="10px"></th>
			<th width="150px">Custas e/ou Despesas Procesuais</th>
			<th width="10px"></th>
			<th width="150px">Total a ser pago no Processo</th>
		</tr>	
	</thead>
	<tbody>
		<tr class="">
			<td><?="R$ ".$Aplicacao->Bd2real($total_com_juros);?></td>
			<td>-</td>
			<td><?="R$ ".$Aplicacao->Bd2real($valor_apurado_ir);?></td>
			<td>=</td>
			<td>
			<?php
					$credito_liquido = ($total_com_juros - $valor_apurado_ir);
					echo "R$ ".$Aplicacao->Bd2real($credito_liquido);
			?>
			</td>
			<td>+</td>
			<td>
			<?php
					echo "R$ ".$Aplicacao->Bd2real($total_custas);
			?>
			</td>
			<td>=</td>
			<td>
			<?php
					$total_pagar = ($credito_liquido + $total_custas);
					echo "R$ ".$Aplicacao->Bd2real($total_pagar);
			?>
			</td>
		</tr>
	</tbody>
	</table>
	</div>
</div>
<div class="space15"><hr class="estilo" /></div>

<?php
	include_once "includes/parte_baixo.php"; 
?>