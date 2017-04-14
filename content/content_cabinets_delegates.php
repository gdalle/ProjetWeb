<div class="row">
    <i>If something doesn't work, please refresh the page.</i>
</div>
<br>
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
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody id="cabinets_table">
                        <?php
                        $req = $dbh->prepare("SELECT * FROM cabinets");
                        $req->execute(array());
                        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr id='cabinet_" . $data['id'] . "'>";
                            echo "<td>" . $data["id"] . "</td>";
                            echo "<td>" . $data["name"] . "</td>";
                            echo "<td>" . $data["description"] . "</td>";
                            echo "<td><span class='glyphicon glyphicon-remove delete_cabinet' id=delete_cabinet_" . $data['id'] . "></span></td>";
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
                            <th>Id</th>
                            <th>Login</th>
                            <th>Admin</th>
                            <th>Name</th>
                            <th>Cabinet</th>
                            <th>Character</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody id="users_table">
                        <?php
                        $req = $dbh->prepare("SELECT * FROM users WHERE 1");
                        $req->execute(array());
                        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr id='user_" . $data["id"] . "'>";
                            echo "<td>" . $data["id"] . "</td>";
                            echo "<td id='login_".$data["login"]."'>" . $data["login"] . "</td>";
                            echo "<td>" . $data["admin"] . "</td>";
                            echo "<td>" . $data["name"] . "</td>";
                            echo "<td>" . Cabinet::getCabinet($dbh, $data["cabinet"])->name . "</td>";
                            echo "<td>" . $data["character"] . "</td>";
                            echo "<td><span class='glyphicon glyphicon-remove delete_user' id=delete_user_" . $data['id'] . "></span> &nbsp; <a href='index.php?page=profile&userId=" . $data['id'] . "'><span class='glyphicon glyphicon-user see_user'></span></a></td>";
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
                    <div class="form-group row">
                        <label for="cabinet_name" class="col-sm-3 col-form-label">Name</label> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cabinet_name" id="cabinet_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cabinet_name" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea rows="2" class="form-control" name="cabinet_description" id="cabinet_description"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
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

                    <div id="login_form" class="form-group row">
                        <label for="user_login" class="col-sm-3 col-form-label">Login</label> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user_login" id="user_login">
                        </div>
                    </div>

                    <div id="password_form" class="form-group row has-warning">
                        <label for="user_password" class="col-sm-3 col-form-label">Password</label> 
                        <div class="col-sm-9">
                            <input type="password" class="form-control form-control-warning" name="user_password" id="user_password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_admin1" class="col-sm-3 col-form-label">Admin</label> 
                        <div class="col-sm-9">
                            <input type="radio" name="user_admin" value="1" id="user_admin1"> Yes &nbsp;
                            <input type="radio" name="user_admin" value="0" id="user_admin0"> No                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_name" class="col-sm-3 col-form-label">Name</label> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user_name" id="user_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_cabinet" class="col-sm-3 col-form-label">Cabinet</label> 
                        <div class="col-sm-9">
                            <select name="user_cabinet" id="user_cabinet">
                                <?php
                                $query = "SELECT * FROM `cabinets`";
                                $sth = $dbh->prepare($query);
                                $sth->setFetchMode(PDO::FETCH_CLASS, 'Cabinet');
                                $success = $sth->execute();
                                while ($cabinet = $sth->fetch()) {
                                    echo "<option value='" . $cabinet->id . "'>" . $cabinet->name . "</option>";
                                }
                                ?>
                            </select>                        
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_character" class="col-sm-3 col-form-label">Character</label> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user_character" id="user_character">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_description" class="col-sm-3 col-form-label">Description</label> 
                        <div class="col-sm-9">
                            <textarea rows="3" class="form-control" name="user_description" id="user_description"></textarea>
                        </div>
                    </div>
                    <div>
                        <span id="password_feedback">Password not secure or login used</span> &nbsp; <span id="login_feedback"></span>
                    </div>
                    <button type="submit" name="user_description" id="button_user_create" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
