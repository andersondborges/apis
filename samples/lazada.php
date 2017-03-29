<?php

	$date = date( "Y-m-d" );
	$ayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $date ) ) );    
    
    // Specify API URL
    define('HASOFFERS_API_URL', 'https://api.hasoffers.com/Apiv3/json');
 
    // Specify method arguments
    $args = array(
        'NetworkId' => 'lazada',
        'Target' => 'Affiliate_Report',
        'Method' => 'getConversions',
        'api_key' => 'a4b20138d73c8683fa59bcff83dbe9bacb37b482ec98f19fdf4c4f9dc885fdce',
        'limit' => '0',        
        'fields' => array(
            'Stat.ad_id',
            'Stat.affiliate_info1',
            'Stat.affiliate_info2', //subid2            
            'Stat.currency',
            'Stat.sale_amount',
            'Stat.approved_payout',
            'Stat.date',
            'Stat.id'            
        ),
        'filters' => array(
            'Stat.date' => array(
                'conditional' => 'BETWEEN',
                'values' => array(
                    $ayer,
                    $date
                )
            )
        )
    );
 
    // Initialize cURL
    $curlHandle = curl_init();
 
    // Configure cURL request
    curl_setopt($curlHandle, CURLOPT_URL, HASOFFERS_API_URL . '?' . http_build_query($args));
 
    // Make sure we can access the response when we execute the call
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
 
    // Execute the API call
    $jsonEncodedApiResponse = curl_exec($curlHandle);
 
    // Ensure HTTP call was successful
    if($jsonEncodedApiResponse === false) {
        throw new \RuntimeException(
            'API call failed with cURL error: ' . curl_error($curlHandle)
        );
    }
 
    // Clean up the resource now that we're done with cURL
    curl_close($curlHandle);
 
    // Decode the response from a JSON string to a PHP associative array
    $apiResponse = json_decode($jsonEncodedApiResponse, true);
 
    // Make sure we got back a well-formed JSON string and that there were no
    // errors when decoding it
    $jsonErrorCode = json_last_error();
    if($jsonErrorCode !== JSON_ERROR_NONE) {
        throw new \RuntimeException(
            'API response not well-formed (json error code: ' . $jsonErrorCode . ')'
        );
    }
 
    // Print out the response details
		  if($apiResponse['response']['status'] === 1) {
     	$campaignid = '';
        // No errors encountered
        /*echo 'API call successful';       
        echo 'Response Data: ' . print_r($apiResponse['response']['data'], true);
        echo PHP_EOL; 
        echo $apiResponse['date']; */
        
        //var_dump($apiResponse);
       
        /* Funcion para formar postback */
        
        function postback() {
        	    global $CampaignID;
        			global $Comission;
        			global $TotalCost; 
        			global $RefID; 
        			global $OrderID; 
        			global $Date; 
        			global $Currency; 
        			global $ExtraData; 
        	
        	return $postback = "http://track.clickwise.net/pb?ActionCode=sale&CampaignID=$CampaignID&RefId=$RefID&OrderId=$OrderID&TotalCost=$TotalCost&Date=$Date&Comission=$Comission&Currency=$Currency&ExtraData=$ExtraData"; 
       
       }
        
         
        $i = count($apiResponse["response"]["data"]["data"]);
        for ($j = 0; $j < $i; $j++) {
        
        
                /* Variables */
        $RefID = $apiResponse["response"]["data"]["data"][$j]["Stat"]["affiliate_info1"]; 
        $OrderID = $apiResponse["response"]["data"]["data"][$j]["Stat"]["ad_id"] . "-" . $apiResponse["response"]["data"]["data"][$j]["Stat"]["id"]; 
        $Date = $apiResponse["response"]["data"]["data"][$j]["Stat"]["date"]; 
        $Currency = $apiResponse["response"]["data"]["data"][$j]["Stat"]["currency"]; 
        $ExtraData = $apiResponse["response"]["data"]["data"][$j]["Stat"]["affiliate_info2"];
        

        		
        	  	//Philippines
        		if (strstr($apiResponse['response']['data']['data'][$j]['Stat']['currency'], 'PHP')) {
        			$CampaignID = '22def9e9';
        			$Comission = $apiResponse["response"]["data"]["data"][$j]["Stat"]["approved_payout@PHP"];
        			$TotalCost = $apiResponse["response"]["data"]["data"][$j]["Stat"]["sale_amount@PHP"]; 
    	   			echo postback() . "\n";
        			
        			//Indonesia
        		} elseif (strstr($apiResponse['response']['data']['data'][$j]['Stat']['currency'], 'IDR')) {
        			$CampaignID = '28cdd034';
        			$Comission = $apiResponse["response"]["data"]["data"][$j]["Stat"]["approved_payout@IDR"];
        			$TotalCost = $apiResponse["response"]["data"]["data"][$j]["Stat"]["sale_amount@IDR"]; 
         			echo postback() . "\n";
        		
        			//Vietnam
        		} elseif (strstr($apiResponse['response']['data']['data'][$j]['Stat']['currency'], 'VND')) {
        			$CampaignID = '7b52d2d3';
        			$Comission = $apiResponse["response"]["data"]["data"][$j]["Stat"]["approved_payout@VND"];
        			$TotalCost = $apiResponse["response"]["data"]["data"][$j]["Stat"]["sale_amount@VND"]; 
         			echo postback() . "\n";
        		
							//Malaysia        		
        		} elseif (strstr($apiResponse['response']['data']['data'][$j]['Stat']['currency'], 'MYR')) {
        			$CampaignID = '9640e846';
        			$Comission = $apiResponse["response"]["data"]["data"][$j]["Stat"]["approved_payout@MYR"];
        			$TotalCost = $apiResponse["response"]["data"]["data"][$j]["Stat"]["sale_amount@MYR"]; 
         			echo postback() . "\n";        			
        		
							//Thailand        		
        		} elseif (strstr($apiResponse['response']['data']['data'][$j]['Stat']['currency'], 'THB')) {
        			$CampaignID = 'c2a7bde2';
        			$Comission = $apiResponse["response"]["data"]["data"][$j]["Stat"]["approved_payout@THB"];
        			$TotalCost = $apiResponse["response"]["data"]["data"][$j]["Stat"]["sale_amount@THB"]; 
         			echo postback() . "\n";        			
        		        		
        			//Singapore
        		} elseif (strstr($apiResponse['response']['data']['data'][$j]['Stat']['currency'], 'SGD')) {
        			$CampaignID = 'ef90a565';
        			$Comission = $apiResponse["response"]["data"]["data"][$j]["Stat"]["approved_payout@SGD"];
        			$TotalCost = $apiResponse["response"]["data"]["data"][$j]["Stat"]["sale_amount@SGD"]; 
         			echo postback() . "\n";        			
        		}
    		}	
     }
     
    else {
        // An error occurred
        echo 'API call failed (' . $apiResponse['response']['errorMessage'] . ')';
        echo PHP_EOL;
        echo 'Errors: ' . print_r($apiResponse['response']['errors'], true);
        echo PHP_EOL;
    }
?>
