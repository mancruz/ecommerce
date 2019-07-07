<?php

    # this function have finallity of converter the dates bettwen data base and front and
    function converterDatas($data){
        if ($data == '') {
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

    # this function set the price in real
    function formatPrice($vlPrice = 0){

        return number_format($vlPrice, 2, ",", ".");
    
    }

    function convertDatasHorasBR($data){
        if(is_null($data)){
            
            $dataConverted = $data;

        }else{

            $dataConverted = date('d/m/Y', strtotime($data));

        }

        return $dataConverted;
    }

    # this function set the heave
    function formatPeso(float $vlPeso){

        return number_format($vlPeso, 3, ",", ".");
    
    }

    # this function set the heave
    function formatPercent(float $vlPercent){

        return number_format($vlPercent, 4, ",", ".");
    
    }
?>