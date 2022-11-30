<?php

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    require_once('functions/connect.php');

    $input_login = $_POST['login'];
    $input_password = $_POST['password'];

    // $input_login = 'admin';
    // $input_password = 'admin';
    
    $sql = "SELECT login FROM users";
    
    $query = $id->query($sql);
    
    $row = $query->fetch_assoc();
    
    while ($row != null) {
        // var_dump($row);
        
        // Test if input login exists in database
        foreach ($row as $db_login) {
            // var_dump($key);
            // var_dump($login);
            $is_user_in_db = false;
            if ($input_login === $db_login) {
                echo 'le login ' . $input_login . ' est dans la base de données<br>';
                
                $sql = "SELECT login, password FROM users WHERE login LIKE '$input_login'";
                
                $query = $id->query($sql);
    
                $row_user_login_password = $query->fetch_assoc();
    
                if ($row_user_login_password['password'] === $input_password) {
                    session_start();
                    $_SESSION['is_logged'] = true;
                    $_SESSION['logged_user'] = $db_login;
                    echo 'utilisateur ' . $_SESSION['logged_user'] . ' connecté !';
                    header('Location: index.php');
                } else {
                    echo 'mot de passe incorrect';
                }
                var_dump($row_user_login_password);

                $is_user_in_db = true;
                break;
    
            } 
        }
        $row = $query->fetch_assoc();
    
    }
    if (!$is_user_in_db) {
        echo 'L\'utilisateur n\'existe pas.';
    }
} else {
    echo 'Remplissez tous les champs !';
}


?>

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
        <tr>
            <td colspan="2"><input type="submit" value="Connexion"></td>
        </tr>
    </table>
</form>