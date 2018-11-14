<?php
    session_start() 
?>

<div ng-app="myApp" ng-controller="productController">
    <div>
        Price:
        <select id="priceOption" name="priceOption" ng-change="filterPrice()" ng-model="priceOptionSelected" ng-options="item.label for item in priceOptions">
        <option value="">-- Choose Price Options --</option>
        </select>
        Brand:
        <select id="brandOption" name="brandOption" ng-change="filterBrand()" ng-model="brandOptionSelected" ng-options="item.brand for item in brandOptions">
        <option value="">-- Choose Brand Options --</option>
        </select>
        Colour:
        <select id="colourOption" name="colourOption" ng-change="filterColour()" ng-model="colourOptionSelected" ng-options="item.colour for item in colourOptions">
        <option value="">-- Choose Colour Options --</option>
        </select>
        <hr>
    </div>
    <div id="products"></div>

    <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add To Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for='quantity'>Quantity</label>
                    <input name='quantity' id='quantity' type='number' value='1' min='1' />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addToCart()">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>