<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问
// SELECT * FROM `pro_collect` WHERE prod_id = 5


try {
    $mem_id=$_POST['mem_id'];
    $art_id=$_POST['art_no'];

    // 連接資料庫
    require_once("connect_chd103g5_2.php");
    // sql指令
	$sql = "SELECT * FROM `article_collect` WHERE art_id = $art_id and mem_id = $mem_id" ;
    // 
    $news = $pdo->query( $sql );
    $result=$news->fetchAll(PDO::FETCH_ASSOC);
    // echo $result[0]['art_id'];
    // exit;
    
    // echo json_encode($result);

    if(empty($result)){
        $sql = "insert into article_collect (mem_id, art_no) values (:mem_id, :art_no)";
    
        $news = $pdo->prepare( $sql );
    
        $news->bindValue(":mem_id", $mem_id);
        $news->bindValue(":art_no", $art_id);
    
        $news->execute();
    
        $result=array("error" => false, "msg" => "成功加入收藏");
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