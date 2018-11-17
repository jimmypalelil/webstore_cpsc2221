
<div class="btn-group">
    <button style="display:inline;" class="btn btn-success adminButtons" ng-class="{'adminButtonClicked': selectedButton == view }"  ng-click="setTableType(view); setButton(view)" ng-repeat="view in views">{{view}}</button>
</div>
<hr class="my-4">


<table class="table">
<tr>
    <th ng-repeat="(key, index) in table[0]">{{key | uppercase}}</th>
    <th>EDIT</th>
</tr>
<tr ng-repeat="item in table">
    <td ng-repeat="(key,value) in item">{{value}}</td>
    <td><a data-toggle="modal" data-target="#updateModal" ng-click="setUpdateItem(item)"><i class="fas fa-edit"></i></a>
</tr>
</table>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
				<div class="modal-body">         
                    <div class="form-group" ng-repeat="(key, value) in updateItem">
                        <label for={{key}}>{{key | uppercase}}</label>
                        <input ng-disabled="$index==0" value={{value}} />
                    </div>         
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="updateEntry()">UPDATE</button>
				</div>
			</form>
        </div>
    </div>
</div>
