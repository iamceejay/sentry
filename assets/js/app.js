angular.module('sentry', ['sentry.factory', 'sentry.controller', 'angular-loading-bar', 'toaster', 'ngAnimate', 'builder', 'builder.components', 'validator', 'validator.rules', 'chart.js', 'noCAPTCHA', 'htmlToPdfSave'])

.config(function($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
})

.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
  cfpLoadingBarProvider.includeSpinner = false;
}])

.config(['noCAPTCHAProvider', function (noCaptchaProvider) {
  noCaptchaProvider.setSiteKey('6Ld8fBcUAAAAAHJV7osWGm3zcvpgvrNvMOTGhXtr');
  noCaptchaProvider.setTheme('light');
}])