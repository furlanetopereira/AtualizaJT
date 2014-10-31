<?php
//includes dos modulos
include_once $pasta.'aplicacao/Entity.php';

include $pasta."aplicacao/ConexaoSQLAPI.php";
include $pasta."aplicacao/Atualizacoes.php";


class Aplicacao {
	private $ConexaoSQL;
	private $Mensagens;
	private $Mes;

	private $Atualizacoes;
	
	private function setConexaoSQL($ConexaoSQL){ $this->ConexaoSQL = $ConexaoSQL; }
	public function getConexaoSQL(){ return $this->ConexaoSQL; }
	private function setMensagens($Mensagens){ $this->Mensagens = $Mensagens; }
	public function getMensagens(){ return $this->Mensagens; }
	private function setMes($Mes){ $this->Mes = $Mes; }
	public function getMes(){ return $this->Mes; }
	
	private function setAtualizacoes($Atualizacoes){ $this->Atualizacoes = $Atualizacoes; }
	public function getAtualizacoes(){ return $this->Atualizacoes; }

	public function Aplicacao(){	
		session_start();
		$this->setConexaoSQL(new ConexaoSQL());
		$this->setAtualizacoes(new Atualizacoes());
		$mensagens[0] = 'Operação não realizada';
		$mensagens[1] = 'Operação realizada com sucesso';
		$mensagens[2] = "Seu usuário está bloqueado!";
		$mensagens[3] = "Nome ou senha Inválida!";
		
		
		$mensagens[25] = 'Preencha os campos novamente';
		$colMeses = array(1=>"Jan",2=>"Fev",3=>"Mar",4=>"Abr",
                  5=>"Mai",6=>"Jun",7=>"Jul",8=>"Ago",9=>"Set",
                  10=>"Out",11=>"Nov",12=>"Dez");
		$this->setMensagens($mensagens);
		$this->setMes($colMeses);

	}
	

	public function antiSQLInjection($string)
	{
		//remove palavras que contenham sintaxe sql
		$string = preg_replace("/(from|select|insert|delete|where|drop table|show tables|\\\\)/","",$string);
		$string = trim($string);//limpa espa�os vazio
		$string = strip_tags($string);//tira tags html e php
		$string = addslashes($string);//Adiciona barras invertidas a uma string
		return $string;
	}

	public function last_id($tabela=""){
		$query = "SELECT id FROM ".$tabela." ORDER BY id DESC limit 1";
		//echo $query;
		$consulta = $this->getConexaoSQL()->executaConsulta($query);

		for($index = 0; $index < sizeof( $consulta); $index++) {
			$id = $consulta[$index]["id"];
		}
		return $id;
	}
	
	public function criptografaSenha( $senha){		
		$retorno = sha1( trim( $senha));		
		return $retorno;
	}
	
	function warp($link)
	{
		echo "<script>";
			echo "window.location = '$link';";
		echo "</script>";
	}
	
	public function Logar(){
		
		$ss_usuario = $this->antiSQLInjection($_POST[nome]);
		$ss_senha = $this->criptografaSenha($this->antiSQLInjection($_POST[senha]));
		

		$query = "SELECT * FROM usuarios WHERE nome='".$ss_usuario."' AND senha='".$ss_senha."' LIMIT 1";	
		//echo $query;
		$consulta = $this->getConexaoSQL()->executaConsulta($query);
		if($consulta[0]["nome"]!=""){
			if($consulta[0]["status"]=="0"){
				$_SESSION[ss_usuario] = $consulta[0]["nome"];
				$_SESSION[ss_senha] = $consulta[0]["senha"];
				$this->warp("index.php");
			}else{
				return $msg=2;//User bloqueado
			}
		}else{
			return $msg=3;//"Usuário ou senha Inválida!"
		}
	}
	
	public function VerificaLogado(){
		if(isset($_SESSION[ss_usuario]) && isset($_SESSION[ss_senha])){
			$ss_usuario = $this->antiSQLInjection($_SESSION[ss_usuario]);
			$ss_senha = $this->antiSQLInjection($_SESSION[ss_senha]);

			$query = "SELECT * FROM usuarios WHERE nome='".$ss_usuario."' AND senha='".$ss_senha."' LIMIT 1";	
			//echo $query."<BR><BR>"; die(1);
			$consulta = $this->getConexaoSQL()->executaConsulta($query);
			if($consulta[0]["nome"]!=""){
				if($consulta[0]["status"]=="0"){
					$_SESSION[ss_usuario] = $consulta[0]["nome"];
					$_SESSION[ss_senha] = $consulta[0]["senha"];
				}else{
					$this->warp("login.php");
				}
			}else{
				$this->warp("login.php");
			}
		}else{
			$this->warp("login.php");
		}
		
	}
	public function VerificaAdmin(){
		$ss_usuario = $this->antiSQLInjection($_SESSION[ss_usuario]);
		$ss_senha = $this->antiSQLInjection($_SESSION[ss_senha]);
		

		$query = "SELECT * FROM usuarios WHERE nome='".$ss_usuario."' AND senha='".$ss_senha."' LIMIT 1";	

		$consulta = $this->getConexaoSQL()->executaConsulta($query);
		if($consulta[0]["categoria"]=="999"){
			return true;
		}else{
			return false;
		}
		
	}
	public function Data2bd($data,$hora=""){
		$quebra_data = explode("/",$data);
		return $quebra_data[2]."-".$quebra_data[1]."-".$quebra_data[0]." ".$hora;
	}
	public function Data2String($data){
		$quebra_data = explode("/",$data);
		switch ($quebra_data[1]) {
			case 1: $mes = "jan"; break;
			case 2: $mes = "fev"; break;
			case 3: $mes = "mar"; break;
			case 4: $mes = "abr"; break;
			case 5: $mes = "mai"; break;
			case 6: $mes = "jun"; break;
			case 7: $mes = "jul"; break;
			case 8: $mes = "ago"; break;
			case 9: $mes = "set"; break;
			case 10: $mes = "out"; break;
			case 11: $mes = "nov"; break;
			case 12: $mes = "dez"; break;
		}
		return $quebra_data[0]."-".$mes."-".$quebra_data[2];
	}
	public function Bd2data($data_original){
		
		if( $data_original == "" ){
			return $data_original;	
		}


		if ( strlen($data_original) == 10){
			$ano = substr($data_original,0,4);
			$mes = substr($data_original,5,2);
			$dia = substr($data_original,8,2);
			$datBrasileiro = $dia. "/" .$mes."/" .$ano;}
		else{
			$ano = substr($data_original,0,4);
			$mes = substr($data_original,5,2);
			$dia = substr($data_original,8,2);
			$hora = substr($data_original,11,2);
			$minuto = substr($data_original,14,2);
			$datBrasileiro = $dia. "/" .$mes."/" .$ano. " " .$hora. ":" .$minuto;
		}
		return $datBrasileiro;
	}
	public function Real2bd($valor){
		if($valor=="") $valor=0;
		$valor = str_replace(".","",$valor);
		$valor = str_replace("R$","",$valor);
		$valor = str_replace(",",".",$valor);
		return $valor;
	}
	public function Bd2real($n){
		$sep_unidades = ".";
		$sep_decimais = ",";
		//$sep_moeda = "R$";
		if($n=="")$n=0;
		$n = explode(".",$n);

		$n_inteiro = $n[0];
		$n_decimal = $n[1];	
		
		if(strlen($n_decimal) < 2)
		{
			$n_decimal = $n_decimal . "0";
		}
		
		$digitos = strlen($n_inteiro);
				
		if($digitos > 3)
		{
			$i = $digitos;
			do
			{
				$i = $i - 3;
				
				if(!isset($nfinal))
				{
					$part2 = substr($n_inteiro,$i);
					$part1 = substr($n_inteiro,0,$i);
				} else {
					$part2 = substr($nfinal,$i);
					$part1 = substr($nfinal,0,$i);
				}
				
				if(empty($part1))
				{
					$nfinal = $part2;
				} else {
					$nfinal = $part1 . $sep_unidades . $part2;
				}
				
				
				$x++;
			} while(($i-3) >= 1);
			
		} else {
			$nfinal = $n_inteiro;
		}
		
		$n_decimal = substr($n_decimal,0,2);
		if(empty($n_decimal))
			$nfinal = $sep_moeda . "" . $nfinal . $sep_decimais . "00";
		else
			$nfinal = $sep_moeda . "" . $nfinal . $sep_decimais . $n_decimal;
		
		return $nfinal;
	}
	public function Bd2indice($valor){
		return number_format($valor,9,'.','');
	}
	public function Bd2percentual($valor){
		return number_format($valor,2,'.','');
	}
	public function Bd2percentual3($valor){
		return number_format($valor,3,'.','');
	}
	public function Deslogar(){
		$_SESSION[ss_usuario] = null;
		$_SESSION[ss_senha] = null;
		
	}
	
}
?>