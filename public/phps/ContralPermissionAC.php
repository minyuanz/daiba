<?php
header("Access-Control-Allow-Origin: *");
require_once("connect_chd103g5_2.php");
$admin_id = $_POST['admin_id']; //對接用管理員ID
$admin_sich = $_POST['admin_sich']; 

$sql = "UPDATE admins SET admin_sich = '$admin_sich' WHERE admin_id = '$admin_id'";

if ($conn->query($sql) === TRUE) {

  $response = array("success" => true);
  echo json_encode($response);
} else {

  $response = array("success" => false);
  echo json_encode($response);
}

$conn->close();
?>