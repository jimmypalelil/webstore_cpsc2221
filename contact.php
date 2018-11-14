<!DOCTYPE html>
<html lang="en">

<head>
	<title>CPSC 2221 Term Project</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="projectcss.css">
	<link rel="shortcut icon" href="photos/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Website for buying various electronics">
</head>

<body>
<div id="wrapper">

<header><h1>Electronic Web Store</h1></header>
<nav>
		<!--<script>
		var userName; // PLACE HOLDER. WILL BE LOG IN, NOT PROMPT. Just to show where "Hi, user" will be.
		userName = prompt("Please enter your name");
		//if user does not enter a name, it will say "guest"
		if (userName == "") {
			document.write("<h2>Welcome, " + "guest" + "</h2>");
		//if user hits cancel, it will say "guest"
		} else if (!userName){
			document.write("<h2>Welcome, " + "guest" + "</h2>");
		//will display the name the user input
		} else {
			document.write("<h2>Welcome, " + userName + "</h2>");
		}
		</script>-->

      <a href="index.html">Home</a>
      <div class="dropdown">
		<button class="dropbtn">Products</button>
		<div class="dropdown-content">
			<a href="products/cameras.html">Cameras</a>
			<a href="products/laptops.html">Laptops</a>
			<a href="products/cellphones.html">Cellphones</a>
			<a href="products/tablets.html">Tablets</a>
			<a href="products/smartwatches.html">Smartwatches</a>
			</div>
			</div>
      <a href="media.html">Shopping Cart</a>
      <a href="form.html">Contact Us</a>
</nav>


<main>
	
<p><form method="post" action="http://webdevbasics.net/scripts/demo.php">

<label for="myName">Name:</label>
<input type="text" name="myName" id="myName">

<label for="myEmail">E-mail:</label>
<input type="text" name="myEmail" id="myEmail">

<label
for="myComments">Comments:</label><textarea name="myComments"
id="myComments" rows="2" cols="20"></textarea>

<input id="mySubmit" type="submit" value="Submit">

</form></p>

</main>
<footer>Copyright&copy; 2018  CPSC 2221 group 1
</footer>
</div>

</body>
</html>