<div class="container">
<div class="btn-group">
    <button style="display:inline;" class="btn btn-success adminButtons" ng-class="{'adminButtonClicked': selectedButton == view }"  ng-click="setTableType(view); setButton(view)" ng-repeat="view in views">{{view}}</button>
</div>
<hr class="my-4" style="width:100%;">
{{table === '' ? "No Items FOUND!!!" : ''}}
<table class="table table-hover table-striped table-bordered table-condensed">
<thead class="thead-dark">
    <tr>
        <th ng-click="setSortKey(key)" ng-repeat="(key, value) in table[0]">{{key | uppercase}} <i ng-if="key == sortKey" class="fas fa-sort-amount-up"></i><i ng-if="key == sortKeyDown" class="fas fa-sort-amount-down"></i></th>
        <th ng-show="tableType=='Get PRODUCTS'">EDIT</th>
    </tr>
</thead>
<tr ng-repeat="item in table | orderBy: sortKey">
    <td ng-repeat="(key,value) in item">{{ key.includes('price') ? '$' : '' }}{{value == null ? 'N/A': value}}
                {{(key === 'role' && value === 0) || ((key === 'USER_ID' || key === 'uid') &&  value <= 4) ? '(ADMIN)' : ''}} </td>
    <td ng-show="tableType=='Get PRODUCTS'"><a data-toggle="modal" data-target="#updateModal" ng-click="setUpdateItem(item)"><i class="fas fa-edit"></i></a>
</tr>
</table>
</div>

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
                        <input ng-disabled="key!=='price'" value={{value}} ng-change="setUpdatePrice(value)" ng-model="value" />
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
