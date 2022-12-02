<?php
session_start();

require_once('functions/connect.php');
require_once('functions/is_user_in_db.php');

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

if (isset($_POST['submit'])) {

    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['login']) && !empty($_POST['password'])&& !empty($_POST['password-confirmation'])) {
        
        $inputs_ok = true;
    
        $input_firstname = $_POST['firstname'];
        $input_lastname = $_POST['lastname'];
        $input_login = $_POST['login'];
        $input_password = $_POST['password'];
        $input_password_confirmation = $_POST['password-confirmation'];
        
    
        // test if user in db, from the required function
        $is_user_in_db = is_user_in_db($input_login, $id);
        
        if (!$is_user_in_db) {
            $login_ok = true;
        } else {
            $login_ok = false;
            $login_error = 'L\'utilisateur existe déjà !';
        }
        
        if ($input_password === $input_password_confirmation) {
            $password_ok = true;
        } else {
            $password_ok = false;
            $password_error = 'Valeurs non identiques dans les champs de mot de passe';
        }
    
    } else {
        $inputs_ok = false;
        $inputs_error = 'Remplissez tous les champs !';
    }
    
    
    if ($inputs_ok && $login_ok && $password_ok) {
        
        $sql = "UPDATE users SET `firstname` = '$input_firstname', `lastname` = '$input_lastname', `login` = '$input_login', `password` = '$input_password' WHERE login LIKE '$db_login'";
        
        
        if ($id->query($sql)) {
            echo 'Update complete! ';

            // if the condition is realized the table is updated with the value of $input_login, 
            // therefore it is not needed to fetch a new query to update the session variable
            $_SESSION['logged_user'] = $input_login;

            // we need however to redirect to update the inputs informations
            header('Location: profil.php');

        } else {
            echo 'Error: ' . $id->error;
        }
    }

}
// session_destroy();
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
            <td colspan="2"><input type="submit" name="submit" value="Modifier"></td>
        </tr>
    </table>
</form>