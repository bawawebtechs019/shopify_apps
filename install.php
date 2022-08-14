<?php
  echo "Hello User! <br>";
  $_API_KEY = 'f82b120f41067f6dc81897a273da5c3d';
  $_NGROK_URL = 'https://c8f0-59-89-159-144.in.ngrok.io';
  $shop = $_GET['shop'];
  $scopes = 'read_products';
  // $scopes = 'read_products,write_products,read_order,write_orders';
  $redirect_uri = $_NGROK_URL.'/shopify/token.php';
  $nonce = bin2hex( random_bytes( 12 ) );
  $access_mode = 'per-user';
  
  $OAuth_url = 'https://'.$shop.'/admin/oauth/authorize?client_id='.$_API_KEY.'&scope='.$scopes.'&redirect_uri='.$redirect_uri.'&state='.$nonce.'&grant_options[]='.$access_mode;
  // https://{shop}.myshopify.com/admin/oauth/authorize?client_id={api_key}&scope={scopes}&redirect_uri={redirect_uri}&state={nonce}&grant_options[]={access_mode}



  // echo $shop;
  
  header("location: ".$OAuth_url);
  exit();
?>