<?php
    session_start() 
?>

<div ng-app="myApp" ng-controller="productController">
    <div class="filter-column" ng-show="{{showFilters}}">
        <h3>Filters</h3>
        Price
        <!-- <label for="priceOption" class="input-group-text">        -->
        <select class="custom-select" style="width: 210%;" id="priceOption" name="priceOption" ng-change="filterProducts()" ng-model="priceOptionSelected" ng-options="item.label for item in priceOptions">
        <option value="">-- Choose Price Options --</option>
        </select>
        Brand
        <select class="custom-select" style="width: 210%;" id="brandOption" name="brandOption" ng-change="filterProducts()" ng-model="brandOptionSelected" ng-options="item.brand for item in brandOptions">
        <option value="">-- Choose Brand Options --</option>
        </select>
        Colour
        <select class="custom-select" style="width: 210%;" id="colourOption" name="colourOption" ng-change="filterProducts()" ng-model="colourOptionSelected" ng-options="item.colour for item in colourOptions">
        <option value="">-- Choose Colour Options --</option>
        </select>
        Storage
        <select class="custom-select" style="width: 210%;" id="storageOption" name="storageOption" ng-change="filterProducts()" ng-model="storageOptionSelected" ng-options="item.storage for item in storageOptions">
        <option value="">-- Choose Storage Options --</option>
        </select>
        <hr class="my-4">
    </div>

    <!-- Product Table gets inserted here -->
    <div class="grid-container" id="products"></div>
    <!-- End of product table -->

    <!-- Popup dialog for Quantity Input -->
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

    <!-- Popup for Removing Item from Shopping cart -->
    <div class="modal fade" id="removeFromCartModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add To Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item from your Cart?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="removeFromCart()">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup for checking out Items from Shopping cart -->
    <div class="modal fade" id="addToOrdersModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add To Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to Proceed with Checkout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addToOrders()">Checkout</button>
                </div>
            </div>
        </div>
    </div>

</div>