<?php
header("Access-Control-Allow-Origin:*");

try {
    $fileNames = array();

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

    $prod_id = $_POST['prod_id']; 
    $sql = "SELECT prod_img1, prod_img2, prod_img3, prod_img4 FROM product WHERE prod_id = :prod_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":prod_id", $prod_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // 更新数据库中的图片文件名，如果没有上传新图片则保持不变
    $newImgNames = array();
    for ($i = 0; $i < 4; $i++) {
        $newImgNames[] = $fileNames[$i] !== "" ? $fileNames[$i] : $row["prod_img" . ($i + 1)];
    }

    // 更新商品信息，包括图片文件名
    $sql = "UPDATE product SET
            prod_name = :prod_name,
            prod_price = :prod_price,
            prod_type = :prod_type,
            sta_id = :sta_id,
            prod_des1 = :prod_des1,
            prod_des2 = :prod_des2,
            prod_img1 = :prod_img1,
            prod_img2 = :prod_img2,
            prod_img3 = :prod_img3,
            prod_img4 = :prod_img4
            WHERE prod_id = :prod_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":prod_name", $_POST["prod_name"]);
    $stmt->bindParam(":prod_price", $_POST["prod_price"]);
    $stmt->bindParam(":prod_type", $_POST["prod_type"]);
    $stmt->bindParam(":sta_id", $_POST["sta_id"]);
    $stmt->bindParam(":prod_des1", $_POST["prod_des1"]);
    $stmt->bindParam(":prod_des2", $_POST["prod_des2"]);
    $stmt->bindParam(":prod_img1", $newImgNames[0]);
    $stmt->bindParam(":prod_img2", $newImgNames[1]);
    $stmt->bindParam(":prod_img3", $newImgNames[2]);
    $stmt->bindParam(":prod_img4", $newImgNames[3]);
    $stmt->bindParam(":prod_id", $prod_id);

    $stmt->execute();

    echo "商品信息已成功更新";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>