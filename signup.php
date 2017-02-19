<?php
include 'Includes/header.php';
$success = 1;
$usernameErr = $passwordErr = $emailErr = $blogErr = $genderErr = "";
$check1 = $check2 = "";
if(isset($_POST["submit"])){
	$Username = test_input($_POST["username"]);
	$Password = test_input($_POST["password"]);
	$Email = test_input($_POST["email"]);
	$Gender = $_POST["gender"];
	$Logged = base64_encode(base64_encode("$Username:$Password"));
	if(empty($Username)){
		$usernameErr = "请输入账号";
		$success = 0;
	}
	else if(!preg_match("/^[a-zA-Z0-9]+$/",$Username)){
		$usernameErr = "只允许字母和数字";
		$success = 0;
	}
	if(empty($Password)){
		$passwordErr = "请输入密码";
		$success = 0;
	}
	if(empty($Email)){
		$emailErr = "请输入邮箱";
		$success = 0;
	}
	else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$Email)){
		$emailErr = "无效的邮箱格式";
		$success = 0;
	}
	if(empty($Gender)){
		$genderErr = "请选择性别";
		$success = 0;
	}
	else{
		if($Gender == 1){
			$check1 = "checked";
			$check2 = "";
		}
		else if($Gender == 2){
			$check2 = "checked";
			$check1 = "";
		}
	}
	if($success){
		$permit = 1;
		$usernameResult = $emailResult = "";
		$usernameResult = mysql_query("select username from user where user='$Username'");
		$emailResult = mysql_query("select email from user where email='$Email'");
		if(mysql_num_rows($usernameResult)){
			$usernameErr = "账号已被注册";
			$permit = 0;
		}
		if(mysql_num_rows($emailResult)){
			$emailErr = "邮箱已被注册";
			$permit = 0;
		}
		if($permit){
			mysql_query("insert into user (username,password,email,gender,logged) values ('$Username','$Password','$Email','$Gender','$Logged')");
			echo "注册成功，将在 3 秒后跳转到登录页面。";
			echo '<meta http-equiv="refresh" content="3;url=login.php">';
		}
	}
}
?>
<br/>
<br/>
	<div class="form">
		<form action="signup.php" method="post">
			账号：<input type="text" name="username" value="<?php echo $_POST["username"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $usernameErr; ?></span>
<br/>
<br/>
			密码：<input type="password" name="password" value="<?php echo $_POST["password"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $passwordErr; ?></span>
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
<?php include 'Includes/footer.php'; ?>
