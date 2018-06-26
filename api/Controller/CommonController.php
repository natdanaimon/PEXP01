<?php

@session_start();

$app->map(['GET', 'POST'], '/Dropdown/Status', function ($request, $response) use($db, $util) {
    $service = new CommonService();
    $_data = $service->DropdownStatusAC($db);
    return $response->getBody()->write($util->resp(0, L::Success_0, $_data));
});

$app->map(['GET', 'POST'], '/Dropdown/Level', function ($request, $response)  use($db, $util) {
    $service = new CommonService();
    $_data = $service->DropdownLevel($db);
    return $response->getBody()->write($util->resp(0, L::Success_0, $_data));
});



