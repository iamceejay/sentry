<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,800" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Istok+Web" rel="stylesheet">  

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/paper.css');?>">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
    <script src="<?php echo base_url('assets/js/paper.js');?>"></script>

    <!-- ANGULARJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>

    <!-- BOOTSTRAP-UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.3.2/ui-bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.3.2/ui-bootstrap-tpls.js"></script>

    <!-- LOADING BAR -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css' type='text/css' media='all' />
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>

    <!-- TOASTER & NG-ANIMATE -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/1.1.0/toaster.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular-animate.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/1.1.0/toaster.min.js"></script>

    <!-- FORM BUILDER -->
    <link rel="stylesheet" href="<?php echo base_url('assets/angular-form-builder-master/dist/angular-form-builder.css');?>">
    <script src="<?php echo base_url('assets/angular-form-builder-master/dist/angular-form-builder.js');?>"></script>
    <script src="<?php echo base_url('assets/angular-form-builder-master/dist/angular-form-builder-components.js');?>"></script>

    <!-- VALIDATOR -->
    <script src="<?php echo base_url('assets/angular-validator-master/dist/angular-validator.js');?>"></script>
    <script src="<?php echo base_url('assets/angular-validator-master/dist/angular-validator-rules.js');?>"></script>

    <!-- ANGULAR CHART -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="<?php echo base_url('assets/angular-chart/angular-chart.js');?>"></script>

    <!-- RE-CAPTCHA -->
    <script src="<?php echo base_url('assets/angular-no-captcha-master/src/angular-no-captcha.js');?>"></script>

    <!-- PDF -->
    <script src="https://cdn.rawgit.com/niklasvh/html2canvas/0.5.0-alpha2/dist/html2canvas.min.js"></script>
    <script src="<?php echo base_url('assets/js/jspdf.debug.js');?>"></script>
    <script src="<?php echo base_url('assets/angular-save-html-to-pdf/dist/saveHtmlToPdf.min.js');?>"></script>

    <!-- APP -->
    <script src="<?php echo base_url('assets/js/app.js');?>"></script>
    <script src="<?php echo base_url('assets/js/factory.js');?>"></script>
    <script src="<?php echo base_url('assets/js/controller.js');?>"></script>

    <script src="<?php echo base_url('assets/js/sketch.min.js');?>"></script>
</head>

<body ng-app="sentry" ng-controller="homeCtrl">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsed-menu">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="<?php echo base_url();?>" class="navbar-brand">Sentry</a>
            </div>

            <div class="collapse navbar-collapse" id="collapsed-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><a href="<?php echo base_url('create_account');?>">Create Account</a></li>
                    <button type="button" ng-click="loginModal()" class="btn btn-default navbar-btn">Login</button>
                </ul>
            </div>
        </div>
    </nav>