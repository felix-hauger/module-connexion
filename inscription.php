<?php
session_start();
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