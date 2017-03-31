<?php
$noUser = !isset($_GET["userId"]);
$rightUser = ($_GET["userId"] == $_SESSION["userId"]);
if ($noUser) {
    header("Location: ./index.php?page=home");
} else {
    $user = User::getUserId($dbh, $_GET["userId"]);
    if ($user == null) {
        header("Location: ./index.php?page=home");
    } else {
        $cabinet = Cabinet::getCabinet($dbh, $user->cabinet);
    }
}
?>

<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <?php
                echo "<h3 class='panel-title'> Profile picture</h3>";
                ?>
            </div>

            <div class="panel-body">
                <?php
                $photoLD = "img/" . $user->login . ".jpg";
                echo "<img class='img-responsive' src=$photoLD alt='Profile picture'>";
                if (isAdmin() || $rightUser) {
                    echo <<<END_STRING
                <br>
                <form action="utilities/uploadPicture.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profile_picture">Change your picture<br>(jpg format)</label>
                        <input type="file" class="form-control" name="profile_picture" id="profile_picture"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Make me pretty</button>
                </form>
END_STRING;
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Profile information</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" id="profile_name">
                        <?php
                        echo "<b>Name : </b> " . $user->name;
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        echo "<b>Cabinet : </b>" . $cabinet;
                        ?>
                    </li>
                    <li class="list-group-item" id="profile_character">
                        <?php
                        echo "<b>Character : </b>" . $user->character;
                        ?>
                    </li>
                    <li class="list-group-item" id="profile_description">
                        <?php
                        echo "<b>Description : </b> <span id='content_changer_1'>" . $user->description . "</span>";
                        if ($rightUser || isAdmin()) {
                            echo <<<END_STRING
                            <span class='glyphicon glyphicon-pencil show_changer' id="show_changer_1"></span>
                            <br>
                            <form id="show_changer_1_form" hidden>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="newDescription" placeholder="Enter new description">
                                </div>
                                <button type="submit" class="btn btn-primary" id="change_description">Save</button>
                            </form>
END_STRING;
                        }
                        ?>
                    </li>
                    <li class="list-group-item" id="profile_email">
                        <?php
                        echo "<b>Email : </b> <span id='content_changer_2'>" . $user->email . "</span>";
                        if ($rightUser || isAdmin()) {
                            echo <<<END_STRING
                            <span class='glyphicon glyphicon-pencil show_changer' id="show_changer_2"></span>
                            <br>
                            <form id="show_changer_2_form" hidden>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="newEmail" placeholder="Enter new email">
                                </div>
                                <button type="submit" class="btn btn-primary" id="change_email">Save</button>
                            </form>
END_STRING;
                        }
                        ?>
                    </li>
                    <li class="list-group-item" id="profile_phone">
                        <?php
                        echo "<b>Phone : </b> <span id='content_changer_3'>" . $user->phone . "</span>";
                        if ($rightUser || isAdmin()) {
                            echo <<<END_STRING
                            <span class='glyphicon glyphicon-pencil show_changer' id="show_changer_3"></span>
                            <br>
                            <form id="show_changer_3_form" hidden>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="newPhone" placeholder="Enter new phone">
                                </div>
                                <button type="submit" class="btn btn-primary" id="change_phone">Save</button>
                            </form>
END_STRING;
                        }
                        ?>
                    </li>
                    <li class="list-group-item" id="change_result" hidden>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Login information</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php
                        echo "<b>Login : </b>" . $user->login;
                        ?>
                    </li>
                    <?php
                    if ($rightUser || isAdmin()) {
                        echo <<<END_STRING
                    <li class="list-group-item">
                        <form id="password_changer">
                            <div class="form-group">
                                <label for="oldPassword">Old password :</label>
                                <input type="password" class="form-control" id="oldPassword">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New password :</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <button type='submit' class='btn btn-primary' id='change_password'>Change password</button>
                            <div id="password_change_result"></div>
                        </form>
                    </li>
END_STRING;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

</div>