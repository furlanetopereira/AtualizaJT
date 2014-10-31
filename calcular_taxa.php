<?php
	include_once $pasta."includes/parte_cima.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."includes/alert.php"; 
?>
    
	 <div class="row-fluid" id="div_form">
		 <div class="span12">
			 <!-- BEGIN BLANK PAGE PORTLET-->
			 <div class="widget blue" id="Novo">
				 <div class="widget-title">
					 <h4><i class="icon-edit"></i> Formulário </h4>
				 </div>
				 <div class="widget-body">
					 <div class="portlet-body">
						<form name="form_calculo" class="form-vertical" method="post" action="">
							<div class="row-fluid">
								<div class="span3">
									<div class="control-group">
										<label class="control-label" >Data da Propositura</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="data" id="data" value="<?=$_POST['data'];?>">
										</div>
									</div>
								</div>
								<div class="span3">
									<div class="control-group">
										<label class="control-label" >Valor</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="valor" id="valor" value="<?=$_POST['valor'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span3">
									<div class="control-group">
										<label class="control-label" >Atualizar Para</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="data_atualizar" id="data_atualizar" value="<?=$_POST['data_atualizar'];?>">
										</div>
									</div>
								</div>
								<div class="span3">
									<div class="control-group">
										<label class="control-label" >Houve Depósito?</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="deposito" id="deposito" value="<?=$_POST['deposito'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span3">
									<div class="control-group">
										<label class="control-label" >Atualizar Novamente Para</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="data_atualizar1" id="data_atualizar1" value="<?=$_POST['data_atualizar1'];?>">
										</div>
									</div>
								</div>
								<div class="span3">
									<div class="control-group">
										<label class="control-label" >Houve outro Depósito?</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="deposito1" id="deposito1" value="<?=$_POST['deposito1'];?>">
										</div>
									</div>
								</div>
							</div>
							<a href="javascript:document.form_calculo.submit();" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar</a>
						</form>
					 </div>
				</div>
			</div>
		</div>
	</div>
	
		<?php
		if(isset($_POST['data'])){
			$data = $_POST['data'];
			$valor = $Aplicacao->Real2bd($_POST['valor']);
			$data_atualizar = $_POST['data_atualizar'];
			$deposito = $Aplicacao->Real2bd($_POST['deposito']);
			$data_atualizar1 = $_POST['data_atualizar1'];
			$deposito1 = $Aplicacao->Real2bd($_POST['deposito1']);
						
			
			$query_aPartir = "
				SELECT taxa FROM tr_diaria WHERE data = '".$Aplicacao->Data2bd($data)."'
			";
			$consulta_aPartir = $Aplicacao->getConexaoSQL()->executaConsulta($query_aPartir);
			$query_atualizar = "
				SELECT taxa FROM tr_diaria WHERE data = '".$Aplicacao->Data2bd($data_atualizar)."'
			";
			$consulta_atualizar = $Aplicacao->getConexaoSQL()->executaConsulta($query_atualizar);
			$query_atualizar1 = "
				SELECT taxa FROM tr_diaria WHERE data = '".$Aplicacao->Data2bd($data_atualizar1)."'
			";
			$consulta_atualizar1 = $Aplicacao->getConexaoSQL()->executaConsulta($query_atualizar1);
			
			$taxa = ($consulta_aPartir[0]['taxa'] / $consulta_atualizar[0]['taxa']);
			$calculado = ($valor * $taxa);
			$total = ($calculado - $deposito);
			
			$taxa1 = ($consulta_atualizar[0]['taxa'] / $consulta_atualizar1[0]['taxa']);
			$calculado1 = ($total * $taxa1);
			$total1 = ($calculado1 - $deposito1);
			
			$taxa2 = ($consulta_aPartir[0]['taxa'] / $consulta_atualizar1[0]['taxa']);
			$calculado2 = ($total * $taxa2);
			$total2 = ($calculado2 - $deposito1);
			
			
			
			
		?>
	<div class="space15"></div>
	<table class="table table-striped table-hover table-form table-bordered" id="table-varas">
		<thead>
			<tr>
				<th width="10%">Data</th>
				<th width="10%">Valor</th>
				<th width="10%">Atualizar Para</th>
				<th width="10%">Taxa</th>
				<th width="10%">Valor * Taxa</th>
				<th width="10%">Depósito</th>
				<th width="10%">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr class="">
				<td><?=$data;?></td>
				<td>R$ <?=$Aplicacao->Bd2real($valor);?></td>
				<td><?=$data_atualizar;?></td>
				<td><?=$taxa;?></td>
				<td>R$ <?=$Aplicacao->Bd2real($calculado);?></td>
				<td>R$ <?=$Aplicacao->Bd2real($deposito);?></td>
				<td>R$ <?=$Aplicacao->Bd2real($total);?></td>
			</tr>
			<tr class="">
				<td><?=$data_atualizar;?><BR>apenas conferencia</td>
				<td>R$ <?=$Aplicacao->Bd2real($total);?></td>
				<td><?=$data_atualizar1;?></td>
				<td><?=$taxa1;?></td>
				<td>R$ <?=$Aplicacao->Bd2real($calculado1);?></td>
				<td>R$ <?=$Aplicacao->Bd2real($deposito1);?></td>
				<td>R$ <?=$Aplicacao->Bd2real($total1);?></td>
			</tr>
			<tr class="">
				<td><?=$data_atualizar;?></td>
				<td>R$ <?=$Aplicacao->Bd2real($total);?></td>
				<td><?=$data_atualizar1;?></td>
				<td><?=$taxa2;?></td>
				<td>R$ <?=$Aplicacao->Bd2real($calculado2);?></td>
				<td>R$ <?=$Aplicacao->Bd2real($deposito1);?></td>
				<td>R$ <?=$Aplicacao->Bd2real($total2);?></td>
			</tr>
		</tbody>
	</table>
	<script>
		$(document).ready(function() {
			$('#table-varas').dataTable();
		});
	</script>
<?php } ?>

	<script>
		$(document).ready(function() {
			$('#data').datepicker();
			$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',',  affixesStay: false});
			$('#data_atualizar').datepicker();
			$("#deposito").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',',  affixesStay: false});
			$('#data_atualizar1').datepicker();
			$("#deposito1").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',',  affixesStay: false});
		});

	</script>
<?php
	include_once "includes/parte_baixo.php"; 
?>