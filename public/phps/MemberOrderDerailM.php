<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("connect_chd103g5_2.php"); 
// 接受前台來的  會員id
if (isset($_GET['orderId'])) {
    $orderId = intval($_GET['orderId']);

    // 用明細join 產品 然後帶出圖片 跟名字
    $query = "SELECT od.prod_id, od.orderdetail_count, od.buy_price, p.prod_name, p.prod_img1
        FROM orderdetail od
        JOIN product p ON od.prod_id = p.prod_id
        WHERE od.ord_id = :orderId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($orderDetails);
    } else {
        echo json_encode(array('error' => true, 'message' => 'Failed to fetch order details'));
    }
} else {
    echo json_encode(array('error' => true, 'message' => 'Order ID not provided'));
}
?>