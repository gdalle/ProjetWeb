<?php

function printLoginForm($askedPage) {
    echo <<<ENDSTRING
        <form action='index.php?todo=login&askedPage=$askedPage' method='post'>
        Login: <input type="text" name="login" required></input>
        Password: <input type="password" name="password" required></input>
        <input type="submit" value="Sign in!">
ENDSTRING;
    if (isset($_GET['error']) && $_GET['error'] == true) {
        echo("<b>Wrong login or password.</b>");
    }
}

function printLogoutForm($askedPage) {
    echo <<<ENDSTRING
        <form action='index.php?todo=logout&askedPage=$askedPage method='post'>
        <input type="submit" value="Log out!">
ENDSTRING;
    if (isset($_GET['error']) && $_GET['error'] == true) {
        echo("<b>Wrong login or password.</b>");
    }
}

?>
