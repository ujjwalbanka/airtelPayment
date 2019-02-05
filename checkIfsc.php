<?php
include 'airtelApi.php';

if($_POST) {
    $data = new \stdClass();
    $data->ifsccode = filter_var($_POST["ifsc"], FILTER_SANITIZE_STRING);
    $apiResponse = checkIfsc($data);
  if($apiResponse) {
    $output = json_encode(array('success' => true, 'data' => json_decode($apiResponse)));
    die($output);
  } else {
    $output = json_encode(array('success' => false));
    die($output);
  }
}