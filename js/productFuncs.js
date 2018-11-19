var pid, uid, ordering;

function getProduct(usid, productType, orderType) {
    ordering = ordering === 'asc' ? 'desc' : 'asc';
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/GetProduct.php?p=" + productType;
    query = query + "&ot=" + orderType;
    query = query + "&o=" + ordering;
    query = query + "&uid=" + usid;
    query = query + "&req=" + 'all';
    xmlhttp.open("GET", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("products").innerHTML = this.responseText;
        }
    };        
}

function getFilteredProducts(usid, productType, selectQuery) {
    ordering = ordering === 'asc' ? 'desc' : 'asc';
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/GetProduct.php?p=" + productType;
    query = query + "&ot=name";
    query = query + "&o=asc";
    query = query + "&uid=" + usid;
    query = query + "&req=filter"
    query = query + "&q=" + selectQuery;
    xmlhttp.open("GET", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("products").innerHTML = this.responseText;
        }
    };        
}

function getCart(usid, orderType) {
    ordering = ordering === 'asc' ? 'desc' : 'asc';
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/GetCart.php?req=getCart";
    query = query + "&ot=" + orderType;
    query = query + "&o=" + ordering;
    query = query + "&uid=" + usid;
    xmlhttp.open("GET", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("products").innerHTML = this.responseText;
        }
    };
}

function setProductVars(prid, usid) {    
    pid = prid;
    uid = usid;
}

function setUID(usid) {    
    uid = usid;
}

function addToCart() {
    var quantity = document.getElementById("quantity").value;
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/AddToCart.php?pid=" + pid;
    query = query + "&uid=" + uid;
    query = query + "&q=" + quantity;
    xmlhttp.open("POST", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Product was added to Your Cart Successfully");
            location.reload();
        }
    };    
}

function removeFromCart() {    
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/RemoveFromCart.php?pid=" + pid;
    query = query + "&uid=" + uid;
    xmlhttp.open("POST", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
            alert("Product was deleted Successfully");        
            location.reload();    
        }
    };    
}

function addToOrders() {
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/AddToOrders.php?uid=" + uid;
    xmlhttp.open("POST", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Product was added to Your Orders Successfully");
            location.reload();
        }
    };    
}

function getOrders(uid, ot) {
    ordering = ordering === 'asc' ? 'desc' : 'asc';
    var xmlhttp = new XMLHttpRequest();
    var query = "./products/GetOrders.php?uid=" + uid;
    query = query + "&ot=" + ot;
    query = query + "&o=" + ordering;
    xmlhttp.open("POST", query, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("products").innerHTML = this.responseText;
        }
    };    
}