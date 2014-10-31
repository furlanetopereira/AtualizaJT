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
		$parametros['id'] = $id;
		$consulta = $Aplicacao->getAtualizacoes()->pegaAtualizacoes($parametros);
		if(sizeof($consulta)>0){
			$num_processo = $consulta[0]->get('num_processo');
			$vara = $consulta[0]->get('vara');
			$reclamante = $consulta[0]->get('reclamante');
			$reclamada = $consulta[0]->get('reclamada');
			$data_original = $consulta[0]->get('data_original');
			$valor_original = $Aplicacao->Bd2real($consulta[0]->get('valor_original'));
			$data_atualizar = $consulta[0]->get('data_atualizar');
			$data_ajuizamento = $consulta[0]->get('data_ajuizamento');
		}
	}
	
?>
		<h3 class="page-title">Valores do Reclamante</h3>
    
	 <div class="row-fluid" id="div_form">
		 <div class="span12">
			 <div class="widget blue" id="Novo">
				 <div class="widget-title">
					 <h4><i class="icon-edit"></i> Formulário </h4>
				 </div>
				 <div class="widget-body">
					 <div class="portlet-body">
						<form name="form_incluir" class="form-horizontal" method="post" action="">
							<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
							<input type="hidden" name="acao" id="acao" value="valores" />
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label">Número do Processo:</label>
										<div class="controls controls-row span7">
											<input type="text" class="input-block-level" maxlength="50" name="num_processo" id="num_processo" value="<?php echo $num_processo;?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label span2" >Vara:</label>
										<div class="controls controls-row span8">
											<input type="text" class="input-block-level" maxlength="50" name="vara" id="vara" value="<?php echo $vara;?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Reclamante:</label>
										<div class="controls controls-row span7">
											<input type="text" class="input-block-level" maxlength="50" name="reclamante" id="reclamante" value="<?php echo $reclamante;?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label span2" >Reclamada:</label>
										<div class="controls controls-row span7">
											<input type="text" class="input-block-level" maxlength="50" name="reclamada" id="reclamada" value="<?php echo $reclamada;?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Data do valor original:</label>
										<div class="controls controls-row span4">
											<input type="text" class="input-block-level" data-mask="99/99/9999" name="data_original" id="data_original" value="<?php echo $data_original;?>">
										</div>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label span2" >Valor:</label>
										<div class="controls controls-row span3">
											<input type="text" class="input-block-level" name="valor_original" id="valor_original" value="<?php echo $valor_original;?>">
										</div>
										<span class="help-inline">(Valor homologado, líquido de INSS)</span>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label" >Data de atualização:</label>
										<div class="controls controls-row span4">
											<input type="text" class="input-block-level" data-mask="99/99/9999" name="data_atualizar" id="data_atualizar" value="<?php echo $data_atualizar;?>">
										</div>
										<span class="help-inline">(data atual)</span>
									</div>
								</div>
								<div class="span7">
									<div class="control-group">
										<label class="control-label span7" >Data do ajuizamento da ação ou início dos juros:</label>
										<div class="controls controls-row span3">
											<input type="text" class="input-block-level" data-mask="99/99/9999" name="data_ajuizamento" id="data_ajuizamento" value="<?php echo $data_ajuizamento;?>">
										</div>
									</div>
								</div>
							</div>
						</form>
					 </div>
				</div>
			</div> 
				<a href="javascript:ValidaValores();" style="float:right;" class="btn btn-large btn-primary">
					<i class="icon-ok icon-white"></i> Salvar e Digitar Mais Dados</a>
		</div>
	</div>

	<script>
		$(document).ready(function() {			
			$("#valor_original").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',  affixesStay: false});
		});

	</script>

   <script src="javascript/atualizacoes.js"></script>
<?php
	include_once "includes/parte_baixo.php"; 
?>