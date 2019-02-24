<?php
require_once("app_functions.php");


// Set variables for our request
$shop = "[store_handle]"; // Shop handle
$api_key = "[api_key]"; // API key
$shared_secret = "[api_secret_key]"; // API secret key
$code = $_GET["code"];
$timestamp = $_GET["timestamp"];
$signature = $_GET["signature"];

// Compile signature data
$signature_data = $shared_secret . "code=" . $code . "shop=". $shop . ".myshopify.comtimestamp=" . $timestamp;

$query = array(
  "Content-type" => "application/json", // Tell Shopify that we're expecting a response in JSON format
  "client_id" => $api_key, // Your API key
  "client_secret" => $shared_secret, // Your app credentials (secret key)
  "code" => $code // Grab the access key from the URL
);

// Call our Shopify function
$shopify_response = shopify_call(NULL, $shop, "/admin/oauth/access_token", $query, 'POST');

// Convert response into a nice and simple array
$shopify_response = json_decode($shopify_response['response'], TRUE);

//echo var_dump($shopify_response);
// Store the response
$token = $shopify_response['access_token'];

// Show token (DO NOT DO THIS IN YOUR PRODUCTION ENVIRONMENT)
echo "Token: " . $token;

?>
