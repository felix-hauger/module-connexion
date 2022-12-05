<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    

<header>
    <h1>Esprit Voyageur</h1>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>

            <?php if (isset($_SESSION['is_logged'])): ?>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>

            <?php else: ?>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>

            <?php endif ?>

            <?php if (isset($_SESSION['is_logged']) && $_SESSION['logged_user'] === 'admin'): ?>
            <li><a href="admin.php">Admin</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>
