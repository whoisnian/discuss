<?php include 'includes/header.php';

if($_COOKIE["user"] == 'Guest'){
	echo '
<p class="error">
	匿名用户不具有管理权限，将在 3 秒后跳转到主页。</p>
<meta http-equiv="refresh" content="3;url=index.php">';
}
else{
echo '
<ul class="list-ul">
	<li class="list-li">
		<a href="edit.php">新的留言（未开放）</a></li>
	<li class="list-li">
		<a href="search.php">留言查询（未开放）</a></li>
	<li class="list-li">
		<a href="setting.php">个人设置（未开放）</a></li>
</ul>';
}

include 'includes/footer.php';
?>
