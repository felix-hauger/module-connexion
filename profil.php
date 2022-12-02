<?php
session_start();

require_once('functions/connect.php');
var_dump($_SESSION);
$logged_user = $_SESSION['logged_user'];


$sql = "SELECT firstname, lastname, login, password FROM users WHERE login LIKE '$logged_user'";

$query = $id->query($sql);

$user_infos = $query->fetch_assoc();

var_dump($user_infos);

$db_firstname = $user_infos['firstname'];
$db_lastname = $user_infos['lastname'];
$db_login = $user_infos['login'];
$db_password = $user_infos['password'];

?>

<h1>Profil</h1>

<h2>Modifier vos informations de profil</h2>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="firstname">Prénom</label></td>
            <td><input type="text" name="firstname" id="firstname" value="<?= $db_firstname ?>"></td>
            <?php  /* Ajouter conditons pour exceptions */?>
        </tr>
        <tr>
            <td><label for="lastname">Nom de Famille</label></td>
            <td><input type="text" name="lastname" id="lastname" value="<?= $db_lastname ?>"></td>
        </tr>
        <tr>
            <td><label for="login">Pseudo</label></td>
            <td><input type="text" name="login" id="login" value="<?= $db_login ?>"></td>
            <?php if (isset($login_error)): ?>
            <td class="error_msg"><?= $login_error ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <td><label for="password">Mot de Passe</label></td>
            <td><input type="password" name="password" id="password" value=""></td>
            <?php if (isset($password_error)): ?>
            <td class="error_msg"><?= $password_error ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <td><label for="password-confirmation">Confirmation du Mot de Passe</label></td>
            <td><input type="password" name="password-confirmation" id="password-confirmation" value="<?php  ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Inscription"></td>
        </tr>
    </table>
</form>