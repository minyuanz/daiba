<?php
header("Access-Control-Allow-Origin:*");

// header("Content-Type: application/json");


try {
    // 連接資料庫
    require_once("connect_chd103g5_2.php");
    // sql指令
	$sql = "SELECT e.*, d.mem_name,d.mem_id FROM article e
    LEFT JOIN member d ON e.mem_id = d.mem_id;" ;
    // 
    $news = $pdo->query( $sql );
    $result=$news->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>