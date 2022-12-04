<?php
session_start();
require_once('elements/header.php');
// var_dump($_SESSION);

?>

<main>
    <h1>Bonjour <?php echo isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : 'invité'; ?></h1>
</main>