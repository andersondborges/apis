<?php

//fuente: http://interessespessoais.com/programacaoweb/ler-ficheiros-csv-com-a-funcao-fgetcsv/



$handle = fopen("https://p3tew145y3tag41n:zgtm5lGm@api.performancehorizon.com/reporting/export/export/conversion.csv?start_date=2016-12-18+00%3A00%3A00&end_date=" . date("Y-m-d") . "+00%3A00%3A00&publisher_id=1101l10013&statuses%5B%5D=pending", "r");

while (($datos = fgetcsv($handle, 0, ",")) !== FALSE) {
        //var_dump($datos);

        $datos[5] = substr($datos[5], 0, -9);  // conversion_date_time
        $RefId = substr($datos[10], 0, 13); //refid sin extra_data1
        $Data = substr($datos[10], 13);

        if (strstr($datos[9], 'HKD')) {
                 $datos[13] = '6d72d01c';
                 //$currency = 'HKD';
        } elseif (strstr($datos[9], 'PHP')) {
                $datos[13] = 'a13a77b3';
                 //$currency = 'PHP';           
        } elseif (strstr($datos[9], 'IDN')) {
                $datos[13] = '58d0c387';
                 //$currency = 'IDR';                   
        } elseif (strstr($datos[9], 'MYR')) {
                $datos[13] = '54ea6839';
                 //$currency = 'MYR';                   
        } elseif (strstr($datos[9], 'SGD')) {
                $datos[13] = '5de28857';
                 //$currency = 'SGD';                   
        } elseif (strstr($datos[9], 'TWD')) {
                $datos[13] = '779c9899';
                //$currency = 'TWD';                            
        }

                $postback = /*file_get_contents(*/'http://track.clickwise.net/pb?ActionCode=sale&CampaignID=' . $datos[13] . '&RefId=' . $RefId . '&OrderId=' . $datos[0] . '&TotalCost=' . $datos[22] . '&Date=' . $datos[5] . '&Currency=' . $datos[9] . '&Data=' . $Data . "\n"/*)*/;

                echo $postback;

}

?>
