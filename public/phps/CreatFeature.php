<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();

    var_dump($_FILES); 
    var_dump($_POST); 

    for ($i = 1; $i <= 5; $i++) { 
        if ($_FILES["special_pic{$i}"]["error"] === 0) { 
            $dir = "../img/"; 
            if (!file_exists($dir)) {
                mkdir($dir);  
            }
           
            $filename = uniqid() . '.' . pathinfo($_FILES["special_pic{$i}"]["name"], PATHINFO_EXTENSION);
            $to = $dir . $filename;
            if (move_uploaded_file($_FILES["special_pic{$i}"]["tmp_name"], $to)) {
                $fileNames[] = $filename;
            } else {
                echo "文件移動失敗：", $_FILES["special_pic{$i}"]["error"], "<br>";
                $fileNames[] = "";
            }
        } else {
            $fileNames[] = ""; 
        }
    }
    require_once("connect_chd103g5_2.php");

    $sql = "INSERT INTO special (special_title,fea_name,sta_name,special_des,special_pic1,special_pic2,special_pic3,special_pic4,special_pic5,special_ctx1,special_ctx2,special_ctx3,special_ctx4,special_ctx5) 
            VALUES (:special_title,:fea_name,:sta_name,:special_des,:special_pic1,:special_pic2,:special_pic3,:special_pic4,:special_pic5,:special_ctx1,:special_ctx2,:special_ctx3,:special_ctx4,:special_ctx5)";

    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(":sta_id", $_POST["sta_id"]);
    $stmt->bindValue(":special_title", $_POST["special_title"]);
    $stmt->bindValue(":fea_name", $_POST["fea_name"]);
    $stmt->bindValue(":sta_name", $_POST["sta_name"]);
    $stmt->bindValue(":special_des", $_POST["special_des"]);
    $stmt->bindValue(":special_pic1", $fileNames[0]); 
    $stmt->bindValue(":special_pic2", $fileNames[1]); 
    $stmt->bindValue(":special_pic3", $fileNames[2]); 
    $stmt->bindValue(":special_pic4", $fileNames[3]); 
    $stmt->bindValue(":special_pic5", $fileNames[4]);
    $stmt->bindValue(":special_ctx1", $_POST["special_ctx1"]);
    $stmt->bindValue(":special_ctx2", $_POST["special_ctx2"]);
    $stmt->bindValue(":special_ctx3", $_POST["special_ctx3"]);
    $stmt->bindValue(":special_ctx4", $_POST["special_ctx4"]);
    $stmt->bindValue(":special_ctx5", $_POST["special_ctx5"]);

    $stmt->execute();
    // $result=array("error" => false, "msg" => "新增成功");
    // echo json_encode($result);

    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>