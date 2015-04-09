<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Comment System 3.0 By Dyrhoi</title>
</head>

<body>
<?php 
$mysqli = new mysqli("localhost", "root", "", "commentsystem");
$mysqli->set_charset('UTF8');

if(isset($_GET['id'])){
	
	$result = $mysqli->query("SELECT * from article WHERE article_id='".$_GET['id']."'");
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo 	'<article style="border: 1px solid black; max-width:600px; margin:0 auto; padding:20px;">
				<h3>'.$row['article_title'].'</h3>
				<p>'.$row['article_content'].'</p>
			</article>';
	$result_2 = $mysqli->query("SELECT * from comment WHERE fk_comment_article_id='".$row['article_id']."'");
	while ($row_2 = $result_2->fetch_array(MYSQLI_ASSOC)) {
		echo 	'<section style="border: 1px solid black; max-width:600px; margin:5px auto; padding:20px;">
					<p><strong>C</strong> - '.$row_2['comment_content'].'</p>
				</section>';
	}
	
	?>
	<form action="#" method="post" style="max-width:600px; margin:0 auto; padding:20px; border:1px solid black; margin:0 auto;">
		<textarea style="width:100%;" placeholder="Skriv kommentar" name="comment"></textarea>
		<input type="submit" name="submit">
	</form>
<?php

	if(isset($_POST['submit'])){
		$comment = $mysqli->real_escape_string($_POST['comment']);		
		$result_3 = "INSERT INTO comment (comment_content, fk_comment_article_id) VALUES ('$comment', '$row[article_id]')";
		mysqli_query($mysqli, $result_3);
		header('Location: index.php?id='.$_GET['id']);
	}
}
?>
</body>
</html>