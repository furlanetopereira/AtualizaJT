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

		<h3 class="page-title">Custas e/ou Despesas Processuais</h3>
    
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
							<input type="hidden" name="pesq_id" id="pesq_id" value="<?=$id;?>" />
							<input type="hidden" name="acao" id="acao" value="add" />
							<input type="hidden" name="pesq" id="pesq" value="atualizacoes_tipo1" />
							
							<div class="row-fluid">
							
							
							
								<div class="tabbable custom-tab">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#incluir">Incluir Nova</a></li>
                                        <li><a data-toggle="tab" href="#listagem">Listagem</a></li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div id="incluir" class="tab-pane fade in active">

											<div class="row-fluid">
												<div class="span9">
													<div class="control-group">
														<label class="control-label span5" >Nome da Custa e/ou Despesa Processual:</label>
														<div class="controls controls-row span7">
															<input type="text" class="input-block-level" maxlength="50" name="nome_custa" id="data" value="<?=$_POST['data'];?>">
														</div>
													</div>
												</div>
												<div class="span3">
													<div class="control-group">
														<div class="controls controls-row span3">
															<input type="text" class="input-block-level" maxlength="10" name="folhas_custa" id="valor" value="<?=$_POST['valor'];?>">
														</div><span class="help-inline">Folhas dos Autos</span>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span3">
													<div class="control-group">
														<label class="control-label span3" >Data:</label>
														<div class="controls controls-row span7">
															<input type="text" class="input-block-level" data-mask="99/99/9999" name="data_custa" id="data_custa" value="<?=$_POST['valor'];?>">
														</div>
													</div>
												</div>
												<div class="span3">
													<div class="control-group">
														<label class="control-label span3" >Valor:</label>
														<div class="controls controls-row span7">
															<input type="text" class="input-block-level" name="valor_custa" id="valor_custa" value="<?=$_POST['data'];?>">
														</div>
													</div>
												</div>
											</div>
											<a href="javascript:ValidaIncluirCustas();" class="btn btn-success"><i class="icon-plus icon-white"></i> Incluir</a>
										
                                        </div>
                                        <div id="listagem" class="tab-pane fade">
										


											<table class="table table-striped table-hover table-form table-bordered" id="table-custas">
												<thead>
													<tr>
														<th width="300">Nome da Custa e/ou Despesa Processual</th>
														<th width="100">Data</th>
														<th width="100">Valor</th>
														<th width="20">Excluir</th>
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
														<td><?=$consulta_custas[$index]->get('nome_custa')." | fl. ".$consulta_custas[$index]->get('folhas_custa');?></td>
														<td><?=$consulta_custas[$index]->get('data_custa');?></td>
														<td>R$ <?=$Aplicacao->Bd2real($consulta_custas[$index]->get('valor_custa'));?></td>
														<td>
															<a href="javascript:ExcluirCusta(<?=$consulta_custas[$index]->get('id');?>);" title="Excluir" 
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
													$('#table-custas').dataTable();
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
				<a href="javascript:SalvarVisualizar();" style="float:right;" class="btn btn-large btn-primary">
					<i class="icon-ok icon-white"></i> Salvar e Visualizar Cálculos</a>
				<a href="javascript:Voltar(4);" class="btn btn-large">
					<i class="icon-arrow-left icon-white"></i> Voltar</a>
		</div>
	</div>

	<form name="form_excluir" method="post" action="">
		<input type="hidden" name="id" id="id" value="<?=$id;?>" />
		<input type="hidden" name="id_custa" id="id_custa" value="" />
		<input type="hidden" name="delete" id="delete" value="custa" />
	</form>
	<form name="form_visualizar" method="post" action="">
		<input type="hidden" name="id" id="id" value="<?=$id;?>" />
	</form>
	<script>
		$(document).ready(function() {			
			$("#valor_custa").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',  affixesStay: false});
		});

	</script>

   <script src="javascript/atualizacoes.js"></script>
<?php
	include_once "includes/parte_baixo.php"; 
?>