<?php
print_r($_POST);
header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();
    $art_status = 0;
    $artDate = new DateTime(); 
    $artDateStr = $artDate->format('Y-m-d H:i:s'); 


    var_dump($_FILES); 
    var_dump($_POST); 
    
    for ($i = 1; $i <= 3; $i++) { 
        if ($_FILES["art_pic{$i}"]["error"] === 0) { 
            $dir = "../img/"; 
            if (!file_exists($dir)) {
                mkdir($dir);  
            }
           
            $filename = uniqid() . '.' . pathinfo($_FILES["art_pic{$i}"]["name"], PATHINFO_EXTENSION);
            $to = $dir . $filename;
            if (move_uploaded_file($_FILES["art_pic{$i}"]["tmp_name"], $to)) {
                $fileNames[] = $filename;   
            } else {
                echo "文件移動失敗：", $_FILES["art_pic{$i}"]["error"], "<br>";
                $fileNames[] = "";
            }
        } else {
            $fileNames[] = ""; 
        }
    }
    $art_status = 0;
    require_once("connect_chd103g5_2.php");

    $sql = "INSERT INTO `article` (`sta_id`, `fea_id`, `art_title`, `art_subTitle`, `art_content`,`art_address`, `art_pic1`, `art_pic2`, `art_pic3`, `art_date`, `art_status`) 
    VALUES (:sta_id, :fea_id, :art_Title, :art_subTitle, :art_content,:art_address, :art_pic1, :art_pic2, :art_pic3,:art_date, :art_status);";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":art_Title", $_POST["art_title"]);
    $stmt->bindValue(":art_subTitle", $_POST["art_subTitle"]);
    $stmt->bindValue(":art_address", $_POST["art_address"]);
    $stmt->bindValue(":sta_id", $_POST["sta_id"]);
    $stmt->bindValue(":fea_id", $_POST["fea_id"]);
    $stmt->bindValue(":art_pic1", $fileNames[0]);
    $stmt->bindValue(":art_pic2", $fileNames[1]);
    $stmt->bindValue(":art_pic3", $fileNames[2]); 
    $stmt->bindValue(":art_date", $artDateStr);
    $stmt->bindValue(":art_content", $_POST["art_content"]);  
    $stmt->bindValue(":art_status", $art_status);  
    
    $stmt->execute();
    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    echo $_POST["station"];
}
?>
