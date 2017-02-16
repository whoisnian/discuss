<?php
include 'includes/header.php';

$messageResult = mysql_query("select * from message order by messageid desc");
while($row = mysql_fetch_array($messageResult)){
	$function = "";
	$messagename = $row['user'];
	$messageid = $row['messageid'];
	if($row['anonymous'] == "1"){
		$messagename = "用户匿名发表";
	}
	if($logged){
		$function = '
<form action="reply.php" method="post" class="form-right">
	<input type="hidden" name="messageid" value="'.$messageid.'">
	<input type="submit" name="submit" value="回复">
</form>';
	}
	if(($logged == $row['user']&&$logged != "Guest")||($logged == "admin")){
		$function = $function.'
<form action="updatemessage.php" method="post" class="form-right">
	<input type="hidden" name="messageid" value="'.$messageid.'">
	<input type="hidden" name="title" value="'.$row['title'].'">
	<input type="hidden" name="message" value="'.$row['message'].'">
    <input type="hidden" name="anonymous" value="'.$row['anonymous'].'">
    <input type="submit" name="submit" value="修改">
</form>
<form action="delete.php" method="post" class="form-right">
	<input type="hidden" name="messageid" value="'.$messageid.'">
	<input type="submit" name="submit" value="删除">
</form>';
	}
	echo '
<table class="table">
<tr>
	<td class="table-a">'.$messagename.'<br/>'.$row['time'].'</td>
	<td class="table-b">'.$row['title'].'</td>
	<td class="table-c">'.$function.'</td>
</tr>
<tr>
	<td colspan="3" class="table-d">'.$row['message'].'</td>
</tr>';
	$replyResult = mysql_query("select * from reply where replyto='$messageid' order by replyid desc");
	while($rowrow = mysql_fetch_array($replyResult)){
		$replyname = $rowrow['user'];
		if($rowrow['anonymous'] == "1"){
			$replyname = "用户匿名发表";
		}
		echo '
<tr>
	<td class="table-e">'.$replyname.'<br/>'.$rowrow['time'].'</td>
	<td colspan="2" class="table-f">'.$rowrow['reply'].'</td>
</tr>';
	}
	echo '
</table>
<br/>';
}

include 'includes/footer.php';
?>
