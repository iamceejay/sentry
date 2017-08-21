<!-- MODAL CODE -->
<div class="modal-header">
    <button type="button" class="close" ng-click="modalClose()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Take a Survey</h4>
</div>
            
<div class="modal-body">
    <div class="form-group text-center">
        <h3>Enter the code below</h3>
        <input type="text" class="form-control input-lg text-center" ng-model="input.code" placeholder="Code">
    </div>

    <div class="form-group">
        <button class="btn btn-success btn-block btn-lg text-uppercase" ng-click="confirmCode()">Confirm Code</button>
    </div>
</div>         