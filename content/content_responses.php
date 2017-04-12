
<div class="row" id="content_to_show">
    
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Past directives
                </h3>
            </div>
            <div class="panel-body">
                <table class="table nice_table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Title</th>
                            <th>Collective</th>
                            <th>Content & Answer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="directives_table">
                        <?php
                        $query2 = "SELECT * FROM `directives` ORDER BY `time` DESC";
                        $sth2 = $dbh->prepare($query2);
                        $sth2->setFetchMode(PDO::FETCH_CLASS, 'Directive');
                        $success = $sth2->execute();
                        while ($directive = $sth2->fetch()) {
                            $rightCabinet = $directive->cabinet == $_SESSION["cabinet"];
                            $rightUser = $directive->collective || $directive->delegate == $_SESSION["userId"];
                            $toDisplay = isAdmin() || ($rightCabinet && $rightUser);
                            $toAnswer = $directive->status($dbh) == "Validated";
                            if ($toDisplay) {
                                echo "<tr id='directive_" . $directive->id . "'>";
                                echo "<td>" . $directive->time . "</td>";
                                echo "<td>" . $directive->title . "</td>";
                                echo "<td>" . $directive->collective . "</td>";
                                echo "<td><button class='btn btn-primary show_content' id='show_content_" . $directive->id . "'>Show</button></td>";
                                echo "<td>" . $directive->status($dbh) . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<div id="hidden_text">
    <!--Hidden text & answers of the directives -->
    <?php
    $query = "SELECT * FROM `directives`ORDER BY `time` ASC";
    $sth = $dbh->prepare($query);
    $sth->execute(array($_SESSION["userId"]));
    while ($data = $sth->fetch()) {
        $directive = Directive::getDirective($dbh, $data["id"]);
        if ($directive->answer==NULL){
            $answer = "No answer has been given yet.";
        } else {
            $answer = $directive->answer;
        }
        echo <<<END_STRING
        <div id='content_to_show_$directive->id' hidden>
            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Directive text
                        </h3>
                    </div>
                    <div class="panel-body">
                        <b>$directive->title</b>
                        <br><br>
                        $directive->content
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Answer
                        </h3>
                    </div>
                    <div class="panel-body">
                        $answer
                    </div>
                </div>
            </div>
        </div>
END_STRING;
    }
    ?>
</div>