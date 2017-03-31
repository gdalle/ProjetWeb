<?php

session_name("SecretSessionName");
session_start();

require("database.php");
require("logInOut.php");

if (!isLogged()) {
    echo "ERROR!";
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == 'sendMessage') {
    if (!isset($_POST['message'])) {
        echo "ERROR!";
        exit();
    }
    $message = $_POST["message"];
    $UID = $_SESSION["userId"];
    $cabinet = $_SESSION["cabinet"];
    $db = MyDatabase::connect();
    $req = $db->prepare("INSERT INTO chat (user, cabinet, message) VALUES(?, ?, ?)");
    $success = $req->execute(array($UID, $cabinet, $message));
}

if (isset($_GET['todo']) && $_GET['todo'] == 'getMessages') {
    $db = MyDatabase::connect();
    $messages = $db->query("SELECT * FROM chat INNER JOIN users ON chat.user = users.id WHERE chat.cabinet = " . $_SESSION['cabinet'] . " ORDER BY chat.message_date ASC;");
    while ($message = $messages->fetch()) {

        echo "<p>";
        echo "<b> " . $message['name'] . " </b> (". $message["message_date"]. ") <br>";
        echo($message['message']);
        echo "</p>";
    }
}
