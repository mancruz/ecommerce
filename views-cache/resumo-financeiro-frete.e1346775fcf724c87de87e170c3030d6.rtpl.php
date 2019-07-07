<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>Relatório</title>
        <style>
        .header,
        .footer {
            width: 100%;
            text-align: center;
            
        }
        .header {
            top: 0px;
        }
        .footer {
            bottom: 0px;
        }
        .pagenum:before {
            content: counter(page);
        }
        body{
            
            font-size: 10px;
        }
        .folha {
            page-break-after: always;
        }
        table.tableBorder{
            
            border: 1px solid ;
            
        }
        th{
            text-align: center;   
        }
        td{
            text-align: center;   
        }
        </style>
    </head>
    <body>
    <div class='header folha'>
            <table width='100%'>
                <tr>
                    <td>
                        <img border='0' src='C:/wamp64/www/ecommerce/res/admin/material/assets/img/Logo.png' width='100' height='100'><br>
                        <font size='4'> Relatório de Frete</font>
                    </td>
    
                </tr>
    
            </table> <hr>

    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Data Chegada</th>
                <th>Id</th>
                <th>Cliente</th>
                <th>Motorista</th>
                <th class="text-right">Valor Bruto</th>
                <th class="text-right">Despesa</th>
                <th class="text-right">Motorista</th>
                <th class="text-right">Imposto</th>
                <th class="text-right">Resultado</th>
                <th class="text-right">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter1=-1;  if( isset($dados) && ( is_array($dados) || $dados instanceof Traversable ) && sizeof($dados) ) foreach( $dados as $key1 => $value1 ){ $counter1++; ?>
            <tr>
                <td class="text-center"><?php echo convertDatasHorasBR($value1["DATA_CHEGADA"]); ?></td>
                <td><?php echo htmlspecialchars( $value1["COD_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["RAZAO_SOCIAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td class="text-right"><?php echo formatPrice($value1["TOTAL_BRUTO"]); ?></td>
                <td class="text-right"><?php echo formatPrice($value1["TOTAL_DESPESAS"]); ?></td>
                <td class="text-right"><?php echo formatPrice($value1["TOTAL_MOTORISTA"]); ?></td>
                <td class="text-right"><?php echo formatPrice($value1["TOTAL_IMPOSTOS"]); ?></td>
                <td class="text-right"><?php echo formatPrice($value1["RESULTADO"]); ?></td>
                <td class="text-right"><?php echo formatPrice($value1["SALDO"]); ?></td>
                TOTAL_SALDO
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
                <tr style="font-weight: bolder">
                        <td colspan="4" font size="7">TOTAL</td>
                        <td class="text-right"><?php echo formatPrice($TOTAL_BRUTO); ?></td>
                        <td class="text-right"><?php echo formatPrice($TOTAL_DESPESAS); ?></td>
                        <td class="text-right"><?php echo formatPrice($TOTAL_MOTORISTA); ?></td>
                        <td class="text-right"><?php echo formatPrice($TOTAL_IMPOSTOS); ?></td>
                        <td class="text-right"><?php echo formatPrice($TOTAL_RESULTADO); ?></td>
                        <td class="text-right"><?php echo formatPrice($TOTAL_SALDO); ?></td>
                        
                </tr>  
        </tfoot>
    </table>
    <div class='footer'>
        <hr><table class='table'>
                        <tr>
                            <td>
                                $dataHoje
                            </td>
                            <td align='right'>
                                $horaHoje
                            </td>
                        </tr>
                    </table>
                    </div>

  </body>
</html>