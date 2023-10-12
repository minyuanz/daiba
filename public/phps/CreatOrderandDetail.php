<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

//處裡對接錢台來的數據
$mem_id = $data->mem_id;
$cartTotal = $data->cartTotal;
$ord_name = $data->ord_name;
$ord_phone = $data->ord_phone;
$ord_email = $data->ord_email;
$ord_address = $data->ord_address;
$selectedPayment = $data->selectedPayment;
$creditCardNumber = $data->creditCardNumber;
$expirationDate = $data->expirationDate;
$securityCode = $data->securityCode;
$SelectionPointUse = $data->SelectionPointUse;
$orderDetails = $data->orderDetails;

try {
    require_once("connect_chd103g5_2.php");
    $pdo->beginTransaction();

    // echo json_encode(["1111" => "Order placement failed"]);

    // 插入訂單數據
    $sql = "INSERT INTO `orders` (mem_id, ord_price, ord_status, ord_name, ord_address, ord_phone, ord_date, ord_credit)
        VALUES (:mem_id, :ord_price, '0', :ord_name, :ord_address, :ord_phone, NOW(), :ord_credit)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":mem_id", $mem_id);
    $stmt->bindValue(":ord_price", $cartTotal);
    $stmt->bindValue(":ord_name", $ord_name);
    $stmt->bindValue(":ord_address", $ord_address);
    $stmt->bindValue(":ord_phone", $ord_phone);
    $stmt->bindValue(":ord_credit", $creditCardNumber);
    // $stmt->bindValue(":ord_email", $ord_email);
    $stmt->execute();

    $orderID = $pdo->lastInsertId();
    $sql = "INSERT INTO `orderdetail` (ord_id, prod_id, orderdetail_count, buy_price)
    VALUES (:ord_id, :prod_id, :orderdetail_count, :buy_price)";
    $stmt = $pdo->prepare($sql);
    echo json_encode(["1111" => "Order placement failed"]);

    // 插入訂單明細數據
    foreach ($orderDetails as $orderDetail) {
        $stmt->bindValue(":ord_id", $orderID);
        $stmt->bindValue(":prod_id", $orderDetail->prod_id);
        $stmt->bindValue(":orderdetail_count", $orderDetail->orderdetail_count);
        $stmt->bindValue(":buy_price", $orderDetail->buy_price);
        $stmt->execute();
    }

    $pdo->commit();
    echo json_encode(["message" => "Order placed successfully"]);
} catch (PDOException $ex) {
    $pdo->rollBack();
    echo json_encode(["error" => $ex]);
}
?>