<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class SistemaPerfilEdita extends Model{

		public function save($valores = array(),$idLinkPerffil){

			$sql = new Sql();

			# cria o objeto cliente
			$sistemaPE = new SistemaPerfilEdita;

			#$totalRegister = intdiv(count($valores),3);
			$totalRegister = count($valores);
			for ($X=0; $X < $totalRegister; $X++){

				if($X == 0){
						$Y = 0;
				} else {
						#$Y = $X*3;
						$Y = $X;

				}
				# extrair o código de link
			  	$codPermissao = array_keys($valores)[$Y];
				$codPermissao = (int)substr($codPermissao,10,strlen($codPermissao)-10);

				# coloca os valores dos dados do formulário nas variáveis
				$COD_LINK_FORM			= $codPermissao;
				$PERMISSAO_VISUALIZAR 	= isset($_POST["visualizar".$codPermissao]) 	? strip_tags(filter_input(INPUT_POST,"visualizar".$codPermissao)) 			: 'NAO';	 
				#$PERMISSAO_INCLUIR 		= isset($_POST["cadastrar".$codPermissao]) 		? strip_tags(filter_input(INPUT_POST,"cadastrar".$codPermissao)) 		: 'NÃO';
				#$PERMISSAO_EDITAR 		= isset($_POST["editar".$codPermissao]) 		? strip_tags(filter_input(INPUT_POST,"editar".$codPermissao)) 				: 'NÃO';
			
				# coloca os dados dentro de uma array
				$dados = array(
								'COD_LINK_FORM'=>$COD_LINK_FORM,
								'PERMISSAO_VISUALIZAR'=>$PERMISSAO_VISUALIZAR#,
								#'PERMISSAO_INCLUIR'=>$PERMISSAO_INCLUIR,
								#'PERMISSAO_EDITAR'=>$PERMISSAO_EDITAR
							);
					
				$sistemaPE->upDate(array_filter($dados),(int)$COD_LINK_FORM);

			}

		}

		public function get($idPerfilAcesso){

			$conversor = new Converter;

			$sql = new Sql();

			$results = $sql->select("SELECT
			tb_perfil_formulario.COD_LINK_FORM,
			tb_formularios.Nome_Formulario,
			tb_perfil_formulario.PERMISSAO_VISUALIZAR#,
			#tb_perfil_formulario.PERMISSAO_INCLUIR,
			#tb_perfil_formulario.PERMISSAO_EDITAR
		  FROM tb_perfil_formulario
			INNER JOIN tb_formularios
			  ON tb_perfil_formulario.COD_FORM = tb_formularios.cod_Form
		  WHERE tb_perfil_formulario.COD_LINK_FORM = :idPerfilAcesso
		  ORDER BY tb_formularios.Nome_Formulario", [	
				':idPerfilAcesso'=>$idPerfilAcesso	
			
			]);

			$this->setData($results[0]);
		}

		# serach and pagination of the site
		public static function getPageSearch($idPerfilAcesso){

			$sql = new Sql;

			$results = $sql->select("SELECT
			tb_perfil_formulario.COD_LINK_FORM,
			tb_formularios.Nome_Formulario,
			tb_perfil_formulario.PERMISSAO_VISUALIZAR#,
			#tb_perfil_formulario.PERMISSAO_INCLUIR,
			#tb_perfil_formulario.PERMISSAO_EDITAR
		  FROM tb_perfil_formulario
			INNER JOIN tb_formularios
			  ON tb_perfil_formulario.COD_FORM = tb_formularios.cod_Form
		  WHERE tb_perfil_formulario.COD_PERFIL = :idPerfilAcesso
		  ORDER BY tb_formularios.Nome_Formulario",
		  	[				
				':idPerfilAcesso'=>$idPerfilAcesso				
			]);
			
			return [

				'data'=>$results
			];
		}


		# update the record
		public function upDate($sistemaPerfilEdit = array(),$idPE){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_perfil_formulario SET ";

			foreach ($sistemaPerfilEdit as $key => $value) {
				# code...
				$sql = $sql . $key . " = :" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . " WHERE COD_LINK_FORM = :COD_LINK_FORM";

			$sistemaPerfilEdit["COD_LINK_FORM"] = $idPE;
			$sqlUpdate->query($sql, $sistemaPerfilEdit);

		}

	}

 ?>