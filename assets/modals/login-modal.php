<!-- MODAL LOGIN -->
<div class="modal-header">
    <button type="button" class="close" ng-click="modalClose()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Login to your Account</h4>
</div>
            
<div class="modal-body">
    <form>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" ng-model="login.username" placeholder="Username">
        </div>
                    
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" ng-model="login.password" placeholder="Password">
        </div>
    </form>
</div>
            
<div class="modal-footer">
    <button class="btn btn-success btn-block text-uppercase" ng-click="userLogin()">Login</button>
</div>            