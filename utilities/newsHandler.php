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

if (isLogged() && $_GET['todo'] == "publish_news") {
    publish_news($dbh);
    header("Location: ../index.php?page=manage_news");
}

function publish_news($dbh) {
    $title = htmlspecialchars($_POST["news_title"]);
    $content = htmlspecialchars($_POST["news_content"]);
    $argumentsCorrect = true;
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
?>
