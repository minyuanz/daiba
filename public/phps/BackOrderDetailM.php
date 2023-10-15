<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("connect_chd103g5_2.php"); 
if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

    $sql = "SELECT o.*, od.prod_id, od.orderdetail_count, od.buy_price, p.prod_name, p.prod_img1
            FROM orders o
            JOIN orderdetail od ON o.ord_id = od.ord_id
            JOIN product p ON od.prod_id = p.prod_id
            WHERE o.ord_id = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $orderData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($orderData);
    } else {
        echo json_encode(array('error' => true, 'message' => 'Failed to fetch order details'));
    }
} else {
    echo json_encode(array('error' => true, 'message' => 'Order ID not provided'));
}

$pdo = null;
?>