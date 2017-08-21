<div id="page-content-wrapper" class="container" ng-controller="surveyCtrl">
    <div class="row">
        <div class="col-sm-12" ng-if="(surveyID == undefined)">
            <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <h4><b>Survey Reports</b></h4>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input type="text" class="form-control" ng-model="searchSurvey" placeholder="Search Survey">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Codes</th>
                                <th>Reports</th>
                                <!--<th>Export</th>-->
                                <th>Manage</th>
                                <th><span class="form-group"><input type="number" ng-model="populationSize" class="form-control input-sm" placeholder="Number of population to be added"></span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="survey in surveys | filter: searchSurvey" ng-if="(surveys.length != 0)">
                                <td ng-bind="survey.title"></td>
                                <td><span ng-bind="survey.description | limitTo : 10"></span>...</td>
                                <td><button class="btn btn-primary btn-sm" ng-click="surveyCode(survey._id)"><i class="glyphicon glyphicon-eye-open"></i> View Codes</button></td>
                                <td><button class="btn btn-success btn-sm" ng-click="surveyReport(survey._id, survey.title)"><i class="glyphicon glyphicon-eye-open"></i> View Reports</button></td>
                                <!--<td><button class="btn btn-danger btn-sm" ng-click="exportPDF(survey._id)"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button></td>-->
                                <td>
                                    <button class="btn btn-default btn-sm" ng-disabled="!survey.editable" ng-click="editSurvey(survey)"><i class="glyphicon glyphicon-edit"></i> Edit Survey</button>
                                </td>
                                <td>
                                    <button class="btn btn-default btn-sm btn-block" ng-click="addPopulation(survey._id, populationSize)" ng-disabled="(populationSize == undefined)"><i class="glyphicon glyphicon-plus-sign"></i> Add Population</button>
                                </td>
                            </tr>

                            <tr ng-if="(surveys.length == undefined)">
                                <td colspan="6" class="text-center">
                                    <h3><b>You haven't created a survey yet.</b></h3>
                                    <h5><b>Click the button below to create a survey</b></h5>
                                    <a href="<?php echo site_url('user/create_survey');?>" class="btn btn-success">Create Survey</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="well" ng-if="(codes != undefined)">
                <h3><b>Available Codes</b></h3>
                <hr>

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="code in codes">
                                <td ng-bind="($index + 1)"></td>
                                <td ng-bind="code.code"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="codeClose()"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-sm-12" ng-if="(surveyID != undefined && viewtype == undefiend && !enableTable)">
            <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <h4><b>Report Charts</b></h4>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input type="text" class="form-control" ng-model="searchChart" placeholder="Search Chart">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Chart Description</th>
                                <th>Type</th>
                                <th>View</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="chart in charts | filter: searchChart">
                                <th ng-bind="chart.description"></th>
                                <th><span class="label label-primary text-uppercase"><i class="glyphicon glyphicon-stats"></i> <span ng-bind="chart.type"></span></span></th>
                                <th ng-if="chart.type == 'horizontal' || chart.type == 'bar'"><button class="btn btn-success btn-sm" ng-click="viewChart(chart.type, chart.description, chart.variable, chart.series, chart.variable_options, chart.series_options)"><i class="glyphicon glyphicon-eye-open"></i> View Chart</button></th>
                                <th ng-if="chart.type == 'pie' || chart.type == 'polar' || chart.type == 'radar' || chart.type == 'doughnut'"><button class="btn btn-success btn-sm" ng-click="viewChart2(chart.type, chart.description, chart.series, chart.series_options)"><i class="glyphicon glyphicon-eye-open"></i> View Chart</button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="reportReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <h4><b>Summary</b></h4>
                    </div>

                    <div class="col-sm-10">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="summaryPDF" pdf-name="{{ summaryTitle }} - Summary.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="table-responsive" pdf-save-content="summaryPDF">
                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h3><b>Summary of</b></h3>
                            <h1 class="text-uppercase"><b>{{ summaryTitle }}</b></h1>
                            <h5 class="text-uppercase"><b>{{ pdf.company }}</b></h5>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th ng-repeat="s in summary">{{ s.description }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="a in summaryAnswers">
                                <td ng-repeat="l in indexLabels">
                                    {{ summaryAnswers[$parent.$index][indexLabels[$index]].toString() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" ng-if="(enableTable == true)">
        <div class="col-sm-12">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th ng-bind="table.question"></th>
                                            <th>Answers</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr ng-repeat="result in table.result">
                                            <td ng-bind="result.option"></td>
                                            <td ng-bind="result.answers"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="well">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Calculation</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Mean</td>
                                            <td ng-bind="resultMean"></td>
                                        </tr>

                                        <tr>
                                            <td>Median</td>
                                            <td ng-bind="resultMedian"></td>
                                        </tr>

                                        <tr>
                                            <td>Mode</td>
                                            <td ng-bind="resultMode"></td>
                                        </tr>

                                        <tr>
                                            <td>Variance</td>
                                            <td ng-bind="resultVariance"></td>
                                        </tr>

                                        <tr>
                                            <td>Standard Deviation</td>
                                            <td ng-bind="resultSD"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="tableReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row" ng-if="(viewtype != undefined)">
        <!-- BAR CHART -->
        <div class="col-sm-12" ng-if="(viewtype == 'bar')">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b ng-bind="viewchart.description"></b></h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="barPDF" pdf-name="{{ summaryTitle }} - {{ viewchart.description }}.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div style="width: 90% !important; margin: 0 auto;" pdf-save-content="barPDF">
                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1 class="text-uppercase"><b>{{ summaryTitle }}</b></h1>
                            <h5 class="text-uppercase"><b>{{ pdf.company }}</b></h5>

                            <h3 style="margin: 80px 0 50px 0;"><b>{{ viewchart.description }}</b></h3>
                        </div>
                    </div>

                    <canvas id="bar" class="chart chart-bar"
                        chart-data="data" chart-labels="labels" chart-series="series" chart-options="options">
                    </canvas>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Legend</b></td>
                                    <td>
                                        <span ng-repeat="legend in legends">
                                            <span class="label label-primary">
                                                {{ legend.legend }}
                                            </span>

                                            <strong style="padding: 0 10px;">{{ legend.key }}</strong>
                                        </span>
                                    </td>
                                </tr>

                                <tr style="font-size: 18px;">
                                    <td><b>Data Set</b></td>
                                    <td>
                                        {
                                        <span ng-repeat="set in sets">
                                            <b>{{ set.value }}</b> <b ng-if="(!$last)">, </b> 
                                        </span>
                                        }
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="well well-sm" ng-class="{'chart-print' : exportPDF}">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Statistical Calculations</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Mean</td>
                                        <td><strong>{{ chartReport.mean }}</strong></td>
                                    </tr>

                                    <tr>
                                        <td>Median</td>
                                        <td><strong>{{ chartReport.median }}</strong></td>
                                    </tr>

                                    <tr>
                                        <td>Mode</td>
                                        <td>{{ chartReport.mode }}</td>
                                    </tr>

                                    <tr>
                                        <td>Variance</td>
                                        <td>{{ chartReport.variance }}</td>
                                    </tr>

                                    <tr>
                                        <td>Standard Deviation</td>
                                        <td>{{ chartReport.sd }}</td>
                                    </tr>

                                    <tr>
                                        <td>Maximum</td>
                                        <td>{{ chartReport.max }}</td>
                                    </tr>

                                    <tr>
                                        <td>Minumum</td>
                                        <td>{{ chartReport.min }}</td>
                                    </tr>

                                    <tr>
                                        <td>Range</td>
                                        <td>{{ chartReport.range }}</td>
                                    </tr>

                                    <tr>
                                        <td>Sum</td>
                                        <td>{{ chartReport.sum }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" ng-if="exportPDF" style="margin-top: 100px;">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>

                </div>

                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="chartReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- DOUGHNUT  CHART -->
        <div class="col-sm-12" ng-if="(viewtype == 'doughnut')">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b ng-bind="viewchart.description"></b></h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="doughnutPDF" pdf-name="{{ summaryTitle }} - {{ viewchart.description }}.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>

                <hr>

                <div style="width: 90% !important; margin: 0 auto;" pdf-save-content="doughnutPDF">
                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1 class="text-uppercase"><b>{{ summaryTitle }}</b></h1>
                            <h5 class="text-uppercase"><b>{{ pdf.company }}</b></h5>

                            <h3 style="margin: 80px 0 50px 0;"><b>{{ viewchart.description }}</b></h3>
                        </div>
                    </div>

                    <canvas id="doughnut" class="chart chart-doughnut"
                        chart-data="data" chart-labels="labels" chart-options="options" style="max-width: 50% !important; margin: 0 auto;">
                    </canvas>

                    <div class="row" ng-if="exportPDF" style="margin-top: 100px;">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="chartReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- RADAR  CHART -->
        <div class="col-sm-12" ng-if="(viewtype == 'radar')">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b ng-bind="viewchart.description"></b></h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="radarPDF" pdf-name="{{ summaryTitle }} - {{ viewchart.description }}.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div style="width: 90% !important; margin: 0 auto;" pdf-save-content="radarPDF">
                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1 class="text-uppercase"><b>{{ summaryTitle }}</b></h1>
                            <h5 class="text-uppercase"><b>{{ pdf.company }}</b></h5>

                            <h3 style="margin: 80px 0 50px 0;"><b>{{ viewchart.description }}</b></h3>
                        </div>
                    </div>

                    <canvas id="radar" class="chart chart-radar"
                        chart-data="data" chart-labels="labels" chart-options="options" style="max-width: 50% !important; margin: 0 auto;">
                    </canvas>

                    <div class="row" ng-if="exportPDF" style="margin-top: 100px;">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="chartReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- PIE  CHART -->
        <div class="col-sm-12" ng-if="(viewtype == 'pie')">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b ng-bind="viewchart.description"></b></h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="piePDF" pdf-name="{{ summaryTitle }} - {{ viewchart.description }}.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div style="width: 90% !important; margin: 0 auto;" pdf-save-content="piePDF">
                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1 class="text-uppercase"><b>{{ summaryTitle }}</b></h1>
                            <h5 class="text-uppercase"><b>{{ pdf.company }}</b></h5>

                            <h3 style="margin: 80px 0 50px 0;"><b>{{ viewchart.description }}</b></h3>
                        </div>
                    </div>

                    <canvas id="pie" class="chart chart-pie"
                        chart-data="data" chart-labels="labels" chart-options="options" style="max-width: 50% !important; margin: 0 auto;">
                    </canvas>

                    <div class="row" ng-if="exportPDF" style="margin-top: 100px;">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="chartReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- POLAR  CHART -->
        <div class="col-sm-12" ng-if="(viewtype == 'polar')">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b ng-bind="viewchart.description"></b></h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="polarPDF" pdf-name="{{ summaryTitle }} - {{ viewchart.description }}.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div style="width: 90% !important; margin: 0 auto;" pdf-save-content="polarPDF">
                    <canvas id="polar-area" class="chart chart-polar-area"
                        chart-data="data" chart-labels="labels" chart-options="options" style="max-width: 50% !important; margin: 0 auto;">
                    </canvas>

                    <div class="row" ng-if="exportPDF" style="margin-top: 100px;">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="pull-right">
                    <button class="btn btn-danger" ng-click="chartReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- HORIZONTAL  CHART -->
        <div class="col-sm-12" ng-if="(viewtype == 'horizontal')">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b ng-bind="viewchart.description"></b></h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="pull-right">
                            <button class="btn btn-danger" ng-click="exportToPDF()">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="row" ng-if="exportPDF">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
                        </div>
                                    
                        <div class="form-group">
                            <label for="verified">Verified By</label>
                            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
                        </div>

                        <div class="form-group">
                            <label for="verified">Signed By</label>
                            <input type="text" class="form-control" ng-model="pdf.signed" placeholder="Signed by">
                        </div>

                        <div class="form-group">
                            <button pdf-save-button="hbarPDF" pdf-name="{{ summaryTitle }} - {{ viewchart.description }}.pdf" class="btn-success btn btn-block" ng-if="(pdf.company != undefined && pdf.verified != undefined && pdf.signed != undefied)">Export Now</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div style="width: 90% !important; margin: 0 auto;" pdf-save-content="hbarPDF">

                    <div class="row" ng-if="exportPDF">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1 class="text-uppercase"><b>{{ summaryTitle }}</b></h1>
                            <h5 class="text-uppercase"><b>{{ pdf.company }}</b></h5>

                            <h3 style="margin: 80px 0 50px 0;"><b>{{ viewchart.description }}</b></h3>
                        </div>
                    </div>

                    <canvas id="base" class="chart chart-horizontal-bar"
                        chart-data="data" chart-labels="labels" chart-series="series" chart-options="options">
                    </canvas>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Legend</b></td>
                                    <td>
                                        <span ng-repeat="legend in legends">
                                            <span class="label label-primary">
                                                {{ legend.legend }}
                                            </span>

                                            <strong style="padding: 0 10px;">{{ legend.key }}</strong>
                                        </span>
                                    </td>
                                </tr>

                                <tr style="font-size: 18px;">
                                    <td><b>Data Set</b></td>
                                    <td>
                                        {
                                        <span ng-repeat="set in sets">
                                            <b>{{ set.value }}</b> <b ng-if="(!$last)">, </b> 
                                        </span>
                                        }
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="well well-sm" ng-class="{'chart-print' : exportPDF}">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Statistical Calculations</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Mean</td>
                                        <td><strong>{{ chartReport.mean }}</strong></td>
                                    </tr>

                                    <tr>
                                        <td>Median</td>
                                        <td><strong>{{ chartReport.median }}</strong></td>
                                    </tr>

                                    <tr>
                                        <td>Mode</td>
                                        <td>{{ chartReport.mode }}</td>
                                    </tr>

                                    <tr>
                                        <td>Variance</td>
                                        <td>{{ chartReport.variance }}</td>
                                    </tr>

                                    <tr>
                                        <td>Standard Deviation</td>
                                        <td>{{ chartReport.sd }}</td>
                                    </tr>

                                    <tr>
                                        <td>Maximum</td>
                                        <td>{{ chartReport.max }}</td>
                                    </tr>

                                    <tr>
                                        <td>Minumum</td>
                                        <td>{{ chartReport.min }}</td>
                                    </tr>

                                    <tr>
                                        <td>Range</td>
                                        <td>{{ chartReport.range }}</td>
                                    </tr>

                                    <tr>
                                        <td>Sum</td>
                                        <td>{{ chartReport.sum }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" ng-if="exportPDF" style="margin-top: 100px;">
                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.verified }}</b></h3>
                            <p>Verified By</p>
                        </div>

                        <div class="col-sm-6 text-center">
                            <h3><b>{{ pdf.signed }}</b></h3>
                            <p>Signed By</p>
                        </div>
                    </div>
                
                
                
                
                
                <div>
            </div>

            <hr>
            <div class="pull-right">
                <button class="btn btn-danger" ng-click="chartReturn()"><i class="glyphicon glyphicon-arrow-left"></i> Return</button>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>