<?php
include 'includes/header.php';

$success = 1;
$titleErr = $messageErr = "";
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
		$anonymous = "请选择是否匿名";
		$success = 0;
	}
	if($success){
		include_once 'includes/connectdb.php';

		$permit = 1;
		$User = $_COOKIE["user"];
		$Title = $_POST["title"];
		$Message = $_POST["message"];
		$Time = "";
		$Anonymous = $_POST["anonymous"];
	}
}

?>
<br/>
<br/>
	<div>
		<form action="edit.php" method="post">
			标题：<input 
