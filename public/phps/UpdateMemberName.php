<?php
header("Access-Control-Allow-Origin:*");

try {
    // if ( $_FILES["mem_img"]["error"] === 0) {
    //     //-----------------決定好資料夾的路徑
    //     $dir = "../img/";
    //     if( !file_exists($dir) ){
    //         mkdir($dir);
    //     }
                
    //     $from = $_FILES["mem_img"]["tmp_name"];
        
    //     //-----------------決定檔案名稱
    //     $filename = uniqid(); //使用uniqid()來當做主檔名
    //     $pathInfo = pathinfo($_FILES["mem_img"]["name"]);//取得檔案的資訊放在陣列中
    //     $fileExt = $pathInfo["extension"]; //取得副檔名
    //     $filename = "{$filename}.{$fileExt}"; //加上副檔名的檔名 

    //     $to = $dir . $filename;
    //     copy($from, $to);
    // } else {
    //     $fileName = "";
    // }


    require_once("connect_chd103g5_2.php");

    //變數名稱 = $_post[formData的key值]
    $mem_id=$_POST['mem_id'];
    // $mem_img=$_POST['mem_img'];
    $mem_name=$_POST['mem_name'];


    // 更新商品信息，包括图片文件名
    $sql = "UPDATE member SET
        -- mem_img = :mem_img
        mem_name = :mem_name
        WHERE mem_id = :mem_id";

    $news = $pdo->prepare($sql);

    // $news->bindValue(":mem_img", $filename);
    $news->bindValue(":mem_name", $mem_name);
    $news->bindValue(":mem_id", $mem_id);

    $news->execute();

    $result=array("error" => false, "msg" => "修改成功");
    echo json_encode($result);
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>