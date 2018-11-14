<?php
/* Smarty version 3.1.33, created on 2018-11-12 02:35:05
  from 'E:\XAMPP\htdocs\term project\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5be8d8c966a3e9_51887824',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dff6701ffe33270501a454aa49d594d7a0d9cb89' => 
    array (
      0 => 'E:\\XAMPP\\htdocs\\term project\\templates\\index.tpl',
      1 => 1541986051,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5be8d8c966a3e9_51887824 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
      <a href="shoppingcart.html">Shopping Cart</a>
      <a href="contact.html">Contact Us</a>
</nav>


<main>
	
<p>asdsfjkafha slide show of images/deals will go here</p>

</main>
<footer>Copyright&copy; 2018  CPSC 2221 group 1
</footer>
</div>

</body>
</html><?php }
}
