<?php
    include("install.php");
    include("webroot/config.php");

    $controllers = new CControllerHandler();
    $controllers->add("session", new CSessionController());
    $controllers->add("database", new CDatabaseController($config["database"]));
    $controllers->add("account", new CAccountController());

    if($config["URL"]["mainPage"] === "products") {
        $config["css"][] = SERVER_PATH . "webroot/css/products.css";
        $config["js"][] = SERVER_PATH . "webroot/js/productItem.js";
        $config["js"][] = SERVER_PATH . "webroot/js/webshopHandler.js";

        $controllers->add("products", new CProductController());
    }

    if($config["URL"]["mainPage"] === "cart") {
        $config["css"][] = SERVER_PATH . "webroot/css/cart.css";
        $config["js"][] = SERVER_PATH . "webroot/js/webshopHandler.js";
    }

    if($config["URL"]["mainPage"] === "login") {
        $config["css"][] = SERVER_PATH . "webroot/css/login.css";
        $config["js"][] = SERVER_PATH . "webroot/js/accountHandler.js";
    }

    if($config["URL"]["mainPage"] === "account") {
        $config["css"][] = SERVER_PATH . "webroot/css/account.css";
        $config["js"][] = SERVER_PATH . "webroot/js/accountHandler.js";

        if($config["URL"]["subPage"] === "products") {
            $config["css"][] = SERVER_PATH . "webroot/css/products.css";
            $config["js"][] = SERVER_PATH . "webroot/js/productItem.js";
            $config["js"][] = SERVER_PATH . "webroot/js/fileUploadHandler.js";
            $config["js"][] = SERVER_PATH . "webroot/js/webshopHandler.js";
        }
    }

    include("theme/render.php");
 ?>
