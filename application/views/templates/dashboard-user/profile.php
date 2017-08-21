 <div id="page-content-wrapper" class="container" ng-controller="profileCtrl">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
            <div class="card">
                <div class="cover" data-fade="1500" data-duration="1500">
                    <ul class="cover-pics">
                        <li><img src="<?php echo base_url('assets/img/create-survey-1.jpg');?>"></li>
                        <li><img src="<?php echo base_url('assets/img/create-survey-2.jpg');?>"></li>
                        <li><img src="<?php echo base_url('assets/img/create-survey-3.jpg');?>"></li>
                    </ul>

                    <img src="<?php echo base_url('assets/img/avatar.png');?>" class="avatar">
                </div>

                <div class="about">
                    <table class="table">
                        <tr>
                            <td><h5><b>Name</b></h5></td>
                            <td><h5><?php echo $this->session->userdata('fname') . ' ' . $this->session->userdata('lname');?></h5></td>
                        </tr>

                        <tr>
                            <td><h5><b>Username</b></h5></td>
                            <td><h5><?php echo $this->session->userdata('username');?></h5></td>
                        </tr>

                        <tr>
                            <td><h5><b>E-mail</b></h5></td>
                            <td><h5><?php echo $this->session->userdata('email');?></h5></td>
                        </tr>

                        <tr>
                            <td><h5><b>Password</b></h5></td>
                            <td><button class="btn btn-default btn-block" ng-click="updatePassword()">Update</button></td>
                        </tr>

                        <tr ng-if="update">
                            <td><h5><b>New Password</b></h5></td>
                            <td>
                                <div class="form-group">
                                    <input type="password" class="form-control" ng-model="user.password" placeholder="Enter new password">
                                </div>
                            </td>
                        </tr>
                    </table>

                    <button ng-if="(user.password.length >= 8)" class="btn btn-success btn-block text-uppercase" ng-click="updatePass()">Update Password</button>
                </div>
            </div>
        </div>
    </div>
</div>