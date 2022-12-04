<?php
require_once('elements/header.php');

if (isset($_POST['submit'])) {

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        require_once('functions/connect.php');
        require_once('functions/is_user_in_db.php');
    
        $input_login = $_POST['login'];
        $input_password = $_POST['password'];
    
        // test if user in db, from the required function
        $is_user_in_db = is_user_in_db($input_login, $id);
    
        if ($is_user_in_db) {
            // echo 'le login ' . $input_login . ' est dans la base de données<br>';
            
            $sql = "SELECT login, password FROM users WHERE login LIKE '$input_login'";
            
            $query = $id->query($sql);
    
            // get login & password from db in associative array
            $row_user_login_password = $query->fetch_assoc();
            $db_login = $row_user_login_password['login'];
            $db_password = $row_user_login_password['password'];
    
            // log in if matching password
            if ($row_user_login_password['password'] === $input_password) {
    
                session_start();
                
                // to display log out button
                $_SESSION['is_logged'] = true;
                
                // to display profil.php infos & admin link / page if logged as admin
                $_SESSION['logged_user'] = $db_login;

                $logged_user = $_SESSION['logged_user'];
                
                if ($logged_user === 'admin') {
                    header('Location: admin.php');
                } else {
                    echo 'utilisateur ' . $_SESSION['logged_user'] . ' connecté !';
                    header('Location: index.php');
                }

    
                die();
                
            } else {
                // if password is incorrect
                $login_error = 'Identifiants incorrects.';
            }
    
        } else {
            // if user is NOT in db
            $login_error = 'Identifiants incorrects.';
        }
    } else {
        $inputs_error = 'Remplissez tous les champs !';
    }
}


?>
<main>
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="login">Pseudo</label></td>
                <td><input type="text" name="login" id="login"></td>
            </tr>
            <tr>
                <td><label for="password">Mot de Passe</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <?php if (isset($login_error)): ?>
            <tr><td class="error_msg"><?= $login_error ?></td></tr>
            <?php endif; ?>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Connexion"></td>
            </tr>
            <?php if (isset($inputs_error)): ?>
                <tr><td class="error_msg"><?= $inputs_error ?></td></tr>
            <?php endif; ?>
        </table>
    </form>
</main>