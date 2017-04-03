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

if (isLogged() && isAdmin() && $_GET['todo'] == "create_cabinet") {
    create_cabinet($dbh);
}
if (isLogged() && isAdmin() && $_GET['todo'] == "create_user") {
    create_user($dbh);
}
if (isLogged() && isAdmin() && $_GET['todo'] == "delete_cabinet") {
    delete_cabinet($dbh, $_POST["cabinet_id"]);
}
if (isLogged() && isAdmin() && $_GET['todo'] == "delete_user") {
    delete_user($dbh, $_POST["user_id"]);
}

function create_cabinet($dbh) {
    $argumentsCorrect = (isset($_POST['cabinet_name']) && isset($_POST['cabinet_description']) && strlen($_POST['cabinet_name']) > 0 && strlen($_POST['cabinet_description']) > 0);
    if ($argumentsCorrect) {
        $cabinet_name = htmlspecialchars($_POST['cabinet_name']);
        $cabinet_description = htmlspecialchars($_POST['cabinet_description']);
        $success = Cabinet::insertCabinet($dbh, $cabinet_name, $cabinet_description);
        $cabinet_id = Cabinet::getCabinetName($dbh, $cabinet_name)->id;
        if ($success) {
            echo "<tr id='cabinet_$cabinet_id'>";
            echo "<td>$cabinet_id</td>";
            echo "<td>$cabinet_name</td>";
            echo "<td>$cabinet_description</td>";
            echo "<td><span class='glyphicon glyphicon-remove delete_cabinet' id='delete_cabinet_" . $cabinet_id . "'></span></td>";
            echo "</tr>";
        }
        return $success;
    }
    return false;
}

function delete_cabinet($dbh, $cabinet_id) {
    $cabinet_id = htmlspecialchars($cabinet_id);
    $argumentsCorrect = ($cabinet_id > 0);
    if ($argumentsCorrect) {
        $success = Cabinet::deleteCabinet($dbh, $cabinet_id);
        return $success;
    }
    return false;
}

function create_user($dbh) {
    $argumentsCorrect = isset($_POST["user_login"]) && isset($_POST["user_password"]) && isset($_POST["user_name"]) && isset($_POST["user_cabinet"]) && isset($_POST["user_character"]) && isset($_POST["user_description"]) && strlen($_POST["user_login"]) > 0 && strlen($_POST["user_password"]) > 0 && strlen($_POST["user_name"]) > 0 && strlen($_POST["user_cabinet"]) > 0 && strlen($_POST["user_character"]) > 0;
    if ($argumentsCorrect) {
        $user_login = htmlspecialchars($_POST['user_login']);
        $user_password = htmlspecialchars($_POST['user_password']);
        $user_admin = htmlspecialchars($_POST['user_admin']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_cabinet = htmlspecialchars($_POST['user_cabinet']);
        $user_character = htmlspecialchars($_POST['user_character']);
        $user_description = htmlspecialchars($_POST['user_description']);
        $success = User::insertUser($dbh, $user_login, $user_password, $user_admin, $user_name, $user_cabinet, $user_character, $user_description);
        if ($success) {
            $user = User::getUserLogin($dbh, $user_login);
            $user_id = $user->id;
            echo "<tr id='user_" . $user_id . "'>";
            echo "<td>" . $user_id . "</td>";
            echo "<td>" . $user_login . "</td>";
            echo "<td>" . $user_admin . "</td>";
            echo "<td>" . $user_name . "</td>";
            echo "<td>" . $user_cabinet . "</td>";
            echo "<td>" . $user_character . "</td>";
            echo "<td><span class='glyphicon glyphicon-remove delete_user' id='delete_user_" . $user->id . "'></span> &nbsp;  <a href='index.php?page=profile&userId=" . $user->id . "'><span class='glyphicon glyphicon-user'></span></a></td>";
            echo "</tr>";
        }
        return $success;
    }
    return false;
}

function delete_user($dbh, $user_id) {
    $user_id = htmlspecialchars($user_id);
    if ($user_id == 0) {
        return false;
    }
    $argumentsCorrect = true;
    if ($argumentsCorrect) {
        $success = User::deleteUser($dbh, $user_id);
        return $success;
    }
    return false;
}

?>
