<?php
include 'Includes/header.php';
$success = 1;
$searched = 0;
$userErr = "";
if(isset($_POST["submit"])){
	$User = test_input($_POST["user"]);
	if($_POST["submit"] == "通过账号查询"){
		if(empty($User)){
			$userErr = "账号不能为空";
			$success = 0;
		}
		else if(!preg_match("/^[a-zA-Z0-9]+$/",$User)){
			$userErr = "只允许字母和数字";
			$success = 0;
		}
		if($success){
			$userResult = mysql_query("select * from user where username='$User'");
			if(!mysql_num_rows($userResult)){
				$userErr = "此账号不存在";
				$success = 0;
			}
		}
	}
	else if($_POST["submit"] == "通过邮箱查询"){
		if(empty($User)){
			$userErr = "请输入邮箱";
			$success = 0;
		}
		else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$User)){
			$userErr = "无效的邮箱格式";
			$success = 0;
		}
		if($success){
			$userResult = mysql_query("select * from user where email='$User'");
			if(!mysql_num_rows($userResult)){
				$userErr = "此邮箱不存在";
				$success = 0;
			}
		}
	}
	if($success){
		$row = mysql_fetch_array($userResult);
		$Userid = $row["userid"];
		$Username = $row["username"];
		$Gender = $row["gender"];
		$QQ = $row["qq"];
		$Email = $row["email"];
		$Blog = $row["blog"];
		if(empty($Blog)){
			$Blog = "none";
		}
		if(empty($QQ)){
			$QQ = "none";
		}
		if($Gender == 1){
			$Gender = "Man";
		}
		else if($Gender == 2){
			$Gender = "Woman";
		}
		else{
			$Gender = "none";
		}
		$searched = 1;
	}
}
?>
<br/>
<br/>
	<div class="form">
		<form action="searchuser.php" method="post">
			<input type="text" name="user" value="<?php echo $_POST["user"]; ?>"size="30" maxlength="30">
			<span class="error"><?php echo $userErr; ?></span>
<br/>
<br/>
			<input type="submit" name="submit" value="通过账号查询">
			<input type="submit" name="submit" value="通过邮箱查询"></form></div>
<?php
if($searched){
	echo '	
<br/>
<br/>
<div class="information">
	<table>
		<tr>
			<td width="200px">UserID:</td>
			<td>'.$Userid.'</td>
		</tr>
		<tr>
			<td>UserName:</td>
			<td>'.$Username.'</td>
		</tr>
		<tr>
			<td>Gender:</td>
			<td>'.$Gender.'</td>
		</tr>
		<tr>
			<td>QQ:</td>
			<td>'.$QQ.'</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>'.$Email.'</td>
		</tr>
		<tr>
			<td>Blog:</td>
			<td>'.$Blog.'</td>
		</tr>
	</table>
</div>';
}
include 'Includes/footer.php';
?>
