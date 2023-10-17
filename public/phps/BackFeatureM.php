<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("connect_chd103g5_2.php"); 

try {
    $sql = "SELECT * FROM  special ";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    $response = array('error' => true, 'msg' => '獲取訊息失敗: ' . $e->getMessage());
    echo json_encode($response);
}
$pdo = null;
?>
