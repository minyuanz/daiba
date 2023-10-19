<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("connect_chd103g5_2.php"); 
// phpinfo();
// exit();

try {
    // sql指令
	$sql = "select * from mrtstation";
    // 
    $mrt = $pdo->query( $sql );
    $result=$mrt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);

}  catch (PDOException $e) {
    $response = array('error' => true, 'msg' => '獲取管理員數據失敗: ' . $e->getMessage());
    echo json_encode($response);
}

// 關閉連接
$pdo = null;
?>