<div id="page-content-wrapper" class="container" ng-controller="templateCtrl">
    <div class="row">
        <div id="builder-area" class="col-sm-7">
            <div class="well">
                <h5>
                    <b>Builder Area</b>
                    <small ng-show="(form.length == 0)">Drag and drop the Builder Components here.</small>
                </h5>
                <hr>

                <div fb-builder="default"></div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-info" ng-click="infoModal()" ng-show="(form.length != 0)">Edit Info</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-sm-4 builder-sidebar">
            <div class="well">
                <h5><b>Builder Components</b></h5>
                <hr>
                
                <div style="overflow-y: auto; overflow-x: hidden; height: 80vh !important;">
                    <div fb-components></div>
                </div>
            </div>
        </div>
    </div>
</div>