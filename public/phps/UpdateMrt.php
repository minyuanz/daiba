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
        //$fileName = $_FILES["news_imageURL"]["name"]; //原檔名
        $filename = uniqid(); //使用uniqid()來當做主檔名
        $pathInfo = pathinfo($_FILES["news_imageURL"]["name"]);//取得檔案的資訊放在陣列中
        $fileExt = $pathInfo["extension"]; //取得副檔名
        $filename = "{$filename}.{$fileExt}"; //加上副檔名的檔名 

        $to = $dir . $filename;
        copy($from, $to);
    } else {
        $fileName = "";
    }

    require_once("connect_chd103g5_2.php");

    // $prod_id = $_POST['prod_id']; 
    // $sql = "SELECT prod_img1, prod_img2, prod_img3, prod_img4 FROM product WHERE prod_id = :prod_id";
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(":prod_id", $prod_id);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // // 更新数据库中的图片文件名，如果没有上传新图片则保持不变
    // $newImgNames = array();
    // for ($i = 0; $i < 4; $i++) {
    //     $newImgNames[] = $fileNames[$i] !== "" ? $fileNames[$i] : $row["prod_img" . ($i + 1)];
    // }

    //變數名稱 = $_post[formData的key值]
    $sta_id=$_POST['sta_id'];
    $mrt_code1=$_POST['mrt_code1'];
    $mrt_code2=$_POST['mrt_code2'];
    $sta_name=$_POST['sta_name'];
    $mrt_id1=$_POST['mrt_id1'];
    $mrt_id2=$_POST['mrt_id2'];
    $sta_describe=$_POST['sta_describe'];
    // $sta_pictor=$_POST['sta_pictor'];


    // 更新商品信息，包括图片文件名
    $sql = "UPDATE  mrtstation SET
        mrt_code1 = :mrt_code1,
        mrt_code2 = :mrt_code2,
        sta_name = :sta_name,
        mrt_id1 = :mrt_id1,
        mrt_id2 = :mrt_id2,
        sta_pictor = :sta_pictor,
        sta_describe = :sta_describe
        WHERE sta_id = :sta_id";

    $mrts = $pdo->prepare($sql);

    $mrts->bindValue(":mrt_code1", $mrt_code1);
    $mrts->bindValue(":mrt_code2", $mrt_code2);
    // $mrts->bindValue(":mrts_date", date("Y-m-d"));
    // $mrts->bindValue(":mrts_tag", '所有消息');
    $mrts->bindValue(":sta_name", $sta_name);
    $mrts->bindValue(":sta_pictor", $filename);
    $mrts->bindValue(":mrt_id1", $mrt_id1);
    $mrts->bindValue(":mrt_id2", $mrt_id2);
    $mrts->bindValue(":sta_describe", $sta_describe);
    $mrts->bindValue(":sta_id", $sta_id);

    $mrts->execute();

    $result=array("error" => false, "msg" => "新增成功");
    echo json_encode($result);
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>
