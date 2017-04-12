<div class="row">
  <div id="mapdiv" style="background-color:#EEEEEE; height: 500px"></div>
</div>
  <?php
  if(isLogged() && isAdmin())
  {?>
    <script type="text/javascript" src="js/mapManager.js"></script>
    <div class="row"><br/>
        <div>
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
        
    </div>
<?php
  }
  ?>

