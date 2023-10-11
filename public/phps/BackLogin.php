<?php
require_once("connect_chd103g5_2.php"); 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


try {
    $admin_acc = $_POST['adminId'];
    $admin_pas = $_POST['adminPwd'];
    $sql = "SELECT * FROM admin WHERE admin_acc = :admin_acc AND admin_pas = :admin_pas AND admin_sich = 1";//admin_sich違停權與否
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':admin_acc', $admin_acc);
    $stmt->bindParam(':admin_pas', $admin_pas);
    $stmt->execute();

    // 檢查回傳的資料是否為正確的帳號密碼
    if ($stmt->rowCount() > 0) {
        $response = array('success' => true, 'msg' => '登入成功');
    } else {
        // 查詢是否停權並顯示
        $sqlCheckSich = "SELECT * FROM admin WHERE admin_acc = :admin_acc AND admin_sich = 0";
        $stmtCheckSich = $pdo->prepare($sqlCheckSich);
        $stmtCheckSich->bindParam(':admin_acc', $admin_acc);
        $stmtCheckSich->execute();

        if ($stmtCheckSich->rowCount() > 0) {
            $response = array('success' => false, 'msg' => '此帳號已經停權');
        } else {
            $response = array('success' => false, 'msg' => '登入失敗請檢察帳號密碼');
        }
    }

    echo json_encode($response);
} catch (PDOException $e) {
    $response = array('error' => true, 'msg' => '登入失敗: ' . $e->getMessage());
    echo json_encode($response);
}
?>