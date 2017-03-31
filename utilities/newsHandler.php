<?php

function displayNews()
{
  $db = MyDatabase::connect();
  $news = $db->query("SELECT * FROM news;");
  $newsItems = array();
  while($newsItem = $news->fetch())
  {
    $newsItems[] = $newsItem;
  }
  ?>

  <div class="col-sm-4">
      <div class="panel panel-info">
          <div class="panel-heading">
              <h3 class="panel-title">Newsfeed</h3>
          </div>
          <div class="panel-body pre-scrollable">
              <ul class="list-group nav nav-tabs nav-stacked">

  <?php
  for($i=0; $i<sizeOf($newsItems); $i++)
  {
      ?>
      <li href ="#tab<?php echo $i; ?>" data-toggle="tab" class="list-group-item <?php if($i==0) { echo "active"; }?>"><?php echo $newsItems[$i]['title']; ?></li>
      <?php
  }
  ?>

  </ul>
  </div>
  </div>
  </div>
  <div class="col-sm-4">
  <div class="panel panel-default pre-scrollable">
  <div class="tab-content">

  <?php
  for($i=0; $i<sizeOf($newsItems); $i++)
  {
    ?>
    <div class="tab-pane fade <?php if($i==0) { echo "in active"; }?>" id="tab<?php echo $i; ?>">
      <div class="panel-heading"><h3 class="panel-title"><b><?php echo($newsItems[$i]["title"]); ?></b></h3></div>
      <div class="panel-body">
          <?php echo($newsItems[$i]["content"]); ?>
      </div>
    </div>
    <?php
  }
  ?>
  </div>
  </div>
  </div>
  <?php
}
?>
