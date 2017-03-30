<?php
    function getURLParts ($p_Skip = 0)
    {
        $request = parse_url($_SERVER['REQUEST_URI']);
        $path = $request["path"];
        $result = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');

        $parts = explode('/', $result);
        $wantedParts = array ();

        for($i = $p_Skip; $i < count($parts); $i++) {
            $wantedParts[] = $parts[$i];
        }

        return $wantedParts;
    }

    function getServerPath($pDirectory = null)
	{
		$url = "http";
		$url .= (@$_SERVER["HTTPS"] == "on") ? 's' : '';
		$url .= "://";
		$serverPort = ($_SERVER["SERVER_PORT"] == "80") ? '' : (($_SERVER["SERVER_PORT"] == 443 && @$_SERVER["HTTPS"] == "on") ? '' : ":{$_SERVER['SERVER_PORT']}");
		$url .= $_SERVER["SERVER_NAME"];


		if(isset($pDirectory)) {
			$url .= $pDirectory . "/";
		}

		return $url;
	}

    function autoLoader($class)
    {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $path = ROOT_PATH . "/src/{$class}.php";

        if(is_file($path)) {
            include($path);
        }
        else {
            throw new Exception("Classfile '{$class}' does not exists.");
        }
    }
    spl_autoload_register('autoLoader');
