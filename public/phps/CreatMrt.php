<?php

header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();
    var_dump($_FILES); 
    var_dump($_POST); 
        if ($_FILES["sta_pictor{$i}"]["error"] === 0) { 
            $dir = "../img/product/"; 
            if (!file_exists($dir)) {
                mkdir($dir);  
            }
           
            $filename = uniqid() . '.' . pathinfo($_FILES["sta_pictor{$i}"]["name"], PATHINFO_EXTENSION);
            $to = $dir . $filename;
            if (move_uploaded_file($_FILES["sta_pictor{$i}"]["tmp_name"], $to)) {
                $fileNames[] = $filename;
            } else {
                echo "文件移動失敗：", $_FILES["sta_pictor{$i}"]["error"], "<br>";
                $fileNames[] = "";
            }
        } else {
            $fileNames[] = ""; 
        }
    require_once("connect_chd103g5_2.php");

    $sql = "INSERT INTO product (sta_id, mrt_code1, mrt_code2, sta_name, mrt_id1, mrt_id2, sta_pictor1,sta_describe) 
            VALUES (:sta_id, :mrt_code1, :mrt_code2, :sta_name, :mrt_id1, :mrt_id2, :sta_pictor1,:sta_describe)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":sta_id", $_POST["sta_id"]);
    $stmt->bindValue(":mrt_code1", $_POST["mrt_code1"]);
    $stmt->bindValue(":mrt_code2", $_POST["mrt_code2"]);
    $stmt->bindValue(":sta_name", $_POST["sta_name"]);
    $stmt->bindValue(":mrt_id1", $_POST["mrt_id1"]);
    $stmt->bindValue(":mrt_id2", $_POST["mrt_id2"]);
    $stmt->bindValue(":sta_pictor1", $fileNames[0]); 
    $stmt->bindValue(":sta_describe", $_POST["sta_describe"]); 

    $stmt->execute();
    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>