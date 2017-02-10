<?php
include 'includes/header.php';
$success = 1;
$userErr = $passwdErr = "";
if(isset($_POST["submit"])){
	if(empty($_POST["user"])){
		$userErr = "请输入账号";
		$success = 0;
	}
	if(empty($_POST["passwd"])){
		$passwdErr = "请输入密码";
		$success = 0;
	}
	if($success){
		$permit = 1;
		$User = $_POST["user"];
		$Passwd = $_POST["passwd"];
		$con = mysql_connect("localhost","nian","whoisnian");
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("discuss", $con);
		$userResult = $passwdResult = "";
		$userResult = mysql_query("SELECT user FROM user WHERE user='$User'");
		$passwdResult = mysql_query("SELECT passwd FROM user WHERE user='$User'");
		if(!mysql_num_rows($userResult)){
			$userErr = "此账号不存在";
			$permit = 0;
		}
		else if(mysql_result($passwdResult,0) != $Passwd){
			$passwdErr = "密码错误，请重试";
			$permit = 0;
		}
		if($permit){
			echo "登录成功，将在 3 秒后跳转到首页。";
			setcookie("user", "$User", time()+3600*24);
			echo '<meta http-equiv="refresh" content="3;url=home.php">';
		}
	}
	mysql_close($con);
}
?>
<br/>
<br/>
	<div style="text-align:left">
		<form action="login.php" method="post">
			账号：<input type="text" name="user" size="30" maxlength="30">
			<span class="error"><?php echo $userErr; ?></span>
<br/>
<br/>
			密码：<input type="password" name="passwd" size="30" maxlength="30">
			<span class="error"><?php echo $passwdErr; ?></span>
<br/>
<br/>
			<input type="submit" name="submit" value="登录"></form></div>

<?php include 'includes/footer.php'; ?>
