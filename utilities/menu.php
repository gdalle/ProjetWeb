<?php

$onlyIcon = false;
$onlyText = false;

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
    "menuTitle" => "News & Messages",
    "icon" => "<span class='glyphicon glyphicon-comment'></span>");
$pageList["directives"] = array(
    "name" => "directives",
    "title" => "Directives",
    "subtitle" => "Home",
    "subPages" => true,
    "menuTitle" => "Directives",
    "icon" => "<span class='glyphicon glyphicon-list-alt'></span>");
$pageList["responses"] = array(
    "name" => "responses",
    "title" => "Directives",
    "subtitle" => "Past directives & Responses from the backroom",
    "subPages" => false,
    "menuTitle" => "Responses");
$pageList["send_directives"] = array(
    "name" => "send_directives",
    "title" => "Directives",
    "subtitle" => "Send directives",
    "subPages" => false,
    "menuTitle" => "Send & vote");
$pageList["situation"] = array(
    "name" => "situation",
    "title" => "Situation",
    "subtitle" => "Home",
    "subPages" => true,
    "menuTitle" => "Situation",
    "icon" => "<span class='glyphicon glyphicon-eye-open'></span>");
$pageList["military"] = array(
    "name" => "military",
    "title" => "Situation",
    "subtitle" => "Military briefing",
    "subPages" => false,
    "menuTitle" => "Military situation");
$pageList["economic"] = array(
    "name" => "economic",
    "title" => "Situation",
    "subtitle" => "Economic briefing",
    "subPages" => false,
    "menuTitle" => "Economic situation");
$pageList["backroom"] = array(
    "name" => "backroom",
    "title" => "Backroom",
    "subtitle" => "Where the shit happens",
    "subPages" => true,
    "menuTitle" => "Backroom",
    "icon" => "<span class='glyphicon glyphicon-king'></span>");
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
    "menuTitle" => "Delegates",
    "icon" => "<span class='glyphicon glyphicon-pawn'></span>");
$pageList["login"] = array(
    "name" => "login",
    "title" => "MUN Crisis Manager",
    "subtitle" => "Log in",
    "subPages" => false,
    "menuTitle" => "Log in",
    "icon" => "<span class='glyphicon glyphicon-log-in'></span>");
$pageList["profile"] = array(
    "name" => "profile",
    "title" => "Profile",
    "subtitle" => "I'ts amazing how much we know about you",
    "subPages" => false,
    "menuTitle" => "Profile",
    "icon" => "<span class='glyphicon glyphicon-user'></span>");



$menuPageList = array("news_messages", "situation", "directives");
$menuPageListAdmin = array("news_messages", "situation", "backroom");
$menuPageListUnlogged = array();

$subPageList = array();
$subPageList["directives"] = array("send_directives", "responses");
$subPageList["situation"] = array("economic", "military");
$subPageList["backroom"] = array("manage_directives", "manage_news", "manage_situation");

function checkPage($askedPage) {
    global $pageList;
    foreach ($pageList as $page) {
        if ($askedPage == $page["name"] && $page["subPages"] == false) {
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.css">

    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/code.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/gcal.js"></script>
  
    
    
CHAINE_DE_FIN;
}

function buildMap()
{
  echo <<<ENDSTR
    <link rel="stylesheet" href="lib/AMCharts/ammap/ammap.css" type="text/css">
    <script src="lib/AMCharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="lib/AMCharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>

    <script>
      // svg path for target icon
      var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";

      var map = AmCharts.makeChart("mapdiv", {
        type: "map",

        projection:"miller",
        imagesSettings: {
          rollOverColor: "#CC0000",
          rollOverScale: 3,
          selectedScale: 3,
          selectedColor: "#CC0000"
        },

        areasSettings: {
          outlineThickness:0.5
        },

        dataProvider: {
          map: "worldLow",
          images: [
ENDSTR;
    $dbh = MyDatabase::connect();
    $res = $dbh->query('SELECT * FROM map_points;');
    while($point=$res->fetch())
    {
      echo '{svgPath: targetSVG, zoomLevel: 5, scale: 0.5, title: "' . $point['title'] . '", latitude: ' . $point['latitude'] . ', longitude: ' . $point['longitude'] . '},';
    }
  echo <<<ENDSTR
  ]
        },
      });
    </script>
ENDSTR;
}

function generateHTMLHeader($pageTitle) {
    echo <<<CHAINE_DE_FIN
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8"/>
            <meta name="author" content="Guillaume Dalle & Benjamin Petit"/>
            <title>$pageTitle</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
CHAINE_DE_FIN;
    imports();
    if($pageTitle=='Situation')
    {
      buildMap();
    }
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
        if ($admin) {
            menuItem($askedPage, $pageList["cabinets_delegates"]);
            //echo ("<li><a href='index.php?page=cabinets_delegates'>Users &nbsp; <span class='glyphicon glyphicon-pawn' aria-hidden='true'></span></a></li>");
        }
        echo ("<li><a href='index.php?page=profile&userId=" . $_SESSION["userId"] . "'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>&nbsp; Profile</a></li>");
        echo ('<li><a href="index.php?page=home&todo=logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>');
    } else {
        menuItem($askedPage, $pageList["login"]);
        //echo ('<li><a href="index.php?page=login">Log in</a></li>');
    }
    echo <<<CHAINE_DE_FIN
        </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
CHAINE_DE_FIN;
}

function menuItem($askedPage, $page) {
    global $onlyIcon;
    global $onlyText;
    $name = $page["name"];
    $menuTitle = $page["menuTitle"];
    $icon = $page["icon"];
    if ($onlyIcon) {
        $realTitle = $icon;
    } else if ($onlyText) {
        $realTitle = $menuTitle;
    } else {
        $realTitle = "$icon &nbsp; $menuTitle";
    }
    if ($name == $askedPage) {
        echo "<li class='active'><a href='index.php?page=$name'>$realTitle</a></li>";
    } else {
        echo "<li><a href='index.php?page=$name'>$realTitle</a></li>";
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
    global $onlyIcon;
    global $onlyText;
    $name = $page["name"];
    $menuTitle = $page["menuTitle"];
    $icon = $page["icon"];
    if ($onlyIcon) {
        $realTitle = $icon;
    } else if ($onlyText) {
        $realTitle = $menuTitle;
    } else {
        $realTitle = "$icon &nbsp; $menuTitle";
    }
    if (subPageActive($askedPage, $page)) {
        echo "<li class = 'dropdown active'>";
    } else {
        echo "<li class = 'dropdown'>";
    }
    echo "<a href = '#' class = 'dropdown-toggle' data-toggle = 'dropdown'>$realTitle</a>";
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
