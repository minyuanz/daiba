<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

header("Content-Type: application/json");

// SELECT pro_collect.mem_id, pro_collect.prod_id, member.mem_name, member.mem_name, member.mem_email, product.prod_id, product.prod_name, product.prod_price, product.prod_img1 FROM pro_collect JOIN member ON pro_collect.mem_id = member.mem_id JOIN product ON pro_collect.prod_id = product.prod_id WHERE pro_collect.mem_id = 1;

try {
    // 連接資料庫
    require_once("connect_chd103g5_2.php");

    $memId=$_POST['mem_id'];
    // sql指令
	$sql = "SELECT pro_collect.mem_id, pro_collect.prod_id, member.mem_name, member.mem_name, member.mem_email, product.prod_id, product.prod_name, product.prod_price, product.prod_img1 FROM pro_collect JOIN member ON pro_collect.mem_id = member.mem_id JOIN product ON pro_collect.prod_id = product.prod_id WHERE pro_collect.mem_id = $memId";
    // 
    $news = $pdo->query( $sql );
    $result=$news->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>