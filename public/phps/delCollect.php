<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

try {
    
    require_once("connect_chd103g5_2.php");
    //變數名稱 = $_post[formData的key值]
    $mem_id=$_POST['mem_id'];
    $prod_id=$_POST['prod_id'];
    // DELETE FROM pro_collect WHERE prod_id = 2 AND mem_id = 2;

    
	$sql = "DELETE FROM pro_collect WHERE prod_id = :prod_id AND mem_id = :mem_id";

    $news = $pdo->prepare( $sql );

    $news->bindValue(":mem_id", $mem_id);
    $news->bindValue(":prod_id", $prod_id);

    $news->execute();

    $result=array("error" => false, "msg" => "刪除成功");
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>