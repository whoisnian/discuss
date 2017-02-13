<?php
include 'includes/header.php';

setcookie("user", "Guest", time()+3600*24);
echo '<meta http-equiv="refresh" content="0;url=index.php">';

include 'includes/footer.php';
?>
