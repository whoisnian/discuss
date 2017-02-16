<?php
include 'includes/header.php';

$success = 1;
$replyErr = $anonymousErr = "";
$check1 = $check2 = "";
if(!$logged){
	echo "请登录，将跳转到登录页面。";
	echo '<meta http-equiv="refresh" content="0;url=login.php">';
	$success = 0;
}
else if(!isset($_POST["replyed"])){
	$Replyto = $_POST["messageid"];
	$success = 0;
}
else if(isset($_POST["submit"])&&$success == 1){
	if(empty($_POST["reply"])){
		$replyErr = "请输入内容";
		$success = 0;
	}
	if(empty($_POST["anonymous"])){
		$anonymousErr = "请选择是否匿名";
		$success = 0;
	}
	else{
		if($_POST["anonymous"] == "1"){
			$check1 = "checked";
			$check2 = "";
		}
		else{
			$check2 = "checked";
			$check1 = "";
		}
	}
	if($success){
		date_default_timezone_set("Asia/Shanghai");
		$Replyto = $_POST["replyto"];
		$User = $logged;
		$Reply = $_POST["reply"];
		$Time = date("Y-m-d H:i:s");
		$Anonymous = $_POST["anonymous"];
		echo "回复成功，将在 3 秒后跳转到首页。";
		mysql_query("insert into reply (replyto,user,reply,time,anonymous) values ('$Replyto','$User','$Reply','$Time','$Anonymous')");
		echo '<meta http-equiv="refresh" content="3;url=index.php">';
	}
}
?>
<br/>
<br/>
	<div class="form">
		<form action="reply.php" method="post">
			回复：<textarea name="reply" rows="5" cols="52"><?php echo $_POST["reply"]; ?></textarea>
			<span class="error"><?php echo $replyErr; ?></span>
<?php
if($logged == "Guest"){
	echo '
			<input type="hidden" name="anonymous" value="2">';
}
else{
	echo '
<br/>
<br/>
			匿名：<input type="radio" name="anonymous" value="1" '.$check1.'>是
			      <input type="radio" name="anonymous" value="2" '.$check2.'>否
			<span class="error">'.$anonymousErr.'</span>';
}
?>
<br/>		
<br/>
			<input type="hidden" name="replyed" value="1">
			<input type="hidden" name="replyto" value="<?php echo $Replyto; ?>">
			<input type="submit" name="submit" value="回复"></form></div>

<?php include 'includes/footer.php'; ?>
