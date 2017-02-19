<?php
include 'Includes/header.php';
$success = 1;
$searched = 0;
$textErr = "";
if(isset($_POST["submit"])){
	$Text = test_input($_POST["text"]);
	if(empty($Text)){
		$textErr = "请输入查询内容";
		$success = 0;
	}
	if($_POST["submit"] == "在用户中查询"){

	}
	else if($_POST["submit"] == "在标题中查询"){

	}
	else if($_POST["submit"] == "在留言中查询"){

	}
	if($success){

	}
}
?>
<br/>
<br/>
	<div class="form">
		<form action="searchmessage.php" method="post">
			<input type="text" name="text" value="<?php echo $_POST["text"]; ?>" size="30" maxlength="30">
			<span class="error"><?php echo $textErr; ?></span>
<br/>
<br/>
			<input type="submit" name="submit" value="在用户中查询">
			<input type="submit" name="submit" value="在标题中查询">
			<input type="submit" name="submit" value="在留言中查询"></form></div>
<?php
if($searched){

}
include 'Includes/footer.php';
?>
