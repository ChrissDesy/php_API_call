<?php

    //declare variables
    $url = 'https://api.demo.sitehost.co.nz';
    $apiKey = 'd17261d51ff7046b760bd95b4ce781ac';
    $clientId = '293785';
    $customer = '293785';

    // initialise curl
    $curl = curl_init();

    // create link with credentials
    $mainLink = $url. '/1.0/srs/list_domains.json?customer='.$customer.'&client_id='.$clientId.'&apikey='.$apiKey;

    // add options
    curl_setopt($curl, CURLOPT_URL, $mainLink);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // execute request
    $resp = curl_exec($curl);
    curl_close($curl);

    // dump result
    var_dump($resp);

    
    // NOTE:  Cannot retrieve list of items due to location constrain on apiKey.

?>
