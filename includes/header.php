<?php
include 'connectdb.php';

$logged = "";
if(isset($_COOKIE["logged"])){
	$logged = $_COOKIE["logged"];
	$userResult = mysql_query("select user from user where logged='$logged'");
	if(!mysql_num_rows($userResult)){
		$logged = "";
		setcookie("logged","");
	}
	else{
		$logged = mysql_result($userResult,0);
	}
}

echo '
<!DOCTYPE html>
<html>
<head>	
	<title>
        Discuss
    </title>
	<link rel="stylesheet" type="text/css" href="styles/mystyle.css">
</head>

<body class="wapper">
    <div class="content">
	    <a href="index.php" class="home">Discuss Here!</a>
        <hr/>
        <div class="menu">';
if($logged){
    echo $logged.",welcome! ";
	echo '<button type="button" onclick="window.location.href=(\'index.php\')" class="button">首页</button>';
	if($_SERVER['PHP_SELF'] != '/discuss/manage.php'){
		echo '<button type="button" onclick="window.location.href=(\'manage.php\')" class="button">管理</button>';
	}
	echo '<button type="button" onclick="window.location.href=(\'logout.php\')" class="button">注销</button></div>';
}
else{
	echo '<button type="button" onclick="window.location.href=(\'index.php\')" class="button">首页</button>';
    if($_SERVER['PHP_SELF'] != '/discuss/login.php'){
		echo '<button type="button" onclick="window.location.href=(\'login.php\')" class="button">登录</button>';
	}
    if($_SERVER['PHP_SELF'] != '/discuss/signup.php'){
		echo '<button type="button" onclick="window.location.href=(\'signup.php\')" class="button">注册</button>';
	}
	echo '<button type="button" onclick="window.location.href=(\'anonymous.php\')" class="button">匿名</button></div>';
}
echo '
		<hr/>
<!------------header ending------------->';
?>
