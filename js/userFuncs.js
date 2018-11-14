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
    var query = "/term\ project/UserAction.php?req=logout";
    xmlhttp.open("POST", query, true);
    xmlhttp.send();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.href="/term\ project/index.php";
        }
    }; 
}