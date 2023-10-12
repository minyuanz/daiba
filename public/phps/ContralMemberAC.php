<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once("connect_chd103g5_2.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->mem_id, $data->mem_status)) {
        $mem_id = $data->mem_id;
        $mem_status = $data->mem_status;

        $sql = "UPDATE member SET mem_status = :mem_status WHERE mem_id = :mem_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mem_status', $mem_status, PDO::PARAM_STR);
        $stmt->bindParam(':mem_id', $mem_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "msg" => "更新失敗");
        }
    } else {
        $response = array("success" => false, "msg" => "参数 mem_id 和 mem_status 遺失");
    }
} else {
    header('HTTP/1.1 200 OK');
}

//輸出json響應
echo json_encode($response);
?>