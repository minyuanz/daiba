<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 导入数据库连接文件
require_once("connect_chd103g5_2.php");

// 检查是否是 POST 请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 解析 JSON 数据
    $data = json_decode(file_get_contents("php://input"));

    // 检查是否提供了所需参数
    if (isset($data->admin_id, $data->admin_sich)) {
        $admin_id = $data->admin_id;
        $admin_sich = $data->admin_sich;

        // 使用 PDO 执行 SQL 更新操作
        $sql = "UPDATE admin SET admin_sich = :admin_sich WHERE admin_id = :admin_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':admin_sich', $admin_sich, PDO::PARAM_STR);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();

        // 检查更新是否成功
        if ($stmt->rowCount() > 0) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "msg" => "更新失败");
        }
    } else {
        $response = array("success" => false, "msg" => "参数 admin_id 和 admin_sich 缺失");
    }
} else {
    // 处理 OPTIONS 请求
    header('HTTP/1.1 200 OK');
}

// 输出 JSON 响应
echo json_encode($response);
?>