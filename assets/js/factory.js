const loc = 'http://127.0.0.1/sentry/';
const post_config = {headers: { 'Content-Type' : 'application/x-www-form-urlencoded'}};

angular.module('sentry.factory', [])

.factory('UserFactory', function($http, $httpParamSerializerJQLike, toaster, $window, $timeout) {
    return {
        createUser: function(data) {
            $http.post(loc + 'api_user/signup', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc;
                }, 3000);

                console.log(response.data);
            },
            function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });

                console.log(error.data);
            })
        },
        userLogin: function(data) {
            $http.post(loc + 'api_user/login', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $window.location.href = loc + response.data.link;

                console.log(response.data);
            },
            function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
                
                console.log(error.data);
            })
        },
        getAllUsers: function() {
            return $http.get(loc + 'users/users');
        },
        resetPassword: function(id) {
            $http.get(loc + 'users/reset_password/' + id)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $window.location.href = loc + 'admin/users';
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        userDeactivate: function(id) {
            $http.get(loc + 'users/user_deactivate/' + id)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $window.location.href = loc + 'admin/users';
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        userActivate: function(id) {
            $http.get(loc + 'users/user_activate/' + id)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $window.location.href = loc + 'admin/users';
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        updatePassword: function(password) {
            $http.post(loc + 'users/update', $httpParamSerializerJQLike(password), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $window.location.href = loc + 'api_user/logout';
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        }
    }
})

.factory('DashboardFactory', function($http) {
    return {
        countSurveys: function() {
            return $http.get(loc + 'api_user/count_survey');
        },
        countActive: function() {
            return $http.get(loc + 'api_user/count_codes');
        },
        countInactive: function() {
            return $http.get(loc + 'api_user/count_inactive');
        },
        countActiveUsers: function() {
            return $http.get(loc + 'admin/count_active_users');
        },
        countInactiveUsers: function() {
            return $http.get(loc + 'admin/count_inactive_users');
        },
        countTemplates: function() {
            return $http.get(loc + 'admin/count_templates');
        },
        countQuestions: function() {
            return $http.get(loc + 'admin/count_questions');
        }
    }
})

.factory('BuilderFactory', function($http, $httpParamSerializerJQLike, toaster, $window, $timeout) {
    return {
        setInfo: function(data) {
            $http.post(loc + 'survey/temp_question', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                console.log(response.data);
            })
        },
        getQuestions: function() {
            return $http.get(loc + 'survey/temp_label');
        },
        cancelSurvey: function() {
            $http.get(loc + 'survey/temp_destroy');
        },
        saveSurvey: function(data) {
            $http.post(loc + 'survey/save', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                console.log(response.data);

                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc;
                }, 5000);

            }, function(error) {
                console.log(error.data);

                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        saveTempQuestions: function(data) {
            $http.post(loc + 'survey/builder_questions', $httpParamSerializerJQLike(data), post_config)
            .then(function(resposne) {
                console.log(response);
            })
        },
        getTempQuestions: function() {
            return $http.get(loc + 'survey/builder_questions');
        }
    }
})

.factory('SurveyFactory', function($http, $httpParamSerializerJQLike, toaster, $window, $timeout) {
    return {
        getSurveys: function() {
            return $http.get(loc + 'survey/my_surveys');
        },
        getCodes: function(data) {
            return $http.get(loc + 'survey/my_codes/' + data);
        },
        confirmCode: function(data) {
            $http.post(loc + 'survey/check_code', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                $window.location.href = loc + 'respondent/survey';
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        getQuestions: function() {
            return $http.get(loc + 'survey/respondent_survey');
        },
        getInfo: function() {
            return $http.get(loc + 'survey/respondent_survey_id');
        },
        saveResponse: function(data) {
            $http.post(loc + 'survey/respondent_answer', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc;
                }, 5000);

            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        editSurvey: function(data) {
            $http.post(loc + 'survey/temp_edit', $httpParamSerializerJQLike(data), post_config);
        },
        getEditInfo: function() {
            return $http.get(loc + 'survey/temp_edit');
        },
        addPopulation: function(data) {
            $http.post(loc + 'survey/code_add', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        }
    }
})

.factory('ReportFactory', function($http, $httpParamSerializerJQLike) {
    return {
        getQuestions: function(id) {
            return $http.get(loc + 'report/questions/' + id);
        },
        getCharts: function(id) {
            return $http.get(loc + 'report/charts/' + id);
        },
        postResults: function(data) {
            return $http.post(loc + 'report/report_results', $httpParamSerializerJQLike(data), post_config);
        },
        postResult: function(data) {
            return $http.post(loc + 'report/report_result', $httpParamSerializerJQLike(data), post_config);
        },
        getAnswers: function(data) {
            return $http.post(loc + 'report/report_answers', $httpParamSerializerJQLike(data), post_config);
        },
        getSummary: function(id) {
            return $http.get(loc + 'survey/report_summary/' + id);
        }
    }
})

.factory('QuestionFactory', function($http, $httpParamSerializerJQLike, toaster, $window, $timeout) {
    return {
        addQuestion: function(data) {
            $http.post(loc + 'question/add', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc + 'admin/question_bank';
                }, 5000);
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        getQuestions: function() {
            return $http.get(loc + 'question/questions');
        },
        updateQuestion: function($data) {
            $http.post(loc + 'question/question_update', $httpParamSerializerJQLike($data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc + 'admin/question_bank';
                }, 5000);
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        }
    }
})

.factory('TemplateFactory', function($http, $httpParamSerializerJQLike, toaster, $timeout, $window) {
    return {
        saveTemplate: function(data) {
            $http.post(loc + 'template/add', $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc + 'admin/templates';
                }, 5000);
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        saveQuestion: function(data) {
            $http.post(loc + 'template/temp_question', $httpParamSerializerJQLike(data), post_config);
            console.log(data);
        },
        getQuestions: function() {
            return $http.get(loc + 'template/temp_question');
        },
        getAll: function() {
            return $http.get(loc + 'template/templates');
        },
        tempTemplate: function(data) {
            $http.post(loc + 'template/temp_template', $httpParamSerializerJQLike(data), post_config);

            $timeout(function() {
                $window.location.href = loc + 'user/survey_builder';
            }, 10000);
        },
        getTempTemplate: function() {
            return $http.get(loc + 'template/temp_template');
        },
        destoryTemp: function() {
            $http.get(loc + 'template/temp_desstroy');
        },
        deleteTemplate: function(id) {
            $http.get(loc + 'template/template_delete/' + id)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $window.location.href = loc + 'admin/templates';
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        },
        editTemplate: function(data) {
            $http.post(loc + 'template/edit_temp_data', $httpParamSerializerJQLike(data), post_config);
        },
        getTemplate: function() {
            return $http.get(loc + 'template/edit_temp_data');
        },
        updateTemplate: function(data, id) {
            $http.post(loc + 'template/update_template/' + id, $httpParamSerializerJQLike(data), post_config)
            .then(function(response) {
                toaster.success({
                    title : response.data.status,
                    body : response.data.message,
                    timeout : 3000
                });

                $timeout(function() {
                    $window.location.href = loc + 'admin/templates';
                }, 5000);
            }, function(error) {
                toaster.pop({
                    type : 'error',
                    title : error.data.status,
                    body : error.data.message,
                    timeout : 3000
                });
            })
        }
    }
})