<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问
// SELECT * FROM `pro_collect` WHERE prod_id = 5


try {
    $mem_id=$_POST['mem_id'];
    $prod_id=$_POST['prod_id'];

    // 連接資料庫
    require_once("connect_chd103g5_2.php");
    // sql指令
	$sql = "SELECT * FROM `pro_collect` WHERE prod_id = $prod_id and mem_id = $mem_id" ;
    // 
    $news = $pdo->query( $sql );
    $result=$news->fetchAll(PDO::FETCH_ASSOC);
    // echo $result[0]['prod_id'];
    // exit;
    
    // echo json_encode($result);

    if(empty($result)){
        $sql = "insert into pro_collect (mem_id, prod_id) values (:mem_id, :prod_id)";
    
        $news = $pdo->prepare( $sql );
    
        $news->bindValue(":mem_id", $mem_id);
        $news->bindValue(":prod_id", $prod_id);
    
        $news->execute();
    
        $result=array("error" => false, "msg" => "新增成功");
        echo json_encode($result);

    } else{
        $result=array("error" => false, "msg" => "已經加入收藏清單");

        echo json_encode($result);
    };
    // require_once("connect_chd103g5_2.php");
    //變數名稱 = $_post[formData的key值]
    
    

 

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>