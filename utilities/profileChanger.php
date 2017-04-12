<?php

session_name("SecretSessionName");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
require("logInOut.php");
require("database.php");
$dbh = MyDatabase::connect();

if (isLogged() && $_GET['todo'] == "change_password_comp") {
    change_password_comp($dbh);
}
elseif (isLogged() && isAdmin() && $_GET['todo'] == "change_password_nocomp") {
    change_password_nocomp($dbh);
}
elseif (isLogged() && isAdmin() && $_GET['todo'] == "change_character") {
    change_character($dbh);
}
elseif (isLogged() && isAdmin() && $_GET['todo'] == "change_description") {
    change_description($dbh);
}
elseif (isLogged() && $_GET['todo'] == "change_email") {
    change_email($dbh);
}
elseif (isLogged() && $_GET['todo'] == "change_phone") {
    change_phone($dbh);
} else {
    echo "ERROR";
}

function change_password_comp($dbh) {
    $success = false;
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newPassword = htmlspecialchars($_POST["newPassword"]);
    $oldPassword = htmlspecialchars($_POST["oldPassword"]);
    $argumentsCorrect = (strlen($newPassword) > 0);
    if ($argumentsCorrect) {
        $success = User::setPassword($dbh, $user, $oldPassword, $newPassword);
    }
    if ($success) {
        echo "Password successfully changed";
    } else {
        echo "Password hasn't changed";
    }
}

function change_password_nocomp($dbh) {
    $success = false;
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newPassword = htmlspecialchars($_POST["newPassword"]);
    $oldPassword = htmlspecialchars($_POST["oldPassword"]);
    $argumentsCorrect = (strlen($newPassword) > 0);
    if ($argumentsCorrect) {
        $success = User::setPasswordNoComp($dbh, $user, $newPassword);
    }
    if ($success) {
        echo "Password successfully changed";
    } else {
        echo "Password hasn't changed";
    }
}

function change_description($dbh) {
    $success = false;
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newDescription = htmlspecialchars($_POST["newDescription"]);
    $argumentsCorrect = (strlen($newDescription) > 0);
    if ($argumentsCorrect) {
        $success = User::setDescription($dbh, $user, $newDescription);
    }
    if ($success) {
        echo $newDescription;
    } else {
        echo "No change occurred";
    }
}

function change_character($dbh) {
    $success = false;
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newCharacter = htmlspecialchars($_POST["newCharacter"]);
    $argumentsCorrect = (strlen($newCharacter) > 0);
    if ($argumentsCorrect) {
        $success = User::setCharacter($dbh, $user, $newCharacter);
    }
    if ($success) {
        echo $newCharacter;
    } else {
        echo "No change occurred";
    }
}

function change_email($dbh) {
    $success = false;
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newEmail = htmlspecialchars($_POST["newEmail"]);
    $argumentsCorrect = (strlen($newEmail) > 0);
    if ($argumentsCorrect) {
        $success = User::setEmail($dbh, $user, $newEmail);
    }
    if ($success) {
        echo $newEmail;
    } else {
        echo "No change occurred";
    }
}

function change_phone($dbh) {
    $success = false;
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newPhone = htmlspecialchars($_POST["newPhone"]);
    $argumentsCorrect = (strlen($newPhone) > 0);
    if ($argumentsCorrect) {
        $success = User::setPhone($dbh, $user, $newPhone);
    }
    if ($success) {
        echo $newPhone;
    } else {
        echo "No change occurred";
    }
}

?>
