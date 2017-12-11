<?php

if (isset($_POST['login']))
    $controller->login();


echo'<form method="post">';
    echo'<input type="text" name="uname" style="display:block;">';
    echo'<input type="password" name="upass" style="display:block;">';
    echo'<input type="submit" name="login">';
echo'</form>';

?>