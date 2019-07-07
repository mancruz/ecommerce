<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class Manutencao extends Model{

		public function save(){

			$sql = new Sql();

			$results = $sql->select("call sp_manutencao_save(:ID_MANUTENCE,:COD_USU,:DATE_MANUTENCE_START,:DATE_MANUTENCE_FINISH,:COD_VEICULO,:TIPO_MANUTENCAO,:STATUS,:DESCRICAO_SERVICO,:KM_ATUAL,:LOCAL_MANUTENCAO,:MECANICO_RESPONSAVEL)", array(
				':ID_MANUTENCE'				=>	$this->getID_MANUTENCE(),
				':COD_USU'					=>	$this->getCOD_USU(),
				':DATE_MANUTENCE_START'		=>	$this->getDATE_MANUTENCE_START(),
				':DATE_MANUTENCE_FINISH'	=>	$this->getDATE_MANUTENCE_FINISH(),
				':COD_VEICULO'				=>	$this->getCOD_VEICULO(),
				':TIPO_MANUTENCAO'			=>	$this->getTIPO_MANUTENCAO(),
				':STATUS'					=>	$this->getSTATUS(),
				':DESCRICAO_SERVICO'		=>	$this->getDESCRICAO_SERVICO(),
				':KM_ATUAL'					=>	$this->getKM_ATUAL(),
				':LOCAL_MANUTENCAO'			=>	$this->getLOCAL_MANUTENCAO(),
				':MECANICO_RESPONSAVEL'		=>	$this->getMECANICO_RESPONSAVEL()
			));

			$this->setData($results[0]);
		}

		public function saveItem(){

			$sql = new Sql();

			$results = $sql->select("call sp_manutencao_Itens_save(:ID_MANUTENCE,:ITEM,:DESCRICAO,:QTD,:VALOR,:COD_CLI_FORN,:GARANTIA_DIAS)", array(
				':ID_MANUTENCE'		=>	$this->getID_MANUTENCE(),
				':ITEM'				=>	$this->getITEM(),
				':DESCRICAO'		=>	$this->getDESCRICAO(),
				':QTD'				=>	$this->getQTD(),
				':VALOR'			=>	$this->getVALOR(),
				':COD_CLI_FORN'		=>	$this->getCOD_CLI_FORN(),
				':GARANTIA_DIAS'	=>	$this->getGARANTIA_DIAS()
			));

			$this->setData($results[0]);
		}

		# get the data maintenance
		public function get($ID_MANUTENCE){

			$sql = new Sql();

			$results = $sql->select("SELECT
										tb_manutence.*,
										tb_frota.PLACA,
										tb_frota.FABRICANTE,
										tb_frota.MODELO
									FROM tb_manutence
										INNER JOIN tb_frota
										ON tb_manutence.COD_VEICULO = tb_frota.COD_VEICULO
									WHERE tb_manutence.ID_MANUTENCE =  :ID_MANUTENCE", [
										":ID_MANUTENCE"=> $ID_MANUTENCE
									]);

			$this->setData($results[0]);
		}

		#-----------------------------------------------------------------------------------------------------
		# get the maintenance itens
		#-----------------------------------------------------------------------------------------------------
		public static function getItens($ID_MANUTENCE){

			# creater the classes
			$sql = new Sql();

			# load the data
			$results = $sql->select("call sp_manutencao_Itens_list_all(:ID_MANUTENCE)", [
										":ID_MANUTENCE" => (int)$ID_MANUTENCE
									]);
			
			# set the data
			return [
				'manutencaoItens'=>$results
			];
		}

		#-----------------------------------------------------------------------------------------------------
		# get the providers
		#-----------------------------------------------------------------------------------------------------
		public static function getFornecedores(){

			$sql = new Sql();

			$results = $sql->select("SELECT COD_CLI_FORN,
											RAZAO_SOCIAL,
											CNPJ
									 FROM tb_clientes_fornecedores
										WHERE TIPO_CADASTRO <> :TIPO_CADASTRO",[
											'TIPO_CADASTRO' => 'Clientes'
										]);

			return [
				'driver'=>$results
			];
		}

		public static function getManutencaoCavalo(){

			$sql = new Sql();

			$results = $sql->select("SELECT
										COD_VEICULO,
										PLACA,
										FABRICANTE,
										MODELO
									FROM
										tb_frota
									ORDER BY PLACA"
									);

			return [
				'manutencaoCavalo'=>$results
			];
		}

		public function delete($id_Manutencao){

			$sql = new Sql;
			
			$sql->query("CALL sp_manutencao_delete(:ID_MANUTENCE)", array(
				":ID_MANUTENCE"=>$id_Manutencao
			));
	
		}

		public function deleteItem($id_Manutencao_Item){

			$sql = new Sql;
			
			$sql->query("DELETE FROM tb_manutence_itens WHERE COD_ITEM = :COD_ITEM", array(
				":COD_ITEM"=>$id_Manutencao_Item
			));	
		}

		# pagination the site
		public static function getPage($dtDe, $dtAte, $page, $itensPerPage, $search){

			$start = ($page - 1) * $itensPerPage;

			# carrega classes for this process
			$conversor = new Converter;
			$sql = new Sql;

			# converte as datas para pesquisa no banco
			$dtDe	=	$conversor->converterDatas($dtDe);
			$dtAte	=	$conversor->converterDatas($dtAte);

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS 
					tb_manutence.ID_MANUTENCE,
					tb_manutence.DATE_MANUTENCE_START,
					tb_frota.PLACA,
					tb_frota.FABRICANTE,
					tb_frota.MODELO,
					tb_manutence.TIPO_MANUTENCAO,
					tb_manutence.STATUS
				FROM tb_manutence
					INNER JOIN tb_frota
					ON tb_manutence.COD_VEICULO = tb_frota.COD_VEICULO
				WHERE tb_manutence.DATE_MANUTENCE_FINISH BETWEEN :dataIni AND :dataFim AND CONCAT(PLACA, FABRICANTE, MODELO) LIKE :search
				ORDER BY tb_manutence.DATE_MANUTENCE_START
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
				'currentPage'=>$page

			];
		}

	}

 ?>