<div class="create-account-wrapper">
    <div class="create-account">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-light">
                    <h1>Far far away, behind the</h1>

                    <h2>word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h2>

                    <p class="lead">
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                    </p>
                </div>

                <div class="col-sm-offset-1 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h1>Sentry</h1>

                            <p>Please enter the required credentials</p>

                            <form role="form" name="createAccountForm">
                                <div class="form-group form-group-md" ng-class="{'has-error' : createAccountForm.fname.$invalid && !createAccountForm.fname.$pristine}">
                                    <label for="firstname">First Name</label>
                                    <input type="text" ng-model="user.fname" name="fname" id="firstname" class="form-control" placeholder="First Name" ng-required="true">

                                    <div class="has-error">
                                        <small class="help-block" ng-show="createAccountForm.fname.$invalid && !createAccountForm.fname.$pristine"><b>First name field is required.</b></small>
                                    </div>
                                </div>

                                <div class="form-group form-group-md" ng-class="{'has-error' : createAccountForm.lname.$invalid && !createAccountForm.lname.$pristine}">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" ng-model="user.lname" name="lname" id="lastname" class="form-control" placeholder="Last Name" ng-required="true">

                                    <div class="has-error">
                                        <small class="help-block" ng-show="createAccountForm.lname.$invalid && !createAccountForm.lname.$pristine"><b>Last name field is required.</b></small>
                                    </div>
                                </div>

                                <div class="form-group form-group-md" ng-class="{'has-error' : createAccountForm.username.$invalid && !createAccountForm.username.$pristine}">
                                    <label for="username">Username</label>
                                    <input type="text" ng-model="user.username" name="username" id="username" class="form-control" placeholder="Username" ng-required="true">

                                    <div class="has-error">
                                        <small class="help-block" ng-show="createAccountForm.username.$invalid && !createAccountForm.username.$pristine"><b>Username field is required.</b></small>
                                    </div>
                                </div>

                                <div class="form-group form-group-md" ng-class="{'has-error' : createAccountForm.email.$invalid && !createAccountForm.email.$pristine}">
                                    <label for="email">E-mail</label>
                                    <input type="email" ng-model="user.email" name="email" id="email" class="form-control" placeholder="E-mail Address" ng-required="true">

                                    <div class="has-error">
                                        <small class="help-block" ng-show="createAccountForm.email.$invalid && !createAccountForm.email.$pristine"><b>You must enter a valid e-mail.</b></small>
                                    </div>
                                </div>

                                <div class="form-group form-group-md">
                                    <label for="password">Password</label>
                                    <input type="{{ inputType }}" ng-model="user.password" name="password" id="password" class="form-control" placeholder="Password" ng-required="true">
                                    
                                    <div class="has-error">
                                        <small class="help-block" ng-show="createAccountForm.password.$invalid && !createAccountForm.password.$pristine"><b>Password field is required.</b></small>
                                    </div>
                                </div>

                                <div class="form-group form-group-md">
                                    <label for="password2">Confirm Password</label>
                                    <input type="{{ inputType }}" name="password2" id="password2" ng-model="user.password2" class="form-control" placeholder="Confirm Password" ng-required="true" ng-change="checkMatch()">

                                    <div class="has-error">
                                        <small class="help-block" ng-show="createAccountForm.password2.$invalid && !createAccountForm.password2.$pristine"><b>Confirm password field is required</b></small>
                                    </div>

                                    <div class="has-error">
                                        <small class="help-block" ng-show="!passwordMatch"><b>Password does not match.</b></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="pull-right">
                                        <button class="btn btn-default" type="button" ng-click="showPassword()"><span class="glyphicon glyphicon-eye-open"></span> View Password</button>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <div style="width: 304px !important; margin: 0 auto !important;">
                                        <no-captcha
                                            g-recaptcha-response="gRecaptchaResponse"
                                            control="noCaptchaControl"
                                            site-key="6Ld8fBcUAAAAAHJV7osWGm3zcvpgvrNvMOTGhXtr">
                                        </no-captcha>
                                    </div>
                                </div>

                                <button 
                                    type="submit" 
                                    class="btn btn-success btn-block" 
                                    ng-click="createUser()"
                                    ng-disabled="createAccountForm.$invalid && gRecaptchaResponse != ''">
                                    Create Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>