<div id="page-content-wrapper" class="container" ng-controller="dashboardCtrl">
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <div class="jumbotron text-center">
                    <h1>Welcome back <?php echo $this->session->userdata('fname');?>!</h1>
                    <h3>Ready to create another survey?</h3>
                </div>

                <h3><b>What do you got?</b></h3>

                <hr>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="surveys"></strong></h1>
                                <h5><b>Number of Created Surveys</b></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="codes"></strong></h1>
                                <h5><b>Number of Active Codes</b></h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1 style="font-size: 72px !important;"><strong ng-bind="inactive"></strong></h1>
                                <h5><b>People who Took your Surveys</b></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <h3><b>What do you wanna do?</b></h3>

                <hr>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <i class="fa fa-file fa-5x" style="font-size: 100px !important; margin-bottom: 10px !important;" aria-hidden="true"></i>
                                <h5><b>I wanna make another survey</b></h5>
                            </div>

                            <div class="panel-body">
                                <a href="<?php echo base_url('user/create_survey');?>" class="btn btn-block btn-default">Create Survey</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <i class="fa fa-area-chart fa-5x" style="font-size: 100px !important; margin-bottom: 10px !important;" aria-hidden="true"></i>
                                <h5><b>I wanna view my surveys</b></h5>
                            </div>

                            <div class="panel-body">
                                <a href="<?php echo base_url('user/surveys');?>" class="btn btn-block btn-default">View Survey</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <i class="fa fa-user-circle-o fa-5x" style="font-size: 100px !important; margin-bottom: 10px !important;" aria-hidden="true"></i>
                                <h5><b>I wanna view my profile</b></h5>
                            </div>

                            <div class="panel-body">
                                <a href="<?php echo base_url('user/profile');?>" class="btn btn-block btn-default">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>