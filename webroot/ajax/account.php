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

    function login($p_Config, $p_Options = null)
    {
        $controllers = new CControllerHandler();
        $controllers->add("session", new CSessionController());
        $controllers->add("database", new CDatabaseController($p_Config["database"]));
        $controllers->add("account", new CAccountController());

        return ["success" => $controllers->get("account")->login($p_Options->email, $p_Options->password)];
    }

    function logout()
    {
        $controllers = new CControllerHandler();
        $controllers->add("session", new CSessionController());
        $controllers->add("account", new CAccountController());

        return ["success" => $controllers->get("account")->logout()];
    }

    echo json_encode($res);
