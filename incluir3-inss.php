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
	$forma_atualizar = 0;
	$consulta = $Aplicacao->getAtualizacoes()->pegaAtualizacoes($parametros);
	if(sizeof($consulta)>0){
		$inss_reclamante = $Aplicacao->Bd2real($consulta[0]->get('inss_reclamante'));
		$inss_reclamada = $Aplicacao->Bd2real($consulta[0]->get('inss_reclamada'));
		$valor_tributavel = $Aplicacao->Bd2real($consulta[0]->get('valor_tributavel'));
		$taxa_inss_empregador = $consulta[0]->get('taxa_inss_empregador');
		$taxa_inss_sat = $consulta[0]->get('taxa_inss_sat');
		$taxa_inss_terceiros = $consulta[0]->get('taxa_inss_terceiros');
		$taxa_inss_reclamante = $Aplicacao->Bd2real($consulta[0]->get('taxa_inss_reclamante'));
		$forma_atualizar = $consulta[0]->get('forma_atualizar');
	}
?>
		<h3 class="page-title">Contribuição Previdenciária (INSS)</h3>
    
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
							<input type="hidden" name="acao" id="acao" value="inss" />
							
							<div class="row-fluid">
							
							
							
								<div class="tabbable custom-tab">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#valor">Digite o valor homologado da Contribuição Previdenciária.</a></li>
                                        <li><a data-toggle="tab" href="#tributacao">ou Digite a base de tributação da Contribuição Previdenciária e correspondentes alíquotas</a></li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div id="valor" class="tab-pane fade in active">

											<div class="row-fluid">
												<div class="span5" >
													<div class="control-group">
														<label class="control-label span6" >INSS cota parte Reclamante:</label>
														<div class="controls controls-row span6">
															<input type="text" class="input-block-level span8" name="inss_reclamante" id="inss_reclamante" value="<?=$inss_reclamante;?>">
														</div>
													</div>
												</div>
												<div class="span7">
													<div class="control-group">
														<label class="control-label span4">INSS cota parte Reclamada:</label>
														<div class="controls controls-row span4">
															<input type="text" class="input-block-level span8" name="inss_reclamada" id="inss_reclamada" value="<?=$inss_reclamada;?>">
														</div>
													</div>
												</div>
											</div>
                                        </div>
                                        <div id="tributacao" class="tab-pane fade">
										

											<div class="row-fluid">
												<div class="span5">
													<div class="control-group">
														<label class="control-label span5">Valor Tributável:</label>
														<div class="controls controls-row span6">
															<input type="text" class="input-block-level span10" name="valor_tributavel" id="valor_tributavel" value="<?=$valor_tributavel;?>">
														</div>
													</div>
												</div>
												<div class="span6">
													<div class="control-group">
														<label class="control-label span5" >Alíquota INSS Empregador:</label>
														<div class="controls controls-row span3">
															<input type="text" class="input-block-level" name="taxa_inss_empregador" id="taxa_inss_empregador" value="<?=$Aplicacao->Bd2percentual($taxa_inss_empregador);?>">
														</div>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span5">
													<div class="control-group">
														<label class="control-label span5" >Alíquota INSS SAT:</label>
														<div class="controls controls-row span3">
															<input type="text" class="input-block-level " name="taxa_inss_sat" id="taxa_inss_sat" value="<?=$Aplicacao->Bd2percentual($taxa_inss_sat);?>">
														</div>
														<span class="help-inline">(opcional)</span>
													</div>
												</div>
												<div class="span6">
													<div class="control-group">
														<label class="control-label span5" >Alíquota INSS Terceiros:</label>
														<div class="controls controls-row span3">
															<input type="text" class="input-block-level " name="taxa_inss_terceiros" id="taxa_inss_terceiros" value="<?=$Aplicacao->Bd2percentual($taxa_inss_terceiros);?>">
														</div>
														<span class="help-inline">(opcional)</span>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span8">
													<div class="control-group">
														<label class="control-label span4" >INSS cota parte Reclamante:</label>
														<div class="controls controls-row span3">
															<input type="text" class="input-block-level" name="taxa_inss_reclamante" id="taxa_inss_reclamante" value="<?=$taxa_inss_reclamante;?>">
														</div>
														<span class="help-inline">(opcional)</span>
													</div>
												</div>
											</div>
										
										
                                        </div>
                                    </div>
                                </div>
							</div>
							<BR>
							<div class="row-fluid">
								<div class="span12" style="margin-left:20px;">
									<div class="control-group">
										<label class="control-label span12" >Escolha a forma de atualização da Contribuição Previdenciária:</label>
										<div class="controls controls-row span12">
											<label class="radio">
												<input type="radio" name="forma_atualizar" <?php if($forma_atualizar==0) echo 'checked="checked"'; ?> id="forma_atualizar" value="0"> TR (íncides trabalhistas da Tabela Mensal do TST)<BR>
											</label><BR>
											<label class="radio">
												<input type="radio" name="forma_atualizar" <?php if($forma_atualizar==1) echo 'checked="checked"'; ?> id="forma_atualizar" value="1"> Selic (índices utilizados pela Previdência Social)
											</label>
										</div>
									</div>
								</div>
							</div>
							
						</form>
					 </div>
				</div>
			</div> 
				<a href="javascript:ValidaINSS();" style="float:right;" class="btn btn-large btn-primary">
					<i class="icon-ok icon-white"></i> Salvar e Digitar Mais Dados</a>
				<a href="javascript:Voltar(2);" class="btn btn-large">
					<i class="icon-arrow-left icon-white"></i> Voltar</a>
		</div>
	</div>

	<script>
		$(document).ready(function() {			
			$("#inss_reclamada").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',',allowZero:true,  affixesStay: false});
			$("#inss_reclamante").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', allowZero:true, affixesStay: false});
			$("#valor_tributavel").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', allowZero:true, affixesStay: false});
			$("#taxa_inss_reclamante").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', allowZero:true, affixesStay: false});
			
			$("#taxa_inss_empregador").maskMoney({suffix:' %', allowNegative: false, thousands:'',decimal:'.', allowZero:true, affixesStay: false});
			$("#taxa_inss_sat").maskMoney({suffix:' %', allowNegative: false, thousands:'',decimal:'.', allowZero:true, affixesStay: false});
			$("#taxa_inss_terceiros").maskMoney({suffix:' %', allowNegative: false, thousands:'',decimal:'.', allowZero:true, affixesStay: false});
		});

	</script>

   <script src="javascript/atualizacoes.js"></script>
<?php
	include_once "includes/parte_baixo.php"; 
?>