<?php
    include("../../install.php");

    $data = (isset($_GET["data"]) ? $_GET["data"] : []);
    $data = json_decode($data);

    $res = [];

    foreach($data as $val)
    {
        $f = $val->type;
        $res[$val->type] = $f($config, (isset($val->options) ? $val->options : null));
    }

    function products($p_Config, $p_Options = null)
    {
        $databaseController = new CDatabaseController($p_Config["database"]);
        $productController = new CProductController($databaseController);

        $products = $productController->getProducts([
                "page" => $p_Options->page,
                "query" => $p_Options->query,
                "cats" => (isset($p_Options->cats) ? $p_Options->cats : []),
                "units" => (isset($p_Options->units) ? $p_Options->units : [])
            ]
        );

        return ["items" => $products, "total" => $productController->totalProductsAmount];
    }

    function cart($config, $p_Options)
    {
        $cart = (isset($_SESSION["cart"]) ? $_SESSION["cart"] : []);
        $res = [];

        if($p_Options->action === "get") {
            $res =  $cart;
        }
        else if($p_Options->action === "add")
        {
            if(!array_key_exists($p_Options->item->id, $cart))
            {
                $cart[$p_Options->item->id] = [
                    "data" => $p_Options->item,
                    "qty" => 1
                ];
            }
            else {
                $cart[$p_Options->item->id]["qty"]++;
            }

            $_SESSION["cart"] = $cart;
            $res = $cart;
        }

        return $res;
    }

    echo json_encode($res);
