<?php
// session_start();

// $_SESSION['user_successfully_created'] = false;

if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['login']) && !empty($_POST['password'])&& !empty($_POST['password-confirmation'])) {
    require_once('functions/connect.php');
    require_once('functions/is_user_in_db.php');
    
    $input_firstname = $_POST['firstname'];
    $input_lastname = $_POST['lastname'];
    $input_login = $_POST['login'];
    $input_password = $_POST['password'];
    $input_password_confirmation = $_POST['password-confirmation'];
    

    if ($input_password === $input_password_confirmation) {
        
        // test if user in db, from the required function
        $is_user_in_db = is_user_in_db($input_login, $id);

        if ($is_user_in_db) {
            echo 'L\'utilisateur existe déjà !';
        } else {
            
            $sql = "INSERT INTO users (`firstname`, `lastname`, `login`, `password`) VALUES ('$input_firstname', '$input_lastname', '$input_login', '$input_password')";
            
            
            if ($id->query($sql)) {
                echo 'Insertion complete! ';
                header('Location: connexion.php');
            } else {
                echo 'Error: ' . $id->error;
            }
        }

    } else {
        echo 'Valeurs non identiques dans les champs de mot de passe';
    }

}

?>


<h1>Inscription</h1>
<form action="" method="post">
    <table>
        <tr>
            <td><label for="firstname">Prénom</label></td>
            <td><input type="text" name="firstname" id="firstname"></td>
            <?php  /* Ajouter conditons pour exceptions */?>
        </tr>
        <tr>
            <td><label for="lastname">Nom de Famille</label></td>
            <td><input type="text" name="lastname" id="lastname"></td>
        </tr>
        <tr>
            <td><label for="login">Pseudo</label></td>
            <td><input type="text" name="login" id="login"></td>
        </tr>
        <tr>
            <td><label for="password">Mot de Passe</label></td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td><label for="password-confirmation">Confirmation du Mot de Passe</label></td>
            <td><input type="password" name="password-confirmation" id="password-confirmation"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Inscription"></td>
        </tr>
    </table>
</form>