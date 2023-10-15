<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


if (isset($_POST['orderId']) && isset($_POST['newStatus'])) {
    $orderId = $_POST['orderId'];
    $newStatus = $_POST['newStatus'];

    require_once("connect_chd103g5_2.php");
    // 更新訂單的狀態
    $query = "UPDATE orders SET ord_status = :newStatus WHERE ord_id = :orderId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => '訂單狀態已更新'));
    } else {
        echo json_encode(array('error' => true, 'message' => '訂單狀態更新失敗'));
    }
} else {
    echo json_encode(array('error' => true, 'message' => '缺少參數'));
}

?>

