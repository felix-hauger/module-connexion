<?php
session_start();

require_once('functions/connect.php');
require_once('functions/is_user_in_db.php');
require_once('elements/header.php');


var_dump($_SESSION);

if ($_SESSION['logged_user'] != 'admin') {
    header('Location: connexion.php');
    die();
}

$sql = "SELECT id, firstname, lastname, login, password FROM users";

$query = $id->query($sql);

$row = $query->fetch_assoc();
?>

<main>
    <table>
        <thead>
            <tr>
                <?php
                echo '<table><thead><tr>';
    
                foreach ($row as $key => $value) {
                    echo '<th>' . $key . '</th>';
                }
    
                echo '</tr></thead><tbody>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row != null) {
    
                echo '<tr>';
    
                foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
                }
    
                echo '</tr>';
    
                $row = $query->fetch_assoc();
            }
            ?>
        </tbody>
    </table>
</main>
