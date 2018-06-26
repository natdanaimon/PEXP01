<?php

@session_start();




$app->map(['GET', 'POST'], '/Bill/Export', function($request, $response) use($db, $util) {

    return $response->getBody()->write($util->resp(0, L::Success_0));
});



