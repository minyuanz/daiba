<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

try {
    
    require_once("connect_chd103g5_2.php");
    //變數名稱 = $_post[formData的key值]
    $news_id=$_POST['news_id'];
    // $art_id=$_POST['art_id'];
    // DELETE FROM pro_collect WHERE art_id = 2 AND mem_id = 2;

    
	$sql = "DELETE FROM news WHERE news_id = :news_id";

    $news = $pdo->prepare( $sql );

    $news->bindValue(":news_id", $news_id);
    // $news->bindValue(":art_id", $art_id);

    $news->execute();

    $result=array("error" => false, "msg" => "刪除成功");
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>