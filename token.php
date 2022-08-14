<?php
  $api_key = 'f82b120f41067f6dc81897a273da5c3d';
  $secret_key = 'ec091ac1781140dfb20844c443eff6ad';
  $params = $_GET;
  $hmac = $params['hmac'];
  $shop_url = $params['shop'];
  $params = array_diff_key($params, array('hmac' => ''));
  ksort($params);
  
  $new_hmac = hash_hmac('sha256', http_build_query($params), $secret_key);

  if( hash_equals( $hmac, $new_hmac ) ) {
    // echo "This HMAC is Coming from Shopify.";
    $access_token_endpoints = 'https://'.$shop_url.'admin/oauth/access_token';
    $var = array(
      "client_id" => $api_key,
      "client_secret" => $secret_key,
      "code" => $params['code']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $access_token_endpoints);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($var));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
    $response = curl_exec($ch);

    curl_close($ch);
    
    $response = json_decode($response, true);

    echo($response);
    var_dump($response);

  } else {
    echo "This HMAC is not Coming from Shopify.";
  }

  // echo print_r($new_hmac);
  
?>