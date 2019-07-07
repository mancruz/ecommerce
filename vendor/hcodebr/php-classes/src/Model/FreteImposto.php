<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class FreteImposto extends Model{


		public function save(){

			$sql = new Sql();

			$sql->select("call sp_frete_imposto_save(:COD_FRETE,:COD_IMPOSTO,:PERCENTUAL)", array(
				'COD_FRETE'		=>$this->getCOD_FRETE(),
				'COD_IMPOSTO'	=>$this->getCOD_IMPOSTO(),
				'PERCENTUAL'	=>$this->getPERCENTUAL()
			));

		}

		#========================================
		# Load the the data of forward
		public static function get($idFrete){

			$sql = new Sql;

			$results = $sql->select("SELECT
			tb_frete_imposto.COD_FRET_IMPOST,
			tb_frete_imposto.COD_FRETE,
			tb_frete_imposto.COD_IMPOSTO,
			tb_imposto.IMPOSTO,
			tb_frete_imposto.PERCENTUAL
		  FROM tb_frete_imposto
			INNER JOIN tb_imposto
			  ON tb_frete_imposto.COD_IMPOSTO = tb_imposto.COD_IMPOSTO
		  WHERE tb_frete_imposto.COD_FRETE = :idFrete", [	
				":idFrete"=> $idFrete
			
			]);

			return [
				'dataImposto'=>$results

			];
		}
		#========================================
		# GET THE RATE
		public function getImposto($idImposto){

			$sql = new Sql;

			$results = $sql->select("SELECT	*
		  FROM tb_frete_Imposto
		  WHERE COD_FRET_IMPOST = :idImposto", [	
				":idImposto"=> $idImposto
			
			]);
			
			$this->setData($results[0]);
		}
		#========================================

		public static function getImpostoCategorias(){

			$sql = new Sql();

			$results = $sql->select("SELECT * from tb_imposto;");

			return [
				'ImpostoCategoria'=>$results
			];
		}

		public function delete(){

			$sql = new Sql;
			
			$sql->query("CALL sp_frete_imposto_delete(:id_Imposto)", array(
				":id_Imposto"=>$this->getCOD_FRET_IMPOST()
			));
	
		}




	}

 ?>