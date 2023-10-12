<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once("connect_chd103g5_2.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->art_no, $data->art_status)) {
        $art_no = $data->art_no;
        $art_status = $data->art_status;

        $sql = "UPDATE article SET art_status = :art_status WHERE art_no = :art_no";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':art_status', $art_status, PDO::PARAM_STR);
        $stmt->bindParam(':art_no', $art_no, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "msg" => "更新失败");
        }
    } else {
        $response = array("success" => false, "msg" => "參數 art_no 和 art_status 遺失");
    }
} else {
    header('HTTP/1.1 200 OK');
}

echo json_encode($response);
?>