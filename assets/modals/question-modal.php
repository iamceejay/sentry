<!-- MODAL QUESTION -->
<div class="modal-header">
    <button type="button" class="close" ng-click="modalClose()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Question</h4>
</div>
            
<div class="modal-body">
    <form>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label>Type</label>
                </div>

                <div class="col-sm-10">
                    <select ng-model="question.type" class="form-control input-sm">
                        <option value="textfield">Text Field</option>
                        <option value="textarea">Text Area</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio Button</option>
                        <option value="select">Select</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label>Question</label>
                </div>

                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" ng-model="question.description">
                </div>
            </div>
        </div>

        <div class="form-group" ng-if="(question.type == 'textarea' || question.type == 'textfield')">
            <div class="row">
                <div class="col-sm-2">
                    <label>Placeholder</label>
                </div>

                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" ng-model="question.placeholder">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label>Variable</label>
                </div>

                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" ng-model="question.label">
                </div>
            </div>
        </div>

        <div class="form-group" ng-if="(question.type == 'checkbox' || question.type == 'radio' || question.type == 'select')">
            <div class="row">
                <div class="col-sm-2">
                    <label>Options</label>
                </div>

                <div class="col-sm-10">
                    <textarea class="form-control input-sm" ng-model="question.options"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
            
<div class="modal-footer">
    <button class="btn btn-success btn-block text-uppercase" ng-click="save()">Add Question</button>
</div>