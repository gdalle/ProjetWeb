<?php

session_name("SecretSessionName");
session_start();

require("database.php");
require("logInOut.php");

if (!isLogged()) {
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == 'sendMessage' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $UID = $_SESSION["userId"];
    $cabinet = $_SESSION["cabinet"];
    $db = MyDatabase::connect();
    $success = ChatMessage::insertMessage($db, $UID, $cabinet, $message);
}

elseif (isset($_GET['todo']) && $_GET['todo'] == 'getMessages') {
    $db = MyDatabase::connect();
    $sth = $db->prepare("SELECT * FROM chat INNER JOIN users ON chat.user = users.id WHERE chat.cabinet = ? ORDER BY chat.message_date ASC;");
    $sth->execute(array($_SESSION['cabinet']));
    while ($message = $sth->fetch()) {
        echo "<p>";
        echo '<a href="index.php?page=profile&userId=' . $message['user'] . '"> ' . $message['name'] . " </a> (" . $message["message_date"] . ") <br>";
        echo($message['message']);
        echo "</p>";
    }
}

else {
    echo "ERROR";
}
