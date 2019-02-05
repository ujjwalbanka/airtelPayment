<?php
include 'airtelApi.php';

if($_POST) {
    $data = new \stdClass();
    $data->amount = (int) filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_INT);
    $data->befName = filter_var($_POST["befName"], FILTER_SANITIZE_STRING);
    $data->beneMobNo =(int) filter_var($_POST["beneMobNo"], FILTER_SANITIZE_NUMBER_INT);
    $data->bankName = filter_var($_POST["bankName"], FILTER_SANITIZE_STRING);
    $data->ifsc = filter_var($_POST["ifsc"], FILTER_SANITIZE_STRING);
    $data->beneAccNo = (int)filter_var($_POST["beneAccNo"], FILTER_SANITIZE_NUMBER_INT);
    $data->rebeneAccNo = filter_var($_POST["rebeneAccNo"], FILTER_SANITIZE_STRING);
    $data->branchName = filter_var($_POST["branchName"], FILTER_SANITIZE_STRING);
    $data->aadharCard = filter_var($_POST["aadharCard"], FILTER_SANITIZE_STRING);
    $data->address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    
    
    $apiResponse = impsTransaction($data);
  if($apiResponse) {
    $output = json_encode(array('success' => true, 'data' => json_decode($apiResponse)));
    die($output);
  } else {
    $output = json_encode(array('success' => false));
    die($output);
  }
}