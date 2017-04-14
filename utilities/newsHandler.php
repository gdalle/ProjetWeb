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


if (isAdmin() && isset($_GET['todo']) && $_GET['todo'] == 'publish_news') {
    publish_news_item($dbh);
} elseif (isAdmin() && isset($_GET['todo']) && $_GET['todo'] == 'delete_newsItem') {
    delete_news_item($dbh);
} else {
    echo "ERROR";
}

function publish_news_item($dbh) {
    $success = false;
    $title = htmlspecialchars($_POST["news_form_title"]);
    $content = htmlspecialchars($_POST["news_form_content"]);
    $argumentsCorrect = strlen($title) > 0 && strlen($content) > 0;
    if ($argumentsCorrect) {
        $success = NewsItem::insertNewsItem($dbh, $title, $content);
    }
    if ($success){
        echo 'News item insertion successful.';
    } else {
        echo "News item insertion failed.";
    }
}

function delete_news_item($dbh) {
    $success = false;
    $id = htmlspecialchars($_POST["id"]);
    $success = NewsItem::deleteNewsItem($dbh, $id);
    if ($success){
        echo 'News item deletion successful.';
    } else {
        echo "News item deletion failed.";
    }
}
?>
