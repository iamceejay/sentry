<div id="page-content-wrapper" class="container" ng-controller="questionCtrl">
    <div class="row">
        <div class="col-sm-12">
            <div class="well" ng-if="!edit">
                <h3><b>Question Bank</b> <button class="btn btn-success btn-sm" ng-click="addQuestion()"><i class="glyphicon glyphicon-plus-sign"></i> Add Question</button></h3>
                <hr>

                <div class="row">
                    <div class="col-sm-1">
                        <h5><b>Search</b></h5>
                    </div>

                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" ng-model="search" placeholder="ex. Question, Variable">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Type</th>
                                <th>Variable</th>
                                <th>Manage</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="q in questions | filter: search">
                                <td ng-bind="q.description"></td>
                                <td ng-bind="q.type"></td>
                                <td ng-bind="q.label"></td>
                                <td>
                                    <button class="btn btn-default btn-sm" ng-click="editQuestion(q._id, q.description, q.label, q.type, q.options)"><i class="glyphicon glyphicon-edit"></i> Edit Question</button>
                                    <!--<button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove-sign"></i> Delete Question</button>-->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="well" ng-if="edit">
                <h3><b>Edit Question</b></h3>
                <hr>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" class="form-control" ng-model="e.description" placeholder="Question">
                        </div>

                        <div class="form-group">
                            <label>Variable</label>
                            <input type="text" class="form-control" ng-model="e.label" placeholder="Variable">
                        </div>

                        <div class="form-group" ng-if="e.type == 'checkbox' || e.type == 'radio' || e.type == 'select'">
                            <label>Options</label>
                            <textarea style="height: 100px;" class="form-control" ng-model="e.options"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-block" ng-click="updateQuestion()">Update Question</button>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="return()">Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>