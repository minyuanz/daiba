<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();
    var_dump($_FILES); 
    var_dump($_POST); 
        if ($_FILES["sta_pictor"]["error"] === 0) { 
            $dir = "../img/"; 
            if (!file_exists($dir)) {
                mkdir($dir);  
            }
           
            $filename = uniqid() . '.' . pathinfo($_FILES["sta_pictor"]["name"], PATHINFO_EXTENSION);
            $to = $dir . $filename;
            if (move_uploaded_file($_FILES["sta_pictor"]["tmp_name"], $to)) {
                $fileNames[] = $filename;
            } else {
                echo "文件移動失敗：", $_FILES["sta_pictor"]["error"], "<br>";
                $fileNames[] = "";
            }
        } else {
            $fileNames[] = ""; 
        }
    require_once("connect_chd103g5_2.php");

    $sql = "INSERT INTO mrtstation (sta_name, sta_describe,mrt_code1,mrt_code2,mrt_id1, mrt_id2,sta_pictor) 
            VALUES (:sta_name, :sta_describe,:mrt_code1,:mrt_code2,:mrt_id1, :mrt_id2,:sta_pictor)";

    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(":sta_id", $_POST["sta_id"]);
    $stmt->bindValue(":mrt_code1", $_POST["mrt_code1"]);
    $stmt->bindValue(":mrt_code2", $_POST["mrt_code2"]);
    $stmt->bindValue(":sta_name", $_POST["sta_name"]);
    $stmt->bindValue(":mrt_id1", $_POST["mrt_id1"]);
    $stmt->bindValue(":mrt_id2", $_POST["mrt_id2"]);
    $stmt->bindValue(":sta_pictor", $fileNames[0]); 
    $stmt->bindValue(":sta_describe", $_POST["sta_describe"]); 

    $stmt->execute();
    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>