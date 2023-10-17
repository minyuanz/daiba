<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("connect_chd103g5_2.php");

try {
    $sql = "SELECT sta_name FROM mrtstation"; 
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    $response = array('error' => true, 'msg' => '获取捷运站信息失败: ' . $e->getMessage());
    echo json_encode($response);
}

$pdo = null;
?>