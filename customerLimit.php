<?php
include 'airtelApi.php';

if($_POST) {
    $apiResponse = getLimit();
  if($apiResponse) {
    $output = json_encode(array('success' => true, 'data' => json_decode($apiResponse)));
    die($output);
  } else {
    $output = json_encode(array('success' => false));
    die($output);
  }
}