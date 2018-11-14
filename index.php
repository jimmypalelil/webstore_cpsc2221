<!DOCTYPE html>
<html ng-app="myApp" lang="en">

<head>
	<title>CPSC 2221 Term Project</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="projectcss.css">
	<link rel="shortcut icon" href="photos/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Website for buying various electronics">
	<!-- Boostrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!-- Bootstrap END -->

	<!-- Angular -->
	<script src="https://code.angularjs.org/1.3.0-rc.5/angular.min.js"></script>
    <script src="https://code.angularjs.org/1.3.0-rc.5/angular-route.min.js"></script>

	<script src="js/app.js"></script>
	<!-- Angular END -->


	<script src="./js/userFuncs.js"></script>	
	<script src="./js/productFuncs.js"></script>
</head>

<body>
<div id="wrapper" ng-controller='mainController'>

<header><h1>Electronic Web Store</h1></header>
<nav>
	<?php
		session_start();
		if($_SESSION) echo "<p>Hi, ".$_SESSION['email']. "</p>";
	?>
	<a href="index.php">Home</a>
	
	<?php
		if($_SESSION) {
			echo '
						<div class="dropdown">
						<button class="dropbtn">Products</button>
						<div class="dropdown-content">
							<a href="#/products/camera/'.$_SESSION['UID'].'">Cameras</a>
							<a href="#/products/laptop/'.$_SESSION['UID'].'">Laptops</a>
							<a href="#/products/cellphone/'.$_SESSION['UID'].'">Cellphones</a>
							<a href="#/products/tablet/'.$_SESSION['UID'].'">Tablets</a>
							<a href="#/products/smartwatch/'.$_SESSION['UID'].'">Smartwatches</a>
						</div>	
					</div>';
			echo '<a href="#/usr/shoppingCart/'.$_SESSION['UID'].'">Shopping Cart</a>';
			echo '<a href="#/usr/orders/'.$_SESSION['UID'].'">Orders</a>';
			echo "<a data-toggle='modal' data-target='#logoutModal'>Logout</a>";
		}	else {
			echo "<a data-toggle='modal' data-target='#loginModal'>Login</a>";
			echo "<a data-toggle='modal' data-target='#registerModal'>Register</a>";
		}
	?>	
</nav>


<main>
	
<div ng-view></div>

</main>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group">
						<label for='email'>Email</label>
						<input name='email' id='email' type='email' />
					</div>
					<div class="form-group">
						<label for='password'>Password</label>
						<input name='password' id='password' type='password' />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="loginUser()">LOGIN</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group">
						<label for='firstName'>First Name</label>
						<input name='firstName' ng-model="firstName" id='firstName' type='text' />
					</div>
					<div class="form-group">
						<label for='lastName'>Last Name</label>
						<input name='lastName' ng-model="lastName" id='lastName' type='text' />
					</div>
					<div class="form-group">
						<label for='registerEmail'>Email</label>
						<input name='registerEmail' id='registerEmail' ng-model="email" type='email' />
					</div>
					<div class="form-group">
						<label for='registerPassword'>Password</label>
						<input name='registerPassword' id='registerPassword' ng-model="password" type='password' />
					</div>
					<div class="form-group">
						<label for='address'>Address</label>
						<textarea name='address' id='address' ng-model="address"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="registerUser()">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add To Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to LOGOUT?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="logout()">LOGOUT</button>
                </div>
            </div>
        </div>
    </div>

</div>
<footer>Copyright&copy; 2018  CPSC 2221 group 1
</footer>

</body>
</html>