<div class="row">
  <div id="mapdiv" style="background-color:#EEEEEE; height: 500px"></div>
</div>
  <?php
  if(isLogged() && isAdmin())
  {?>
    <script type="text/javascript" src="js/mapManager.js"></script>
    <div class="row"><br/>
        <div class = "col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Map points</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                            </tr>
                        </thead>
                        <tbody id="cabinets_table">
                            <?php
                            $req = $dbh->prepare("SELECT * FROM map_points");
                            $req->execute(array());
                            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr id='newsItem_" . $data['id'] . "'>";
                                echo "<td>" . $data["id"] . "</td>";
                                echo "<td>" . $data["title"] . "</td>";
                                echo "<td>" . $data["latitude"] . "</td>";
                                echo "<td>" . $data["longitude"] . "</td>";
                                echo '<td><a href="utilities/mapHandler.php?todo=remove_point&point_id=' . $data['id'] . '"><span class="glyphicon glyphicon-remove delete_mapPoint"></span></a></td>';
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
                    <h3 class="panel-title">Add a point of interest</h3>
                </div>
                <div class="panel-body">
                    <form action="utilities/mapHandler.php?todo=add_point" method="post" id="point_form">
                        <div class="form-group row">
                            <label for="news_title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="point_title" id="point_title"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="point_latitude" class="col-sm-3 col-form-label">Latitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="point_latitude" id="point_latitude"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="point_longitude" class="col-sm-3 col-form-label">Longitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="point_longitude" id="point_longitude"></input>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block">Add point</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
  }
  ?>
</div>
