<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

try {
    
    require_once("connect_chd103g5_2.php");
    //變數名稱 = $_post[formData的key值]
    $mem_id=$_POST['mem_id'];
    $prod_id=$_POST['prod_id'];

    
	$sql = "insert into pro_collect (mem_id, prod_id) values (:mem_id, :prod_id)";

    $news = $pdo->prepare( $sql );

    $news->bindValue(":mem_id", $mem_id);
    $news->bindValue(":prod_id", $prod_id);

    $news->execute();

    $result=array("error" => false, "msg" => "新增成功");
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>