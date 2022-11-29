<?php

$id = new mysqli('localhost', 'root', '', 'moduleconnexion');

if ($id->query($sql)) {
    echo 'Action complete! ';
} else {
    echo 'Error: ' . $id->error;
}

// mysqli_close($id);