<?php

session_name("SecretSessionName");
session_start();
require("database.php");
require("logInOut.php");

if (!isLogged() || !isAdmin()) {
    echo "ERROR";
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == "add_point") {
    if (isset($_POST['point_title']) && isset($_POST['point_latitude']) && isset($_POST['point_longitude'])) {
        $title = htmlspecialchars($_POST['point_title']);
        $latitude = htmlspecialchars($_POST['point_latitude']);
        $longitude = htmlspecialchars($_POST['point_longitude']);
        $dbh = MyDatabase::connect();
        $success = MapPoint::insertMapPoint($dbh, $title, $latitude, $longitude);
        if ($success) {
            header('Location: index.php?page=manage_situation');
        } else {
            header('Location: index.php?page=error');
        }
    }
    header('Location: ../index.php?page=error');
} elseif (isset($_GET['todo']) && $_GET['todo'] == 'remove_point') {
    if (isset($_GET['point_id'])) {
        $id = htmlspecialchars($_GET['point_id']);
        $dbh = MyDatabase::connect();
        $success = MapPoint::deleteMapPoint($dbh, $id);
        if ($success) {
            header('Location: ../index.php?page=manage_situation');
        } else {
            header('Location: ../index.php?page=error');
        }
    }
    header('Location: ../index.php?page=error');
} else {
    echo "ERROR";
}

header('Location: ../index.php?page=manage_situation');
?>
