<?php

    namespace Hcode\FUNCTIONS;

    class Converter {

        public function converterDatas($data){

            if ($data == '' || $data =="//") {
				$data = null;
			}
			else
			{
                if(count(explode("/",$data)) > 1){

                    $data = implode("-",array_reverse(explode("/",$data)));

                }elseif(count(explode("-",$data)) > 1){
                    
                    $data = implode("/",array_reverse(explode("-",$data)));
                }
            }
           

            return $data;
        }

        public function convertPrice($price){

            $source = array('.',',');
            $replace = array('','.');

            if ($price <> NULL) {
                # code...
                $valor = str_replace($source,$replace,$price);
            } else{

                $valor = NULL;
            }
            

            return $valor;

        }

    }