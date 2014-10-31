var form_incluir = document.form_incluir;

function Limpar(){
	document.form_pesq_atualizacoes_tipo1.reset();
	document.form_editar_atualizacao_tipo1.target = "";
	document.form_pesq_atualizacoes_tipo1.pesq.value = "clear";
	document.form_pesq_atualizacoes_tipo1.submit();
}
function Editar(id){
	document.form_editar_atualizacao_tipo1.action = "incluir1-valores.php";
	document.form_editar_atualizacao_tipo1.target = "";
	document.form_editar_atualizacao_tipo1.id.value = id;
	document.form_editar_atualizacao_tipo1.submit();
}
function Visualizar(id){
	document.form_editar_atualizacao_tipo1.action = "relatorio-calculo-tipo2.php";
	document.form_editar_atualizacao_tipo1.target = "_blank";
	document.form_editar_atualizacao_tipo1.id.value = id;
	document.form_editar_atualizacao_tipo1.submit();
}

function Voltar(page){
	form_incluir.acao.value = "";
	form_incluir.target = "";
	if(page==1){
		form_incluir.action = "incluir1-valores.php";
	}
	if(page==2){
		form_incluir.action = "incluir2-depositos.php";
	}
	if(page==3){
		form_incluir.action = "incluir3-inss.php";
	}
	if(page==4){
		form_incluir.action = "incluir4-ir.php";
	}
	form_incluir.submit();
}
function ValidaValores(){
	form_incluir.action = "incluir2-depositos.php";
	var msg = "";

	if(form_incluir.data_original.value == ""){
		msg += "- Data do valor original\n";			
	}
	if(form_incluir.valor_original.value == ""){
		msg += "- Valor original a ser atualizado\n";			
	}
	if(form_incluir.data_atualizar.value == ""){
		msg += "- Data de atualização\n";			
	}
	if(form_incluir.data_ajuizamento.value == ""){
		msg += "- Data do ajuizamento\n";			
	}

	if(msg != ""){
		alert("Alguns campos são obrigatórios:\n\n" + msg);	
	} else {
		form_incluir.submit();	
	}
}
	//INICIO DEPOSITOS
	function ValidaDepositos(){
		form_incluir.action = "incluir3-inss.php";
		var msg = "";

		/*if(form_incluir.data_original.value == ""){
			msg += "- Data do valor original\n";			
		}*/
		
		if(msg != ""){
			alert("Alguns campos são obrigatórios:\n\n" + msg);	
		} else {
			form_incluir.submit();	
		}
	}
	function ValidaIncluirDepositos(){
		form_incluir.action = "";
		var msg = "";

		if(form_incluir.data_deposito.value == ""){
			msg += "- Data\n";			
		}
		if(form_incluir.valor_deposito.value == ""){
			msg += "- Valor\n";			
		}
		
		if(msg != ""){
			alert("Alguns campos são obrigatórios:\n\n" + msg);	
		} else {
			form_incluir.submit();	
		}
	}
	function ExcluirDeposito(id){
		if(confirm("Realmente deseja excluir este item?")){
			document.form_excluir.id_deposito.value = id;
			document.form_excluir.submit();
		}
		
	}
	//FIM DEPOSITOS
	
function ValidaINSS(){
	form_incluir.action = "incluir4-ir.php";
	var msg = "";

	/*if(form_incluir.data_original.value == ""){
		msg += "- Data do valor original\n";			
	}*/
	
	if(msg != ""){
		alert("Alguns campos são obrigatórios:\n\n" + msg);	
	} else {
		form_incluir.submit();	
	}
}
function ValidaIR(){
	form_incluir.action = "incluir5-custas.php";
	var msg = "";

	if(form_incluir.valor_ir.value == "" && form_incluir.percentual_ir.value == ""){
		msg += "- Base de Cálculo do Imposto de Renda\n";			
	}
	if(form_incluir.num_meses.value == ""){
		msg += "- Número de meses considerados para RRA\n";			
	}
	
	if(msg != ""){
		alert("Alguns campos são obrigatórios:\n\n" + msg);	
	} else {
		form_incluir.submit();	
	}
}


	function ValidaIncluirCustas(){
		form_incluir.action = "";
		form_incluir.target = "";
		var msg = "";

		if(form_incluir.valor_custa.value == ""){
			msg += "- Valor da Custa e/ou Despesa Processual\n";			
		}
		if(form_incluir.data_custa.value == ""){
			msg += "- Data da Custa e/ou Despesa Processual\n";			
		}

		if(msg != ""){
			alert("Alguns campos são obrigatórios:\n\n" + msg);	
		} else {
			form_incluir.submit();	
		}
	}
	function ExcluirCusta(id){
		if(confirm("Realmente deseja excluir este item?")){
			document.form_excluir.id_custa.value = id;
			document.form_excluir.submit();
		}
		
	}
function SalvarVisualizar(){
	document.form_visualizar.action = "relatorio-calculo-tipo2.php";
	document.form_visualizar.target = "_blank";
	document.form_visualizar.submit();
	form_incluir.action = "";
	form_incluir.target = "";
	window.setTimeout(function() {
		form_incluir.submit();
	}, 500);
	
}