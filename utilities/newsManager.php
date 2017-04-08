<?php
session_name("SecretSessionName");
session_start();
require("database.php");
require("logInOut.php");

if(!isLogged() || !isAdmin())
{
  echo "ERROR!!!";
  exit();
}

if(isset($_GET['todo']) && $_GET['todo']=='delete_newsItem' && isset($_POST['id']))
{
  //Eventuellement de petites vérifications à effectuer avant d'envoyer le $_POST.
  $db = MyDatabase::connect();
  NewsItem::deleteNewsItem($db, $_POST['id']);
  echo 'DONE!';
}

if(isset($_GET['todo']) && $_GET['todo']=='create_newsItem' && isset($_POST['title']) && isset($_POST['content']))
{
  $db = MyDatabase::connect();
  NewsItem::insertNewsItem($db, $_POST["title"], $_POST['content']);
  echo 'DONE!';
}

?>
