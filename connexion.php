<?php
require_once('elements/header.php');

if (isset($_POST['submit'])) {

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        require_once('functions/connect.php');
        require_once('functions/is_user_in_db.php');
    
        $input_login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, "UTF-8");
        $input_password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, "UTF-8");
    
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
            if (password_verify($input_password, $db_password)) {
    
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
    <div class="hero">
        <div class="form-container">
            <form action="" method="post">
                <h2>Connexion</h2>
    
                <input type="text" name="login" id="login" placeholder="Votre Identifiant">
                
                <input type="password" name="password" id="password" placeholder="Votre Mot de Passe">
                <?php if (isset($login_error)): ?>
                <p class="error_msg"><?= $login_error ?></p>
                <?php endif; ?>
    
                <input type="submit" value="Connexion" name="submit">
                <?php if (isset($inputs_error)): ?>
                <p class="error_msg"><?= $inputs_error ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</main>


<?php

require_once('elements/footer.php');
