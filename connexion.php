<?php

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    require_once('functions/connect.php');
    require_once('functions/is_user_in_db.php');

    $input_login = $_POST['login'];
    $input_password = $_POST['password'];


    $is_user_in_db = is_user_in_db($input_login, $id);
    var_dump($is_user_in_db);
    if ($is_user_in_db) {
        echo 'le login ' . $input_login . ' est dans la base de données<br>';
        
        $sql = "SELECT login, password FROM users WHERE login LIKE '$input_login'";
        
        $query = $id->query($sql);

        $row_user_login_password = $query->fetch_assoc();
        $db_login = $row_user_login_password['login'];
        $db_password = $row_user_login_password['password'];

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