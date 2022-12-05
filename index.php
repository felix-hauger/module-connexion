<?php
session_start();
require_once('elements/header.php');
// var_dump($_SESSION);

?>

<main>
    <div class="hero">
        <h2 id="index-title" >Bonjour <?= isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : 'voyageur en herbe'; ?> !</h2>
    </div>
</main>
<?php
require_once('elements/footer.php');