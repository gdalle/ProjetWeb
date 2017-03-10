<?php

session_start();
require("utils.php");

if (!isset($_GET['todo']) || !isLogged()) {
    header("Location: ../index.php?error=true");
    exit;
} else {
    // Cas de la création d'un cabinet
    if ($_GET['todo'] == "create_cabinet") {
        create_cabinet();
    }
    // Cas de la création d'un delegate
    if ($_GET['todo'] == "create_delegate") {
        create_delegate();
    }
    // Cas de la suppression d'un cabinet
    if ($_GET['todo'] == "delete_cabinet") {
        delete_cabinet($_GET["cabinet_id"]);
    }
}

function create_cabinet() {
    $db = new PDO('mysql:host=localhost;dbname=MUN;charset=utf8mb4', 'root', '');
    $argumentsCorrect = (isset($_POST['cabinet_name']) && isset($_POST['cabinet_description']) && strlen($_POST['cabinet_name']) > 0 && strlen($_POST['cabinet_description']) > 0);
    if (!$argumentsCorrect) {
        echo "Wrong arguments for cabinet creation";
        exit;
    } else {
        $cabinet_name = htmlspecialchars($_POST['cabinet_name']);
        $cabinet_description = htmlspecialchars($_POST['cabinet_description']);
        $req = $db->prepare("INSERT INTO `cabinets` (`id`, `name`, `description`) VALUES (NULL, ?, ?)");
        $success = $req->execute(array($cabinet_name, $cabinet_description));
        if (!$success) {
            echo "Cabinet creation failed";
            exit;
        } else {
            echo "Cabinet creation successful";
            exit;
        }
    }
}

function delete_cabinet($cabinet_id) {
    $cabinet_id = htmlspecialchars($cabinet_id);
    $db = new PDO('mysql:host=localhost;dbname=MUN;charset=utf8mb4', 'root', '');
    $argumentsCorrect = true;
    if (!$argumentsCorrect) {
        echo "Wrong arguments for cabinet deletion";
        exit;
    } else {
        $req = $db->prepare("DELETE FROM cabinets WHERE id=?");
        $success = $req->execute(array($cabinet_id));
        if (!$success) {
            echo "Cabinet deletion failed";
            exit;
        } else {
            echo "Cabinet deletion successful";
            exit;
        }
    }
}

function create_delegate() {
    $db = new PDO('mysql:host=localhost;dbname=MUN;charset=utf8mb4', 'root', '');
    $argumentsCorrect = isset($_POST["delegate_login"]) && isset($_POST["delegate_password"]) && isset($_POST["delegate_admin"]) && isset($_POST["delegate_name"]) && isset($_POST["delegate_cabinet"]) && isset($_POST["delegate_character"]) && isset($_POST["delegate_description"]) && strlen($_POST["delegate_login"]) > 0 && strlen($_POST["delegate_password"]) > 0 && strlen($_POST["delegate_name"]) > 0 && strlen($_POST["delegate_cabinet"]) > 0 && strlen($_POST["delegate_character"]) > 0;
    if (!$argumentsCorrect) {
        echo "Wrong arguments for delegate creation";
        exit;
    } else {
        $delegate_login = htmlspecialchars($_POST['delegate_login']);
        $delegate_password = htmlspecialchars($_POST['delegate_password']);
        $delegate_admin = htmlspecialchars($_POST['delegate_admin']);
        $delegate_name = htmlspecialchars($_POST['delegate_name']);
        $delegate_cabinet = htmlspecialchars($_POST['delegate_cabinet']);
        $delegate_character = htmlspecialchars($_POST['delegate_character']);
        $delegate_description = htmlspecialchars($_POST['delegate_description']);
        $req = $db->prepare("INSERT INTO `users` (`id`, `login`, `password_hash`, `admin`, `name`, `cabinet`, `character`, `description`, `alive`, `email`, `phone`) VALUES (NULL, ?, SHA1(?), ?, ?, ?, ?, ?, '1', NULL, NULL)");
        $success = $req->execute(array($delegate_login, $delegate_password, $delegate_admin, $delegate_name, $delegate_cabinet, $delegate_character, $delegate_description));
        if (!$success) {
            echo "Delegate creation failed";
            exit;
        } else {
            echo "Delegate creation successful";
            exit;
        }
    }
}

function delete_delegate($delegate_id) {
    $delegate_id = htmlspecialchars($delegate_id);
    $db = new PDO('mysql:host=localhost;dbname=MUN;charset=utf8mb4', 'root', '');
    $argumentsCorrect = true;
    if (!$argumentsCorrect) {
        echo "Wrong arguments for delegate deletion";
        exit;
    } else {
        $req = $db->prepare("DELETE FROM users WHERE id=?");
        $success = $req->execute(array($delegate_id));
        if (!$success) {
            echo "Delegate deletion failed";
            exit;
        } else {
            echo "Delegate deletion successful";
            exit;
        }
    }
}

?>
