<?php
session_start();

if (isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    die();
}

// $_SESSION['user_successfully_created'] = false;
require_once('elements/header.php');

if (isset($_POST['submit'])) {
    
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['login']) && !empty($_POST['password'])&& !empty($_POST['password-confirmation'])) {
        require_once('functions/connect.php');
        require_once('functions/is_user_in_db.php');
        
        $inputs_ok = true;
    
        $input_firstname = htmlspecialchars(trim($_POST['firstname']), ENT_QUOTES, "UTF-8");
        $input_lastname = htmlspecialchars(trim($_POST['lastname']), ENT_QUOTES, "UTF-8");
        $input_login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, "UTF-8");
        $input_password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, "UTF-8");
        $input_password_confirmation = htmlspecialchars(trim($_POST['password-confirmation']), ENT_QUOTES, "UTF-8");
        
    
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
        
        $hashed_password = password_hash($input_password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (`firstname`, `lastname`, `login`, `password`) VALUES ('$input_firstname', '$input_lastname', '$input_login', '$hashed_password')";
        
        
        if ($id->query($sql)) {
            echo 'Insertion complete! ';
            header('Location: connexion.php');
        } else {
            echo 'Error: ' . $id->error;
        }
    }

}


?>

<main>
    <div class="hero">
        <div class="form-container">
            <form action="" method="post">
                <h2>Inscription</h2>
    
                <input type="text" name="firstname" id="firstname" placeholder="Votre Prénom">
    
                <input type="text" name="lastname" id="lastname" placeholder="Votre Nom">
    
                <input type="text" name="login" id="login" placeholder="Votre Identifiant">
                <?php if (isset($login_error)): ?>
                <p class="error_msg"><?= $login_error ?></p>
                <?php endif; ?>
    
                <input type="password" name="password" id="password" placeholder="Votre Mot de Passe">
                <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Confirmation Mot de Passe">
                <?php if (isset($password_error)): ?>
                <p class="error_msg"><?= $password_error ?></p>
                <?php endif; ?>
    
                <input type="submit" value="Inscription" name="submit">
                <?php if (isset($inputs_error)): ?>
                <p class="error_msg"><?= $inputs_error ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</main>
<?php
require_once('elements/footer.php');