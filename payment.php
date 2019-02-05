<?php
include 'airtelApi.php';

function storeToDb($userId, $transId) {

  $servername = "localhost";
  $database = "oiw";
  $username = "root";
  $password = "Password!23";

  $conn = mysqli_connect($servername, $username, $password, $database);

  // Check connection

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  echo "Connected successfully";
  
  $sql = "insert into `agent_register_trans` (`agent_id`,`trans_id`) VALUES ('".$userId."', '".$transId."')";
  if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  mysqli_close($conn);
}

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
    $data->reference1 = isset($_POST["reference1"]) ? filter_var($_POST["reference1"], FILTER_SANITIZE_STRING) : 'AGENTID1';
    $data->userId = isset($_POST["userId"]) ? filter_var($_POST["userId"], FILTER_SANITIZE_STRING) : 'null';
    
    $apiResponse = json_decode(impsTransaction($data));
    storeToDb($data->userId, $apiResponse->tranId);
  if($apiResponse) {
    $output = json_encode(array('success' => true, 'data' => $apiResponse));
    die($output);
  } else {
    $output = json_encode(array('success' => false));
    die($output);
  }
}