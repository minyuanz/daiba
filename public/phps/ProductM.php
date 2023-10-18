<?php
header("Access-Control-Allow-Origin: *");

require_once("connect_chd103g5_2.php"); 

try {
    $sql = "SELECT * FROM product WHERE prod_status    = 1";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    $response = array('error' => true, 'msg' => '獲取產品訊息失敗: ' . $e->getMessage());
    echo json_encode($response);
}

$pdo = null;
?>