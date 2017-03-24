<?php
session_name("SecretSessionName");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
require("database.php");
$dbh = MyDatabase::connect();
$user = User::getUserId($dbh, $_SESSION["userId"]);

function resizeImage($photoHD, $photoLD, $newWidth) {
    list($widthOrig, $heightOrig) = getimagesize($photoHD);
    $ratio = $widthOrig / $newWidth;
    $newHeight = $heightOrig / $ratio;
    $tmpPhotoLD = imagecreatetruecolor($newWidth, $newHeight);
    $image = imagecreatefromjpeg($photoHD);
    imagecopyresampled($tmpPhotoLD, $image, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
    imagejpeg($tmpPhotoLD, $photoLD, 100);
}

echo 'Hello';
// ex pour une image jpg
if (!empty($_FILES['profile_picture']['tmp_name']) && is_uploaded_file($_FILES['profile_picture']['tmp_name'])) {
// Le fichier a bien été téléchargé
// Par sécurité on utilise getimagesize plutot que les variables $_FILES
    list($larg, $haut, $type, $attr) = getimagesize($_FILES['profile_picture']['tmp_name']);
    echo $larg . " " . $haut . " " . $type . " " . $attr;
// JPEG => type=2
    if ($type == 2) {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../img/' . $_SESSION["login"] . '.jpg')) {
            echo "Upload successful";
            $newWidth = 200;
            $photoHD = "../img/" . $user->login . ".jpg";
            $photoLD = "../img/" . $user->login . "LD.jpg";
            resizeImage($photoHD, $photoLD, $newWidth);
            echo "Resize successful";
        } else {
            echo "Upload failed";
        }
    } else
        echo "Wrong file type";
}
?>