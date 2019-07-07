<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class ClienteFornecedor extends Model{


		public static function listAll(){

			$sql = new Sql();

			#if (empty($parameter)){

				return $sql->select("SELECT * FROM tb_clientes_fornecedores ORDER BY NOME");
				 
		#	} else {

		#		return $sql->select("SELECT * FROM tb_clientes_fornecedores ORDER BY NOME");
		#	}
		}

		public function save($clienteFornecedor){

			$conversor = new Converter;

			# cria o objeto cliente
			$clientes = new ClienteFornecedor;

			# coloca os valores dos dados do formulário nas variáveis
			$COD_CLI_FORN		= isset($_POST["COD_CLI_FORN"]) 		? strip_tags(filter_input(INPUT_POST,"COD_CLI_FORN")) 		: NULL;
			$NOME 				= isset($_POST["NOME"]) 				? strip_tags(filter_input(INPUT_POST,"NOME")) 				: NULL;	 
			$RAZAO_SOCIAL 		= isset($_POST["RAZAO_SOCIAL"]) 		? strip_tags(filter_input(INPUT_POST,"RAZAO_SOCIAL")) 		: NULL;
			$TEL_CEL 			= isset($_POST["TEL_CEL"]) 				? strip_tags(filter_input(INPUT_POST,"TEL_CEL")) 			: NULL;
			$TEL_FIXO			= isset($_POST["TEL_FIXO"]) 			? strip_tags(filter_input(INPUT_POST,"TEL_FIXO")) 			: NULL;
			$TEL_COMER 			= isset($_POST["TEL_COMER"]) 			? strip_tags(filter_input(INPUT_POST,"TEL_COMER")) 			: NULL;
			$CONTATO 			= isset($_POST["CONTATO"]) 				? strip_tags(filter_input(INPUT_POST,"CONTATO")) 			: NULL;
			$EMAIL 				= isset($_POST["EMAIL"]) 				? strip_tags(filter_input(INPUT_POST,"EMAIL")) 				: NULL;
			$RG 				= isset($_POST["RG"]) 					? strip_tags(filter_input(INPUT_POST,"RG")) 				: NULL;
			$CPF 				= isset($_POST["CPF"]) 					? strip_tags(filter_input(INPUT_POST,"CPF")) 				: NULL;
			$INSCRICAO_ESTADUAL	= isset($_POST["INSCRICAO_ESTADUAL"]) 	? strip_tags(filter_input(INPUT_POST,"INSCRICAO_ESTADUAL"))	: NULL;	 
			$INSCRICAO_SUFRAMA 	= isset($_POST["INSCRICAO_SUFRAMA"]) 	? strip_tags(filter_input(INPUT_POST,"INSCRICAO_SUFRAMA")) 	: NULL;
			$CNPJ				= isset($_POST["CNPJ"]) 				? strip_tags(filter_input(INPUT_POST,"CNPJ")) 				: NULL;
			$TIPO_CADASTRO 		= isset($_POST["TIPO_CADASTRO"]) 		? strip_tags(filter_input(INPUT_POST,"TIPO_CADASTRO")) 		: NULL;
			$STATUS 			= isset($_POST["STATUS"]) 				? strip_tags(filter_input(INPUT_POST,"STATUS")) 			: NULL;
			$ISENTO_ICMS 		= isset($_POST["ISENTO_ICMS"]) 			? strip_tags(filter_input(INPUT_POST,"ISENTO_ICMS")) 		: NULL;
			$DATA_NASCIMENTO 	= isset($_POST["DATA_NASCIMENTO"]) 		? strip_tags(filter_input(INPUT_POST,"DATA_NASCIMENTO")) 	: NULL;
			$OBSERVACAO			= isset($_POST["OBSERVACAO"]) 			? strip_tags(filter_input(INPUT_POST,"OBSERVACAO")) 		: NULL;
			$LOGRADOURO			= isset($_POST["LOGRADOURO"]) 			? strip_tags(filter_input(INPUT_POST,"LOGRADOURO")) 		: NULL;
			$NUMERO				= isset($_POST["NUMERO"]) 				? strip_tags(filter_input(INPUT_POST,"NUMERO")) 			: NULL;
			$COMPLEMENTO		= isset($_POST["COMPLEMENTO"]) 			? strip_tags(filter_input(INPUT_POST,"COMPLEMENTO")) 		: NULL;
			$BAIRRO				= isset($_POST["BAIRRO"]) 				? strip_tags(filter_input(INPUT_POST,"BAIRRO")) 			: NULL;
			$CIDADE				= isset($_POST["CIDADE"]) 				? strip_tags(filter_input(INPUT_POST,"CIDADE")) 			: NULL;
			$ESTADO				= isset($_POST["ESTADO"]) 				? strip_tags(filter_input(INPUT_POST,"ESTADO")) 			: NULL;
			$CEP				= isset($_POST["CEP"]) 					? strip_tags(filter_input(INPUT_POST,"CEP")) 				: NULL;

			# Format the datas
			
			# here, format the date to insert in database 
			$DATA_NASCIMENTO = $conversor->converterDatas($DATA_NASCIMENTO);

			# format the field ICMS
			if($ISENTO_ICMS =="on"){
				$ISENTO_ICMS = 1;
			}else{
				$ISENTO_ICMS = NULL;
			}
			
			# coloca os dados dentro de uma array
			$dados = array(
							'NOME' => $NOME,
							'RAZAO_SOCIAL' => $RAZAO_SOCIAL,
							'TEL_CEL' => $TEL_CEL,
							'TEL_FIXO' => $TEL_FIXO,
							'TEL_COMER' => $TEL_COMER,
							'CONTATO' => $CONTATO,
							'EMAIL' => $EMAIL,
							'RG' => $RG,
							'CPF' => $CPF,
							'INSCRICAO_ESTADUAL' => $INSCRICAO_ESTADUAL,
							'INSCRICAO_SUFRAMA' => $INSCRICAO_SUFRAMA,
							'CNPJ' => $CNPJ,
							'TIPO_CADASTRO' => $TIPO_CADASTRO,
							'STATUS' => $STATUS,
							'ISENTO_ICMS' => $ISENTO_ICMS,
							'DATA_NASCIMENTO' => $DATA_NASCIMENTO,
							'OBSERVACAO' => $OBSERVACAO,
							'LOGRADOURO' => $LOGRADOURO,
							'NUMERO' => $NUMERO,
							'COMPLEMENTO' => $COMPLEMENTO,
							'BAIRRO' => $BAIRRO,
							'CIDADE' => $CIDADE,
							'ESTADO' => $ESTADO,
							'CEP' => $CEP
						);
			if($COD_CLI_FORN){
				
				$clientes->upDate($dados,(int)$COD_CLI_FORN);

			} else{	

				$clientes->insert($dados);
			}	
		}

		public function get($ClienteFornecedor){
			$conversor = new Converter;
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_clientes_fornecedores WHERE COD_CLI_FORN = :ClienteFornecedor", [
	
				":ClienteFornecedor"=> $ClienteFornecedor
			
			]);

			# converte a data para ser exibida na página
			$dtNascimento = $results[0]['DATA_NASCIMENTO'];			
			$results[0]['DATA_NASCIMENTO'] = $conversor->converterDatas($dtNascimento);

			$this->setData($results[0]);
		}

		public function cancel($id_cliente){

			$codiCliente = $id_cliente;

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_clientes_fornecedores SET STATUS = 'Cancelado'  WHERE COD_CLI_FORN = :COD_CLI_FORN;";

			$clienteDados["COD_CLI_FORN"] = $codiCliente;
			
			$sqlUpdate->query($sql, $clienteDados);
			
			header('location: /admin/cliente-fornecedor');
	
		}

		# pagination the site
		public static function getPage($page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_clientes_fornecedores
				ORDER BY NOME
				LIMIT $start, $itensPerPage;
			
			");

			$resultadoTotal = $sql->select("SELECT FOUND_ROWS() AS nrTotal;");

			return [
				'data'=>$results,
				'total'=>(int)$resultadoTotal[0]['nrTotal'],
				'pages'=>ceil($resultadoTotal[0]['nrTotal'] / $itensPerPage),
				'currentPage'=>$page

			];
		}

		# serach and pagination of the site
		public static function getPageSearch($search, $page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_clientes_fornecedores
				WHERE NOME LIKE :search
				ORDER BY NOME
				LIMIT $start, $itensPerPage;
			
			", [
				':search'=>'%'.$search.'%'
			]);

			$resultadoTotal = $sql->select("SELECT FOUND_ROWS() AS nrTotal;");

			return [
				'data'=>$results,
				'total'=>(int)$resultadoTotal[0]['nrTotal'],
				'pages'=>ceil($resultadoTotal[0]['nrTotal'] / $itensPerPage),
				'currentPage'=>$page,
				

			];
		}

		# insert the new record
		public function insert($clienteDados = array()){

			$sqlInsert = new Sql();

			$sql = "INSERT INTO tb_clientes_fornecedores (";

			foreach ($clienteDados as $key => $value) {
				# code...
				$sql = $sql . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ") VALUES (";

			foreach ($clienteDados as $key => $value) {
				# code...
				$sql = $sql . ":" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ")";

			$sqlInsert->query($sql, $clienteDados);
			
			header('location: /admin/cliente-fornecedor');


		}

		# update the record
		public function upDate($clienteDados = array(),$id_Cliente){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_clientes_fornecedores SET ";

			foreach ($clienteDados as $key => $value) {
				# code...
				$sql = $sql . $key . " = :" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . " WHERE COD_CLI_FORN = :COD_CLI_FORN";

			$clienteDados["COD_CLI_FORN"] = $id_Cliente;
			$sqlUpdate->query($sql, $clienteDados);
			
			header('location: /admin/cliente-fornecedor/'.  $id_Cliente);

		}

	}




 ?>