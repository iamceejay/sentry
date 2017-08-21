<div class="container" style="margin-top: 80px;" ng-controller="respondentCtrl">
    <style>
    .help-block {
        display: none !important;
    }
    </style>
    <div class="col-md-offset-2 col-md-8">
        <div class="well">
            <div class="text-center">
                <h3><b><?php echo $this->session->userdata('survey_info')[0]['title'];?></b></h3>
                <small><?php echo $this->session->userdata('survey_info')[0]['description'];?></small>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal">
                        <div ng-model="input" fb-form="respondent" fb-default="defaultValue"></div>
                    </form>
                </div>
            </div>

            <hr>

            <button class="btn btn-success btn-block" ng-click="submitAnswers()">Submit</button>
        </div>  
    </div>
</div>