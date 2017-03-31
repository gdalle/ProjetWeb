<?php
$pageList = array();
$pageList["home"] = array(
    "name" => "home",
    "title" => "MUN Crisis Manager",
    "subtitle" => "Home page",
    "subPages" => false,
    "menuTitle" => "Home");
$pageList["news_messages"] = array(
    "name" => "news_messages",
    "title" => "News & Messages",
    "subtitle" => "Keep tabs on the universe",
    "subPages" => false,
    "menuTitle" => "News & Messages");
$pageList["directives"] = array(
    "name" => "directives",
    "title" => "Directives",
    "subtitle" => "Home",
    "subPages" => true,
    "menuTitle" => "Directives");
$pageList["responses"] = array(
    "name" => "responses",
    "title" => "Directives",
    "subtitle" => "Past directives & Responses from the backroom",
    "subPages" => false,
    "menuTitle" => "Responses");
$pageList["send_directives"] = array(
    "name" => "send_directives",
    "title" => "Directives",
    "subtitle" => "Send a directive",
    "subPages" => false,
    "menuTitle" => "Send");
$pageList["situation"] = array(
    "name" => "situation",
    "title" => "Situation",
    "subtitle" => "Home",
    "subPages" => true,
    "menuTitle" => "Situation");
$pageList["military"] = array(
    "name" => "military",
    "title" => "Situation",
    "subtitle" => "Military briefing",
    "subPages" => false,
    "menuTitle" => "Military");
$pageList["economic"] = array(
    "name" => "economic",
    "title" => "Situation",
    "subtitle" => "Economic briefing",
    "subPages" => false,
    "menuTitle" => "Economic");
$pageList["social"] = array(
    "name" => "social",
    "title" => "Situation",
    "subtitle" => "Social & political briefing",
    "subPages" => false,
    "menuTitle" => "Social");
$pageList["backroom"] = array(
    "name" => "backroom",
    "title" => "Backroom",
    "subtitle" => "Where the shit happens",
    "subPages" => true,
    "menuTitle" => "Backroom");
$pageList["manage_directives"] = array(
    "name" => "manage_directives",
    "title" => "Backroom management",
    "subtitle" => "Directives",
    "subPages" => false,
    "menuTitle" => "Directives");
$pageList["manage_news"] = array(
    "name" => "manage_news",
    "title" => "Backroom management",
    "subtitle" => "News",
    "subPages" => false,
    "menuTitle" => "News");
$pageList["manage_situation"] = array(
    "name" => "manage_situation",
    "title" => "Backroom management",
    "subtitle" => "Situation",
    "subPages" => false,
    "menuTitle" => "Situation");
$pageList["cabinets_delegates"] = array(
    "name" => "cabinets_delegates",
    "title" => "Backroom management",
    "subtitle" => "Cabinets & delegates",
    "subPages" => false,
    "menuTitle" => "Cabinets & delegates");
$pageList["login"] = array(
    "name" => "login",
    "title" => "MUN Crisis Manager",
    "subtitle" => "Log in",
    "subPages" => false,
    "menuTitle" => "Log in");
$pageList["profile"] = array(
    "name" => "profile",
    "title" => "Manage your profile",
    "subtitle" => "Tell us all about you",
    "subPages" => false,
    "menuTitle" => "Profile");



$menuPageList = array("news_messages", "situation", "directives");
$menuPageListAdmin = array("news_messages", "situation", "backroom");
$menuPageListUnlogged = array("news_messages", "situation");

$subPageList = array();
$subPageList["directives"] = array("responses", "send_directives");
$subPageList["situation"] = array("economic", "military", "social");
$subPageList["backroom"] = array("cabinets_delegates", "manage_news", "manage_situation", "manage_directives");

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

function imports() {
    echo <<<CHAINE_DE_FIN
    <!-- CSS Perso -->
    <link href="css/style.css" rel="stylesheet">
    <!-- CSS Bootstrap et autres -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" charset="utf-8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
CHAINE_DE_FIN;
}

function generateHTMLHeader($pageTitle) {
    echo <<<CHAINE_DE_FIN
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <meta name="author" content="Guillaume Dalle & Benjamin Petit"/>
            <title>$pageTitle</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
CHAINE_DE_FIN;
            imports() ;       
    echo <<<CHAINE_DE_FIN
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
    global $menuPageListAdmin;
    global $menuPageListUnlogged;
    echo <<<CHAINE_DE_FIN
    <!-- Fixed navbar -->
    <nav id="custom-bootstrap-menu" class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?page=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
CHAINE_DE_FIN;
    $logged = isLogged();
    $admin = isAdmin();
    if ($logged) {
        if ($admin) {
            $rightMenuPageList = $menuPageListAdmin;
        } else {
            $rightMenuPageList = $menuPageList;
        }
    } else {
        $rightMenuPageList = $menuPageListUnlogged;
    }

    foreach ($rightMenuPageList as $pageName) {
        if ($pageList[$pageName]["subPages"]) {
            menuSubitems($askedPage, $pageList[$pageName]);
        } else {
            menuItem($askedPage, $pageList[$pageName]);
        }
    }


    echo ' </ul>
        <ul class="nav navbar-nav navbar-right">';
    if ($logged) {
        $name = $_SESSION['name'];
        echo ('<li><a href="index.php?page=profile"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>');
        echo ('<li><a href="index.php?page=home&todo=logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>');
    } else {
        echo ('<li><a href="index.php?page=login">Log in</a></li>');
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

function subPageActive($askedPage, $page) {
    global $subPageList;
    $name = $page["name"];
    foreach ($subPageList[$name] as $subPage) {
        if ($askedPage == $subPage) {
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
    if (subPageActive($askedPage, $page)) {
        echo "<li class = 'dropdown active'>";
    } else {
        echo "<li class = 'dropdown'>";
    }
    echo "<a href = '#' class = 'dropdown-toggle' data-toggle = 'dropdown'>" . $menuTitle . "</a>";
    echo "<ul class = 'dropdown-menu'>";
    foreach ($subPageList[$name] as $subPage) {
        echo "<li><a href ='index.php?page=";
        echo $subPage;
        echo "'>";
        if ($subPage == $name) {
            echo "Home";
        } else {
            echo $pageList[$subPage]["menuTitle"];
        }
        echo "</a></li>";
    }
    echo "</ul>";
    echo "</li>";
}

?>
