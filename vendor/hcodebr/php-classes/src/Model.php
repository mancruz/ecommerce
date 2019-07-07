<?php 

	namespace Hcode;
	use \Hcode\FUNCTIONS\Converter;
use Hcode\DB\Sql;

/**
	 * 
	 */
	class Model{

		private $values = [];

		public function __call($name, $args)
		{
			$method		= substr($name, 0, 3);
			$fieldName	= substr($name, 3, strlen($name));

			switch ($method)
			{
				case "get":
					return  (isset($this->values[$fieldName])) ? $this->values[$fieldName] : 0;
				break;
				case "set":

					$this->values[$fieldName] = $args[0];

				break;


			}

		}

		public function setData($data = array()){

			foreach ($data as $key => $value) {
				
				$this->{"set".$key}($value);
			
			}
		}

		public function setDataFormat($data = array()){

			foreach ($data as $key => $value) {
				
				$verData = strstr($value, '/');

				if($verData<>false){
					
					if(strstr($verData, '/')<>false){
						
						//cria um array
						$array = explode('/',$value);
		
						//garante que o array possue tres elementos (dia, mes e ano)
						if(count($array) == 3){
							$dia = (int)$array[0];
							$mes = (int)$array[1];
							$ano = (int)$array[2];
		
							//testa se a data é válida
							if(checkdate($mes, $dia, $ano)){
		
								$conversor = new Converter;
		
								$value = $conversor->converterDatas($value);
		
							}
						}
					}
				}

				# retira ponto para tentar identificar se o valor é número
				$verNum = str_replace('.','', $value);

				if (is_numeric($verNum) <> false){

					$conversor = new Converter;

					$verNum = strstr($value, '.');

					if ($verNum <> false){

						$value = $conversor->convertPrice($value);

					}
					
				}
				
				# verifica se o valor é decimal para converter ',' por '.'	
				$verNum = strstr($value, ',');
		
				if($verNum <> false){
		
		
					$conversor = new Converter;
		
					$value = $conversor->convertPrice($value);
		
				}

				$data[$key] = ($value);
			
			}

			return $data;
		}

		public function getValues(){

			return $this->values;
		}

	}
 ?>