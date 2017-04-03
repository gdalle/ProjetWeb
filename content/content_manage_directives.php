<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Directive text
                </h3>
            </div>
            <div class="panel-body" id="content_to_show">

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
                <form action="utilities/directiveHandler.php?todo=answer_directive" method="post" id="answer_form" hidden>
                    <div class="form-group-row">
                        <label for="directiveId" class="col-form-label">To directive n° </label>
                        <input type="number" class="directiveIdForm" name="directiveId" id="directiveId">
                    </div>
                    <div class="form-group">
                        <textarea rows="4" class="form-control" name="answer" id="answer"></textarea>
                    </div>
                    <button type="submit" class="btn btn-block">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Directives status
                </h3>
            </div>
            <div class="panel-body">
                <table class="table nice_table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Time</th>
                            <th>Cabinet</th>
                            <th>Delegate</th>
                            <th>Title</th>
                            <th>Collective</th>
                            <th>Status</th>
                            <th>Options</th>
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
                                echo "<td>" . $directive->id . "</td>";
                                echo "<td>" . $directive->time . "</td>";
                                echo "<td>" . $directive->cabinet($dbh)->name . "</td>";
                                echo "<td>" . $directive->delegate($dbh)->character . "</td>";
                                echo "<td>" . $directive->title . "</td>";
                                echo "<td>" . $directive->collective . "</td>";
                                echo "<td>" . $directive->status($dbh) . "</td>";
                                if ($toAnswer) {
                                    echo "<td> <span class='glyphicon glyphicon-trash delete_directive' id='delete_directive_" . $directive->id . "'></span> &nbsp; <button class='btn btn-success show_answer_directive' id='answer_directive_" . $directive->id . "'>Show / Answer</button></td>";
                                } else {
                                    echo "<td> <span class='glyphicon glyphicon-trash delete_directive' id='delete_directive_" . $directive->id . "'></span> &nbsp; <button class='btn btn-success show_directive' id='answer_directive_" . $directive->id . "'>Show</button></td>";
                                }
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
    <!--Hidden text of the directives -->
    <?php
    $query = "SELECT * FROM `directives`ORDER BY `time` ASC";
    $sth = $dbh->prepare($query);
    $sth->execute(array($_SESSION["userId"]));
    while ($data = $sth->fetch()) {
        $directive = Directive::getDirective($dbh, $data["id"]);
        $toDisplay = true;
        if ($toDisplay) {
            echo "<div id='content_to_show_" . $directive->id . "' hidden><b>$directive->title</b><br><br>$directive->content </div>";
        }
    }
    ?>
</div>