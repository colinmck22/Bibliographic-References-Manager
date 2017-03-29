<?php
//--------------------------------
require_once '_header.php';
//--------------------------------
?>

<form
    action="index.php?action=processLogin"
    method="post"
    >

    <p>
        username:
        <input type="text" name="username">
    </p>

    <p>
        password:
        <input type="password" name="password">
    </p>

    <input type="submit" value="login">

</form>