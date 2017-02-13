<?php
include 'includes/header.php';

$success = 1;
$userErr = $passwdErr = $emailErr = $genderErr = "";
$check1 = $check2 = "";
if(isset($_POST["submit"])){
	if(empty($_POST["user"])){
		$userErr = "请输入账号";
		$success = 0;
	}
	else if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST["user"])){
		$useridErr = "只允许字母和数字";
		$success = 0;
	}
	if(empty($_POST["passwd"])){
		$passwdErr = "请输入密码";
		$success = 0;
	}
	if(empty($_POST["email"])){
		$emailErr = "请输入邮箱";
		$success = 0;
	}
	else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST["email"])){
		$emailErr = "无效的邮箱格式";
		$success = 0;
	}
	if(empty($_POST["gender"])){
		$genderErr = "请选择性别";
		$success = 0;
	}
	else{
		if($_POST["gender"] == 1){
			$check1 = "checked";
			$check2 = "";
		}
		else{
			$check2 = "checked";
			$check1 = "";
		}
	}
	if($success){
		include_once 'includes/connectdb.php';

		$permit = 1;
		$User = $_POST["user"];
		$Email = $_POST["email"];
		$Passwd = $_POST["passwd"];
		$Gender = $_POST["gender"];
		$userResult = $emailResult = "";
		$userResult = mysql_query("SELECT user FROM user WHERE user='$User'");
		$emailResult = mysql_query("SELECT email FROM user WHERE email='$Email'");
		if(mysql_num_rows($userResult)){
			$userErr = "账号已被注册";
			$permit = 0;
		}
		if(mysql_num_rows($emailResult)){
			$emailErr = "邮箱已被注册";
			$permit = 0;
		}
		if($permit){
			mysql_query("INSERT INTO user (user,passwd,email,gender) VALUES ('$User','$Passwd','$Email','$Gender')");
			echo "注册成功，将在 3 秒后跳转到登录页面。";
			echo '<meta http-equiv="refresh" content="3;url=login.php">';
		}
 		mysql_close($con);
	}
}
?>
<br/>
<br/>
	<div>
		<form action="signup.php" method="post">
			账号：<input type="text" name="user" value="<?php echo $_POST["user"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $userErr; ?></span>
<br/>
<br/>
			密码：<input type="password" name="passwd" value="<?php echo $_POST["passwd"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $passwdErr; ?></span>
<br/>
<br/>
			邮箱：<input type="text" name="email" value="<?php echo $_POST["email"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $emailErr; ?></span>
<br/>
<br/>
			性别：<input type="radio" name="gender" value="1" <?php echo $check1; ?>>男性
				  <input type="radio" name="gender" value="2" <?php echo $check2; ?>>女性
			<span class="error"><?php echo $genderErr; ?></span>
<br/>
<br/>
			<input type="submit" name="submit" value="注册"></form></div>

<?php include 'includes/footer.php'; ?>
