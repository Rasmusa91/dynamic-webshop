<?php
	/**
	* Error handling
	*
	*/
	error_reporting(-1);
	ini_set("display_error", 1);
	ini_set("output_buffering", 0);

	/**
	* Paths
	*
	*/
	define("SERVER_PATH", getServerPath("/dynamicShop"));
	define("ROOT_PATH", __DIR__);

	/**
	* Session
	*
	*/
	session_start();

	/**
	* Config
	*
	*/
	$config = [];

	/**
	* Database
	*
	*/
	$config["database"]["dsn"] = "";
	$config["database"]["username"] = "";
	$config["database"]["password"] = "";
	$config["database"]["driver_options"] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES \"UTF8\"");
