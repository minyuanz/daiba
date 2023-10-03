<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once("connect_chd103g5_2.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->admin_id, $data->admin_sich)) {
        $admin_id = $data->admin_id;
        $admin_sich = $data->admin_sich;

        $sql = "UPDATE admin SET admin_sich = :admin_sich WHERE admin_id = :admin_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':admin_sich', $admin_sich, PDO::PARAM_STR);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "msg" => "更新失败");
        }
    } else {
        $response = array("success" => false, "msg" => "参数 admin_id 和 admin_sich 缺失");
    }
} else {
    header('HTTP/1.1 200 OK');
}

//輸出json響應
echo json_encode($response);
?>