<?php

$id = new mysqli('localhost', 'root', '', 'moduleconnexion');

$query = $id->query($sql);
// if ($id->query($sql)) {
//     echo 'Action complete! ';
// } else {
//     echo 'Error: ' . $id->error;
// }

// mysqli_close($id);