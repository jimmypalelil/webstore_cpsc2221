<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>CPSC 2221 Term Project</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../projectcss.css">
	<link rel="shortcut icon" href="photos/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Website for buying various electronics">
	<!-- Boostrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!-- Bootstrap END -->

	<script src="productFuncs.js"></script>
	<script src="../userFuncs.js"></script>	
	<script>
		var uid = "<?php echo $_SESSION['UID']; ?>";
		getCart(uid, "name", "asc");
	</script>

</head>

<body>
<div id="wrapper">

<header><h1>Electronic Web Store</h1></header>
<nav>
	<?php
		if($_SESSION) echo "<p>Hi, ".$_SESSION['email']. "</p>";
	?>
	<a href="../index.php">Home</a>
	
	<?php
		if($_SESSION) {
			echo '
						<div class="dropdown">
						<button class="dropbtn">Products</button>
						<div class="dropdown-content">
							<a href="cameras.php">Cameras</a>
							<a href="laptops.php">Laptops</a>
							<a href="cellphones.php">Cellphones</a>
							<a href="tablets.php">Tablets</a>
							<a href="smartwatches.php">Smartwatches</a>
						</div>
					</div>';
			echo '<a href="shoppingcart.php" id="shoppingCart">Shopping Cart</a>';
			echo "<a id='logoutLink' onclick='logout()'>Logout</a>";
		}	else {
			echo "<a id='loginLink' data-toggle='modal' data-target='#loginModal'>Login</a>";
		}
	?>	
</nav>


<main>
	
	<div id="products"><div>

</main>
<footer>Copyright&copy; 2018  CPSC 2221 group 1
</footer>
</div>

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

</body>
</html>