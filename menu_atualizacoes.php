<?php
	include_once $pasta."includes/parte_cima.php"; 
?>

<div class="row-fluid">
	<div class="span12">
		<h3 class="page-title">Atualização de Valores na Justiça do Trabalho</h3>
		<p>Este sistema faz automaticamente os cálculos de atualização monetária (correção monetária) e recálculos dos Juros de Mora.
		<BR>Você deve, inicialmente escolher uma das opções abaixo, dependendo do tipo de cálculo que você pretende atualizar.
		<BR>Também atualizará os valores de eventuais valores depositados, de Multas, de Contribuição Previdenciária, e também de Custas e outras Despesas Processuais.
		<BR>Para qualquer uma das opões, o sistema calculará o  Imposto de Renda (se devido), com base nos valores atuais (utilizando-se a Tabela atual da Receita Federal do Brasil).
		</p>
	</div>
</div>
	
	<div class="row-fluid">
		<div class="span6 ">
			<!-- BEGIN widget widget-->
			<div class="widget blue-full">
				<div class="widget-title">
					<h4><i class="icon-reorder"></i> Tipo 1</h4>
					<div class="actions">
						<a href="pesquisar_atualizacoes_tipo1.php" class="btn"><i class="icon-search"></i> Pesquisar Histórico</a>
						<a href="incluir1-valores.php" class="btn"><i class="icon-plus"></i> Incluir Novo</a>
					</div>
				</div>
				<div class="widget-body">
					<h2><strong>1. A partir de valores homologados pelo Juízo</strong></h2>
					<p>
					É o modo mais comum na Justiça do Trabalho. A partir de um determinado valor homologado pelo Juízo, você pode fazer atualização Monetária para uma nova data.							
					<BR>
					Este sistema calculará a atualização monetária (correção monetária ) a partir de um Principal já homologado, e recalculará Juros de Mora desde a propositura da ação.							
					<BR>
					Neste caso, você necessitará dos valores constantes na Sentença de Homologação, que geralmente não contém o valor dos juros e sim apenas a data da propositura da ação.							
					</p>
				</div>
			</div>
			<!-- END widget widget-->
		</div>
		<div class="span6 ">
			<!-- BEGIN widget widget-->
			<div class="widget green-full">
				<div class="widget-title">
					<h4><i class="icon-reorder"></i> Tipo 2</h4>
					<div class="actions">
						<a href="#" class="btn"><i class="icon-search"></i> Pesquisar</a>
						<a href="#" class="btn"><i class="icon-plus"></i> Incluir</a>
					</div>
				</div>
				<div class="widget-body">
					<h2><strong>2. A partir de valores homologados pelo Juízo, valores originais com juros decrescentes</strong></h2>
					<p>Para os casos nos quais o cálculo original apresenta juros decrescentes. 							
					<BR>Este sistema calculará a atualização monetária (correção monetária) a partir de um Principal já homologado, e recalculará Juros de Mora desde a anterior (a data da homologação).																			
					<BR>Neste caso, você necessitará dos valores constantes na Sentença de Homologação: valores de Principal e também de Juros de Mora, e deve informar a data até a qual data o valor foi homologado pela Sentença de Homologação.							
					</p>
				</div>
			</div>
			<!-- END widget widget-->
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span6 ">
			<!-- BEGIN widget widget-->
			<div class="widget red-full">
				<div class="widget-title">
					<h4><i class="icon-reorder"></i> Tipo 3</h4>
					<div class="actions">
						<a href="#" class="btn"><i class="icon-search"></i> Pesquisar</a>
						<a href="#" class="btn"><i class="icon-plus"></i> Incluir</a>
					</div>
				</div>
				<div class="widget-body">
					<h2><strong>3. A partir de valores de acordo não cumprido</strong></h2>
					<p>Para os casos de atualização de valores de acordos não cumpridos.														
					<BR>Este sistema calculará a atualização monetária (correção monetária ) a partir da data do acordo e recalculará Juros de Mora também a partir da mesma data.														
					<BR>Neste caso, você necessitará dos valores constantes no Acordo, que geralmente contém eventuais Multas por inadimplemento.							
					</p>
				</div>
			</div>
			<!-- END widget widget-->
		</div>
		<div class="span6 ">
			<!-- BEGIN widget widget-->
			<div class="widget yellow-full">
				<div class="widget-title">
					<h4><i class="icon-reorder"></i> Tipo 4</h4>
					<div class="actions">
						<a href="#" class="btn"><i class="icon-search"></i> Pesquisar</a>
						<a href="#" class="btn"><i class="icon-plus"></i> Incluir</a>
					</div>
				</div>
				<div class="widget-body">
					<h2><strong>4. Atualização dos Danos Morais constantes em uma decisão judicial trabalhista</strong></h2>
					<p>Neste Sistema, os Danos Morais, são atualizados desde a datra da prolação da Sentença até uma determinada data atual (você digitará a data atual).							
					<BR>E, quanto aos Juros de Mora, os mesmos serão calculados desde a data da propositura ou ajuizamento da ação.							
					<BR>Este sistema faz atualizações considerando os critérios acima, que são de acordo com a Súmula 439 do TST.							
					</p>
				</div>
			</div>
			<!-- END widget widget-->
		</div>
	</div>
<?php
	include_once "includes/parte_baixo.php"; 
?>