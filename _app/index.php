<?php

  // Get helper functions
  require_once("app_functions.php");

  // Set variables for our request
  require_once("../../credentials/credentials-gather.php");
  $query = array("Content-type" => "application/json"); // Tell Shopify that we're expecting a response in JSON format

  // Get values for array from submitted register form
  $customer = $_POST['email'];
  $variant = $_POST['variant'];

  $date = $_POST['date'];
  $time = $_POST['time'];
  $location = $_POST['location'];
  $address = $_POST['address'];

  $array_string = '{"order":{"email":"' . $customer . '","note_attributes":[{"name":"date","value":"' . $date . '"},{"name":"time","value":"' . $time . '"},{"name":"location","value":"' . $location . '"},{"name":"address","value":"' . $address . '"}],"fulfillment_status":"fulfilled","send_receipt":true,"send_fulfillment_receipt":false,"inventory_behaviour":"decrement_obeying_policy","line_items":[{"variant_id":' . $variant . ',"quantity":1}]}}';

  $order = shopify_call($token, $shop, "/admin/orders.json", $array_string, 'POST');

  // if successful
  header("Location:https://[store_handle].com/pages/registration-confirmation");
  die();

?>
