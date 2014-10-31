<?php
class Custas extends Entity {
	public function __construct(){}
	protected $id;
	protected $id_atualizacao;
	protected $nome_custa;
	protected $folhas_custa;
	protected $valor_custa;
	protected $data_custa;
	
	public function Custas(){	
	}
}
class Depositos extends Entity {
	public function __construct(){}
	protected $id;
	protected $id_atualizacao;
	protected $data_deposito;
	protected $valor_deposito;
	protected $obs_deposito;
	
	public function Depositos(){	
	}
}
class Atualizacoes extends Entity {
	public function __construct(){}
	protected $id;
	protected $num_processo;
	protected $vara;
	protected $reclamante;
	protected $reclamada;
	protected $data_original;
	protected $valor_original;
	protected $data_atualizar;
	protected $data_ajuizamento;
	protected $valor_ir;
	protected $percentual_ir;
	protected $num_meses;
	protected $num_dependentes;
	
	protected $inss_reclamada;
	protected $inss_reclamante;
	protected $valor_tributavel;
	protected $taxa_inss_empregador;
	protected $taxa_inss_sat;
	protected $taxa_inss_terceiros;
	protected $taxa_inss_reclamante;
	protected $forma_atualizar;
	
	public function Atualizacoes(){	
	}
	public function processa(){
		global $Aplicacao;
		//print_r($_POST);
		return $this->processaInserirAtualizacao();
		
	}

	public function processaInserirAtualizacao(){
		global $Aplicacao;
		$parametros['id'] = $Aplicacao->antiSQLInjection($_POST[id]);
		$parametros['num_processo'] = $Aplicacao->antiSQLInjection($_POST[num_processo]);
		$parametros['vara'] = $Aplicacao->antiSQLInjection($_POST[vara]);
		$parametros['reclamante'] = $Aplicacao->antiSQLInjection($_POST[reclamante]);
		$parametros['reclamada'] = $Aplicacao->antiSQLInjection($_POST[reclamada]);
		
		$parametros['data_original'] = $Aplicacao->antiSQLInjection($_POST[data_original]);
		$parametros['data_original'] = $Aplicacao->Data2bd($parametros['data_original']);
		$parametros['valor_original'] = $Aplicacao->antiSQLInjection($_POST[valor_original]);
		$parametros['valor_original'] = $Aplicacao->Real2bd($parametros['valor_original']);
		
		$parametros['data_atualizar'] = $Aplicacao->antiSQLInjection($_POST[data_atualizar]);
		$parametros['data_atualizar'] = $Aplicacao->Data2bd($parametros['data_atualizar']);
		$parametros['data_ajuizamento'] = $Aplicacao->antiSQLInjection($_POST[data_ajuizamento]);
		$parametros['data_ajuizamento'] = $Aplicacao->Data2bd($parametros['data_ajuizamento']);
		
			$parametros['data_deposito'] = $Aplicacao->antiSQLInjection($_POST[data_deposito]);
			$parametros['data_deposito'] = $Aplicacao->Data2bd($parametros['data_deposito']);
			$parametros['valor_deposito'] = $Aplicacao->antiSQLInjection($_POST[valor_deposito]);
			$parametros['valor_deposito'] = $Aplicacao->Real2bd($parametros['valor_deposito']);
			$parametros['obs_deposito'] = $Aplicacao->antiSQLInjection($_POST[obs_deposito]);
			
		$parametros['inss_reclamante'] = $Aplicacao->antiSQLInjection($_POST[inss_reclamante]);
		$parametros['inss_reclamante'] = $Aplicacao->Real2bd($parametros['inss_reclamante']);
		$parametros['inss_reclamada'] = $Aplicacao->antiSQLInjection($_POST[inss_reclamada]);
		$parametros['inss_reclamada'] = $Aplicacao->Real2bd($parametros['inss_reclamada']);
		$parametros['valor_tributavel'] = $Aplicacao->antiSQLInjection($_POST[valor_tributavel]);
		$parametros['valor_tributavel'] = $Aplicacao->Real2bd($parametros['valor_tributavel']);
		$parametros['taxa_inss_empregador'] = $Aplicacao->antiSQLInjection($_POST[taxa_inss_empregador]);
		$parametros['taxa_inss_sat'] = $Aplicacao->antiSQLInjection($_POST[taxa_inss_sat]);
		$parametros['taxa_inss_terceiros'] = $Aplicacao->antiSQLInjection($_POST[taxa_inss_terceiros]);
		$parametros['taxa_inss_reclamante'] = $Aplicacao->antiSQLInjection($_POST[taxa_inss_reclamante]);
		$parametros['taxa_inss_reclamante'] = $Aplicacao->Real2bd($parametros['taxa_inss_reclamante']);
		$parametros['forma_atualizar'] = $Aplicacao->antiSQLInjection($_POST[forma_atualizar]);
			
			$parametros['valor_ir'] = $Aplicacao->antiSQLInjection($_POST[valor_ir]);
			$parametros['valor_ir'] = $Aplicacao->Real2bd($parametros['valor_ir']);
			$parametros['percentual_ir'] = $Aplicacao->antiSQLInjection($_POST[percentual_ir]);
			$parametros['num_meses'] = $Aplicacao->antiSQLInjection($_POST[num_meses]);
			$parametros['num_dependentes'] = $Aplicacao->antiSQLInjection($_POST[num_dependentes]);
			
		$parametros['nome_custa'] = $Aplicacao->antiSQLInjection($_POST[nome_custa]);
		$parametros['folhas_custa'] = $Aplicacao->antiSQLInjection($_POST[folhas_custa]);
		$parametros['valor_custa'] = $Aplicacao->antiSQLInjection($_POST[valor_custa]);
		$parametros['valor_custa'] = $Aplicacao->Real2bd($parametros['valor_custa']);
		$parametros['data_custa'] = $Aplicacao->antiSQLInjection($_POST[data_custa]);
		$parametros['data_custa'] = $Aplicacao->Data2bd($parametros['data_custa']);
		
		$resultado = $this->inserirAtualizacao($parametros);
		return $resultado;
	}
	
	public function inserirAtualizacao($parametros){
		global $Aplicacao;
		//print_r($parametros);
		$id = trim($parametros['id']);
		$num_processo = trim($parametros['num_processo']);
		$vara = trim($parametros['vara']);
		$reclamante = trim($parametros['reclamante']);
		$reclamada = trim($parametros['reclamada']);
		$data_original = trim($parametros['data_original']);
		$valor_original = trim($parametros['valor_original']);
		$data_atualizar = trim($parametros['data_atualizar']);
		$data_ajuizamento = trim($parametros['data_ajuizamento']);
		
			$data_deposito = trim($parametros['data_deposito']);
			$valor_deposito = trim($parametros['valor_deposito']);
			$obs_deposito = trim($parametros['obs_deposito']);
			
		$inss_reclamada = trim($parametros['inss_reclamada']);
		$inss_reclamante = trim($parametros['inss_reclamante']);
		$valor_tributavel = trim($parametros['valor_tributavel']);
		$taxa_inss_empregador = trim($parametros['taxa_inss_empregador']);
		$taxa_inss_sat = trim($parametros['taxa_inss_sat']);
		$taxa_inss_terceiros = trim($parametros['taxa_inss_terceiros']);
		$taxa_inss_reclamante = trim($parametros['taxa_inss_reclamante']);
		$forma_atualizar = trim($parametros['forma_atualizar']);
			
			$valor_ir = trim($parametros['valor_ir']);
			$percentual_ir = trim($parametros['percentual_ir']);
			$num_meses = trim($parametros['num_meses']);
			$num_dependentes = trim($parametros['num_dependentes']);
		
		$nome_custa = trim($parametros['nome_custa']);
		$folhas_custa = trim($parametros['folhas_custa']);
		$valor_custa = trim($parametros['valor_custa']);
		$data_custa = trim($parametros['data_custa']);
		
		if($id!=""){ $set[] = "id = '".$id."'"; }
		if($num_processo!=""){ $set[] = "num_processo = '".$num_processo."'"; }
		if($vara!=""){ $set[] = "vara = '".$vara."'"; }
		if($reclamante!=""){ $set[] = "reclamante = '".$reclamante."'"; }
		if($reclamada!=""){ $set[] = "reclamada = '".$reclamada."'"; }
		if($data_original!="" && $data_original!="--"){ $set[] = "data_original = '".$data_original."'"; }
		if($valor_original!="" && $valor_original>0){ $set[] = "valor_original = '".$valor_original."'"; }
		if($data_atualizar!="" && $data_atualizar!="--"){ $set[] = "data_atualizar = '".$data_atualizar."'"; }
		if($data_ajuizamento!="" && $data_ajuizamento!="--"){ $set[] = "data_ajuizamento = '".$data_ajuizamento."'"; }
		
			if($inss_reclamante!=""){ $set[] = "inss_reclamante = '".$inss_reclamante."'"; }
			if($inss_reclamada!=""){ $set[] = "inss_reclamada = '".$inss_reclamada."'"; }
			if($valor_tributavel!=""){ $set[] = "valor_tributavel = '".$valor_tributavel."'"; }
			if($taxa_inss_empregador!=""){ $set[] = "taxa_inss_empregador = '".$taxa_inss_empregador."'"; }
			if($taxa_inss_sat!=""){ $set[] = "taxa_inss_sat = '".$taxa_inss_sat."'"; }
			if($taxa_inss_terceiros!=""){ $set[] = "taxa_inss_terceiros = '".$taxa_inss_terceiros."'"; }
			if($taxa_inss_reclamante!=""){ $set[] = "taxa_inss_reclamante = '".$taxa_inss_reclamante."'"; }
			if($forma_atualizar!=""){ $set[] = "forma_atualizar = '".$forma_atualizar."'"; }
		
		if($valor_ir!=""){ $set[] = "valor_ir = '".$valor_ir."'"; }
		if($percentual_ir!=""){ $set[] = "percentual_ir = '".$percentual_ir."'"; }
		if($num_meses!=""){ $set[] = "num_meses = '".$num_meses."'"; }
		if($num_dependentes!=""){ $set[] = "num_dependentes = '".$num_dependentes."'"; }
		
		if(sizeof($set)>0){
			$set = " SET " . implode(", ",$set);
		}
		$parametros['id'] = $id;
		$consulta = $this->pegaAtualizacoes($parametros);
		if(sizeof($consulta)>0){//já existe
			$query = "UPDATE atualizacoes ".$set." WHERE id=".$id;
		}else{
			$query = "INSERT INTO atualizacoes ". $set;
		}
		//echo $query."<BR>";
		$result = $Aplicacao->getConexaoSQL()->executaInsert($query);	
		
		//DEPOSITOS
		if($valor_deposito>0 && $valor_deposito!=""){
			if($id!=""){ $set1[] = "id_atualizacao = '".$id."'"; }
			
			if($data_deposito!=""){ $set1[] = "data_deposito = '".$data_deposito."'"; }
			if($valor_deposito!=""){ $set1[] = "valor_deposito = '".$valor_deposito."'"; }
			if($obs_deposito!=""){ $set1[] = "obs_deposito = '".$obs_deposito."'"; }
			if(sizeof($set1)>0){
				$set1 = " SET " . implode(", ",$set1);
			}
			$query_depositos = "INSERT INTO depositos ". $set1;
			//echo $query_depositos."<BR>";
			$result1 = $Aplicacao->getConexaoSQL()->executaInsert($query_depositos);	
		}
		//CUSTAS E/OU DESPESAS
		if($valor_custa>0 && $valor_custa!=""){
			if($id!=""){ $set1[] = "id_atualizacao = '".$id."'"; }
			if($nome_custa!=""){ $set1[] = "nome_custa = '".$nome_custa."'"; }
			if($folhas_custa!=""){ $set1[] = "folhas_custa = '".$folhas_custa."'"; }
			if($valor_custa!=""){ $set1[] = "valor_custa = '".$valor_custa."'"; }
			if($data_custa!=""){ $set1[] = "data_custa = '".$data_custa."'"; }
			if(sizeof($set1)>0){
				$set1 = " SET " . implode(", ",$set1);
			}
			$query_custas = "INSERT INTO custas_despesas ". $set1;
			//echo $query_custas."<BR>";
			$result1 = $Aplicacao->getConexaoSQL()->executaInsert($query_custas);	
		}
		return $id;
	}
	public function processaExcluirDeposito(){
		global $Aplicacao;
		$id_deposito = $Aplicacao->antiSQLInjection($_POST[id_deposito]);
		
		$query = "DELETE FROM depositos WHERE id = '". $id_deposito."'";
		//echo $query."<BR>";
		return $Aplicacao->getConexaoSQL()->executaDelete($query);
	}
	public function processaExcluirCusta(){
		global $Aplicacao;
		$id_custa = $Aplicacao->antiSQLInjection($_POST[id_custa]);
		
		$query = "DELETE FROM custas_despesas WHERE id = '". $id_custa."'";
		//echo $query."<BR>";
		return $Aplicacao->getConexaoSQL()->executaDelete($query);
	}
	
	public function pegaAtualizacoes($param){
		global $Aplicacao;
		
		$id = $param['id'];
		$num_processo = $param['num_processo'];
		$vara = $param['vara'];
		$reclamante = $param['reclamante'];
		$reclamada = $param['reclamada'];
		if($id!=""){	
			$set[] = "id = '".$id."'";
		}else{
			if($num_processo!=""){ $set[] = "num_processo like '%".$num_processo."%'"; }
			if($vara!=""){ $set[] = "vara like '%".$vara."%'"; }
			if($reclamante!=""){ $set[] = "reclamante like '%".$reclamante."%'"; }
			if($reclamada!=""){ $set[] = "reclamada like '%".$reclamada."%'"; }
			
		}
		if(sizeof($set)>0){
			$where = " WHERE " . implode(" AND ",$set);
		}

		$query = "SELECT * FROM atualizacoes ".$where. " ORDER BY id DESC";
	       // echo $query."<BR>";		

		$consulta = $Aplicacao->getConexaoSQL()->executaConsulta($query);

		for($index = 0; $index < sizeof( $consulta); $index++) {
			$retorno[$index] = new Atualizacoes();
			$retorno[$index]->set('id', $consulta[$index]["id"]);
			$retorno[$index]->set('num_processo', $consulta[$index]["num_processo"]);
			$retorno[$index]->set('vara', $consulta[$index]["vara"]);
			$retorno[$index]->set('reclamante', $consulta[$index]["reclamante"]);
			$retorno[$index]->set('reclamada', $consulta[$index]["reclamada"]);
			$retorno[$index]->set('data_original', $Aplicacao->Bd2data($consulta[$index]["data_original"]));
			$retorno[$index]->set('valor_original', $consulta[$index]["valor_original"]);
			$retorno[$index]->set('data_atualizar', $Aplicacao->Bd2data($consulta[$index]["data_atualizar"]));
			$retorno[$index]->set('data_ajuizamento', $Aplicacao->Bd2data($consulta[$index]["data_ajuizamento"]));
			
			$retorno[$index]->set('valor_ir', $consulta[$index]["valor_ir"]);
			$retorno[$index]->set('percentual_ir', $consulta[$index]["percentual_ir"]);
			$retorno[$index]->set('num_meses', $consulta[$index]["num_meses"]);
			$retorno[$index]->set('num_dependentes', $consulta[$index]["num_dependentes"]);
			
			$retorno[$index]->set('inss_reclamante', $consulta[$index]["inss_reclamante"]);
			$retorno[$index]->set('inss_reclamada', $consulta[$index]["inss_reclamada"]);
			$retorno[$index]->set('valor_tributavel', $consulta[$index]["valor_tributavel"]);
			$retorno[$index]->set('taxa_inss_empregador', $consulta[$index]["taxa_inss_empregador"]);
			$retorno[$index]->set('taxa_inss_sat', $consulta[$index]["taxa_inss_sat"]);
			$retorno[$index]->set('taxa_inss_terceiros', $consulta[$index]["taxa_inss_terceiros"]);
			$retorno[$index]->set('taxa_inss_reclamante', $consulta[$index]["taxa_inss_reclamante"]);
			$retorno[$index]->set('forma_atualizar', $consulta[$index]["forma_atualizar"]);
			
		}
		return $retorno;
	}
	
	public function pegaDepositos($param){
		global $Aplicacao;
		
		$id_atualizacao = $param['id_atualizacao'];
		if($id_atualizacao!=""){	
			$set[] = "id_atualizacao = '".$id_atualizacao."'";
		}
		if(sizeof($set)>0){
			$where = " WHERE " . implode(" AND ",$set);
		}

		$query = "SELECT * FROM depositos ".$where." ORDER BY data_deposito ASC";
	        //echo $query."<BR>";		

		$consulta = $Aplicacao->getConexaoSQL()->executaConsulta($query);

		for($index = 0; $index < sizeof( $consulta); $index++) {
			$retorno[$index] = new Custas();
			$retorno[$index]->set('id', $consulta[$index]["id"]);
			$retorno[$index]->set('data_deposito', $Aplicacao->Bd2data($consulta[$index]["data_deposito"]));
			$retorno[$index]->set('valor_deposito', $consulta[$index]["valor_deposito"]);
			$retorno[$index]->set('obs_deposito', $consulta[$index]["obs_deposito"]);
			
		}
		return $retorno;
	}
	public function pegaCustas($param){
		global $Aplicacao;
		
		$id_atualizacao = $param['id_atualizacao'];
		if($id_atualizacao!=""){	
			$set[] = "id_atualizacao = '".$id_atualizacao."'";
		}
		if(sizeof($set)>0){
			$where = " WHERE " . implode(" AND ",$set);
		}

		$query = "SELECT * FROM custas_despesas ".$where." ORDER BY data_custa ASC";
	        //echo $query."<BR>";		

		$consulta = $Aplicacao->getConexaoSQL()->executaConsulta($query);

		for($index = 0; $index < sizeof( $consulta); $index++) {
			$retorno[$index] = new Custas();
			$retorno[$index]->set('id', $consulta[$index]["id"]);
			$retorno[$index]->set('nome_custa', $consulta[$index]["nome_custa"]);
			$retorno[$index]->set('folhas_custa', $consulta[$index]["folhas_custa"]);
			$retorno[$index]->set('valor_custa', $consulta[$index]["valor_custa"]);
			$retorno[$index]->set('data_custa', $Aplicacao->Bd2data($consulta[$index]["data_custa"]));
			
		}
		return $retorno;
	}
	
	public function pegaIndice($param){
		global $Aplicacao;
		
		$data_original = $param['data_original'];
		$data_atualizar = $param['data_atualizar'];
		
		
		$query_aPartir = "
			SELECT taxa FROM tr_diaria WHERE data = '".$Aplicacao->Data2bd($data_original)."'
		";
		$consulta_aPartir = $Aplicacao->getConexaoSQL()->executaConsulta($query_aPartir);
		
		$query_atualizar = "
			SELECT taxa FROM tr_diaria WHERE data = '".$Aplicacao->Data2bd($data_atualizar)."'
		";
		$consulta_atualizar = $Aplicacao->getConexaoSQL()->executaConsulta($query_atualizar);
		
		$taxa = ($consulta_aPartir[0]['taxa'] / $consulta_atualizar[0]['taxa']);
		return $taxa;
	}
	
	public function CalculaPercentualJurosMora($param){
		global $Aplicacao;
		
		$data_inicial = $param['data_inicial'];
		$data_final = $param['data_final'];
		
		$fechaf = explode('/',$data_final);
		$ano1 = $fechaf[2];
		$mes1 = $fechaf[1];
		$dia1 = $fechaf[0];

		//defino fecha V
		$fecha = explode('/',$data_inicial);
		$ano2 = $fecha[2];
		$mes2 = $fecha[1];
		$dia2 = $fecha[0];
		$diasD = ($dia1 - $dia2);
		$diasM = ($mes1 - $mes2) * 30;
		$diasA = ($ano1 - $ano2) * 360;

		$dias = $diasD + $diasM + $diasA;

		return ($dias/3000*100);
	}
	public function pegaAliquota($param){
		global $Aplicacao;
		$valor = $param['valor'];
		$num_meses = $param['num_meses'];
		$query = "SELECT * FROM mensal_ir";
		$consulta = $Aplicacao->getConexaoSQL()->executaConsulta($query);
		$teste1 = ($consulta[0]['verificacao1']*$num_meses);
		$teste2 = ($consulta[0]['verificacao2']*$num_meses);
		$teste3 = ($consulta[0]['verificacao3']*$num_meses);
		$teste4 = ($consulta[0]['verificacao4']*$num_meses);
		$teste5 = ($consulta[0]['verificacao5']*$num_meses);
		if($valor<=$teste1){
			$percentual = "isento";
			//$retorno = $consulta[0]['percentual1'];
			$valor_parcela = $num_meses*$consulta[0]['parcela1'];
		}
		if($valor>$teste1 && $valor<=$teste2 ){
			$percentual = $consulta[0]['percentual2'];
			$valor_parcela = $num_meses*$consulta[0]['parcela2'];
		}
		if($valor>$teste2 && $valor<=$teste3 ){
			$percentual = $consulta[0]['percentual3'];
			$valor_parcela = $num_meses*$consulta[0]['parcela3'];
		}
		if($valor>$teste3 && $valor<=$teste4 ){
			$percentual = $consulta[0]['percentual4'];
			$valor_parcela = $num_meses*$consulta[0]['parcela4'];
		}
		if($valor>=$teste5){
			$percentual = $consulta[0]['percentual5'];
			$valor_parcela = $num_meses*$consulta[0]['parcela5'];
		}
		
		
		$retorno['percentual'] = $percentual;
		$retorno['valor_parcela'] = $valor_parcela;
		return $retorno;
	
	}

}
?>
