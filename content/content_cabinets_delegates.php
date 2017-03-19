<?php
if (isLogged() && isAdmin() && isset($_GET["todo"]) && $_GET["todo"] == "delete_cabinet") {
    $success = Cabinet::deleteCabinet($dbh, $_GET["cabinet_id"]);
}
if(isLogged() && isAdmin() && isset($_GET["todo"]) && $_GET["todo"] == "delete_delegate") {
    $success = User::deleteUser($dbh, $_GET["delegate_id"]);
}


?>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Cabinets</h3>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>description</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    <tbody id="cabinets_table">
                        <?php
                        $req = $dbh->prepare("SELECT * FROM cabinets");
                        $req->execute(array());
                        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr id='cabinet_".$data['id']."'>";
                            echo "<td>" . $data["id"] . "</td>";
                            echo "<td>" . $data["name"] . "</td>";
                            echo "<td>" . $data["description"] . "</td>";
                            echo "<td><button type='button' class='btn btn-primary delete_cabinet' id=".$data['id'].">delete</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Delegates</h3>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>login</th>
                        <th>admin</th>
                        <th>name</th>
                        <th>cabinet</th>
                        <th>character</th>
                        <th>options<th>
                    </tr>
                    </thead>
                    <tbody id="users_table">
                    <?php
                    $req = $dbh->prepare("SELECT * FROM users WHERE 1");
                    $req->execute(array());
                    while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr id='user_".$data["id"]."'>";
                        echo "<td>" . $data["id"] . "</td>";
                        echo "<td>" . $data["login"] . "</td>";
                        echo "<td>" . $data["admin"] . "</td>";
                        echo "<td>" . $data["name"] . "</td>";
                        echo "<td>" . $data["cabinet"] . "</td>";
                        echo "<td>" . $data["character"] . "</td>";
                        echo "<td><button type='button' class='btn btn-primary delete_user' id='".$data['id']."'>delete</button></td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Create cabinet</h3>
            </div>
            <div class="panel-body">
                <form action="index.php?page=home" id="create_cabinet" method="post">
                    Name : <input type="text" name="cabinet_name" id="cabinet_name"></input><br>
                    Description : <input type="text" name="cabinet_description" id="cabinet_description"></input><br>
                    <input type="submit" value="Create">
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Create user</h3>
            </div>
            <div class="panel-body">
                <form action="index.php?page=home" id="create_user" method="post">
                    Login : <input type="text" name="user_login" id="user_login"></input><br>
                    Password : <input type="text" name="user_password" id="user_password"></input><br>
                    Admin : <input type="checkbox" name="user_admin" id="user_admin"></input><br>
                    Name : <input type="text" name="user_name" id="user_name"></input><br>
                    Cabinet : <input type="number" name="user_cabinet" id="user_cabinet"></input><br>
                    Character : <input type="text" name="user_character" id="user_character"></input><br>
                    Description : <input type="text" name="user_description" value="Nothing to say" id="user_description"></input><br>
                    <input type="submit" value="Create">
                </form>
            </div>
        </div>
    </div>
</div>