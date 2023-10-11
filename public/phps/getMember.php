<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

// header("Content-Type: application/json");


try {
    // 連接資料庫
    require_once("connect_chd103g5_2.php");
    // sql指令
	$sql = "select * from member";
    // 
    $member = $pdo->query( $sql );
    $result=$member->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>