<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("connect_chd103g5_2.php"); 

// 獲取前台來的id並驗正
$memberId = filter_var($_GET['memberId'], FILTER_VALIDATE_INT);
if ($memberId === false) {
    $response = array('error' => true, 'msg' => '無效的會員 ID');
    echo json_encode($response);
} else {
    try {   
        $sql = "SELECT * FROM orders WHERE mem_id = :memberId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result);
    } catch (PDOException $e) {
        $response = array('error' => true, 'msg' => '數據查詢失敗: ' . $e->getMessage());
        echo json_encode($response);
    }
}

$pdo = null;
?>