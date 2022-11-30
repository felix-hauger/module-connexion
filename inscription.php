<?php

if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['login']) && !empty($_POST['password'])) {
    require_once('functions/connect.php');
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    // $sql = "SELECT login FROM users";
    // require('functions/connect.php');

    // var_dump($id->fetch_all($sql));

    $sql = "INSERT INTO users (`firstname`, `lastname`, `login`, `password`) VALUES ('$firstname', '$lastname', '$login', '$password')";
    
    
    if ($id->query($sql)) {
        echo 'Insertion complete! ';
        header('Location: login.php');
    } else {
        echo 'Error: ' . $id->error;
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
            <td colspan="2"><input type="submit" value="Inscription"></td>
        </tr>
    </table>
</form>