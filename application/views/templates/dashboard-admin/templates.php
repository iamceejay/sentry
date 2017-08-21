<div id="page-content-wrapper" class="container" ng-controller="adminTemplates">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3><b>Templates</b> <a href="<?php echo site_url('admin/create_template');?>" class="btn btn-success btn-sm">Create Template</a></h3>
                <hr>

                <div class="row">
                    <div class="col-sm-1">
                        <h5><b>Search</b></h5>
                    </div>

                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" ng-model="search" placeholder="ex. Template title, Description">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Manage</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="template in templates | filter: search">
                                <td ng-bind="template.title"></td>
                                <td><span ng-bind="template.description | limitTo: 50"></span>...</td>
                                <td>
                                    <button class="btn btn-default btn-sm" ng-click="editTemplate(template)">Edit Template</button>
                                    <button class="btn btn-danger btn-sm" ng-click="deleteTemplate(template._id.$id)">Delete Template</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>