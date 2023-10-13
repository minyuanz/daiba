<?php
print_r($_POST);
header("Access-Control-Allow-Origin:*");

try {
    require_once("connect_chd103g5_2.php");

    $sql = "UPDATE member
    SET mem_point = :mem_point
    WHERE mem_id = :mem_id;";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":mem_id", $_POST["mem_id"]); 
    $stmt->bindValue(":mem_point", $_POST["mem_point"]);
    
    $stmt->execute();
    echo "新增成功~";
} catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";

}

?>
