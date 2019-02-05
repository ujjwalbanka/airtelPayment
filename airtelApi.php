<?php

function impsTransaction($data) {
     
    $data->apiMode = "P";
    $data->channel = 'EXPT';
    $data->customerId = '1000011082';
    $data->externalRefNo = "R".uniqid();
    $data->feSessionId = "F".uniqid();
    $data->partnerId = "1000011082";
    $data->reference2 = (int) $data->beneMobNo;
    $data->ver = "1.0";
    $hash_data = $data->channel."#".$data->partnerId."#".$data->customerId."#".$data->amount."#".$data->ifsc."#".$data->beneAccNo."#7fabdc58";
    $hash = openssl_digest($hash_data, 'sha512');
    $data->hash= $hash;
    $curl = curl_init();

    if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    // Optional Authentication:

    curl_setopt($curl, CURLOPT_URL, 'https://apbuat.airtelbank.com:5055/payments/impsTransaction');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $result = curl_exec($curl);

    curl_close($curl);
    return $result;
}

function getLimit() {
    $data = new \stdClass();
    $data->caf = "C2A";
    $data->channel = "EXTP";
    $data->channel = 'EXPT';
    $data->customerId = '1000011082';
    $data->feSessionId = "FESESSIONID123";
    $data->partnerId = "1000011082";
    $data->ver = "1.0";
    $hash_data = $data->partnerId."#".$data->customerId."#".$data->feSessionId."#7fabdc58";
    $hash = openssl_digest($hash_data, 'sha512');
    $data->hash= $hash;
    
    $curl = curl_init();

    if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($curl, CURLOPT_URL, 'https://apbuat.airtelbank.com:5055/api/v1/sender/limit');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function checkIfsc($data) {
    $curl = curl_init();
    var_dump($data);
    if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_URL, 'https://apbuat.airtelbank.com:5055/bankhealth/ifsccode');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
