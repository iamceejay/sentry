<div id="page-content-wrapper" class="container" ng-controller="builderCtrl">
    <div class="row">
        <div id="builder-area" class="col-sm-7">
            <div class="well">
                <div class="row">
                    <div class="col-sm-10">
                        <h5>
                            <b>Builder Area</b>
                            <small ng-show="(form.length == 0)">Drag and drop the Builder Components here.</small>
                        </h5>
                    </div>

                    <div class="col-sm-2">
                        <button class="btn btn-default btn-block" ng-click="infoBuilderArea()">Info <i class="fa fa-info-circle" aria-hidden="true"></i></button>
                    </div>
                </div>
                <hr>

                <div fb-builder="default"></div>
            </div>
        </div>

        <div class="col-sm-4 builder-sidebar">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b>Builder Components</b></h5>
                    </div>

                    <div class="col-sm-3">
                        <button class="btn btn-default btn-block" ng-click="infoBuilderComponents()">Info <i class="fa fa-info-circle" aria-hidden="true"></i></button>
                    </div>

                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-block" ng-click="infoModal()" ng-show="(form.length != 0)">Next <i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
                <hr>
                
                <div style="overflow-y: auto; overflow-x: hidden; height: 80vh !important;">
                    <div fb-components></div>
                </div>
            </div>
        </div>
    </div>
</div>