function ValidaLogin(form){
	var msg = "";

	if(form.nome.value == ""){
		msg += "- Nome\n";	
		form.nome.focus();
	}
	if(form.senha.value == ""){
		msg += "- Senha\n";	
		form.senha.focus();
	}

	if(msg != "")
	{
		alert("Alguns campos são obrigatórios:\n\n" + msg);	
		return false;
	} else {
		return true;
	}
}