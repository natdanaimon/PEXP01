<?php

@session_start();

$app->map(['GET', 'POST'], '/Staff/InquiryStaff', function ($request, $response) use($db, $util) {
    $service = new StaffService();

    $_data = $service->inquiryStaff($db);
    if ($_data != NULL) {
        return $response->getBody()->write($util->resp(0, L::Success_0, $_data));
    } else {
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
});

$app->map(['GET', 'POST'], '/Staff/InquiryStaffbyID/{keyId}', function ($request, $response) use($db, $util) {
    $service = new StaffService();

    $db->conn();
    $keyId = $request->getAttribute('keyId');

    $_data = $service->inquiryStaffbyID($db, $keyId);
    if ($_data != NULL) {
        return $response->getBody()->write($util->resp(0, L::Success_0, $_data));
    } else {
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
});

$app->map(['GET', 'POST'], '/Staff/Save', function($request, $response) use($db, $util) {
    $service = new StaffService();
    $authenService = new AuthenService();
    $commonService = new CommonService();

    $r = $request->getParsedBody();

    //valid form
    if ($util->isEmpty($r['s_user'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_username, L::Err_2002)));
    } else if ($util->isEmptyReg($r['s_user'])) {
        return $response->getBody()->write($util->resp(4001, L::Err_4001));
    } else if ($commonService->getValidUser($db, $r['s_user'], $r['keyId'])) {
        return $response->getBody()->write($util->resp(2005, $util->setMsg(L::lb_username, L::Err_2005)));
    }

    if ($util->isEmpty($r['s_pass'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_password, L::Err_2002)));
    } else if ($util->isEmptyReg($r['s_pass'])) {
        return $response->getBody()->write($util->resp(4001, L::Err_4002));
    }

    if ($util->isEmptyDDL($r['level'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_levelUser, L::Err_2002)));
    }

    if ($util->isEmpty($r['s_firstname'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_firstName, L::Err_2002)));
    } else if ($util->isSpecialChar($r['s_firstname'])) {
        return $response->getBody()->write($util->resp(2006, $util->setMsg(L::lb_firstName, L::Err_2006)));
    }


    if ($util->isEmpty($r['s_lastname'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_lastName, L::Err_2002)));
    } else if ($util->isSpecialChar($r['s_lastname'])) {
        return $response->getBody()->write($util->resp(2006, $util->setMsg(L::lb_lastName, L::Err_2006)));
    }

    if ($util->isEmpty($r['s_phone'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_phoneMobile, L::Err_2002)));
    } else if (!$util->isPhoneNumber($r['s_phone'])) {
        return $response->getBody()->write($util->resp(2003, $util->setMsg(L::lb_phoneMobile, L::Err_2003, L::ErrorLabelFormat_phone)));
    }

    if (!filter_var($r['s_email'], FILTER_VALIDATE_EMAIL) && !$util->isEmpty($r['s_email'])) {
        return $response->getBody()->write($util->resp(2004, $util->setMsg(L::lb_email, L::Err_2004)));
    } else if ($authenService->getValidEmail($db, $r['s_user'], $r['s_email'])) {
        return $response->getBody()->write($util->resp(2005, $util->setMsg(L::lb_email, L::Err_2005)));
    }

    if ($util->isEmptyDDL($r['status'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_status, L::Err_2002)));
    }


    if (!$util->isEmpty($r['s_line'])) {
        if ($util->isErrLineAdd($r['s_line'])) {
            return $response->getBody()->write($util->resp(2006, $util->setMsg(L::lb_lineID, L::Err_2006)));
        }
    }


    $db->conn();
    if ($util->isEmpty($r['keyId'])) {
        if ($service->create($db, $r)) {
            $db->commit();
            return $response->getBody()->write($util->resp(0, L::Success_0));
        } else {
            $db->rollback();
            return $response->getBody()->write($util->resp(2001, L::Err_2001));
        }
    } else {
        if ($service->update($db, $r)) {
            $db->commit();
            return $response->getBody()->write($util->resp(0, L::Success_0));
        } else {
            $db->rollback();
            return $response->getBody()->write($util->resp(2001, L::Err_2001));
        }
    }
    return $response->getBody()->write($util->resp(0, L::Success_0));
});

$app->map(['GET', 'POST'], '/Staff/DeleteAll/{listData}', function($request, $response) use($db, $util) {
    $service = new CommonService();

    $list = explode(",", $request->getAttribute('listData'));
    $db->conn();
    $processStatus = $service->DeleteALL($db, 'tb_staff', 'id', $list);
    if ($processStatus) {
        $db->commit();
        return $response->getBody()->write($util->resp(0, L::Success_0));
    } else {
        $db->rollback();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
});

$app->map(['GET', 'POST'], '/Staff/Delete/{key}', function($request, $response) use($db, $util) {
    $service = new CommonService();
    $db->conn();
    $key = $request->getAttribute('key');


    $processStatus = $service->Delete($db, 'tb_staff', 'id', $key);
    if ($processStatus) {
        $db->commit();
        return $response->getBody()->write($util->resp(0, L::Success_0));
    } else {
        $db->rollback();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
});
