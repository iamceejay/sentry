<div id="page-content-wrapper" class="container" ng-controller="adminUsers">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3><b>Manage Users</b></h3>
                <hr>

                <div class="row">
                    <div class="col-sm-1">
                        <h5><b>Search</b></h5>
                    </div>

                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" ng-model="search" placeholder="ex. First Name, Lastname, E-mail, Username">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="user in users | filter : search">
                                <td ng-bind="($index + 1)"></td>
                                <td>{{ user.fname }} {{ user.lname }}</td>
                                <td ng-bind="user.username"></td>
                                <td ng-bind="user.email"></td>
                                <td>
                                    <span class="label label-danger text-uppercase" ng-bind="user.status" ng-if="(user.status == 'inactive')"></span>
                                    <span class="label label-success text-uppercase" ng-bind="user.status" ng-if="(user.status == 'active')"></span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" ng-click="passwordReset(user._id.$id)"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button class="btn btn-danger btn-sm" ng-if="(user.status == 'active')" ng-click="userDeactivate(user._id.$id)"><i class="fa fa-times" aria-hidden="true"></i> Deactivate</button>
                                    <button class="btn btn-success btn-sm" ng-if="(user.status == 'inactive')" ng-click="userActivate(user._id.$id)"><i class="fa fa-check" aria-hidden="true"></i> Activate</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>