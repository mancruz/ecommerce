<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class FreteDeposito extends Model{


		public function save(){

			$sql = new Sql();

			$sql->query("call sp_frete_deposito_save(:COD_FRETE,:DATA_DEPOSITO,:VALOR,:OBS)", array(
				'COD_FRETE'		=>$this->getCOD_FRETE(),
				'DATA_DEPOSITO'	=>$this->getDATA_DEPOSITO(),
				'VALOR'			=>$this->getVALOR(),
				'OBS'			=>$this->getOBS()
			));

		}

		#========================================
		# Load the the data of forward
		public static function get($idFrete){

			$sql = new Sql;

			$results = $sql->select("SELECT *
									FROM tb_frete_deposito
									WHERE COD_FRETE = :idFrete
									ORDER BY DATA_DEPOSITO", [	
											":idFrete"=> $idFrete										
											]);

			return [
				'dataDeposito'=>$results

			];
		}
		#========================================
		# GET THE DEPOSIT
		public function getDeposito($idDeposito){

			$sql = new Sql;

			$results = $sql->select("SELECT	*
		  FROM tb_frete_deposito
		  WHERE COD_DEPOSITO = :idDeposito", [	
				":idDeposito"=> $idDeposito
			
			]);
			
			$this->setData($results[0]);
		}
		#========================================

		public function delete(){

			$sql = new Sql;
			
			$sql->query("CALL sp_frete_deposito_delete(:COD_DEPOSITO)", array(
				":COD_DEPOSITO"=>$this->getCOD_DEPOSITO()
			));
	
		}




	}

 ?>