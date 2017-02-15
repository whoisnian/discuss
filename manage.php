<?php
include 'includes/header.php';

if(!$logged){
	echo "请登录，将在 3 秒后跳转到登录页面。";
    echo '<meta http-equiv="refresh" content="3;url=login.php">';
}

echo '
<br/>
<br/>
<ul class="list-ul">
	<li class="list-li">
		<a href="new.php">新的留言</a></li><br/>
	<li class="list-li">
		<a href="search.php">留言查询（未开放）</a></li><br/>';
if($logged == "Guest"){
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
