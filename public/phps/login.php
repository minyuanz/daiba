<?php
// session_start();
    header("Access-Control-Allow-Origin:*");
    session_start();
    $email = $_POST["mem_email"];
    $pwd = $_POST["mem_pwd"];
    $errMsg = "";
    try {

        require_once("connect_chd103g5_2.php");
        $sql = "select * from member where mem_email=:mem_email and mem_pwd=:mem_pwd" ;

        $member = $pdo->prepare( $sql ); //先編譯好
        $member->bindValue(":mem_email", $email); //代入資料
        $member->bindValue(":mem_pwd", $pwd);
        $member->execute();//執行之

        // 獲取資料庫中的會員資訊
        if( $member->rowCount() == 0 ){//找不到
        // $errMsg .= "帳密錯誤, <a href='sessionLogin.html'>重新登入</a><br>";
        echo json_encode([]);
    }else {
        $memRow = $member->fetch(PDO::FETCH_ASSOC);

        if ($memRow["mem_status"] != 1) {
            echo json_encode(["blocked" => true, "message" => "您的帳號已經被封鎖，請聯絡管理員"]);
        } else {
            // 登入成功，將登入者的數據寫入 session
            $_SESSION["mem_email"] = $memRow["mem_email"];
            $_SESSION["mem_pwd"] = $memRow["mem_pwd"];
            echo json_encode(["result" => $memRow]);
        }
    }
} catch (PDOException $e) {
    $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
    $errMsg .= "行號 : ".$e -> getLine()."<br>";
};





// 檢查是否找到匹配的會員資訊
//     if($member -> rowCount() !== 0){
//         $memberData = $member->fetch(PDO::FETCH_ASSOC);
//         $_SESSION["mem_email"] = $memberData["mem_email"];
//         $_SESSION["mem_pwd"] = $memRow["mem_pwd"];

//         $result = ["mem_email"=>$memberData["mem_email"], "mem_pwd"=>$memberData["mem_pwd"]];

//         echo json_encode($result);//送出json字串
//     }

//     // if ($memberData) {
//     //     echo json_encode(["error" => false, "msg" => "登入成功", "member" => $memberData]);
//     // } else {
//     //     echo json_encode(["error" => true, "msg" => "登入失敗：帳號或密碼不正確"]);
//     // }
//     // echo json_encode(["error" => false, "msg" => "登入成功", "member" => $member]);

// } catch (PDOException $e) {
// 	$result = ["msg"=>$e->getMessage()];
//   echo json_encode($result);
// }
?>