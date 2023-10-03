<?php

header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();


    var_dump($_FILES); 
    var_dump($_POST); 
    
    for ($i = 1; $i <= 4; $i++) { 
        if ($_FILES["prod_img{$i}"]["error"] === 0) { 
            $dir = "../img/product/"; 
            if (!file_exists($dir)) {
                mkdir($dir);  
            }
           
            $filename = uniqid() . '.' . pathinfo($_FILES["prod_img{$i}"]["name"], PATHINFO_EXTENSION);
            $to = $dir . $filename;
            if (move_uploaded_file($_FILES["prod_img{$i}"]["tmp_name"], $to)) {
                $fileNames[] = $filename;
            } else {
                echo "文件移動失敗：", $_FILES["prod_img{$i}"]["error"], "<br>";
                $fileNames[] = "";
            }
        } else {
            $fileNames[] = ""; 
        }
    }
    require_once("connect_chd103g5_2.php");

    $sql = "INSERT INTO product (prod_name, prod_price, prod_type, sta_id, prod_des1, prod_des2, prod_img1, prod_img2, prod_img3, prod_img4) 
            VALUES (:prod_name, :prod_price, :prod_type, :sta_id, :prod_des1, :prod_des2, :prod_img1, :prod_img2, :prod_img3, :prod_img4)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":prod_name", $_POST["prod_name"]);
    $stmt->bindValue(":prod_price", $_POST["prod_price"]);
    $stmt->bindValue(":prod_type", $_POST["prod_type"]);
    $stmt->bindValue(":sta_id", $_POST["sta_id"]);
    $stmt->bindValue(":prod_des1", $_POST["prod_des1"]);
    $stmt->bindValue(":prod_des2", $_POST["prod_des2"]);
    $stmt->bindValue(":prod_img1", $fileNames[0]); 
    $stmt->bindValue(":prod_img2", $fileNames[1]); 
    $stmt->bindValue(":prod_img3", $fileNames[2]); 
    $stmt->bindValue(":prod_img4", $fileNames[3]); 

    $stmt->execute();
    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>
<!-- header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();

    for ($i = 1; $i <= 4; $i++) { // 最多四张图片
        if ($_FILES["image{$i}"]["error"] === 0) {
            $dir = "../img/";  // 指定存储路径
            if (!file_exists($dir)) {
                mkdir($dir);
            }

            $filename = uniqid() . '.' . pathinfo($_FILES["image{$i}"]["name"], PATHINFO_EXTENSION);
            $to = $dir . $filename;
            if (move_uploaded_file($_FILES["image{$i}"]["tmp_name"], $to)) {
                $fileNames[] = $filename; // 將圖片文字存到數據
            } else {
                echo "文件移动失败：", $_FILES["image{$i}"]["error"], "<br>";
                $fileNames[] = ""; // 如果沒有澤回填空字串
            }
        } else {
            $fileNames[] = ""; 
        }
    }

    require_once("connect_chd103g5_2.php");

    $sql = "INSERT INTO product (prod_name, prod_price, prod_type, sta_id, prod_des1, prod_des2, prod_img1, prod_img2, prod_img3, prod_img4) 
            VALUES (:prod_name, :prod_price, :prod_type, :sta_id, :prod_des1, :prod_des2, :prod_img1, :prod_img2, :prod_img3, :prod_img4)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":prod_name", $_POST["prod_name"]);
    $stmt->bindValue(":prod_price", $_POST["prod_price"]);
    $stmt->bindValue(":prod_type", $_POST["prod_type"]);
    $stmt->bindValue(":sta_id", $_POST["sta_id"]);
    $stmt->bindValue(":prod_des1", $_POST["prod_des1"]);
    $stmt->bindValue(":prod_des2", $_POST["prod_des2"]);
    $stmt->bindValue(":prod_img1", $fileNames[0]); // 插入文件名
    $stmt->bindValue(":prod_img2", $fileNames[1]); // 插入文件名
    $stmt->bindValue(":prod_img3", $fileNames[2]); // 插入文件名
    $stmt->bindValue(":prod_img4", $fileNames[3]); // 插入文件名

    $stmt->execute();
    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
} -->