<?php
header("Access-Control-Allow-Origin:*");


try {

    require_once("connect_chd103g5.php");
	$sql = "insert into member (mem_name, mem_birth, mem_phone, mem_email, mem_pwd) values (:mem_name, :mem_birth, :mem_phone, :mem_email, :mem_pwd)";
    $member = $pdo->prepare( $sql );
    $member->bindValue(":mem_name", $_POST["name"]);
    $member->bindValue(":mem_birth", $_POST["bir"]);
    $member->bindValue(":mem_phone", $_POST["tel"]);
    $member->bindValue(":mem_email", $_POST["email"]);
    $member->bindValue(":mem_pwd", $_POST["pwd"]);
    $member->execute();
    // $member = $_POST;


    echo json_encode(["error" => false, "msg" => "新增成功", "member" => $member]);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>