<?php
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/");
setcookie("user_name", "", time() - 3600*24*30*12, "/");
header('Location: /login.php');
?>