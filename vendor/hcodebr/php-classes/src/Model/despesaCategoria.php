<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class despesaCategoria extends Model{


		public static function listAll(){

			$sql = new Sql();

				return $sql->select("SELECT * FROM tb_frete_desp_cat ORDER BY DESPESA");
		}	

		public function save($despesa){

			$sql = new Sql();

			$conversor = new Converter;

			# cria o objeto cliente
			$despesas = new despesaCategoria;

			# coloca os valores dos dados do formulário nas variáveis
			$COD_DESP_FRET_CAT	= isset($_POST["COD_DESP_FRET_CAT"]) 		? strip_tags(filter_input(INPUT_POST,"COD_DESP_FRET_CAT")) 		: NULL;
			$DESPESA 			= isset($_POST["DESPESA"]) 					? strip_tags(filter_input(INPUT_POST,"DESPESA")) 				: NULL;
			
			# coloca os dados dentro de uma array
			$dados = array(
							'DESPESA'=>$DESPESA
						);

			if((int)$COD_DESP_FRET_CAT){
				
				$despesas->upDate(array_filter($dados),(int)$COD_DESP_FRET_CAT);

			} else{	

				$despesas->insert(array_filter($dados));
			}	
		}

		public function get($idDespesaCategoria){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_frete_desp_cat WHERE COD_DESP_FRET_CAT = :idDespesaCategoria", [
	
				":idDespesaCategoria"=> $idDespesaCategoria
			
			]);

			$this->setData($results[0]);
		}


		# pagination the site
		public static function getPage($page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_frete_desp_cat
				ORDER BY DESPESA
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
				FROM tb_frete_desp_cat
				WHERE DESPESA LIKE :search
				ORDER BY DESPESA
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
		public function insert($despesaCategoriaDados = array()){

			$sqlInsert = new Sql();

			$sql = "INSERT INTO tb_frete_desp_cat (";

			foreach ($despesaCategoriaDados as $key => $value) {
				# code...
				$sql = $sql . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ") VALUES (";

			foreach ($despesaCategoriaDados as $key => $value) {
				# code...
				$sql = $sql . ":" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ")";

			$sqlInsert->query($sql, $despesaCategoriaDados);
			
			header('location: /admin/despesas-categoria');


		}

		# update the record
		public function upDate($despesaCategoriaDados = array(),$idDespesaCategoria){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_frete_desp_cat SET ";

			foreach ($despesaCategoriaDados as $key => $value) {
				# code...
				$sql = $sql . $key . " = :" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . " WHERE COD_DESP_FRET_CAT = :COD_DESP_FRET_CAT";

			$despesaCategoriaDados["COD_DESP_FRET_CAT"] = $idDespesaCategoria;
			$sqlUpdate->query($sql, $despesaCategoriaDados);
			
			header('location: /admin/despesas-categoria/'.  $idDespesaCategoria);

		}

	}

 ?>