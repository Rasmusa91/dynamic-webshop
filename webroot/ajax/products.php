<?php
    include("../../install.php");

    $databaseController = new CDatabaseController($config["database"]);
    $productController = new CProductController($databaseController);

    $products = $productController->getProducts(
        []
    );

    echo json_encode($products);

    /*
    $page = (isset($_GET["page"]) ? $_GET["page"] : 1);
    $page = ($page > 0 ? $page : 1);

    $products = $productController->getProducts(
        ["page" => $page]
    );

    $pagination["curr"] = $page;
    $pagination["max"] = ceil($productController->totalProductsAmount / $productController->productsPerPage);
    $pagination["prev"] = (($page - 1 > 0) ? ($page - 1 > 0) : 1);
    $pagination["next"] = (($page + 1 < $pagination["max"]) ? $pagination["max"] : $pagination["max"]);

    $cart = (isset($_SESSION["cart"]) ? $_SESSION["cart"] : null);
    */
