<?php
$user = User::getUserId($dbh, $_SESSION["userId"]);
$cabinet = Cabinet::getCabinet($dbh, $user->cabinet);
?>

<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <?php
                echo "<h3 class='panel-title'> You look good " . $user->name . " !</h3>";
                ?>
            </div>

            <div class="panel-body">
                <?php
                $photoLD = "img/" . $user->login . ".jpg";
                echo "<img class='img-responsive' src=$photoLD alt='Profile picture'>";
                ?>
                <br>
                <form action="utilities/upload_picture.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profile_picture">Change your picture</label>
                        <input type="file" class="form-control" name="profile_picture" id="profile_picture"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Make me pretty</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Your profile information</h3>
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
                        echo "<b>Description : </b>" . $user->description;
                        ?>
                        <span class='glyphicon glyphicon-pencil show_changer' id="show_changer_1"></span>
                        <form id="show_changer_1_form" hidden>
                            <div class="form-group">
                                <input type="text" class="form-control" id="newDescription" placeholder="Enter new description">
                            </div>
                            <button type="submit" class="btn btn-primary" id="change_description">Save</button>
                        </form>
                    </li>
                    <li class="list-group-item" id="profile_email">
                        <?php
                        echo "<b>Email : </b>" . $user->email;
                        ?>
                        <span class='glyphicon glyphicon-pencil show_changer' id="show_changer_2"></span>
                        <form id="show_changer_2_form" hidden>
                            <div class="form-group">
                                <input type="email" class="form-control" id="newEmail" placeholder="Enter new email">
                            </div>
                            <button type="submit" class="btn btn-primary" id="change_email">Save</button>
                        </form>
                    </li>
                    <li class="list-group-item" id="profile_phone">
                        <?php
                        echo "<b>Phone : </b>" . $user->phone;
                        ?>
                        <span class='glyphicon glyphicon-pencil show_changer' id="show_changer_3"></span>
                        <form id="show_changer_3_form" hidden>
                            <div class="form-group">
                                <input type="text" class="form-control" id="newPhone" placeholder="Enter new phone">
                            </div>
                            <button type="submit" class="btn btn-primary" id="change_phone">Save</button>
                        </form>
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
                <h3 class="panel-title">Change your password</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php
                        echo "Login : " . $user->login;
                        ?>
                    </li>
                    <li class="list-group-item">
                        <form id="password_changer">
                            <div class="form-group">
                                <label for="oldPassword">Old password</label>
                                <input type="password" class="form-control" id="oldPassword">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New password</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <button type='submit' class='btn btn-primary' id='change_password'>Change password</button>
                            <div id="password_change_result"></div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>