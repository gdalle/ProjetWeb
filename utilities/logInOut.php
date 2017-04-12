<?php

function printLoginForm($askedPage) {
    echo <<<ENDSTRING
        <form action='index.php?todo=login&askedPage=$askedPage' method='post'>
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="login" class="col-form-label">Login</label>
            </div>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="login" id="login" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
        </div>
        <button class="btn btn-danger" type="submit">Let's go !</button>
        </form>
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

function login($dbh) {
    $user = User::getUserLogin($dbh, $_POST["login"]);
    if (User::testPassword($user, $_POST["password"])) {
        $_SESSION["loggedIn"] = True;
        $_SESSION["login"] = htmlspecialchars($_POST["login"]);
        $_SESSION["userId"] = htmlspecialchars($user->id);
        $_SESSION["admin"] = $user->admin;
        $_SESSION["name"] = $user->name;
        $_SESSION["character"] = $user->character;
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
        return isLogged() && $_SESSION["admin"];
    }
    return false;
}

?>
