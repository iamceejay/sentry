angular.module('sentry.controller', ['ui.bootstrap'])

.controller('homeCtrl', function(UserFactory, $scope, $uibModal, SurveyFactory) {
    $scope.user = {};
    $scope.login = {};
    $scope.input = {};
    $scope.passwordMatch = true;
    $scope.inputType = 'password';

    $scope.checkMatch = function() {
        if($scope.user.password == $scope.user.password2) {
            $scope.passwordMatch = true;
        } else {
            $scope.passwordMatch = false;
        }
    }

    $scope.showPassword = function() {
        if($scope.inputType == 'text') {
            $scope.inputType = 'password';
        } else {
            $scope.inputType = 'text';
        }
    }

    $scope.loginModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'assets/modals/login-modal.php',
            controller: 'homeCtrl'
        })
    }

    $scope.takeSurvey = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'assets/modals/code-modal.php',
            controller: 'homeCtrl'
        })
    }

    $scope.confirmCode = function() {
        console.log($scope.input);
        SurveyFactory.confirmCode($scope.input);
    }

    $scope.modalClose = function() {
        $scope.$dismiss('cancel');
    }

    // Create User
    $scope.createUser = function() {
        UserFactory.createUser($scope.user);
    }

    // Login
    $scope.userLogin = function() {
        UserFactory.userLogin($scope.login);
    }
})

.controller('dashboardCtrl', function($scope, DashboardFactory) {
    DashboardFactory.countSurveys().then(function(response) {
        $scope.surveys = response.data.count;
    }, function(error) {
        $scope.surveys = 0;
    })

    DashboardFactory.countActive().then(function(response) {
        $scope.codes = response.data.count;
    }, function(error) {
        $scope.codes = 0;
    })

    DashboardFactory.countInactive().then(function(response) {
        $scope.inactive = response.data.count;
    }, function(error) {
        $scope.inactive = 0;
    })
})

.controller('adminDashboardCtrl', function($scope, DashboardFactory) {
    DashboardFactory.countActiveUsers().then(function(response) {
        $scope.activeUsers = response.data.count;
    }, function(error) {
        $scope.activeUsers = 0;
    })

    DashboardFactory.countInactiveUsers().then(function(response) {
        $scope.inactiveUsers = response.data.count;
    }, function(error) {
        $scope.inactiveUsers = 0;
    })

    DashboardFactory.countTemplates().then(function(response) {
        $scope.templates = response.data.count;
    }, function(error) {
        $scope.templates = 0;
    })

    DashboardFactory.countQuestions().then(function(response) {
        $scope.questions = response.data.count;
    }, function(error) {
        $scope.questions = 0;
    })
})

.controller('builderCtrl', function($scope, $builder, $uibModal, BuilderFactory, $window, $timeout, QuestionFactory, SurveyFactory, TemplateFactory) {
    $scope.form = $builder.forms['default'];
    $scope.input = [];
    $scope.defaultValue = {};

    QuestionFactory.getQuestions().then(function(response) {
        angular.forEach(response.data.message, function(value, key) {
            if(value.required == 'false') {
                value.required = false;
            } else {
                value.required = true;
            }

            $builder.registerComponent('qb' + key, value);
        }) 
    })

    SurveyFactory.getEditInfo().then(function(response) {
        $scope.tempEditInfo = response.data.message;

        angular.forEach($scope.tempEditInfo.questions, function(value, key) {
            if(value.required == 'false') {
                value.required = false;
            } else {
                value.required = true;
            }

            $builder.addFormObject('default', value);
        })
    })

    TemplateFactory.getTempTemplate().then(function(response) {
        $scope.tempTemplate = response.data.message;

        console.log(response);

        angular.forEach($scope.tempTemplate.questions, function(value, key) {
            if(value.required == 'false') {
                value.required = false;
            } else {
                value.required = true;
            }

            $builder.addFormObject('default', value);
        })

        TemplateFactory.destoryTemp();
    })

    // Survey Info Modal
    $scope.infoModal = function() {
        BuilderFactory.saveTempQuestions({questions : $scope.form});

        console.log($scope.form);
        
        $uibModal.open({
            animation: true,
            templateUrl: '../assets/modals/survey-info.php',
            controller: 'saveTemp'
        })
    }

    $scope.infoBuilderArea = function() {
        $uibModal.open({
            animation: true,
            templateUrl: '../assets/modals/builder-area-info.php',
            controller: 'builderCtrl'
        })
    }

    $scope.infoBuilderComponents = function() {
        $uibModal.open({
            animation: true,
            templateUrl: '../assets/modals/builder-components-info.php',
            controller: 'builderCtrl'
        })
    }

    $scope.modalClose = function() {
        $scope.$dismiss('cancel');
    }
})

.controller('reportCtrl', function($scope, BuilderFactory, toaster) {
    $scope.reports = [];
    $scope.bar = {};
    $scope.doughnut = {};
    $scope.radar = {};
    $scope.pie = {};
    $scope.polar = {};
    $scope.horizontal = {};

    $scope.addBar = function() {
        $scope.bar.type = 'bar';

        var split = $scope.bar.variable.split(" | ");
        var split2 = $scope.bar.series.split(" | ");

        $scope.bar.variable = split[0];
        $scope.bar.series = split2[0];

        split.splice(0, 1);
        split2.splice(0, 1);

        $scope.bar.variable_options = split[0];
        $scope.bar.series_options = split2[0];

        console.log($scope.bar);

        $scope.reports.push($scope.bar);
        $scope.bar = {};

        toaster.success({
            title : 'Report Added!',
            body : 'Report added to the collection.',
            timeout : 3000
        });

        console.log($scope.reports);
    }

    $scope.addDoughnut = function() {
        $scope.doughnut.type = 'doughnut';

        var split = $scope.doughnut.series.split(" | ");

        $scope.doughnut.series = split[0];

        split.splice(0, 1);

        $scope.doughnut.series_options = split[0];

        console.log($scope.doughnut);

        $scope.reports.push($scope.doughnut);
        $scope.doughnut = {};

        toaster.success({
            title : 'Report Added!',
            body : 'Report added to the collection.',
            timeout : 3000
        });

        console.log($scope.reports);
    }

    $scope.addRadar = function() {
        $scope.radar.type = 'radar';

        var split = $scope.radar.series.split(" | ");

        $scope.radar.series = split[0];

        split.splice(0, 1);

        $scope.radar.series_options = split[0];

        console.log($scope.radar);

        $scope.reports.push($scope.radar);
        $scope.radar = {};

        toaster.success({
            title : 'Report Added!',
            body : 'Report added to the collection.',
            timeout : 3000
        });

        console.log($scope.reports);
    }

    $scope.addPie = function() {
        $scope.pie.type = 'pie';

        var split = $scope.pie.series.split(" | ");

        $scope.pie.series = split[0];

        split.splice(0, 1);

        $scope.pie.series_options = split[0];

        console.log($scope.pie);

        $scope.reports.push($scope.pie);
        $scope.pie = {};

        toaster.success({
            title : 'Report Added!',
            body : 'Report added to the collection.',
            timeout : 3000
        });

        console.log($scope.reports);
    }

    $scope.addPolar = function() {
        $scope.polar.type = 'polar';

        var split = $scope.polar.series.split(" | ");

        $scope.polar.series = split[0];

        split.splice(0, 1);

        $scope.polar.series_options = split[0];

        console.log($scope.polar);

        $scope.reports.push($scope.polar);
        $scope.polar = {};

        toaster.success({
            title : 'Report Added!',
            body : 'Report added to the collection.',
            timeout : 3000
        });

        console.log($scope.reports);
    }

    $scope.addHorizontal = function() {
        $scope.horizontal.type = 'horizontal';

        var split = $scope.horizontal.variable.split(" | ");
        var split2 = $scope.horizontal.series.split(" | ");

        $scope.horizontal.variable = split[0];
        $scope.horizontal.series = split2[0];

        split.splice(0, 1);
        split2.splice(0, 1);

        $scope.horizontal.variable_options = split[0];
        $scope.horizontal.series_options = split2[0];

        console.log($scope.horizontal);

        $scope.reports.push($scope.horizontal);
        $scope.horizontal = {};

        toaster.success({
            title : 'Report Added!',
            body : 'Report added to the collection.',
            timeout : 3000
        });

        console.log($scope.reports);
    }

    $scope.saveSurvey = function() {
        BuilderFactory.saveSurvey({reports : $scope.reports});
    }

    $scope.removeReport = function() {
        $scope.reports.splice(($scope.reports.length - 1), 1);
    }

    $scope.cancelSurvey = function() {
        BuilderFactory.cancelSurvey();
        $window.location.href = loc + 'user';
    }
})

.controller('surveyCtrl', function($scope, SurveyFactory, ReportFactory, toaster, $window, $uibModal) {
    $scope.viewchart = {};
    $scope.enableTable = false;
    $scope.table = {};
    $scope.chartReport = {};
    $scope.exportPDF = false;
    $scope.pdf = {};

    $scope.exportToPDF = function() {
        if($scope.exportPDF) {
            $scope.exportPDF = false;
        } else {
            $scope.exportPDF = true;
        }
    }

    SurveyFactory.getSurveys().then(function(response) {
        $scope.surveys = response.data.message;
        console.log(response.data.message);
    })

    $scope.surveyCode = function(data) {
        console.log(data.$id);

        SurveyFactory.getCodes(data.$id).then(function(response) {
            if(response.data.message.length != 0) {
                $scope.codes = response.data.message;
            } else {
                toaster.pop({
                    type : 'note',
                    title : 'Notice',
                    body : 'There are no available codes.',
                    timeout : 3000
                });
            }
        })
    }

    $scope.surveyReport = function(data, title) {
        $scope.surveyID = data;
        $scope.summaryTitle = title;

        console.log(data.$id);

        ReportFactory.getCharts(data.$id).then(function(response) {
            $scope.charts = response.data.message.reports;
        })

        ReportFactory.getQuestions(data.$id).then(function(response) {
            $scope.questions = response.data.message[0].questions;

            console.log($scope.questions);
        })

        ReportFactory.getSummary(data.$id).then(function(response) {
            $scope.summary = response.data.message[0].questions;
            $scope.summaryAnswers = response.data.answers;
            $scope.indexLabels = [];

            for(var x = 0; x < $scope.summary.length; x++) {
                $scope.indexLabels.push($scope.summary[x].label);
            }


            console.log($scope.summary[0].label);
        })   
    }

    // l = label, s = series
    $scope.viewChart = function(type, description, l, s, label, series) {
        if(type == 'bar') {
            $scope.viewtype = 'bar';
        } else {
            $scope.viewtype = 'horizontal';
        }

        $scope.viewchart.survey_id = $scope.surveyID;
        $scope.viewchart.l = l;
        $scope.viewchart.s = s;
        $scope.viewchart.label = label;
        $scope.viewchart.series = series;
        $scope.viewchart.description = description;

        ReportFactory.postResults($scope.viewchart).then(function(response) {
            $scope.labels = $scope.viewchart.label.split(', ');
            $scope.series = $scope.viewchart.series.split(', ');
            $scope.options = { legend: { display: true } };

            $scope.data = response.data.message;
            $scope.legends = response.data.legend;
            $scope.sets = response.data.dataset;

            $scope.chartReport.mean = $scope.calculateMean($scope.sets);
            $scope.chartReport.median = $scope.calculateMedian($scope.sets);
            $scope.chartReport.mode = $scope.calculateMode($scope.sets);
            $scope.chartReport.variance = $scope.calculateVariance($scope.sets);
            $scope.chartReport.sd = Math.sqrt($scope.chartReport.variance);
            $scope.chartReport.min = $scope.calculateMin($scope.sets);
            $scope.chartReport.max = $scope.calculateMax($scope.sets);
            $scope.chartReport.range = $scope.chartReport.max - $scope.chartReport.min;
            $scope.chartReport.sum = $scope.calculateSum($scope.sets);
        })
    }

    $scope.viewChart2 = function(type, description, s, series) {
        if(type == 'doughnut') {
            $scope.viewtype = 'doughnut';
        } else if(type == 'radar') {
            $scope.viewtype = 'radar';
        } else if(type == 'pie') {
            $scope.viewtype = 'pie';
        } else {
            $scope.viewtype = 'polar';
        }

        $scope.viewchart.survey_id = $scope.surveyID;
        $scope.viewchart.s = s;
        $scope.viewchart.series = series;
        $scope.viewchart.description = description;

        ReportFactory.postResult($scope.viewchart).then(function(response) {
            $scope.labels = $scope.viewchart.series.split(', ');
            $scope.options = { legend: { display: true } };

            if(type == 'radar') {
                $scope.data = [response.data.message];

                console.log($scope.data);
            } else {
                $scope.data = response.data.message;
            }
        })
    }

    $scope.viewTable = function(question, label, options) {
        $scope.enableTable = true;
        $scope.table.question = question;
        var post = [$scope.surveyID.$id, label, options];
        var passed_data = {
            'id' : $scope.surveyID.$id,
            'label' : label,
            'options' : options
        }

        console.log(passed_data);

        ReportFactory.getAnswers(passed_data).then(function(response) {
            var result = response.data.message;

            $scope.table.result = result;

            console.log($scope.table.result);
        })
    }

    // Calculate for Mean
    $scope.calculateMean = function(data) {
        var temp = 0;
        
        for(var x = 0; x < data.length; x++) {
            temp = temp + data[x].value;
        }

        temp = temp / data.length;

        return temp;
    }

    // Calculate for Median
    $scope.calculateMedian = function(data) {
        var temp = [];
        var median;

        for(var x = 0; x < data.length; x++) {
            temp.push(data[x].value);
        }

        temp.sort(function(a, b){return a - b});

        if(temp.length%2 == 0) {
            var middle = temp.length / 2;
            median = (temp[middle - 1] + temp[middle]) / 2;
        } else {
            console.log('odd');
            var middle = temp.length / 2;
            median = temp[Math.floor(middle)];
        }

        return median;
    }

    // Calculate Mode
    $scope.calculateMode = function(data) {
        var array = [];

        for(var x = 0; x < data.length; x++) {
            array.push(data[x].value);
        }

        if (!array.length) return [];
        var modeMap = {},
            maxCount = 0,
            modes = [];

        array.forEach(function(val) {
            if (!modeMap[val]) modeMap[val] = 1;
            else modeMap[val]++;

            if (modeMap[val] > maxCount) {
                modes = [val];
                maxCount = modeMap[val];
            }
            else if (modeMap[val] === maxCount) {
                modes.push(val);
                maxCount = modeMap[val];
            }
		});

        return modes;
    }

    // Calculate Variance
    $scope.calculateVariance = function(data) {
        var temp = [];
        var add = 0;
        var variance;
        var answer;

        for(var x = 0; x < data.length; x++) {
            answer = (data[x].value - $scope.chartReport.mean);
            answer = answer * answer;

            temp.push(answer);
        }


        for(var x = 0; x < temp.length; x++) {
            add = add + temp[x];
        }

        variance = add / temp.length;

        return variance;
    }

    // Min
    $scope.calculateMin = function(data) {
        var temp = [];

        for(var x = 0; x < data.length; x++) {
            temp.push(data[x].value);
        }

        temp.sort(function(a, b){return a - b});

        return temp[0];
    }

    // Max
    $scope.calculateMax = function(data) {
        var temp = [];

        for(var x = 0; x < data.length; x++) {
            temp.push(data[x].value);
        }

        temp.sort(function(a, b){return a - b});

        return temp[temp.length - 1];
    }

    // Sum
    $scope.calculateSum = function(data) {
        var temp = 0;
        
        for(var x = 0; x < data.length; x++) {
            temp = temp + data[x].value;
        }

        return temp;
    }

    $scope.codeClose = function() {
        $scope.codes = undefined;
    }

    $scope.tableReturn = function() {
        $scope.enableTable = false;
        $scope.table = {};
    }

    $scope.chartReturn = function() {
        $scope.viewtype = undefined;
        $scope.viewchart = {};
        $scope.label = {};
        $scope.series = {};
        $scope.data = {};
        $scope.options = {};
    }

    $scope.reportReturn = function() {
        $scope.surveyID = undefined;
    }

    $scope.editSurvey = function(data) {
        SurveyFactory.editSurvey(data);

        $window.location.href = loc + 'user/survey_builder';
    }

    $scope.addPopulation = function(id, population) {
        $scope.tempID = id;
        $scope.population = {
            id : $scope.tempID,
            population : population
        };

        console.log($scope.population);

        SurveyFactory.addPopulation($scope.population);

        console.log($scope.tempID);
    }
})

.controller('respondentCtrl', function($scope, $builder, QuestionFactory, SurveyFactory, $validator, toaster) {
    $scope.form = $builder.forms['respondent'];
    $scope.input = [];
    $scope.defaultValue = {};
    $scope.response = {};

    QuestionFactory.getQuestions().then(function(response) {
        angular.forEach(response.data.message, function(value, key) {
            $builder.registerComponent('qb' + key, value);
        }) 
    })

    SurveyFactory.getQuestions().then(function(response) {
        console.log(response.data);
        
        angular.forEach(response.data.message, function(value, key) {
            console.log(value);
            if(value.required == 'false') {
                value.required = false;
            } else {
                value.required = true;
            }

            $builder.addFormObject('respondent', value);
        })
    })

    SurveyFactory.getInfo().then(function(response) {
        $scope.response.id = response.data.id;
        $scope.response.code = response.data.code;
    })

    $scope.submitAnswers = function() {
        $validator.validate($scope, 'respondent')
        .success(function () {
            $scope.response.answers = $scope.input;

            console.log($scope.response);

            SurveyFactory.saveResponse($scope.response);
        })
        .error(function () {
            toaster.pop({
                type : 'error',
                title : 'Error',
                body : 'Please do not leave any required field blank.',
                timeout : 3000
            });
        })
    }
})

.controller('adminUsers', function($scope, UserFactory) {
    UserFactory.getAllUsers().then(function(response) {
        $scope.users = response.data.message;
    })

    $scope.passwordReset = function(data) {
        UserFactory.resetPassword(data);
    }

    $scope.userDeactivate = function(data) {
        UserFactory.userDeactivate(data);
    }

    $scope.userActivate = function(data) {
        UserFactory.userActivate(data);
    }
})

.controller('questionCtrl', function($scope, $uibModal, QuestionFactory) {
    $scope.question = {};
    $scope.edit = false;
    
    var templateTextField = "<div class=\"form-group\">\n    <label for=\"{{formName+index}}\" class=\"col-sm-4 control-label\" ng-class=\"{'fb-required':required}\">{{description}}</label>\n    <div class=\"col-sm-8\">\n        <input type=\"text\" ng-model=\"inputText\" validator-required=\"{{required}}\" validator-group=\"{{formName}}\" id=\"{{formName+index}}\" class=\"form-control\" placeholder=\"{{placeholder}}\"/>\n        <p class='help-block'>{{label}}</p>\n    </div>\n</div>";
    var popOverTextField = "<form>\n    <div class=\"form-group\">\n        <label class='control-label'>Variable</label>\n        <input type='text' ng-model=\"label\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Question</label>\n        <input type='text' ng-model=\"description\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Placeholder</label>\n        <input type='text' ng-model=\"placeholder\" class='form-control'/>\n    </div>\n    <div class=\"checkbox\">\n        <label>\n            <input type='checkbox' ng-model=\"required\" />\n            Required</label>\n    </div>\n    <div class=\"form-group\" ng-if=\"validationOptions.length > 0\">\n        <label class='control-label'>Validation</label>\n        <select ng-model=\"$parent.validation\" class='form-control' ng-options=\"option.rule as option.label for option in validationOptions\"></select>\n    </div>\n\n    <hr/>\n    <div class='form-group'>\n        <input type='submit' ng-click=\"popover.save($event)\" class='btn btn-primary' value='Save'/>\n        <input type='button' ng-click=\"popover.cancel($event)\" class='btn btn-default' value='Cancel'/>\n        <input type='button' ng-click=\"popover.remove($event)\" class='btn btn-danger' value='Delete'/>\n    </div>\n</form>";

    var templateTextArea = "<div class=\"form-group\">\n    <label for=\"{{formName+index}}\" class=\"col-sm-4 control-label\" ng-class=\"{'fb-required':required}\">{{description}}</label>\n    <div class=\"col-sm-8\">\n        <textarea type=\"text\" ng-model=\"inputText\" validator-required=\"{{required}}\" validator-group=\"{{formName}}\" id=\"{{formName+index}}\" class=\"form-control\" rows='6' placeholder=\"{{placeholder}}\"/>\n        <p class='help-block'>{{label}}</p>\n    </div>\n</div>";
    var popOverTextArea = "<form>\n    <div class=\"form-group\">\n        <label class='control-label'>Variable</label>\n        <input type='text' ng-model=\"label\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Question</label>\n        <input type='text' ng-model=\"description\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Placeholder</label>\n        <input type='text' ng-model=\"placeholder\" class='form-control'/>\n    </div>\n    <div class=\"checkbox\">\n        <label>\n            <input type='checkbox' ng-model=\"required\" />\n            Required</label>\n    </div>\n\n    <hr/>\n    <div class='form-group'>\n        <input type='submit' ng-click=\"popover.save($event)\" class='btn btn-primary' value='Save'/>\n        <input type='button' ng-click=\"popover.cancel($event)\" class='btn btn-default' value='Cancel'/>\n        <input type='button' ng-click=\"popover.remove($event)\" class='btn btn-danger' value='Delete'/>\n    </div>\n</form>";

    var templateCheckBox = "<div class=\"form-group\">\n    <label for=\"{{formName+index}}\" class=\"col-sm-4 control-label\" ng-class=\"{'fb-required':required}\">{{description}}</label>\n    <div class=\"col-sm-8\">\n        <input type='hidden' ng-model=\"inputText\" validator-required=\"{{required}}\" validator-group=\"{{formName}}\"/>\n        <div class='checkbox' ng-repeat=\"item in options track by $index\">\n            <label><input type='checkbox' ng-model=\"$parent.inputArray[$index]\" value='item'/>\n                {{item}}\n            </label>\n        </div>\n        <p class='help-block'>{{label}}</p>\n    </div>\n</div>";
    var popOverCheckbox = "<form>\n    <div class=\"form-group\">\n        <label class='control-label'>Variable</label>\n        <input type='text' ng-model=\"label\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Question</label>\n        <input type='text' ng-model=\"description\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Options</label>\n        <textarea class=\"form-control\" rows=\"3\" ng-model=\"optionsText\"/>\n    </div>\n    <div class=\"checkbox\">\n        <label>\n            <input type='checkbox' ng-model=\"required\" />\n            Required\n        </label>\n    </div>\n\n    <hr/>\n    <div class='form-group'>\n        <input type='submit' ng-click=\"popover.save($event)\" class='btn btn-primary' value='Save'/>\n        <input type='button' ng-click=\"popover.cancel($event)\" class='btn btn-default' value='Cancel'/>\n        <input type='button' ng-click=\"popover.remove($event)\" class='btn btn-danger' value='Delete'/>\n    </div>\n</form>";

    var templateRadio = "<div class=\"form-group\">\n    <label for=\"{{formName+index}}\" class=\"col-sm-4 control-label\" ng-class=\"{'fb-required':required}\">{{description}}</label>\n    <div class=\"col-sm-8\">\n        <div class='radio' ng-repeat=\"item in options track by $index\">\n            <label><input name='{{formName+index}}' ng-model=\"$parent.inputText\" validator-group=\"{{formName}}\" value='{{item}}' type='radio'/>\n                {{item}}\n            </label>\n        </div>\n        <p class='help-block'>{{label}}</p>\n    </div>\n</div>";
    var popOverRadio = "<form>\n    <div class=\"form-group\">\n        <label class='control-label'>Variable</label>\n        <input type='text' ng-model=\"label\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Question</label>\n        <input type='text' ng-model=\"description\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Options</label>\n        <textarea class=\"form-control\" rows=\"3\" ng-model=\"optionsText\"/>\n    </div>\n\n    <hr/>\n    <div class='form-group'>\n        <input type='submit' ng-click=\"popover.save($event)\" class='btn btn-primary' value='Save'/>\n        <input type='button' ng-click=\"popover.cancel($event)\" class='btn btn-default' value='Cancel'/>\n        <input type='button' ng-click=\"popover.remove($event)\" class='btn btn-danger' value='Delete'/>\n    </div>\n</form>";

    var templateSelect = "<div class=\"form-group\">\n    <label for=\"{{formName+index}}\" class=\"col-sm-4 control-label\">{{description}}</label>\n    <div class=\"col-sm-8\">\n        <select ng-options=\"value for value in options\" id=\"{{formName+index}}\" class=\"form-control\"\n            ng-model=\"inputText\" ng-init=\"inputText = options[0]\"/>\n        <p class='help-block'>{{label}}</p>\n    </div>\n</div>";
    var popOverSelect = "<form>\n    <div class=\"form-group\">\n        <label class='control-label'>Variable</label>\n        <input type='text' ng-model=\"label\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Question</label>\n        <input type='text' ng-model=\"description\" validator=\"[required]\" class='form-control'/>\n    </div>\n    <div class=\"form-group\">\n        <label class='control-label'>Options</label>\n        <textarea class=\"form-control\" rows=\"3\" ng-model=\"optionsText\"/>\n    </div>\n\n    <hr/>\n    <div class='form-group'>\n        <input type='submit' ng-click=\"popover.save($event)\" class='btn btn-primary' value='Save'/>\n        <input type='button' ng-click=\"popover.cancel($event)\" class='btn btn-default' value='Cancel'/>\n        <input type='button' ng-click=\"popover.remove($event)\" class='btn btn-danger' value='Delete'/>\n    </div>\n</form>";

    $scope.addQuestion = function() {
        $uibModal.open({
            animation: true,
            templateUrl: '../assets/modals/question-modal.php',
            controller: 'questionCtrl'
        })
    }

    $scope.modalClose = function() {
        $scope.$dismiss('cancel');
    }

    $scope.save = function() {
        $scope.question.group = 'Question Bank';
        $scope.question.required = false;

        if($scope.question.type == 'checkbox' || $scope.question.type == 'radio' || $scope.question.type == 'select') {
            $scope.question.options = $scope.question.options.split("\n");
        }

        if($scope.question.type == 'textfield') {
            $scope.question.component = 'textInput';
            $scope.question.template = templateTextField;
            $scope.question.popoverTemplate = popOverTextField;
            $scope.question.validationOptions = [
                {
                    label: 'none',
                    rule: '/.*/'
                }, {
                label: 'number',
                rule: '[number]'
                }, {
                label: 'email',
                rule: '[email]'
                }, {
                label: 'url',
                rule: '[url]'
                }
            ];
        } else if($scope.question.type == 'textarea') {
            $scope.question.component = 'textArea';
            $scope.question.template = templateTextArea;
            $scope.question.popoverTemplate = popOverTextArea;
        } else if($scope.question.type == 'checkbox') {
            $scope.question.component = 'checkbox';
            $scope.question.template = templateCheckBox;
            $scope.question.popoverTemplate = popOverCheckbox;
        } else if($scope.question.type == 'radio') {
            $scope.question.component = 'radio';
            $scope.question.template = templateRadio;
            $scope.question.popoverTemplate = popOverRadio;
        } else if($scope.question.type == 'select') {
            $scope.question.component = 'select';
            $scope.question.template = templateSelect;
            $scope.question.popoverTemplate = popOverSelect;
        }

        QuestionFactory.addQuestion($scope.question);
    }

    QuestionFactory.getQuestions().then(function(response) {
        $scope.questions = response.data.message;
    })

    $scope.editQuestion = function(id, question, variable, type, options) {
        $scope.edit = true;
        $scope.e = {};

        console.log(options);

        $scope.e.description = question;
        $scope.e.label = variable;
        $scope.e.type = type;
        $scope.e.id = id.$id;

        if(type == 'checkbox' || type == 'radio' || type == 'select') {
            $scope.e.options = options.join("\n");
        }
    }

    $scope.return = function() {
        $scope.edit = false;

        $scope.e.description = undefined;
        $scope.e.label = undefined;
        $scope.e.options = undefined;
        $scope.e.type = undefined;
    }

    $scope.updateQuestion = function() {
        if($scope.e.options.length > 0) {
            $scope.e.options = $scope.e.options.split("\n");
        }

        QuestionFactory.updateQuestion($scope.e);
    }
})

.controller('adminTemplates', function($scope, TemplateFactory, $window) {
    TemplateFactory.getAll().then(function(response) {
        $scope.templates = response.data.message;
    })

    $scope.deleteTemplate = function(id) {
        TemplateFactory.deleteTemplate(id);
    }

    $scope.editTemplate = function(data) {
        TemplateFactory.editTemplate(data);

        $window.location.href = loc + 'admin/create_template';
    }
})

.controller('templatesCtrl', function($scope, TemplateFactory, $window, $timeout) {
    TemplateFactory.getAll().then(function(response) {
        $scope.templates = response.data.message;
    })

    $scope.useTemplate = function(data) {
        TemplateFactory.tempTemplate(data);
    }
})

.controller('templateCtrl', function($scope, $builder, QuestionFactory, $uibModal, TemplateFactory) {
    $scope.form = $builder.forms['default'];
    $scope.input = [];
    $scope.defaultValue = {};

    QuestionFactory.getQuestions().then(function(response) {
        angular.forEach(response.data.message, function(value, key) {
            if(value.required == 'false') {
                value.required = false;
            } else {
                value.required = true;
            }

            $builder.registerComponent('qb' + key, value);
        }) 
    })

    TemplateFactory.getTemplate().then(function(response) {
        angular.forEach(response.data.message.questions, function(value, key) {
            if(value.required == 'false') {
                value.required = false;
            } else {
                value.required = true;
            }

            console.log(value);

            $builder.addFormObject('default', value);
        })
    })

    $scope.infoModal = function() {
        TemplateFactory.saveQuestion({questions : $scope.form});

        $uibModal.open({
            animation: true,
            templateUrl: '../assets/modals/template-modal.php',
            controller: 'saveCtrl'
        })
    }
})

.controller('saveCtrl', function($scope, $uibModal, TemplateFactory, BuilderFactory, $window, $timeout) {
    $scope.template = {};

    TemplateFactory.getTemplate().then(function(response) {
        $scope.template.description = response.data.message.description;
        $scope.template.title = response.data.message.title;
        $scope.temp_id = response.data.message._id[0];

        console.log($scope.temp_id);
    })
    
    TemplateFactory.getQuestions().then(function(response) {
        $scope.template.questions = response.data.message.questions;
    })

    $scope.modalClose = function() {
        $scope.$dismiss('cancel');
    }

    $scope.saveTemplate = function() {
        console.log($scope.template);

        if($scope.temp_id != undefined) {
            TemplateFactory.updateTemplate($scope.template, $scope.temp_id);
        } else {
            TemplateFactory.saveTemplate($scope.template);
        }
    }
})

.controller('saveTemp', function($scope, $timeout, $window, BuilderFactory, SurveyFactory) {
    $scope.survey = {};

    SurveyFactory.getEditInfo().then(function(response) {
         const temp = response.data.message;

         $scope.survey.title = temp.title;
         $scope.survey.description = temp.description;
         $scope.survey.population = parseInt(temp.population, 10);
     })

    $scope.storeInfo = function() {
        BuilderFactory.getTempQuestions().then(function(response) {
            $scope.survey.questions = response.data.message.questions;

            console.log($scope.survey);

            BuilderFactory.setInfo($scope.survey);

            $timeout(function(){
                $window.location.href = loc + 'user/survey_report';
            }, 5000);
        })
    }

    $scope.modalClose = function() {
        $scope.$dismiss('cancel');
    }
})

.controller('profileCtrl', function($scope, $uibModal, UserFactory) {
    $scope.update = false;
    $scope.user = {};

    $scope.updatePassword = function() {
        $scope.update = true;
    }

    $scope.updatePass = function() {
        UserFactory.updatePassword($scope.user);
    }
})