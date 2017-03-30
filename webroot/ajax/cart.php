<?php
    session_start();

    $action = (isset($_GET["action"]) ? $_GET["action"] : null);

    $dataJson = (isset($_GET["data"]) ? $_GET["data"] : "{}");
    $data = json_decode($dataJson);

    $cart = (isset($_SESSION["cart"]) ? $_SESSION["cart"] : []);

    $res = [];

    if(isset($action))
    {
        if($action === "get") {
            $res = $cart;
        }
        else if ($action === "add")
        {
            if(!array_key_exists($data->id, $cart))
            {
                $cart[$data->id] = [
                    "data" => $data,
                    "qty" => 1
                ];
            }
            else {
                $cart[$data->id]["qty"]++;
            }

            $_SESSION["cart"] = $cart;
            $res = $cart;
        }
    }


    echo json_encode($res);
