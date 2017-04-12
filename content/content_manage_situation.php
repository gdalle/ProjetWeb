<div class="row">
    <div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Add a point of interest on the military map</h3>
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