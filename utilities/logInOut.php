<?php

function login($dbh) {
    $user = User::getUserLogin($dbh, $_POST["login"]);
    if (User::testPassword($user, $_POST["password"])) {
        $_SESSION["loggedIn"] = True;
        $_SESSION["userId"] = $user->id;
        $_SESSION["admin"] = $user->admin;
        $_SESSION["name"] = $user->name;
        $_SESSION["cabinet"] = $user->cabinet;
    }
}

function logout($dbh) {
    session_unset();
    session_destroy();
}

function isLogged() {
    if (isset($_SESSION["loggedIn"])) {
        return $_SESSION["loggedIn"];
    }
    return false;
}

function isAdmin() {
    if (isset($_SESSION["admin"])) {
        return $_SESSION["admin"];
    }
    return false;
}

?>
