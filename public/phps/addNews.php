<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

// header("Content-Type: application/json");


try {
    require_once("connect_chd103g5.php");
    //變數名稱 = $_post[formData的key值]
    $news_title=$_POST['news_title'];
    $news_bdes=$_POST['news_sectitle'];
    $news_tag2=$_POST['news_tag'];
    $news_pic1=$_POST['news_imageURL'];
    $news_des1=$_POST['news_content'];
    
	$sql = "insert into news (news_title, news_bdes, news_date, news_tag1, news_tag2, news_pic1, news_des1) values (:news_title, :news_bdes, :news_date, :news_tag1, :news_tag2, :news_pic1, :news_des1)";

    $news = $pdo->prepare( $sql );

    $news->bindValue(":news_title", $news_title);
    $news->bindValue(":news_bdes", $news_bdes);
    $news->bindValue(":news_date", date("Y-m-d"));
    $news->bindValue(":news_tag1", '所有消息');
    $news->bindValue(":news_tag2", $news_tag2);
    $news->bindValue(":news_pic1", $news_pic1);
    $news->bindValue(":news_des1", $news_des1);

    $news->execute();


    $result=array("error" => false, "msg" => "新增成功");
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>