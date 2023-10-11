<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once("connect_chd103g5_2.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 解析json數據
    $data = json_decode(file_get_contents("php://input"));

    // 檢查數據
    if (isset($data->prod_id, $data->prod_status)) {
        $prod_id = $data->prod_id;
        $prod_status = $data->prod_status;

        $sql = "UPDATE product SET prod_status = :prod_status WHERE prod_id = :prod_id";
        $stmt = $pdo->prepare($sql); 
        $stmt->bindParam(':prod_status', $prod_status, PDO::PARAM_STR);
        $stmt->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
        $stmt->execute();

        // 檢查是否更新成功
        if ($stmt->rowCount() > 0) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "msg" => "商品狀態更新失敗");
        }
    } else {
        $response = array("success" => false, "msg" => "參數 prod_id 和 prod_status 遺失");
    }
} else {
    header('HTTP/1.1 200 OK');
}

echo json_encode($response);
?>