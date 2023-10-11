<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");

require_once("connect_chd103g5_2.php");

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (isset($_GET["itemId"]) && is_numeric($_GET["itemId"])) {
        $itemId = $_GET["itemId"];
        try {
            $DELETE_SQL = "DELETE FROM mrtstation WHERE sta_id = :sta_id";
            $stmt = $pdo->prepare($DELETE_SQL);
            $stmt->bindParam(":sta_id", $itemId, PDO::PARAM_INT);
            $stmt->execute();
        
            // 輸出調試信息
            echo json_encode(array('success' => true, 'msg' => '項目已成功刪除'));
        } catch (PDOException $e) {
            // 輸出錯誤信息
            echo json_encode(array('error' => true, 'msg' => '刪除失敗: ' . $e->getMessage()));
        }
        
    } else {
        $response = array('error' => true, 'msg' => '請提供有效的 itemId');
        echo json_encode($response);
    }
} else {
    $response = array('error' => true, 'msg' => '不支持的請求方法');
    echo json_encode($response);
}

// 關閉連接
$pdo = null;
?>
