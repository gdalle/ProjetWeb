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

if (isLogged() && $_GET['todo'] == "change_password") {
    change_password($dbh);
}
if (isLogged() && $_GET['todo'] == "change_description") {
    change_description($dbh);
}
if (isLogged() && $_GET['todo'] == "change_email") {
    change_email($dbh);
}
if (isLogged() && $_GET['todo'] == "change_phone") {
    change_phone($dbh);
}

function change_password($dbh) {
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newPassword = htmlspecialchars($_POST["newPassword"]);
    $oldPassword = htmlspecialchars($_POST["oldPassword"]);
    $success = User::setPassword($dbh, $user, $oldPassword, $newPassword);
    if ($success) {
        echo "Password successfully changed";
    } else {
        echo "Password hasn't changed";
    }
}

function change_description($dbh) {
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newDescription = htmlspecialchars($_POST["newDescription"]);
    $success = User::setDescription($dbh, $user, $newDescription);
    if ($success) {
        echo $newDescription;
    } else {
        echo "No change occurred";
    }
}

function change_email($dbh) {
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newEmail = htmlspecialchars($_POST["newEmail"]);
    $success = User::setEmail($dbh, $user, $newEmail);
    if ($success) {
        echo $newEmail;
    } else {
        echo "No change occurred";
    }
}

function change_phone($dbh) {
    $user = User::getUserId($dbh, $_SESSION["userId"]);
    $newPhone = htmlspecialchars($_POST["newPhone"]);
    $success = User::setPhone($dbh, $user, $newPhone);
    if ($success) {
        echo $newPhone;
    } else {
        echo "No change occurred";
    }
}

?>
