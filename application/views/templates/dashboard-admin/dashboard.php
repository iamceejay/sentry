<div id="page-content-wrapper" class="container" ng-controller="adminDashboardCtrl">
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <div class="jumbotron text-center">
                    <h1>Sentry | Admin Dashboard</h1>
                </div>

                <h3><b>What do we got?</b></h3>
                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="activeUsers"></strong></h1>
                                <h5><b>Active Users</b></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="inactiveUsers"></strong></h1>
                                <h5><b>Inactive Users</b></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="templates"></strong></h1>
                                <h5><b>Created Templates</b></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="questions"></strong></h1>
                                <h5><b>Questions in the Bank</b></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>