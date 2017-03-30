<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');

	error_reporting(-1);
	ini_set("display_error", 1);
	ini_set("output_buffering", 0);

	include("config/config.php");

	$databaseController = new CDatabaseController($config["database"]);
	$productController = new CProductController($databaseController);

	echo $productController->getProducts(isset($_GET["productOffset"]) ? $_GET["productOffset"] : 0);
