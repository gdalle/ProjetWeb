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

if (isAdmin() && $_GET['todo'] == "publish_news") {
    publish_news($dbh);
} elseif (isAdmin() && isset($_GET['todo']) && $_GET['todo'] == 'create_newsItem') {
    create_news_item($dbh);
} elseif (isAdmin() && isset($_GET['todo']) && $_GET['todo'] == 'delete_newsItem') {
    delete_news_item($dbh);
} else {
    echo "ERROR";
}

function publish_news($dbh) {
    $title = htmlspecialchars($_POST["news_title"]);
    $content = htmlspecialchars($_POST["news_content"]);
    $argumentsCorrect = strlen($title) > 0 && strlen($content) > 0;
    $success = false;
    if ($argumentsCorrect) {
        $success = NewsItem::insertNewsItem($dbh, $title, $content);
    }
    if ($success) {
        echo "Publication succeeded";
    } else {
        echo "Publication failed";
    }
    return $success;
}

function create_news_item($dbh) {
    $success = false;
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
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
