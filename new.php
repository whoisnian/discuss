<?php
include 'includes/header.php';

$success = 1;
$titleErr = $messageErr = $anonymousErr = "";
if(isset($_POST["submit"])){
	if(empty($_POST["title"])){
		$titleErr = "请输入标题";
		$success = 0;
	}
	if(empty($_POST["message"])){
		$messageErr = "请输入内容";
		$success = 0;
	}
	if(empty($_POST["anonymous"])){
		$anonymousErr = "请选择是否匿名";
		$success = 0;
	}
	if($success){
		date_default_timezone_set("Asia/Shanghai");
		$permit = 1;
		$User = $logged;
		$Title = $_POST["title"];
		$Message = $_POST["message"];
		$Time = date("Y-m-d H:i:s");
		$Anonymous = $_POST["anonymous"];
		mysql_query("INSERT INTO message (user,title,message,time,anonymous) VALUES ('$User','$Title','$Message','$Time','$Anonymous')");
		echo "发表成功，将在 3 秒后跳转到首页。";
		echo '<meta http-equiv="refresh" content="3;url=index.php">';
	}
}
?>
<br/>
<br/>
	<div>
		<form action="new.php" method="post">
			标题：<input type="text" name="title" value="<?php echo $_POST["title"]; ?>" size="50" maxlength="50">
			<span class="error"><?php echo $titleErr; ?></span>
<br/>
<br/>
内容：<textarea name="message" rows="5" cols="52"><?php echo $_POST["message"]; ?></textarea>
			<span class="error"><?php echo $messageErr; ?></span>
<?php
if($logged == "Guest"){
	echo '
			<input type="hidden" name="anonymous" value="2">';
}
else{
	echo '
<br/>
<br/>
			匿名：<input type="radio" name="anonymous" value="1">是
			      <input type="radio" name="anonymous" value="2">否
			<span class="error">'.$anonymousErr.'</span>';
}
?>
<br/>		
<br/>
			<input type="submit" name="submit" value="发表"></form></div>

<?php include 'includes/footer.php'; ?>
