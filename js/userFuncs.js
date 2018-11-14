var uid, uname;


function loginUser() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var xmlhttp = new XMLHttpRequest();
    var query = "UserAction.php?req=login";
    query = query + "&email=" + email;
    query = query + "&password=" + password;
    xmlhttp.open("GET", query, true);
    xmlhttp.send();     
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responseCode = this.responseText;
            location.reload();
        }
    }; 
}

function logout() {
    var xmlhttp = new XMLHttpRequest();
    var query = "UserAction.php?req=logout";
    xmlhttp.open("POST", query, true);
    xmlhttp.send();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.href="index.php";
        }
    }; 
}

function registerUser(email, password, firstName, lastName, address) {
    var xmlhttp = new XMLHttpRequest();
    var query = "UserAction.php?req=register";
    query = query + "&email=" + email;
    query = query + "&password=" + password;
    query = query + "&firstName=" + firstName;
    query = query + "&lastName=" + lastName;
    query = query + "&address=" + address;
    xmlhttp.open("POST", query, true);
    xmlhttp.send();     
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    }; 
}