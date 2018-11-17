
<div class="btn-group">
    <button style="display:inline;" class="btn btn-success adminButtons" ng-class="{'adminButtonClicked': selectedButton == view }"  ng-click="setTableType(view); setButton(view)" ng-repeat="view in views">{{view}}</button>
</div>
<hr class="my-4">


<table class="table">
<tr>
    <th ng-repeat="(key, index) in table[0]">{{key | uppercase}}</th>
</tr>
<tr ng-repeat="item in table">
    <td ng-repeat="(key,value) in item">{{value}}</td>
</tr>
</table>

<!-- <table class="table">
<tr>
    <th ng-repeat="(key, index) in products[0]">{{key}}</th>
</tr>
<tr ng-repeat="product in products">
    <td ng-repeat="(key,value) in product">{{value}}</td>
</tr>
</table> -->