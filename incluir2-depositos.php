<?php
	include_once $pasta."includes/parte_cima.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."controler/atualizacoes.ctrl.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."includes/alert.php"; 

	if($_POST[id]==""){
		$Aplicacao->warp('incluir1-valores.php');
	}else{	
		$id = $_POST[id];
	}
	
?>
		<h3 class="page-title">Depósitos ou Valores Disponibilizados ao Reclamante</h3>
    
	 <div class="row-fluid" id="div_form">
		 <div class="span12">
			 <div class="widget blue" id="Novo">
				 <div class="widget-title">
					 <h4><i class="icon-edit"></i> Formulário </h4>
				 </div>
				 <div class="widget-body">
					 <div class="portlet-body">
						<form name="form_incluir" class="form-horizontal" method="post" action="">
							<input type="hidden" name="id" id="id" value="<?=$id;?>" />
							<input type="hidden" name="acao" id="acao" value="depositos" />
							
							<div class="row-fluid">
							
							
							
								<div class="tabbable custom-tab">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#incluir">Incluir Novo</a></li>
                                        <li><a data-toggle="tab" href="#listagem">Listagem</a></li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div id="incluir" class="tab-pane fade in active">

											<div class="row-fluid">
												<div class="span3">
													<div class="control-group">
														<label class="control-label span4" >Data:</label>
														<div class="controls controls-row span8">
															<input type="text" class="input-block-level" data-mask="99/99/9999" name="data_deposito" id="data_deposito">
														</div>
													</div>
												</div>
												<div class="span3">
													<div class="control-group">
														<label class="control-label span4" >Valor:</label>
														<div class="controls controls-row span8">
															<input type="text" class="input-block-level" name="valor_deposito" id="valor_deposito">
														</div>
													</div>
												</div>
												<div class="span6">
													<div class="control-group">
														<label class="control-label span5" >Histórico ou observação:</label>
														<div class="controls controls-row span7">
															<input type="text" class="input-block-level" maxlength="70" name="obs_deposito" id="obs_deposito">
														</div>
													</div>
												</div>
											</div>
											<a href="javascript:ValidaIncluirDepositos();" class="btn btn-success"><i class="icon-plus icon-white"></i> Incluir</a>
										
                                        </div>
                                        <div id="listagem" class="tab-pane fade">
										
											<table class="table table-striped table-hover table-form table-bordered" id="table-depositos">
												<thead>
													<tr>
														<th width="70">Data</th>
														<th width="70">Valor</th>
														<th width="350">Histórico ou observação</th>
														<th width="10">Excluir</th>
													</tr>
												</thead>
												<tbody>
												
												 <?php
												 $parametros_custas['id_atualizacao'] = $id;
												 $consulta_depositos = $Aplicacao->getAtualizacoes()->pegaDepositos($parametros_custas);
												 if(sizeof($consulta_depositos)>0){
													for($index = 0; $index < sizeof( $consulta_depositos); $index++) {
													
												 ?>
													<tr class="">
														<td><?=$consulta_depositos[$index]->get('data_deposito');?></td>
														<td>R$ <?=$Aplicacao->Bd2real($consulta_depositos[$index]->get('valor_deposito'));?></td>
														<td><?=$consulta_depositos[$index]->get('obs_deposito');?></td>
														<td>
															<a href="javascript:ExcluirDeposito(<?=$consulta_depositos[$index]->get('id');?>);" title="Excluir" 
															class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
														</td>
													</tr>
												<?php
													}
												}
												?>
												</tbody>
											</table>
											<script>
												$(document).ready(function() {
													$('#table-depositos').dataTable();
												});
											</script>
										
										
                                        </div>
                                    </div>
                                </div>
							</div>
						</form>
					 </div>
				</div>
			</div> 
				<a href="javascript:ValidaDepositos();" style="float:right;" class="btn btn-large btn-primary">
					<i class="icon-ok icon-white"></i> Salvar e Digitar Mais Dados</a>
				<a href="javascript:Voltar(1);" class="btn btn-large">
					<i class="icon-arrow-left icon-white"></i> Voltar</a>
		</div>
	</div>
	<form name="form_excluir" method="post" action="">
		<input type="hidden" name="id" id="id" value="<?=$id;?>" />
		<input type="hidden" name="id_deposito" id="id_deposito" value="" />
		<input type="hidden" name="delete" id="delete" value="deposito" />
	</form>
	<script>
		$(document).ready(function() {			
			$("#valor_deposito").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',  affixesStay: false});
		});

	</script>

   <script src="javascript/atualizacoes.js"></script>
<?php
	include_once "includes/parte_baixo.php"; 
?>