
<div class="row">
    <div class = "col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Published news</h3>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Time</th>
                            <th>Title</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody id="cabinets_table">
                        <?php
                        $req = $dbh->prepare("SELECT * FROM news");
                        $req->execute(array());
                        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr id='newsItem_" . $data['id'] . "'>";
                            echo "<td>" . $data["id"] . "</td>";
                            echo "<td>" . $data["time"] . "</td>";
                            echo "<td>" . $data["title"] . "</td>";
                            echo "<td><span class='glyphicon glyphicon-remove delete_newsItem' id=delete_newsItem_" . $data['id'] . "></span></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class = "col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">The journalist's corner</h3>
            </div>
            <div class="panel-body">
                <form action="utilities/newsHandler.php?todo=publish_news" method="post" id="news_form">
                    <div class="form-group row">
                        <label for="news_title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="news_title" id="news_title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="news_content" class="col-sm-3 col-form-label">Content</label>
                        <div class="col-sm-9">
                            <textarea rows="3" class="form-control" name="news_content" id="news_content"></textarea>
                        </div>
                    </div>
                    <button type="submit" id="publish" class="btn btn-block">Publish</button>
                </form>
            </div>
        </div>
    </div>
</div>