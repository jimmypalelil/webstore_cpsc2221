
<div class='admin-column'>
    <ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center adminButtons" style="padding:10px;" ng-class="{'adminButtonClicked': selectedButton == view }"  ng-click="setTableType(view); setButton(view)" ng-repeat="view in views">{{view}} 
        <span ng-show="selectedButton == view" class="badge"><i class="fas fa-chevron-circle-right"></i></span></li>
</div>

<hr class="my-4" style="width:100%;">

<!-- <div class="grid-container"> -->
    <div class="container">
        <!-- If no items are found from database -->
        {{table === '' ? "No Items FOUND!!!" : ''}}

        <table class="table table-hover table-striped table-bordered table-condensed">

        <!-- Table header with sort icon -->
        <thead class="thead-dark">
            <tr>
                <th ng-show="key !== 'password'" ng-click="setSortKey(key)" ng-repeat="(key, value) in table[0]">{{key | uppercase}} 
                    <i ng-if="key == sortKey" class="fas fa-sort-amount-up"></i><i ng-if="key == sortKeyDown" class="fas fa-sort-amount-down"></i>
                </th>
                <th ng-show="tableType=='Get PRODUCTS'">EDIT</th>
            </tr>
        </thead>
        <tr ng-repeat="item in table | orderBy: sortKey">
            <td ng-show="key !== 'password'" ng-repeat="(key,value) in item">
                {{ key.includes('price') ? '$' : '' }}{{key === 'total_quantity_sold' && value == null ? '0': value == null ? 'N/A' : value}}
                {{(key === 'role' && value === 0) || ((key === 'USER_ID' || key === 'uid') &&  value <= 4) ? '(ADMIN)' : ''}} 
            </td>
            <td ng-show="tableType=='Get PRODUCTS'"><a data-toggle="modal" data-target="#updateModal" ng-click="setUpdateItem(item)"><i class="fas fa-edit"></i></a>
        </tr>
        </table>
    </div>
<!-- </div> -->


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
