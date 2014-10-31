<?php

class ConexaoSQL {
	private $conexaoSQL;
	
	private function setConexaoSQL($conexaoSQL){ $this->conexaoSQL = $conexaoSQL;}
	
	private function getConfiguracoes(){ return $this->configuracoes;}
	public function getConexaoSQL(){ return $this->conexaoSQL;}

	private function setErro($mensagemDeErro) { 
		exit("\n\n ".$mensagemDeErro."\n <br> Abortando o script!\n\n");
	}

	public function ConexaoSQL() {
		$this->conecta();
	}
	 
	private function conecta() 
	{
		//if (!$this->setConexaoSQL(mysql_connect('dbmy0002.whservidor.com', 'furlanetop_2', 'caja2007'))) {	
		if (!$this->setConexaoSQL(mysql_connect('localhost', 'root', ''))) {			
			
			if (!mysql_select_db('fp_contas', $this->getConexaoSQL())) {
				$this->setErro("Ocorreu um erro ao selecionar o banco de dados.");
				return false;
			}
			return true;
		} else {
			$this->setErro("Ocorreu um erro ao conectar no banco de dados.");
			return false;
		}
	}

	public function executaConsulta($consultaSQL) 
	{
		if (!$this->getConexaoSQL()){
			$this->conecta();
		}
		$RetornodaConsultaSQL = mysql_query($consultaSQL, $this->getConexaoSQL());
		if ($RetornodaConsultaSQL) {
			$ArraydeRetorno = array ();
			while ($RegistroSQL = mysql_fetch_array($RetornodaConsultaSQL)) {
				$ArraydeRetorno[] = $RegistroSQL;
			}
			return $ArraydeRetorno;
		} else {
			//return false;
			$this->setErro("Ocorreu um erro enquanto executava a query Consulta no banco de dados");
		}
	}

	public function executaUpdate($updateSQL) 
	{
		if (!$this->getConexaoSQL()){
			$this->conecta();
		}
		$update = mysql_query($updateSQL, $this->getConexaoSQL());
		return $update;
	}
	
	public function executaInsert($insertSQL) 
	{
		if (!$this->getConexaoSQL()){
			$this->conecta();
		}
		$insert =  mysql_query($insertSQL, $this->getConexaoSQL());
		return $insert;
	}
	
	public function executaDelete($deleteSQL) 
	{
		if (!$this->getConexaoSQL()){
			$this->conecta();
		}
		$delete = mysql_query( $deleteSQL, $this->getConexaoSQL());
		return $delete;

	}
	public function desconecta($dbConnecta)
	{
		$dbConnecta = mysql_close($dbConnecta);
		if (!$dbConnecta) {
			die('Não foi possível desconectar.');
		}
		return $dbConnecta;
	}
}
?>
