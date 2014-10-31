<?php
	include_once $pasta."includes/parte_cima.php"; 
?>
<?php //Controler da pagina
	include_once $pasta."controler/atualizacoes.ctrl.php"; 
?>
<div class="row-fluid">
	<div class="span12">
		<h3 class="page-title">1. A partir de valores homologados pelo Juízo</h3>
	</div>
</div>

    
	<div class="row-fluid">
		<p>
			<a href="incluir1-valores.php" class="btn btn-large btn-primary">
				<i class="icon-plus icon-white"></i> Incluir Novo</a> &nbsp; 
			<a href="menu_atualizacoes.php" class="btn btn-large">
				<i class="icon-undo icon-white"></i> Voltar</a>
		</p>
	</div>
	 <div class="row-fluid" id="div_pesq">
		 <div class="span12">
			 <!-- BEGIN BLANK PAGE PORTLET-->
			 <div class="widget green">
				 <div class="widget-title">
					 <h4><i class="icon-reorder"></i> Pesquisar Histórico </h4>
				 </div>
				 <div class="widget-body">
					 <div class="portlet-body">
						<form name="form_pesq_atualizacoes_tipo1" method="post" action="">
							<input type="hidden" name="pesq" value="atualizacoes_tipo1" />
							<input type="hidden" name="editar_id" value="" />
							<div class="row-fluid">
								<div class="span1">
									<div class="control-group">
										<label class="control-label" >ID</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="pesq_id" value="<?=$_SESSION['pesq_id'];?>">
										</div>
									</div>
								</div>
								<div class="span11">
									<div class="control-group">
										<label class="control-label" >Número do Processo</label>
										<div class="controls controls-row">
											<input type="text" class="input-block-level" name="pesq_descricao" value="<?=$_SESSION['pesq_descricao'];?>">
										</div>
									</div>
								</div>
							</div>
							<button class="btn btn-success"><i class="icon-search icon-white"></i> Pesquisar</button>
							<a href="javascript:Limpar();" class="btn"><i class="icon-trash icon-white"></i> Limpar Pesquisa</a>
						</form>
						 <?php 
							if($_SESSION['pesq']=='atualizacoes_tipo1' || $_POST['pesq']=='atualizacoes_tipo1'){
						 ?>
						 <div class="space15"></div>
						 <table class="table table-striped table-hover table-form table-bordered" id="table-atualizacoes_tipo1">
							 <thead>
							 <tr>
								 <th class="center" width="5%">Id</th>
								 <th width="40%">Número do Processo</th>
								 <th width="25%">Data do valor original</th>
								 <th width="25%">Valor original</th>
								 <th width="5%">Controle</th>
							 </tr>
							 </thead>
							 <tbody>
							 <?php
							 if(sizeof($consulta)>0){
								for($index = 0; $index < sizeof( $consulta); $index++) {
								
							 ?>
							 <tr class="">
								 <td class="center"><?=$consulta[$index]->get('id');?></td>
								 <td><?=$consulta[$index]->get('num_processo');?></td>
								 <td><?=$consulta[$index]->get('data_original');?></td>
								 <td>R$ <?=$Aplicacao->Bd2real($consulta[$index]->get('valor_original'));?></td>
								 <td>
									<a href="javascript:Editar(<?=$consulta[$index]->get('id');?>);" title="Alterar registro"
										class="btn btn-mini btn-primary"><i class="icon-pencil"></i></a> 
									<a href="javascript:Visualizar(<?=$consulta[$index]->get('id');?>);" title="Visualizar" 
										class="btn btn-mini btn-inverse"><i class="icon-eye-open"></i></a>
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
									$('#table-atualizacoes_tipo1').dataTable();
								});
							</script>
						 <?php } ?>
						 
					 </div>
				 </div>
			 </div>
			 <!-- END BLANK PAGE PORTLET-->
		 </div>
	</div>
	
								
	<form name="form_editar_atualizacao_tipo1" action="" method="post">
		<input type="hidden" name="id" id="id" value="" />
	</form>
   <script src="javascript/atualizacoes.js"></script>

<?php
	include_once "includes/parte_baixo.php"; 
?>