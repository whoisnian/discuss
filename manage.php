<?php include 'includes/header.php'; ?>

<br/>
<br/>
<ul class="list-ul">
	<li class="list-li">
		<a href="edit.php">新的留言（未开放）</a></li><br/>
	<li class="list-li">
		<a href="search.php">留言查询（未开放）</a></li><br/>';
<?php
if($_COOKIE["user"] == "Guest"){
	echo '</ul>';
}
else{
	echo '
	<li class="list-li">
		<a href="setting.php">个人设置（未开放）</a></li><br/>
</ul>';
}

include 'includes/footer.php';
?>
