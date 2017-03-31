<script type="text/javascript" src="js/newsManager.js"></script>
<div class="row">
    <div class = "col-sm-5">
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
  <div class = "col-sm-7">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Publish a news item</h3>
        </div>
        <div class="panel-body">
  </div>
</div>
