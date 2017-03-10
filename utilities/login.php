<?php
  session_start();
  if(isset($_GET['todo']) && $_GET['todo']=="login")
  {
    if(!isset($_POST['login']) || !isset($_POST['password']))
    {
      header("Location: ../index.php?page=login&error=true");
      exit;
    }
    $db = new PDO('mysql:host=localhost;dbname=MUN;charset=utf8mb4', 'root', '');
    $req = $db->prepare("SELECT * FROM users WHERE login = ? AND password_hash = ?");
    $req->execute(array($_POST['login'], sha1($_POST['password'])));
    if($req->rowCount()==1)
    {
      $data = $req->fetch();
      $_SESSION['login'] = $_POST['login'];
      $_SESSION['name'] = $data['character'];
      $_SESSION['admin'] = $data['admin'];
      $_SESSION['id'] = $data['id'];
      $_SESSION['cabinet'] = $data['cabinet'];
      header("Location: ../index.php"); exit;
    } else { header("Location: ../index.php?page=login&error=true"); exit; }
  }
  if(isset($_GET['todo']) && $_GET['todo']=="logout")
  {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
  }
 ?>