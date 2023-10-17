<?php
header("Access-Control-Allow-Origin: *");

require_once("connect_chd103g5_2.php"); 

try {
    $sql = "SELECT article.*, member.mem_name, member.mem_img
    FROM article
    INNER JOIN member ON article.mem_id = member.mem_id;";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    $response = array('error' => true, 'msg' => '獲取投稿數據失敗: ' . $e->getMessage());
    echo json_encode($response);
}

$pdo = null;
?>