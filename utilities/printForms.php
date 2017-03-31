<?php
function printLoginForm($askedPage) {
    echo <<<ENDSTRING
        <form action='index.php?todo=login&askedPage=$askedPage' method='post'>
        <div class="form-group row">
            <div class="col-sm-1">
                <label for="login" class="col-form-label">Login</label>
            </div>
            <div class="col-sm-5">
                <input class="col-sm-10 form-control" type="text" name="login" id="login" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-sm-5">
                <input class="col-sm-10 form-control" type="password" name="password" id="password" required>
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

?>
