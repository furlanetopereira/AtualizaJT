<?php
	include_once $pasta."includes/parte_cima.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."controler/atualizacoes.ctrl.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."includes/alert.php"; 
	if($_POST[id]==""){
		$id = $Aplicacao->last_id('atualizacoes');
		if($id=="")$id=0;
		$id++;
	}else{
		$id = $_POST[id];
	}
?>

<div class="row-fluid">
	<div class="span12">
		<h3 class="page-title">Atualização de Valores Simples</h3>
	</div>
</div>
    
	 <div class="row-fluid" id="div_form">
		 <div class="span12">
			 <div class="widget blue" id="Novo">
				 <div class="widget-title">
					 <h4><i class="icon-edit"></i> Formulário </h4>
				 </div>
				 <div class="widget-body">
					 <div class="portlet-body">
						<form name="form_incluir_atualizacao" class="form-vertical" method="post" action="">
							<input type="hidden" name="id" id="id" value="<?=$id;?>" />
							<input type="hidden" name="pesq_id" id="pesq_id" value="<?=$id;?>" />
							<input type="hidden" name="acao" id="acao" value="add" />
							<input type="hidden" name="pesq" id="pesq" value="atualizacoes_tipo1" />
							<div class="row-fluid">
								<div class="span12">
									<div class="control-group">
										<label class="control-label" >Digite o número do Processo:</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span4" name="num_processo" id="num_processo" value="<?=$_POST['num_processo'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Digite a data do valor original:</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span6" name="data_original" id="data_original" value="<?=$_POST['data_original'];?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label" >Digite o valor original a ser atualizado (Valor homologado, líquido de INSS):</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span3" name="valor_original" id="valor_original" value="<?=$_POST['valor_original'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Digite a data de atualização (data atual):</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span6" name="data_atualizar" id="data_atualizar" value="<?=$_POST['data_atualizar'];?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label" >Digite a data do ajuizamento da ação ou início dos juros:</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span4" name="data_ajuizamento" id="data_ajuizamento" value="<?=$_POST['data_ajuizamento'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Digite ao valor da base de cálculo do Imposto de Renda:</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span4" name="valor_ir" id="valor_ir" value="<?=$_POST['valor_ir'];?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label" >Ou digite o percentual sobre o valor líquido:</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span2" name="percentual_ir" id="percentual_ir" value="<?=$_POST['percentual_ir'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Digite o número de meses considerados para RRA<BR>(Rendimetos Recebidos Acumuladamente):</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span3" name="num_meses" id="num_meses" value="<?=$_POST['num_meses'];?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label" >Digite a dedução de Dependentes do IR<BR>(digite o número de dependentes):</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level span2" name="num_dependentes" id="num_dependentes" value="<?=$_POST['num_dependentes'];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
							
							
							
								<div class="tabbable custom-tab">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#listagem">Custas e/ou Despesas Processuais:</a></li>
                                        <li><a data-toggle="tab" href="#incluir">Incluir Uma Nova Custa e/ou Despesa Processual:</a></li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div id="listagem" class="tab-pane fade in active">


											<table class="table table-striped table-hover table-form table-bordered" id="table-custas">
												<thead>
													<tr>
														<th width="30%">Nome da Custa e/ou <BR>Despesa Processual</th>
														<th width="20%">Folhas dos Autos</th>
														<th width="25%">Valor da Custa e/ou <BR>Despesa Processual</th>
														<th width="25%">Data da Custa e/ou <BR>Despesa Processual</th>
													</tr>
												</thead>
												<tbody>
												
												 <?php
												 $parametros_custas['id_atualizacao'] = $id;
												 $consulta_custas = $Aplicacao->getAtualizacoes()->pegaCustas($parametros_custas);
												 if(sizeof($consulta_custas)>0){
													for($index = 0; $index < sizeof( $consulta_custas); $index++) {
													
												 ?>
													<tr class="">
														<td><?=$consulta_custas[$index]->get('nome_custa');?></td>
														<td><?=$consulta_custas[$index]->get('folhas_custa');?></td>
														<td><?=$Aplicacao->Bd2real($consulta_custas[$index]->get('valor_custa'));?></td>
														<td><?=$consulta_custas[$index]->get('data_custa');?></td>
													</tr>
												<?php
													}
												}
												?>
												</tbody>
											</table>
											<script>
												$(document).ready(function() {
													$('#table-custas').dataTable();
												});
											</script>

										
                                        </div>
                                        <div id="incluir" class="tab-pane fade">
										
											<div class="row-fluid">
												<div class="span5">
													<div class="control-group">
														<label class="control-label" >Digite o Nome da Custa e/ou Despesa Processual:</label>
														<div class="controls controls-row">
															<input type="text" class="input-block-level span10" name="nome_custa" id="data" value="<?=$_POST['data'];?>">
														</div>
													</div>
												</div>
												<div class="span7">
													<div class="control-group">
														<label class="control-label" >Digite as Folhas dos Autos:</label>
														<div class="controls controls-row">
															<input type="text" class="input-block-level span2" name="folhas_custa" id="valor" value="<?=$_POST['valor'];?>">
														</div>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span5">
													<div class="control-group">
														<label class="control-label" >Digite o Valor da Custa e/ou Despesa Processual:</label>
														<div class="controls controls-row">
															<input type="text" class="input-block-level span4" name="valor_custa" id="valor_custa" value="<?=$_POST['data'];?>">
														</div>
													</div>
												</div>
												<div class="span7">
													<div class="control-group">
														<label class="control-label" >Digite a Data da Custa e/ou Despesa Processual:</label>
														<div class="controls controls-row">
															<input type="text" class="input-block-level span4" name="data_custa" id="data_custa" value="<?=$_POST['valor'];?>">
														</div>
													</div>
												</div>
											</div>
											<a href="javascript:ValidaIncluirCustas();" class="btn btn-success"><i class="icon-plus icon-white"></i> Incluir</a>
                                        </div>
                                    </div>
                                </div>
							</div>
						</form>
					 </div>
				</div>
			</div>
			<center>
				<a href="javascript:ValidaIncluirAtualizacao();" class="btn btn-large btn-primary">
					<i class="icon-ok icon-white"></i> Salvar e Visualizar</a> &nbsp; 
				<a href="menu_atualizacoes.php" class="btn btn-large">
					<i class="icon-undo icon-white"></i> Cancelar e voltar</a>
			</center>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#data_original').datepicker();
			$('#data_ajuizamento').datepicker();
			$('#data_atualizar').datepicker();
			
			$("#valor_original").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',  affixesStay: false});
			$("#valor_ir").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',  affixesStay: false});
			$("#percentual_ir").maskMoney({suffix:' %', allowNegative: false, thousands:'',decimal:'.',  affixesStay: false});
			$("#num_meses").maskMoney({ allowNegative: false, thousands:'',decimal:'',  affixesStay: false});
			$("#num_dependentes").maskMoney({allowNegative: false, thousands:'',decimal:'',  affixesStay: false});
			
			$('#data_custa').datepicker();
			$("#valor_custa").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',  affixesStay: false});
			
		});

	</script>

   <script src="javascript/atualizacoes.js"></script>
<?php
	include_once "includes/parte_baixo.php"; 
?>