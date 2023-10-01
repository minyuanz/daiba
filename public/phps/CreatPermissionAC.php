<?php
require_once("connect_chd103g5_2.php"); 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    //獲取密碼
    $admin_acc = $_POST['admin_acc'];
    $admin_pas = $_POST['admin_pas'];
    $sql = "INSERT INTO admin (admin_acc, admin_pas) VALUES (:admin_acc, :admin_pas)";


    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':admin_acc', $admin_acc);
    $stmt->bindParam(':admin_pas', $admin_pas);


    $stmt->execute();

    // 成功的回應
    $response = array('error' => false, 'msg' => '新增管理員成功');
    echo json_encode($response);
} catch (PDOException $e) {
    // 錯誤的回應
    $response = array('error' => true, 'msg' => '新增管理員失敗: ' . $e->getMessage());
    echo json_encode($response);
}
?>