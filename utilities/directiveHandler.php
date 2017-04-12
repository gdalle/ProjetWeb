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

if (isLogged() && $_GET['todo'] == "send_directive") {
    send_directive($dbh);
    header("Location: ../index.php?page=send_directives");
}
if (isLogged() && $_GET['todo'] == "vote_directive") {
    vote_directive($dbh);
    header("Location: ../index.php?page=send_directives");
}
if (isLogged() && isAdmin() && $_GET['todo'] == "answer_directive") {
    answer_directive($dbh);
    header("Location: ../index.php?page=manage_directives");
}
if (isLogged() && isAdmin() && $_GET['todo'] == "delete_directive") {
    delete_directive($dbh);
}

function send_directive($dbh) {
    $success = false;
    $delegate = $_SESSION["userId"];
    $cabinet = $_SESSION["cabinet"];
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    $collective = htmlspecialchars($_POST["collective"]);
    $argumentsCorrect = true;
    if ($argumentsCorrect) {
        $success = Directive::insertDirective($dbh, $delegate, $cabinet, $title, $content, $collective);
    }
    if ($success) {
        echo "Insertion successful";
    } else {
        echo "Insertion failed";
    }
    return $success;
}

function answer_directive($dbh) {
    $success = false;
    $id = htmlspecialchars($_POST["directiveId"]);
    $answer = htmlspecialchars($_POST["answer"]);
    $argumentsCorrect = true;
    if ($argumentsCorrect) {
        $success = Directive::answerDirective($dbh, $id, $answer);
    }
    if ($success) {
        echo "Answer successful";
    } else {
        echo "Answer failed";
    }
    return $success;
}

function delete_directive($dbh) {
    $success = false;
    $id = htmlspecialchars($_POST["directiveId"]);
    $argumentsCorrect = true;
    if ($argumentsCorrect) {
        $success = Directive::deleteDirective($dbh, $id);
    }
    if ($success) {
        echo "Deletion successful";
    } else {
        echo "Deletion failed";
    }
    return $success;
}

function vote_directive($dbh) {
    $success = false;
    $directiveId = htmlspecialchars($_POST["directiveId"]);
    $delegateId = htmlspecialchars($_SESSION["userId"]);
    $vote = htmlspecialchars($_POST["vote"]);
    $argumentsCorrect = true;
    if ($argumentsCorrect) {
        if ($vote == "favor") {
            $success = Directive::voteDirective($dbh, $directiveId, $delegateId, true);
        } else {
            $success = Directive::voteDirective($dbh, $directiveId, $delegateId, false);
        }
    }
    if ($success) {
        echo "Vote successful";
    } else {
        echo "Vote failed";
    }
    return $success;
}

?>