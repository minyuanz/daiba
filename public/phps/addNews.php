<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

// header("Content-Type: application/json");

// images
// https://www.php.net/manual/zh/function.pathinfo.php
// https://www.php.net/manual/zh/function.uniqid.php
// https://www.php.net/manual/zh/features.file-upload.post-method.php

    



try {
    if ( $_FILES["news_imageURL"]["error"] === 0) {
        //-----------------決定好資料夾的路徑
        $dir = "../img/";
        if( !file_exists($dir) ){
            mkdir($dir);
        }
                
        $from = $_FILES["news_imageURL"]["tmp_name"];
        // $filename = basename($_FILES["news_imageURL"]["name"]);
        
        //-----------------決定檔案名稱
        //$fileName = $_FILES["news_imageURL"]["name"]; //原檔名
        $filename = uniqid(); //使用uniqid()來當做主檔名
        $pathInfo = pathinfo($_FILES["news_imageURL"]["name"]);//取得檔案的資訊放在陣列中
        $fileExt = $pathInfo["extension"]; //取得副檔名
        $filename = "{$filename}.{$fileExt}"; //加上副檔名的檔名 

        $to = $dir . $filename;
        copy($from, $to);
    } else {
        $fileName = "";
    }


    require_once("connect_chd103g5_2.php");
    //變數名稱 = $_post[formData的key值]
    $news_title=$_POST['news_title'];
    $news_bdes=$_POST['news_sectitle'];
    $news_tag1=$_POST['news_tag'];
    // $news_pic1=$_POST['news_imageURL'];
    $news_des1=$_POST['news_content'];
    
	$sql = "insert into news (news_title, news_bdes, news_date, news_tag, news_tag1, news_pic1, news_des1) values (:news_title, :news_bdes, :news_date, :news_tag, :news_tag1, :news_pic1, :news_des1)";

    $news = $pdo->prepare( $sql );

    $news->bindValue(":news_title", $news_title);
    $news->bindValue(":news_bdes", $news_bdes);
    $news->bindValue(":news_date", date("Y-m-d"));
    $news->bindValue(":news_tag", '所有消息');
    $news->bindValue(":news_tag1", $news_tag1);
    $news->bindValue(":news_pic1", $filename);
    $news->bindValue(":news_des1", $news_des1);

    $news->execute();


    $result=array("error" => false, "msg" => "新增成功");
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>