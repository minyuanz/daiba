<?php
header("Access-Control-Allow-Origin:*");

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
        $filename = uniqid(); //使用uniqid()來當做主檔名
        $pathInfo = pathinfo($_FILES["news_imageURL"]["name"]);//取得檔案的資訊放在陣列中
        $fileExt = $pathInfo["extension"]; //取得副檔名
        $filename = "{$filename}.{$fileExt}"; //加上副檔名的檔名 

        $to = $dir . $filename;
        copy($from, $to);
    } else {
        $filename = "";
    }

    require_once("connect_chd103g5_2.php");

    //變數名稱 = $_post[formData的key值]
    $news_id=$_POST['news_id'];
    $news_title=$_POST['news_title'];
    $news_bdes=$_POST['news_sectitle'];
    $news_tag1=$_POST['news_tag'];
    // $news_pic1=$_POST['news_imageURL'];
    $news_des1=$_POST['news_content'];

    // 更新商品信息，包括图片文件名
    $sql = "UPDATE news SET
        news_title = :news_title,
        news_bdes = :news_bdes,
        news_tag1 = :news_tag1,
        news_pic1 = :news_pic1,
        news_des1 = :news_des1
        WHERE news_id = :news_id";

    $news = $pdo->prepare($sql);

    $news->bindValue(":news_title", $news_title);
    $news->bindValue(":news_bdes", $news_bdes);
    $news->bindValue(":news_tag1", $news_tag1);
    $news->bindValue(":news_pic1", $filename);
    $news->bindValue(":news_des1", $news_des1);
    $news->bindValue(":news_id", $news_id);

    $news->execute();

    $result=array("error" => false, "msg" => "新增成功");
    echo json_encode($result);
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>