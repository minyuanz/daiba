<?php
header("Access-Control-Allow-Origin:*"); // 允许任何来源访问

header("Content-Type: application/json");

// SELECT article_collect.mem_id, article_collect.art_id, member.mem_name, member.mem_name, member.mem_email, article.art_title, article.art_subTitle, article.art_date, article.fea_tag FROM article_collect JOIN member ON article_collect.mem_id = member.mem_id JOIN article ON article_collect.art_id = article.art_id WHERE article_collect.mem_id = 4;

// SELECT ac.mem_id, ac.art_id, m.mem_name, m.mem_name, m.mem_email, a.art_title, a.art_subTitle, a.art_pic1,a.art_date, a.fea_tag, a.sta_id FROM article_collect ac JOIN member m ON ac.mem_id = m.mem_id JOIN article a ON ac.art_id = a.art_id WHERE ac.mem_id = 4;


try {
    // 連接資料庫a
    require_once("connect_chd103g5_2.php");

    $memId=$_GET['memId'];
    // sql指令
	$sql = "SELECT ac.mem_id, ac.art_id, m.mem_name, m.mem_name, m.mem_email, a.art_title, a.art_subTitle, a.art_pic1,a.art_date, a.fea_tag, a.sta_id, a.art_content FROM article_collect ac JOIN member m ON ac.mem_id = m.mem_id JOIN article a ON ac.art_id = a.art_id WHERE ac.mem_id = $memId";
    // 
    $news = $pdo->query( $sql );
    $result=$news->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);

} catch (PDOException $e) {
	$result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}
?>