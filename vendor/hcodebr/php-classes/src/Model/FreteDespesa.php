<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class FreteDespesa extends Model{


		public function save(){

			$sql = new Sql();

			$sql->select("call sp_frete_despesa_save(:COD_FRETE,:COD_DESP_FRET_CAT,:VALOR)", array(
				'COD_FRETE'			=>$this->getCOD_FRETE(),
				'COD_DESP_FRET_CAT'	=>$this->getCOD_DESP_FRET_CAT(),
				'VALOR'				=>$this->getVALOR()
			));

		}

		#========================================
		# pagination the site
		public static function get($idFrete){

			$sql = new Sql;

			$results = $sql->select("SELECT
			tb_frete_despesa.COD_DESPESA,
			tb_frete_despesa.COD_FRETE,
			tb_frete_despesa.COD_DESP_FRET_CAT,
			tb_frete_desp_cat.DESPESA,
			tb_frete_despesa.VALOR
		  FROM tb_frete_despesa
			INNER JOIN tb_frete_desp_cat
			  ON tb_frete_despesa.COD_DESP_FRET_CAT = tb_frete_desp_cat.COD_DESP_FRET_CAT
		  WHERE tb_frete_despesa.COD_FRETE = :idFrete", [	
				":idFrete"=> $idFrete
			
			]);

			return [
				'dataDespesa'=>$results

			];
		}
		#========================================
		# GET THE DESPESA
		public function getDespesa($idDespesa){

			$sql = new Sql;

			$results = $sql->select("SELECT	*
		  FROM tb_frete_despesa
		  WHERE COD_DESPESA = :idDespesa", [	
				":idDespesa"=> $idDespesa
			
			]);
			
			$this->setData($results[0]);
		}
		#========================================

		public static function getDespesaCategorias(){

			$sql = new Sql();

			$results = $sql->select("SELECT * from tb_frete_desp_cat;");

			return [
				'despesaCategoria'=>$results
			];
		}

		public function delete(){

			$sql = new Sql;
			
			$sql->query("CALL sp_frete_despesa_delete(:id_Despesa)", array(
				":id_Despesa"=>$this->getCOD_DESPESA()
			));
	
		}




	}

 ?>