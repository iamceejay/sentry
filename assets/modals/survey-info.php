<!-- MODAL SURVEY INFO -->
<div class="modal-header">
    <button type="button" class="close" ng-click="modalClose()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Survey Information</h4>
</div>
            
<div class="modal-body">
    <form>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" ng-model="survey.title" placeholder="Title">
        </div>
                    
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" ng-model="survey.description" placeholder="Description">
        </div>

        <div class="form-group">
            <label for="population">Population</label>
            <input type="number" class="form-control" ng-model="survey.population" placeholder="Population Size">
        </div>
    </form>
</div>
            
<div class="modal-footer">
    <button class="btn btn-success btn-block text-uppercase" ng-click="storeInfo()">Save</button>
</div>