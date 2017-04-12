<?php

session_name("SecretSessionName");
session_start();

require("database.php");
require("logInOut.php");

if (!isLogged()) {
    echo "ERROR";
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == 'sendMessage') {
    $success = false;
    if (!isset($_POST['message'])) {
        echo "Message sending failed.";
        exit();
    }
    $message = htmlspecialchars($_POST["message"]);
    $argumentsCorrect = strlen($message) > 0;
    $UID = $_SESSION["userId"];
    $cabinet = $_SESSION["cabinet"];
    $db = MyDatabase::connect();
    $req = $db->prepare("INSERT INTO chat (user, cabinet, message) VALUES(?, ?, ?)");
    if ($argumentsCorrect) {
        $success = $req->execute(array($UID, $cabinet, $message));
    }
    if (!$success) {
        echo "Message sending failed.";
    } else {
        echo "Message sending successful.";
    }
}

elseif (isset($_GET['todo']) && $_GET['todo'] == 'getMessages') {
    $db = MyDatabase::connect();
    $messages = $db->query("SELECT * FROM chat INNER JOIN users ON chat.user = users.id WHERE chat.cabinet = " . $_SESSION['cabinet'] . " ORDER BY chat.message_date ASC;");
    while ($message = $messages->fetch()) {
        echo "<p>";
        echo '<a href="index.php?page=profile&userId=' . $message['user'] . '"> ' . $message['name'] . " </a> (" . $message["message_date"] . ") <br>";
        echo($message['message']);
        echo "</p>";
    }
}

else {
    echo "ERROR";
}
