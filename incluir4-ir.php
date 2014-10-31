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
	$parametros['id'] = $id;
	$consulta = $Aplicacao->getAtualizacoes()->pegaAtualizacoes($parametros);
	if(sizeof($consulta)>0){
		$valor_ir = $Aplicacao->Bd2real($consulta[0]->get('valor_ir'));
		$percentual_ir = $consulta[0]->get('percentual_ir');
		$data_ajuizamento = $consulta[0]->get('data_ajuizamento');
		$num_meses = $consulta[0]->get('num_meses');
		$num_dependentes = $consulta[0]->get('num_dependentes');
	}

?>

		<h3 class="page-title">Imposto de Renda</h3>
    
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
							<input type="hidden" name="acao" id="acao" value="ir" />
							
							
							<div class="row-fluid">
								<div class="span6">
									<div class="control-group">
										<label class="control-label span8" >Valor da base de cálculo do Imposto de Renda:</label>
										<div class="controls controls-row span4">
											<input type="text" class="input-block-level" name="valor_ir" id="valor_ir" value="<?php echo $valor_ir;?>">
										</div>
									</div>
								</div>
								<div class="span6">
									<div class="control-group">
										<div class="controls controls-row span2">
											<input type="text" class="input-block-level" name="percentual_ir" id="percentual_ir" value="<?php echo $percentual_ir;?>">
										</div>
										<span class="help-inline">Ou digite o percentual sobre o valor líquido</span>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span5">
									<div class="control-group">
										<label class="control-label span9" >Número de meses considerados para RRA:<BR>(Rendimentos Recebidos Acumuladamente)</label>
										
										<div class="controls controls-row span3">
											<input type="text" class="input-block-level" name="num_meses" id="num_meses" value="<?php echo $num_meses;?>">
										</div>
									</div>
								</div>
								<div class="span6">
									<div class="control-group">
										<label class="control-label span6" >Dedução de Dependentes do IR:</label>
										<div class="controls controls-row span2">
											<input type="text" class="input-block-level" name="num_dependentes" id="num_dependentes" value="<?php echo $num_dependentes;?>">
										</div><span class="help-inline">(digite o número de dependentes)</span>
									</div>
								</div>
							</div>
						</form>
					 </div>
				</div>
			</div> 
				<a href="javascript:ValidaIR();" style="float:right;" class="btn btn-large btn-primary">
					<i class="icon-ok icon-white"></i> Salvar e Digitar Mais Dados</a>
				<a href="javascript:Voltar(3);" class="btn btn-large">
					<i class="icon-arrow-left icon-white"></i> Voltar</a>
		</div>
	</div>

	<script>
		$(document).ready(function() {			
			$("#valor_ir").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', allowZero:true, affixesStay: false});
			$("#percentual_ir").maskMoney({suffix:' %', allowNegative: false, thousands:'',decimal:'.', allowZero:true, affixesStay: false});
			$("#num_meses").maskMoney({ allowNegative: false, thousands:'',decimal:'', allowZero:true, affixesStay: false});
			$("#num_dependentes").maskMoney({allowNegative: false, thousands:'',decimal:'', allowZero:true, affixesStay: false});
		});

	</script>

   <script src="javascript/atualizacoes.js"></script>
<?php
	include_once "includes/parte_baixo.php"; 
?>