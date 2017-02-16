<?php
include 'includes/header.php';

if(!$logged){
	echo "请登录，将跳转到登录页面。";
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
}

echo '
<br/>
<br/>
<ul class="list-ul">
	<br/>
	<li class="list-li">
		<a href="new.php" class="list-a">新的留言</a></li><br/>
	<li class="list-li">
		<a href="search.php" class="list-a">留言查询（未完成）</a></li><br/>';
if($logged == "Guest"){
	echo '</ul>';
}
else{
	echo '
	<li class="list-li">
		<a href="setting.php" class="list-a">个人设置（未完成）</a></li><br/>
</ul>';
}

include 'includes/footer.php';
?>
