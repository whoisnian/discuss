<?php 
include 'includes/header.php';

$success = 1;
$oldpasswdErr = $newpasswdErr = "";
if(!$logged){
	echo "请登录，将跳转到登录页面。";
	echo '<meta http-equiv="refresh" content="0;url=login.php">';
    $success = 0;
}
else if($logged == "Guest"){
    echo '<span class="error">匿名用户无权限，将跳转到首页。</span>';
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
	$success = 0;
}
else if(isset($_POST["submit"])){
	$temp = trim($_POST["oldpasswd"]);
	if(empty($temp)){
		$oldpasswdErr = "请输入原密码";
		$success = 0;
	}
	$temp = trim($_POST["newpasswd"]);
	if(empty($temp)){
	    $newpasswdErr = "请输入新密码";
		$success = 0;
	}
	if($success){
		$permit = 1;
		$User = $logged;
		$Oldpasswd = $_POST["oldpasswd"];
		$Newpasswd = $_POST["newpasswd"];
		$Newlogged = base64_encode(base64_encode("$User:$Newpasswd"));
		$passwdResult = "";
		$passwdResult = mysql_query("select passwd from user where user='$User'");
		if(mysql_result($passwdResult,0) != $Oldpasswd){
			$oldpasswdErr = "原密码错误";
			$permit = 0;
		}
		if($permit){
			echo "修改成功，将在 3 秒后跳转到登录页面。";
			mysql_query("update user set passwd='$Newpasswd',logged='$Newlogged' where user='$User'");
			echo '<meta http-equiv="refresh" content="3;url=login.php">';
		}
	}
}
?>
<br/>
<br/>
	<div class="form">
		<form action="updatepasswd.php" method="post">
			原密码：<input type="password" name="oldpasswd" size="30" maxlength="30">
			<span class="error"><?php echo $oldpasswdErr; ?></span>
<br/>
<br/>
			新密码：<input type="password" name="newpasswd" size="30" maxlength="30">
			<span class="error"><?php echo $newpasswdErr; ?></span>
<br/>
<br/>
			<input type="submit" name="submit" value="修改"></form></div>

<?php include 'includes/footer.php'; ?>
