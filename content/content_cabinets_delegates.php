<?php
$db = new PDO('mysql:host=localhost;dbname=MUN;charset=utf8mb4', 'root', '');
?>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Cabinets</h3>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>description</th>
                        <th>options</th>
                    </tr>
                    <?php
                    $req = $db->prepare("SELECT * FROM cabinets WHERE id > 0");
                    $req->execute(array());
                    while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $data["id"] . "</td>";
                        echo "<td>" . $data["name"] . "</td>";
                        echo "<td>" . $data["description"] . "</td>";
                        echo "<td><a href='utilities/delegateHandler.php?todo=delete_cabinet&cabinet_id=" . $data["id"] . "'>delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
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
                    <tr>
                        <th>id</th>
                        <th>login</th>
                        <th>admin</th>
                        <th>name</th>
                        <th>cabinet</th>
                        <th>character</th>
                        <th>options<th>
                    </tr>
                    <?php
                    $req = $db->prepare("SELECT * FROM users WHERE 1");
                    $req->execute(array());
                    while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $data["id"] . "</td>";
                        echo "<td>" . $data["login"] . "</td>";
                        echo "<td>" . $data["admin"] . "</td>";
                        echo "<td>" . $data["name"] . "</td>";
                        echo "<td>" . $data["cabinet"] . "</td>";
                        echo "<td>" . $data["character"] . "</td>";
                        echo "<td><a href='utilities/delegateHandler.php?todo=delete_delegate&delegate_id=" . $data["id"] . "'>delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Create a cabinet</h3>
            </div>
            <div class="panel-body">
                <form action="utilities/delegateHandler.php?todo=create_cabinet" method="post">
                    Name : <input type="text" name="cabinet_name"></input><br>
                    Description : <input type="text" name="cabinet_description"></input><br>
                    <input type="submit" value="Create">
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Create a delegate</h3>
            </div>
            <div class="panel-body">
                <form action="utilities/delegateHandler.php?todo=create_delegate" method="post">
                    Login : <input type="text" name="delegate_login"></input><br>
                    Password : <input type="text" name="delegate_password"></input><br>
                    Admin : <input type="checkbox" name="delegate_admin"></input><br>
                    Name : <input type="text" name="delegate_name"></input><br>
                    Cabinet : <input type="number" name="delegate_cabinet"></input><br>
                    Character : <input type="text" name="delegate_character"></input><br>
                    Description : <input type="text" name="delegate_description" value="Nothing to say"></input><br>
                    <input type="submit" value="Create">
                </form>
            </div>
        </div>
    </div>
</div>