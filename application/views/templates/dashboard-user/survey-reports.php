<div id="page-content-wrapper" class="container" ng-controller="reportCtrl">
    <div class="row">
        <div class="col-md-8">
            <div class="well">
                <h3><b>Reports</b></h3>
                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Bar Chart</h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="name">Description</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="text" ng-model="bar.description" class="form-control input-sm" placeholder="Chart Description">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="variable">X-axis</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select ng-model="bar.variable" class="form-control input-sm">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="variable">Series</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select ng-model="bar.series" class="form-control input-sm">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clear-space"></div>
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success btn-block" ng-click="addBar()">Add Report</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Doughnut Chart</h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="name">Description</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="text" ng-model="doughnut.description" class="form-control input-sm" placeholder="Chart Description">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group-sm">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="variable">Series</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select class="form-control" ng-model="doughnut.series">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success btn-block" ng-click="addDoughnut()">Add Report</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!--<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Radar Chart</h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="name">Description</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="text" ng-model="radar.description" class="form-control input-sm" placeholder="Chart Description">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group-sm">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="variable">Series</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select class="form-control" ng-model="radar.series">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clear-space"></div>
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success btn-block" ng-click="addRadar()">Add Report</button>
                            </div>
                        </div>
                    </div>-->

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Horizontal Bar Chart</h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="name">Description</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="text" ng-model="horizontal.description" class="form-control input-sm" placeholder="Chart Description">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group-sm">
                                        <div class="col-sm-4">
                                            <label for="variable">Y-axis</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select class="form-control" ng-model="horizontal.variable">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group-sm">
                                        <div class="col-sm-4">
                                            <label for="series">Series</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select class="form-control" ng-model="horizontal.series">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="clear-space"></div>
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success btn-block" ng-click="addHorizontal()">Add Report</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Pie Chart</h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="name">Description</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="text" ng-model="pie.description" class="form-control input-sm" placeholder="Chart Description">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group-sm">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="variable">Variable</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select class="form-control" ng-model="pie.series">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success btn-block" ng-click="addPie()">Add Report</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Polar Area Chart</h3>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="name">Description</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="text" ng-model="polar.description" class="form-control input-sm" placeholder="Chart Description">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group-sm">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="variable">Variable</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <select class="form-control" ng-model="polar.series">
                                                <?php foreach($this->session->userdata('temp_labels') as $value): ?>
                                                <option value="<?php echo $value['label'] . ' | ' . implode(", ", $value['options']);?>"><?php echo $value['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success btn-block" ng-click="addPolar()">Add Report</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="well">
                <h3><b>Report Collection</b></h3>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-repeat="report in reports">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ report.description }}</td>
                            <td>{{ report.type }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="removeReport()" ng-if="(reports.length > 0)">Undo</button>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="well">
                <button class="btn btn-success btn-block" ng-click="saveSurvey()">Save Survey</button>
                <!--<button class="btn btn-danger btn-block" ng-click="cancelSurvey()">Discard Survey</button>-->
            </div>
        </div>
    </div>
</div>