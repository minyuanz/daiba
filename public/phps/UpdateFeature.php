<?php
header("Access-Control-Allow-Origin:*");
try {
    $fileNames = array();

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

    $special_id = $_POST['special_id']; 
    $sql = "SELECT special_pic1, special_pic2, special_pic3, special_pic4,special_pic5 FROM special WHERE special_id = :special_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":special_id", $special_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // 更新数据库中的图片文件名，如果没有上传新图片则保持不变
    $newImgNames = array();
    for ($i = 0; $i < 5; $i++) {
        $newImgNames[] = $fileNames[$i] !== "" ? $fileNames[$i] : $row["special_pic" . ($i + 1)];
    }

    // 更新商品信息，包括图片文件名
    $sql = "UPDATE special SET
            special_title = :special_title,
            fea_name = :fea_name,
            sta_name = :sta_name,
            special_des = :special_des,
            special_pic1 = :special_pic1,
            special_pic2 = :special_pic2,
            special_pic3 = :special_pic3,
            special_pic4 = :special_pic4,
            special_pic5 = :special_pic5,
            special_ctx1 = :special_ctx1,
            special_ctx2 = :special_ctx2,
            special_ctx3 = :special_ctx3,
            special_ctx4 = :special_ctx4,
            special_ctx5 = :special_ctx5
            WHERE special_id = :special_id";


    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":special_title", $_POST["special_title"]);
    $stmt->bindValue(":fea_name", $_POST["fea_name"]);
    $stmt->bindValue(":sta_name", $_POST["sta_name"]);
    $stmt->bindValue(":special_des", $_POST["special_des"]); 
    $stmt->bindValue(":special_pic1", $newImgNames[0]); 
    $stmt->bindValue(":special_pic2", $newImgNames[1]); 
    $stmt->bindValue(":special_pic3", $newImgNames[2]); 
    $stmt->bindValue(":special_pic4", $newImgNames[3]); 
    $stmt->bindValue(":special_pic5", $newImgNames[4]);
    $stmt->bindValue(":special_ctx1", $_POST["special_ctx1"]);
    $stmt->bindValue(":special_ctx2", $_POST["special_ctx2"]);
    $stmt->bindValue(":special_ctx3", $_POST["special_ctx3"]);
    $stmt->bindValue(":special_ctx4", $_POST["special_ctx4"]);
    $stmt->bindValue(":special_ctx5", $_POST["special_ctx5"]);
    $stmt->bindValue(":special_id", $special_id);

    $stmt->execute();
    // $result=array("error" => false, "msg" => "新增成功");
    // echo json_encode($result);

    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>