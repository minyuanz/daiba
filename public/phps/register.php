<?php
header("Access-Control-Allow-Origin:*");


try {
    require_once("connect_chd103g5_2.php");

    $sql='SELECT mem_email FROM member';
    $memberEmail=$pdo->query($sql);
    $emailList=$memberEmail->fetchAll(PDO::FETCH_ASSOC);
    $emailExists = false;


    foreach ($emailList as $email) {
        if ($_POST["email"] === $email["mem_email"]) {
            $emailExists = true;
            break; // 找到匹配的电子邮件后退出循环
        }
    }

    if($emailExists){
        echo json_encode(["emailExists" => true, "msg" => "此信箱已經存在"]);
        exit;

    } else{
        $sql = "insert into member (mem_name, mem_birth, mem_phone, mem_email, mem_pwd, mem_status) values (:mem_name, :mem_birth, :mem_phone, :mem_email, :mem_pwd, :mem_status)";
        $member = $pdo->prepare( $sql );
        $member->bindValue(":mem_name", $_POST["name"]);
        $member->bindValue(":mem_birth", $_POST["bir"]);
        $member->bindValue(":mem_phone", $_POST["tel"]);
        $member->bindValue(":mem_email", $_POST["email"]);
        $member->bindValue(":mem_pwd", $_POST["pwd"]);
        $member->bindValue(":mem_status", 1);
        $member->execute();
    
        echo json_encode(["error" => false, "msg" => "註冊成功", "member" => $member]);

    }


} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>