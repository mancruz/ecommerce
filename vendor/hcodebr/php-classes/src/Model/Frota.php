<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class Frota extends Model{


		public static function listAll(){

			$sql = new Sql();

				return $sql->select("SELECT * FROM tb_frota ORDER BY FABRICANTE");
		}	

		public function save($frota){

			$sql = new Sql();

			$conversor = new Converter;

			# cria o objeto cliente
			$frota = new Frota;

			# coloca os valores dos dados do formulário nas variáveis
			$COD_VEICULO	= isset($_POST["COD_VEICULO"]) 		? strip_tags(filter_input(INPUT_POST,"COD_VEICULO")) 		: NULL;
			$FABRICANTE 	= isset($_POST["FABRICANTE"]) 		? strip_tags(filter_input(INPUT_POST,"FABRICANTE")) 		: NULL;	 
			$MODELO 		= isset($_POST["MODELO"]) 			? strip_tags(filter_input(INPUT_POST,"MODELO")) 			: NULL;
			$ANOMODELO 		= isset($_POST["ANOMODELO"]) 		? strip_tags(filter_input(INPUT_POST,"ANOMODELO")) 			: NULL;
			$PLACA			= isset($_POST["PLACA"]) 			? strip_tags(filter_input(INPUT_POST,"PLACA")) 				: NULL;
			$RENAVAM 		= isset($_POST["RENAVAM"]) 			? strip_tags(filter_input(INPUT_POST,"RENAVAM")) 			: NULL;
			$CHASSI 		= isset($_POST["CHASSI"]) 			? strip_tags(filter_input(INPUT_POST,"CHASSI")) 			: NULL;
			$COMBUSTIVEL 	= isset($_POST["COMBUSTIVEL"]) 		? strip_tags(filter_input(INPUT_POST,"COMBUSTIVEL")) 		: NULL;
			$TIPO 			= isset($_POST["TIPO"]) 			? strip_tags(filter_input(INPUT_POST,"TIPO")) 				: NULL;
			$VALOR_COMPRA 	= isset($_POST["VALOR_COMPRA"]) 	? strip_tags(filter_input(INPUT_POST,"VALOR_COMPRA")) 		: NULL;
			$VALOR_REVENDA	= isset($_POST["VALOR_REVENDA"]) 	? strip_tags(filter_input(INPUT_POST,"VALOR_REVENDA"))		: NULL;	 
			$CACAMBA1 		= isset($_POST["CACAMBA1"]) 		? strip_tags(filter_input(INPUT_POST,"CACAMBA1")) 			: NULL;
			$CACAMBA2		= isset($_POST["CACAMBA2"]) 		? strip_tags(filter_input(INPUT_POST,"CACAMBA2")) 			: NULL;
			$DTAQUISICAO	= isset($_POST["DTAQUISICAO"]) 		? strip_tags(filter_input(INPUT_POST,"DTAQUISICAO")) 		: NULL;
			$DTVENDA		= isset($_POST["DTVENDA"]) 			? strip_tags(filter_input(INPUT_POST,"DTVENDA")) 			: NULL;
			$OBS			= isset($_POST["OBS"]) 				? strip_tags(filter_input(INPUT_POST,"OBS")) 				: NULL;
			$STATUS_VEICULO = isset($_POST['STATUS_VEICULO'])	? strip_tags(filter_input(INPUT_POST,"STATUS_VEICULO")) 	: NULL;

			# Format the datas
			$DTAQUISICAO	= $conversor->converterDatas($DTAQUISICAO);
			$DTVENDA 		= $conversor->converterDatas($DTVENDA);
			
			# here, format the price f vehicle 
			$VALOR_COMPRA  = $conversor->convertPrice($VALOR_COMPRA);
			$VALOR_REVENDA = $conversor->convertPrice($VALOR_REVENDA);
			
			# coloca os dados dentro de uma array
			$dados = array(
							'FABRICANTE'=>$FABRICANTE,
							'MODELO'=>$MODELO,
							'ANOMODELO'=>$ANOMODELO,
							'PLACA'=>$PLACA,
							'RENAVAM'=>$RENAVAM,
							'CHASSI'=>$CHASSI,
							'COMBUSTIVEL'=>$COMBUSTIVEL,
							'TIPO'=>$TIPO,
							'VALOR_COMPRA'=>$VALOR_COMPRA,
							'VALOR_REVENDA'=>$VALOR_REVENDA,
							'CACAMBA1'=>$CACAMBA1,
							'CACAMBA2'=>$CACAMBA2,
							'DTAQUISICAO'=>$DTAQUISICAO,
							'DTVENDA'=>$DTVENDA,
							'OBS'=>$OBS,
							'STATUS_VEICULO' =>$STATUS_VEICULO
						);
			if((int)$COD_VEICULO){
				
				$frota->upDate(array_filter($dados),(int)$COD_VEICULO);

			} else{	

				$frota->insert(array_filter($dados));
			}	
		}

		public function get($idFrota){

			$conversor = new Converter;

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_frota WHERE COD_VEICULO = :idFrota", [
	
				":idFrota"=> $idFrota
			
			]);


			$results[0]['VALOR_COMPRA'] = number_format((float)$results[0]['VALOR_COMPRA'],2,',','.');
			$results[0]['VALOR_REVENDA'] = number_format((float)$results[0]['VALOR_REVENDA'],2,',','.');

			$this->setData($results[0]);
		}

		public function cancel($idFrota){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_frota SET STATUS_VEICULO = 'INTERDITADO'  WHERE COD_VEICULO = :idFrota;";

			$frotaDados["idFrota"] = $idFrota;
			
			$sqlUpdate->query($sql, $frotaDados);
			
			header('location: /admin/frota');
	
		}

		# pagination the site
		public static function getPage($page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_frota
				ORDER BY FABRICANTE
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
				FROM tb_frota
				WHERE FABRICANTE LIKE :search
				ORDER BY FABRICANTE
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
		public function insert($frotaDados = array()){

			$sqlInsert = new Sql();

			$sql = "INSERT INTO tb_frota (";

			foreach ($frotaDados as $key => $value) {
				# code...
				$sql = $sql . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ") VALUES (";

			foreach ($frotaDados as $key => $value) {
				# code...
				$sql = $sql . ":" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ")";

			$sqlInsert->query($sql, $frotaDados);
			
			header('location: /admin/frota');


		}

		# update the record
		public function upDate($frotaDados = array(),$idFrota){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_frota SET ";

			foreach ($frotaDados as $key => $value) {
				# code...
				$sql = $sql . $key . " = :" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . " WHERE COD_VEICULO = :COD_VEICULO";

			$frotaDados["COD_VEICULO"] = $idFrota;
			$sqlUpdate->query($sql, $frotaDados);
			
			header('location: /admin/frota/'.  $idFrota);

		}

	}

 ?>