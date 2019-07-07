<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class SistemaPerfil extends Model{


		public function save(){

			$sql = new Sql();

			$results = $sql->select("call sp_perfil_save(:COD_PERFIL, :PERFIL, :OBS)", array(
				":COD_PERFIL"=>$this->getCOD_PERFIL(),
				":PERFIL"=>$this->getPERFIL(),
				":OBS"=>$this->getOBS()
			));

			$this->setData($results[0]);
		}

		public function get($idPerfil){

			$conversor = new Converter;

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_perfil WHERE COD_PERFIL = :idPerfil", [	
				":idPerfil"=> $idPerfil
			
			]);

			$this->setData($results[0]);
		}

		# pagination the site
		public static function getPage($page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_perfil
				ORDER BY PERFIL
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
				FROM tb_perfil
				WHERE PERFIL LIKE :search
				ORDER BY PERFIL	
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
		public function insert($perfilDados = array()){

			$sqlInsert = new Sql();

			$sql = "INSERT INTO tb_perfil (";

			foreach ($perfilDados as $key => $value) {
				# code...
				$sql = $sql . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ") VALUES (";

			foreach ($perfilDados as $key => $value) {
				# code...
				$sql = $sql . ":" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ")";

			$sqlInsert->query($sql, $perfilDados);
			
			header('location: /admin/sistema-perfil');


		}

		# update the record
		public function upDate($perfilDados = array(),$idPerfil){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_perfil SET ";

			foreach ($perfilDados as $key => $value) {
				# code...
				$sql = $sql . $key . " = :" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . " WHERE COD_PERFIL = :COD_PERFIL";

			$perfilDados["COD_PERFIL"] = $idPerfil;
			$sqlUpdate->query($sql, $perfilDados);
			
			header('location: /admin/sistema-perfil/'.  $idPerfil);

		}

	}

 ?>