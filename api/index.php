<?php

@session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require './Autoloader.php';
$_SESSION["lang"] = ($_SESSION["lang"] == NULL ? "th" : $_SESSION["lang"]);
$i18n = new i18n('../lang/lang_' . $_SESSION["lang"] . '.json', '../langcache/', 'th');
$i18n->init();
$util = new Utility();
$db = new ConnectDB();

        
$app = new \Slim\App();

$app->add(function ($request, $response, $next) use ($util) {
    if (strpos($request->getUri(), '/Authen/Login') !== false) {
        $response = $next($request, $response);
    } else if ($util->isBadRequest()) {
        $response->getBody()->write($util->resp(9001, L::badRequest_9001));
        return $response;
    } else {
        $response = $next($request, $response);
    }
    return $response;
});






require_once ('./Controller/CommonController.php');
require_once ('./Controller/AuthenController.php');
require_once ('./Controller/StaffController.php');
require_once ('./Controller/ConfigController.php');
require_once ('./Controller/BillController.php');






$app->run();
