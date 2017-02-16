<?php
include 'includes/header.php';

$success = 1;
$userErr = $passwdErr = "";
if(isset($_POST["submit"])){
	$temp = trim($_POST["user"]);
	if(empty($temp)){
		$userErr = "请输入账号";
		$success = 0;
	}
	$temp = trim($_POST["passwd"]);
	if(empty($temp)){
		$passwdErr = "请输入密码";
		$success = 0;
	}
	if($success){
		$permit = 1;
		$User = $_POST["user"];
		$Passwd = $_POST["passwd"];
		$userResult = $passwdResult = $loggedResult = "";
		$userResult = mysql_query("select user from user where user='$User'");
		$passwdResult = mysql_query("select passwd from user where user='$User'");
		$loggedResult = mysql_query("select logged from user where user='$User'");
		$Logged = mysql_result($loggedResult,0);
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
			setcookie("logged", "$Logged", time()+3600*24);
			echo '<meta http-equiv="refresh" content="3;url=index.php">';
		}
	}
}
?>
<br/>
<br/>
	<div class="form">
		<form action="login.php" method="post">
			账号：<input type="text" name="user" value="<?php echo $_POST["user"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $userErr; ?></span>
<br/>
<br/>
			密码：<input type="password" name="passwd" value="<?php echo $_POST["passwd"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $passwdErr; ?></span>
<br/>
<br/>
			<input type="submit" name="submit" value="登录"></form></div>

<?php include 'includes/footer.php'; ?>
