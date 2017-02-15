<?php
include 'includes/header.php';

if(isset($_POST["submit"])){
	if($_POST["submit"] == "取消"){
		echo '<meta http-equiv="refresh" content="0;url=index.php">';
	}
	else if($_POST["submit"] == "确认"){
		$Messageid = $_POST["messageid"];
		mysql_query("delete from message where messageid='$Messageid'");
		echo '<meta http-equiv="refresh" content="0;url=index.php">';
	}
}
?>
<span class="error">确认删除？</span>
<br/>
<br/>
	<div>
		<form action="delete.php" method="post">
			<input type="hidden" name="messageid" value="<?php echo $_POST["messageid"]; ?>">
			<input type="submit" name="submit" value="取消">
			<input type="submit" name="submit" value="确认"></form></div>

<?php include 'includes/footer.php'; ?>
