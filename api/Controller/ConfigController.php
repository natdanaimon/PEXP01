<?php

@session_start();

$app->map(['GET', 'POST'], '/Config/InquiryConfig', function ($request, $response) use($db, $util) {
    $service = new StaffService();

    $_data = $service->inquiryStaff($db);
    if ($_data != NULL) {
        return $response->getBody()->write($util->resp(0, L::Success_0, $_data));
    } else {
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
});



$app->map(['GET', 'POST'], '/Config/Save', function($request, $response) use($db, $util) {
    $service = new ConfigService();

    $r = $request->getParsedBody();

    //valid form



    if ($util->isEmpty($r['s_address'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_address, L::Err_2002)));
    } else if ($util->isSpecialChar($r['s_address'])) {
        return $response->getBody()->write($util->resp(2006, $util->setMsg(L::lb_address, L::Err_2006)));
    }



    $db->conn();

    if ($service->update($db, $r)) {
        $db->commit();
        return $response->getBody()->write($util->resp(0, L::Success_0));
    } else {
        $db->rollback();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }

    return $response->getBody()->write($util->resp(0, L::Success_0));
});

