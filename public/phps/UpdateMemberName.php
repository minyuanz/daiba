<?php
header("Access-Control-Allow-Origin:*");

try {

    require_once("connect_chd103g5_2.php");

    //變數名稱 = $_post[formData的key值]
    $mem_id=$_POST['mem_id'];
    $mem_name=$_POST['mem_name'];


    // 更新商品信息，包括图片文件名
    $sql = "UPDATE member SET
        mem_name = :mem_name
        WHERE mem_id = :mem_id";

    $news = $pdo->prepare($sql);

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