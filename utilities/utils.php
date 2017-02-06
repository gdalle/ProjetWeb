<?php

$pageList = array();
$pageList["accueil"] = array(
    "name" => "accueil",
    "title" => "Assistant DE",
    "subtitle" => "Accueil",
    "subPages" => false,
    "menuTitle" => "Accueil");
$pageList["forums"] = array(
    "name" => "forums",
    "title" => "Forums",
    "subtitle" => "Accueil",
    "subPages" => true,
    "menuTitle" => "Forums");
$pageList["deadlines"] = array(
    "name" => "deadlines",
    "title" => "Deadlines",
    "subtitle" => "Accueil",
    "subPages" => true,
    "menuTitle" => "Deadlines");
$pageList["psc"] = array(
    "name" => "psc",
    "title" => "Projets Scientifiques Collectifs",
    "subtitle" => "Accueil",
    "subPages" => true,
    "menuTitle" => "PSC");
$pageList["langues"] = array(
    "name" => "langues",
    "title" => "Cours de langues",
    "subtitle" => "Accueil",
    "subPages" => true,
    "menuTitle" => "Langues");
$pageList["description"] = array(
    "name" => "description",
    "title" => "Cours de langues",
    "subtitle" => "Description",
    "subPages" => false,
    "menuTitle" => "Description des cours");
$pageList["affectation"] = array(
    "name" => "affectation",
    "title" => "Cours de langues",
    "subtitle" => "Affectation",
    "subPages" => false,
    "menuTitle" => "Affectation");
$pageList["prerequis"] = array(
    "name" => "prerequis",
    "title" => "Prérequis cours 2A/3A",
    "subtitle" => "Accueil",
    "subPages" => true,
    "menuTitle" => "Prérequis");

$menuPageList = array("forums", "deadlines", "psc", "langues", "prerequis");

$subPageList = array();
$subPageList["forums"] = array("forums");
$subPageList["psc"] = array("psc");
$subPageList["deadlines"] = array("deadlines");
$subPageList["prerequis"] = array("prerequis");
$subPageList["langues"] = array("langues", "description", "affectation");

function checkPage($askedPage) {
    global $pageList;
    foreach ($pageList as $page) {
        if ($askedPage == $page["name"]) {
            return true;
        }
    }
    return false;
}

function getPageTitle($askedPage) {
    global $pageList;
    foreach ($pageList as $page) {
        if ($askedPage == $page["name"]) {
            return $page["title"];
        }
    }
    return "Erreur";
}

function getPageSubtitle($askedPage) {
    global $pageList;
    foreach ($pageList as $page) {
        if ($askedPage == $page["name"]) {
            return $page["subtitle"];
        }
    }
    return "(Grosse erreur)";
}

function generateHTMLHeader($title) {
    echo <<<CHAINE_DE_FIN
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8"/>
            <meta name="author" content="Guillaume Dalle"/>
            <title>$title</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- CSS Perso -->
            <link href="css/style.css" rel="stylesheet">
            <!-- CSS Bootstrap -->
            <link href="css/bootstrap.css" rel="stylesheet">
            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.js"></script>
        </head>
        <body>
            <div class="container fluid">
            
CHAINE_DE_FIN;
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
            </div>
        </body>
    </html>
CHAINE_DE_FIN;
}

function generateMenu($askedPage) {
    global $pageList;
    global $menuPageList;
    echo <<<CHAINE_DE_FIN
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?page=accueil">Assistant DE</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
CHAINE_DE_FIN;
    foreach ($menuPageList as $pageName) {
        if ($pageList[$pageName]["subPages"]) {
            menuSubitems($askedPage, $pageList[$pageName]);
        } else {
            menuItem($askedPage, $pageList[$pageName]);
        }
    }

    echo <<<CHAINE_DE_FIN
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
CHAINE_DE_FIN;
}

function menuItem($askedPage, $page) {
    $name = $page["name"];
    $menuTitle = $page["menuTitle"];
    if ($name == $askedPage) {
        echo "<li class='active'><a href='index.php?page=$name'>$menuTitle</a></li>";
    } else {
        echo "<li><a href='index.php?page=$name'>$menuTitle</a></li>";
    }
}

function subPageActive($askedPage, $page){
    global $subPageList;
    $name = $page["name"];
    foreach ($subPageList[$name] as $subPage){
        if ($askedPage == $subPage){
            return true;
        }
    }
    return false;
}

function menuSubitems($askedPage, $page) {
    global $pageList;
    global $subPageList;
    $name = $page["name"];
    $menuTitle = $page["menuTitle"];
    if (subPageActive($askedPage, $page)){
        echo "<li class = 'dropdown active'>";
    }
    else{
        echo "<li class = 'dropdown'>";
    }
    echo "<a href = '#' class = 'dropdown-toggle' data-toggle = 'dropdown'>" . $menuTitle . "</a>";
    echo "<ul class = 'dropdown-menu'>";
    foreach ($subPageList[$name] as $subPage) {
        echo "<li><a href ='index.php?page=";
        echo $subPage;
        echo "'>";
        if ($subPage == $name) {
            echo "Accueil";
        } else {
            echo $pageList[$subPage]["menuTitle"];
        }
        echo "</a></li>";
    }
    echo "</ul>";
    echo "</li>";
}

?>
