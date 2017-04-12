<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Send a directive
                </h3>
            </div>
            <div class="panel-body">
                <form action='./utilities/directiveHandler.php?todo=send_directive' method='post'>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="title" id="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="collective1" class="col-sm-2 col-form-label">Collective</label> 
                        <div class="col-sm-9">
                            <input type="radio" name="collective" value="1" id="collective1"> Yes &nbsp;
                            <input type="radio" name="collective" value="0" id="collective0"> No                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contentDirective" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea rows="5" class="form-control" name="contentDirective" id="contentDirective" required></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Vote on collective directives
                </h3>
            </div>
            <div class="panel-body" id="content_to_show">
                
            </div>
            <div class="panel-footer">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Delegate</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Vote</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `directives` JOIN `vote` ON `directives`.`id` = `vote`.`directive` WHERE `vote`.`delegate` = ? ORDER BY `time` DESC";
                        $sth = $dbh->prepare($query);
                        $success = $sth->execute(array($_SESSION["userId"]));
                        while ($data = $sth->fetch()) {
                            $directive = Directive::getDirective($dbh, $data["directive"]);
                            $rightCabinet = ($directive->cabinet == $_SESSION["cabinet"]);
                            $toDisplay = ($rightCabinet && $directive->collective && ($directive->status($dbh) == "Vote ongoing"));
                            if ($toDisplay) {
                                echo "<tr id='directive_to_vote_".$directive->id."'>";
                                echo "<td>" . $directive->time . "</td>";
                                echo "<td>" . $directive->delegate($dbh)->character . "</td>";
                                echo "<td>" . $directive->title . "</td>";
                                echo "<td><button class='btn btn-primary show_content' id='show_content_" . $directive->id . "'>show</button></td>";
                                echo "<td> <span class='glyphicon glyphicon-thumbs-up vote_favor' id='vote_favor_".$directive->id."'></span> &nbsp; <span class='glyphicon glyphicon-thumbs-down vote_against' id='vote_against_".$directive->id."'></span> </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody> 
                </table>
                <!--Hidden text of the directives -->
                <?php
                $query = "SELECT * FROM `directives` JOIN `vote` ON `directives`.`id` = `vote`.`directive` WHERE `vote`.`delegate` = ? ORDER BY `time` ASC";
                $sth = $dbh->prepare($query);
                $success = $sth->execute(array($_SESSION["userId"]));
                while ($data = $sth->fetch()) {
                    $directive = Directive::getDirective($dbh, $data["directive"]);
                    $rightCabinet = ($directive->cabinet == $_SESSION["cabinet"]);
                    $toDisplay = ($rightCabinet && $directive->collective && ($directive->status($dbh) == "Vote ongoing"));
                    if ($toDisplay) {
                        echo "<div id='content_to_show_" . $directive->id . "' hidden> 
                                <b>$directive->title</b>
                                <br>
                                $directive->content 
                                </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
