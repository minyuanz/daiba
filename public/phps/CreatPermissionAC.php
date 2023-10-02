<?php
require_once("connect_chd103g5_2.php"); 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    // 获取帐号和密码
    $admin_acc = $_POST['admin_acc'];
    $admin_pas = $_POST['admin_pas'];
    
    // 设置默认的管理等级
    $admin_lv = "管理員";

    $sql = "INSERT INTO admin (admin_acc, admin_pas, admin_lv) VALUES (:admin_acc, :admin_pas, :admin_lv)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':admin_acc', $admin_acc);
    $stmt->bindParam(':admin_pas', $admin_pas);
    $stmt->bindParam(':admin_lv', $admin_lv);

    $stmt->execute();

    // 成功的响应
    $response = array('error' => false, 'msg' => '新增管理員成功');
    echo json_encode($response);
} catch (PDOException $e) {
    // 错误的响应
    $response = array('error' => true, 'msg' => '新增管理員失敗: ' . $e->getMessage());
    echo json_encode($response);
}
?>