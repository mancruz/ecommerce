<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class DashBoard extends Model{


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

		# get the information about freith month
		public static function getFreteCharts($ANO){
			# stance about sql library
			$sql = new Sql;

			# get the volume of frota
			$totalFreteCruzado = $sql->select("call sp_frete_cruzado_totais(:ANO)",array(
										':ANO'=>$ANO	
			));

			$totalResultadoMes = $sql->select("call sp_frete_cruzado_resultado(:ANO)",array(
				':ANO'=>$ANO	
			));

			return [
				'totalFreteCruzado' =>	$totalFreteCruzado,
				'totalResultadoMes' =>	$totalResultadoMes
			];

		}

		# pagination the site
		public static function getDataDashBoard(){

			$sql = new Sql;

			# get the volume of frota
			$totalFrota = $sql->select("SELECT
										COUNT(tb_frota.COD_VEICULO) AS TotalFrota
									FROM tb_frota");

			# get the volume of costumer
			$totalCliente = $sql->select("SELECT
											COUNT(COD_CLI_FORN) AS QtdClientes
		  								  FROM tb_clientes_fornecedores
											WHERE TIPO_CADASTRO <> 'Fornecedor'");
											
			$totalFreteMes = $sql->select("SELECT
											COUNT(COD_FRETE) AS QtdeFreteMes
										FROM tb_frete
										WHERE DATE_FORMAT(DATA_CHEGADA, '%m%Y') = DATE_FORMAT(NOW(), '%m%Y')
										GROUP BY DATA_CHEGADA");
			
			# get the totals about frete
			$totalFreteMensal = $sql->select("SELECT
													DATE_FORMAT(tb_frete.DATA_SAIDA, '%M') AS Mes,
													COUNT(IF(tb_frete.STATUS = 'EM PROCESSO', tb_frete.COD_FRETE, NULL)) AS `Em Processo`,
													COUNT(IF(tb_frete.STATUS = 'Cancelado', tb_frete.COD_FRETE, NULL)) AS Cancelado,
													COUNT(IF(tb_frete.STATUS = 'ConcluÃ­do', tb_frete.COD_FRETE, NULL)) AS Concluido
												FROM tb_frete
												WHERE DATE_FORMAT(tb_frete.DATA_SAIDA, '%Y') = DATE_FORMAT(NOW(), '%Y')
												GROUP BY 1");
			return [
				'TotalFrota'=>$totalFrota[0],
				'TotalClientes'=>$totalCliente[0],
				'TotalFrete'=>(isset($totalFreteMes[0]) ? $totalFreteMes[0] : 0), 
				'TotalFreteMensal'=>(isset($totalFreteMensal[0]) ? $totalFreteMensal[0] : 0) 
			];
		}

		# serach and pagination of the site
		public static function getResumoFrete($dataDe, $dataAte, $search){

			$sql = new Sql;
			$conversor = new Converter;

			# Format the datas
			$dataDe	= $conversor->converterDatas($dataDe);
			$dataAte 	= $conversor->converterDatas($dataAte);

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM c_frete_calculado_completo
				WHERE DATA_CHEGADA BETWEEN :DtDe AND :DtAte AND CONCAT(nome_func, LOCAL_CHEGADA,RAZAO_SOCIAL) LIKE :search AND c_frete_calculado_completo.STATUS <> 'CANCELADO'
				ORDER BY DATA_CHEGADA;
			
			", [
				':DtDe'		=> 	$dataDe,
				':DtAte'	=> 	$dataAte,
				':search'	=>	'%'.$search.'%'
			]);

			$resultadoTotal = $sql->select("SELECT FOUND_ROWS() AS nrTotal;");
			
			$results_Totais = $sql->select("call sp_frete_total_filtro(:dtDe, :dtAte)", array(
				":dtDe"		=>	$dataDe,
				":dtAte"	=>	$dataAte
			));

			return [
				'data'=>$results,
				'total'=>(int)$resultadoTotal[0]['nrTotal'],
				'totais'=>$results_Totais[0]
			];
		}

	}

 ?>