<?php
print_r($_POST);
header("Access-Control-Allow-Origin:*");


try {
    $fileNames = array();
    $art_status = 0;
    $artDate = new DateTime(); 
    $artDateStr = $artDate->format('Y-m-d H:i:s'); 
    if($_POST["sta_id2"] === '0'){
        $_POST["sta_id2"] = null;
    };


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

    // Article
    $sql = "INSERT INTO `article` (`mem_id`,`sta_id1`, `sta_id2`,`fea_tag`, `art_title`, `art_subTitle`, `art_content`,`art_address`, `art_pic1`, `art_pic2`, `art_pic3`, `art_date`, `art_status`) 
    VALUES (:mem_id, :sta_id1,:sta_id2, :fea_tag, :art_Title, :art_subTitle, :art_content,:art_address, :art_pic1, :art_pic2, :art_pic3,:art_date, :art_status);";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":mem_id", $_POST["mem_id"]); 
    $stmt->bindValue(":art_Title", $_POST["art_title"]);
    $stmt->bindValue(":art_subTitle", $_POST["art_subTitle"]);
    $stmt->bindValue(":art_address", $_POST["art_address"]);
    $stmt->bindValue(":sta_id1", $_POST["sta_id1"]);
    $stmt->bindValue(":sta_id2", $_POST["sta_id2"]);
    $stmt->bindValue(":fea_tag", $_POST["fea_tag"]);
    $stmt->bindValue(":art_pic1", $fileNames[0]);
    $stmt->bindValue(":art_pic2", $fileNames[1]);
    $stmt->bindValue(":art_pic3", $fileNames[2]); 
    $stmt->bindValue(":art_date", $artDateStr);
    $stmt->bindValue(":art_content", $_POST["art_content"]);  
    $stmt->bindValue(":art_status", $art_status);  
    
    $stmt->execute();
    echo "新增成功~";
    

    // SELECT article_collect.mem_id, article_collect.art_title, member.mem_name, member.mem_email, article.art_subTitle, article.art_content, article.art_date, article.fea_id, article.art_pic1 FROM article_collect JOIN member ON article_collect.mem_id = member.mem_id JOIN article ON article_collect.art_title = article.art_title WHERE article_collect.mem_id = 5;

    // SELECT article_collect.mem_id, member.mem_name, member.mem_email, article_collect.art_title, article.art_subTitle, article.art_content, article.art_date, article.fea_id, article.art_pic1 FROM article_collect JOIN member ON article_collect.mem_id = member.mem_id JOIN article ON article_collect.art_title = article.art_title WHERE article_collect.mem_id = 5;

} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
   
    
    // echo $_POST["station"];
}

?>
