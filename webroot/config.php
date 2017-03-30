<?php
    /**
    * Header
    *
    */
    $config["lang"] = "en";
    $config["charset"] = "utf-8";
    $config["favicon"] = SERVER_PATH . "webroot/img/favicon.png";
    $config["titleDefault"] = "Home";
    $config["titleExtension"] = " - Dynamic Shop";

    /**
    * CSS
    *
    */
    $config["css"] = [];
    $config["css"][] = SERVER_PATH . "webroot/css/font-awesome-4.5.0/css/font-awesome.css";
    $config["css"][] = SERVER_PATH . "webroot/css/stylesheet.css";

    /**
    * JS
    *
    */
    $config["js"] = [];
    $config["js"][] = SERVER_PATH . "webroot/js/jquery.js";
    $config["js"][] = SERVER_PATH . "webroot/js/ajaxHandler.js";

    /**
    * URL
    *
    */
    $config["URL"] = getURLParts (2);
	$config["URL"]["mainPage"] = (isset($config["URL"][0]) ? $config["URL"][0] : "products");
	$config["URL"]["subPage"] = (isset($config["URL"][1]) ? $config["URL"][1] : null);
	$config["URL"]["subSubPage"] = (isset($config["URL"][2]) ? $config["URL"][2] : null);

    /**
    * Content
    *
    */
	$config["header"] = "webroot/header.php";
	$config["page"] = "webroot/pages/" . $config["URL"]["mainPage"] . ".php";
	if(!file_exists($config["page"])) {
		$config["page"] = "webroot/pages/error.php";
	}
    if(isset($config["URL"]["subPage"]))
    {
        $config["subpage"] = "webroot/pages/account/" . $config["URL"]["subPage"] . ".php";
    	if(!file_exists($config["subpage"])) {
    		$config["page"] = "webroot/pages/error.php";
    	}
    }
	$config["footer"] = "webroot/footer.php";
?>
