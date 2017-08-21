<!-- MODAL PDF -->
<div class="modal-header">
    <button type="button" class="close" ng-click="modalClose()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Export to PDF</h4>
</div>
            
<div class="modal-body">
    <form>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" ng-model="pdf.company" placeholder="Company Name">
        </div>
                    
        <div class="form-group">
            <label for="verified">Verified By</label>
            <input type="text" class="form-control" ng-model="pdf.verified" placeholder="Verified by">
        </div>
    </form>
</div>
            
<div class="modal-footer">
    <button class="btn btn-success btn-block text-uppercase" ng-click="exportReport()">Export to PDF</button>
</div>            