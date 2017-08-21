<div id="page-content-wrapper" class="container" ng-controller="templatesCtrl">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <h4><b>Templates</b></h4>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input type="text" class="form-control" ng-model="searchTemplate" placeholder="Search Template">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-4 col-md-4" style="margin-bottom: 20px;" ng-repeat="template in templates | filter : searchTemplate">
                        <div class="card">
                            <div class="cover" data-fade="1500" data-duration="1500">
                                <ul class="cover-pics">
                                    <li><img src="<?php echo base_url('assets/img/create-survey-1.jpg');?>"></li>
                                    <li><img src="<?php echo base_url('assets/img/create-survey-2.jpg');?>"></li>
                                    <li><img src="<?php echo base_url('assets/img/create-survey-3.jpg');?>"></li>
                                </ul>

                                <img src="<?php echo base_url('assets/img/avatar-create-survey-t.png');?>" class="avatar">
                            </div>

                            <div class="about">
                                <h3 class="name" ng-bind="template.title"></h3>
                                <h5 class="username"><span ng-bind="template.description | limitTo: 100"></span>...</h5>
                                <span class="content">
                                    <button class="btn btn-success btn-block" ng-click="useTemplate(template)">Use Template</buttona>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>