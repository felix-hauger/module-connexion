<?php
session_start();
require_once('elements/header.php');
// var_dump($_SESSION);

?>

<main>
    <h2 id="index-title" >Bonjour <?= isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : 'voyageur en herbe !'; ?></h2>
</main>