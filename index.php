<?php
session_start();
var_dump($_SESSION);

?>


<h1>Bonjour <?php echo isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : 'invité'; ?></h1>