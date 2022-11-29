<?php

if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['login']) && !empty($_POST['password'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $id = new mysqli('localhost', 'root', '', 'moduleconnexion');

    // $query = mysqli_query($id, 'INSERT INTO `users` (`firstname`, `lastname`, `login`, `password`) VALUES ('. `$_POST['firstname']` .', ' . `$_POST['lastname']` . ', ' . `$_POST['login']` . ', '. `$_POST['password']` . ')');

    $query = 'INSERT INTO users (`firstname`, `lastname`, `login`, `password`) VALUES ('. $firstname . ', ' . $lastname . ', ' . $login . ', ' . $password . ')';

    // if ($id→errno) {
    //     printf("Could not insert record into table: %s<br />", $id→error);
    // }
    
    $id→close();
}

?>
<h1>Inscription</h1>
<form action="" method="post">
    <table>
        <tr>
            <td><label for="firstname">Prénom</label></td>
            <td><input type="text" name="firstname" id="firstname"></td>
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
            <td colspan="2"><input type="submit" value="Inscription"></td>
        </tr>
    </table>
</form>