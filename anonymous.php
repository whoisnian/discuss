<?php
setcookie("user", "Guest", time()+3600*24);
echo '<meta http-equiv="refresh" content="0;url=home.php">';
?>
