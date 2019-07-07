<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class Frete extends Model{


		public function save(){

			$sql = new Sql();

			$results = $sql->select("call sp_frete_save(:COD_FRETE,:COD_CLI_FORN,:COD_USU,:COD_FUNC,:PLACA_CAVALO,:CACAMBA,:DATA_CARREGAMENTO,:TIPO_FRETE,:LOCAL_SAIDA,:DATA_SAIDA,:LOCAL_CHEGADA,:DATA_CHEGADA,:CRTC,:DESLOCAMENTO,:KM_SAIDA,:KM_CHEGADA,:PESO_SAIDA,:PESO_CHEGADA,:ADIANTAMENTO,:PRECO_TONELADA,:OBS,:COMISSAO,:ESTADIA,:STATUS)", array(
				'COD_FRETE'			=>$this->getCOD_FRETE(),
				'COD_CLI_FORN'		=>$this->getCOD_CLI_FORN(),
				'COD_USU'			=>$this->getCOD_USU(),
				'COD_FUNC'			=>$this->getCOD_FUNC(),
				'PLACA_CAVALO'		=>$this->getPLACA_CAVALO(),
				'CACAMBA'			=>$this->getCACAMBA(),
				'DATA_CARREGAMENTO'	=>$this->getDATA_CARREGAMENTO(),
				'TIPO_FRETE'		=>$this->getTIPO_FRETE(),
				'LOCAL_SAIDA'		=>$this->getLOCAL_SAIDA(),
				'DATA_SAIDA'		=>$this->getDATA_SAIDA(),
				'LOCAL_CHEGADA'		=>$this->getLOCAL_CHEGADA(),
				'DATA_CHEGADA'		=>$this->getDATA_CHEGADA(),
				'CRTC'				=>$this->getCRTC(),
				'DESLOCAMENTO'		=>$this->getDESLOCAMENTO(),
				'KM_SAIDA'			=>$this->getKM_SAIDA(),
				'KM_CHEGADA'		=>$this->getKM_CHEGADA(),
				'PESO_SAIDA'		=>$this->getPESO_SAIDA(),
				'PESO_CHEGADA'		=>$this->getPESO_CHEGADA(),
				'ADIANTAMENTO'		=>$this->getADIANTAMENTO(),
				'PRECO_TONELADA'	=>$this->getPRECO_TONELADA(),
				'OBS'				=>$this->getOBS(),
				'COMISSAO'			=>$this->getCOMISSAO(),
				'ESTADIA'			=>$this->getESTADIA(),
				'STATUS'			=>$this->getSTATUS()
			));

			$this->setData($results[0]);

			return $results[0];
		}

		public function get($idFrete){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_frete WHERE COD_FRETE = :idFrete", [	
				":idFrete"=> $idFrete
			
			]);
			
			$this->setData($results[0]);
		}

		public static function getMotorista(){

			$sql = new Sql();

			$results = $sql->select("SELECT
										tb_funcionario.cod_func,
										tb_funcionario.nome_func,
										tb_cargo.CARGO
									FROM tb_funcionario
										INNER JOIN tb_cargo
										ON tb_funcionario.cargo_func = tb_cargo.COD_CARGO
									WHERE tb_cargo.CARGO = :cargo",
									[
										':cargo' =>'MOTORISTA'
									]);

			return [
				'driver'=>$results
			];
		}

		public static function getClienteFrete(){

			$sql = new Sql();

			$results = $sql->select("SELECT
										COD_CLI_FORN,
										NOME
									FROM
										tb_clientes_fornecedores
									WHERE
										TIPO_CADASTRO<>'Fornecedor'										
									ORDER BY NOME"
									);

			return [
				'clienteFrete'=>$results
			];
		}

		public static function getFreteCavalo(){

			$sql = new Sql();

			$results = $sql->select("SELECT
										PLACA,
										FABRICANTE,
										MODELO
									FROM
										tb_frota
									ORDER BY PLACA"
									);

			return [
				'freteCavalo'=>$results
			];
		}

		# carrega os dados de resumos de valores
		public static function getFreteTotais($idFrete){

			$sql = new Sql();

			$results = $sql->select("SELECT *
									FROM
										c_frete_calculado
									WHERE COD_FRETE = $idFrete"
									);

			return $results;
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
		public static function getPageSearch($dtDe, $dtAte, $search, $page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$conversor = new Converter;

			# Format the datas
			$dtDe	= $conversor->converterDatas($dtDe);
			$dtAte 	= $conversor->converterDatas($dtAte);

			$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS
			COD_FRETE,
			tb_clientes_fornecedores.NOME,
			DATA_SAIDA,
			DATA_CHEGADA,
			KM_CHEGADA - KM_SAIDA AS Deslocamento,
			nome_func,
			tb_frete.STATUS
		  FROM tb_frete
			INNER JOIN tb_clientes_fornecedores
			  ON tb_frete.COD_CLI_FORN = tb_clientes_fornecedores.COD_CLI_FORN
			INNER JOIN tb_funcionario
			  ON tb_frete.COD_FUNC = tb_funcionario.cod_func
		  WHERE DATA_CHEGADA BETWEEN :dataIni AND :dataFim AND CONCAT(RAZAO_SOCIAL, nome_func) LIKE :search
		  ORDER BY tb_clientes_fornecedores.NOME
		  LIMIT $start, $itensPerPage;", [
				':dataIni'=>$dtDe,
				':dataFim'=>$dtAte,
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

		# FUNCTION FOR CANCEL THE FREIGHT
		public function cancel(){

			$sql = new Sql;

			$sql->query("CALL sp_frete_cancel(:idFrete)", array(
				":idFrete"=>$this->getCOD_FRETE()
			));
		}

	}

 ?>