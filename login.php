<?php

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $input_login = $_POST['login'];
    $input_password = $_POST['password'];

}

$login = 'admin';
$password = 'admin';

$sql = "SELECT login FROM users";

require('functions/connect.php');

$row = $query->fetch_assoc();

while ($row != null) {
    // var_dump($row);
    foreach ($row as $db_login) {
        // var_dump($key);
        // var_dump($login);
        if ($login === $db_login) {
            echo 'le login ' . $login . ' est dans la base de données<br>';
            
            $sql = "SELECT login, password FROM users WHERE login LIKE '$login'";

            require('functions/connect.php');

            $row_user_login_password = $query->fetch_assoc();

            if ($row_user_login_password['password'] === $password) {
                echo 'utilisateur ' . $login . ' connecté !';
            }
            var_dump($row_user_login_password);

        } else {
            // echo 'le login ' . $login . ' n\'est pas dans la base de données<br>';
            
        }
    }
    $row = $query->fetch_assoc();

}


?>

<form action="index.php" method="post">
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
            <td colspan="2"><input type="submit" value="Inscription"></td>
        </tr>
    </table>
</form>