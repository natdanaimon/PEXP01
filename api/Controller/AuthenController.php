<?php

@session_start();

$app->map(['POST'], '/Authen/Login', function ($request, $response) use($db, $util) {
    $service = new AuthenService();

    $req = $request->getParsedBody();
    //valid form
    $flgUser = $util->isEmptyReg($req['user']);
    if ($flgUser) {//4001
        return $response->getBody()->write($util->resp(4001, L::Err_4001));
    }
    $flgPass = $util->isEmptyReg($req['pass']);
    if ($flgPass && !$flgUser) {//4002
        return $response->getBody()->write($util->resp(4002, L::Err_4002));
    }


    if (!$flgUser && !$flgPass) {
        $_data = $service->login($db, $req);
        if (count($_data) > 0) {
            foreach ($_data as $key => $value) {
                $_SESSION["lang"] = "th";
                $_SESSION["sel_lang_pic"] = "th.png";
                $_SESSION["selected_lan_pic"] = "th.png";
                $_SESSION["u_id"] = $_data[$key]['id'];
                $_SESSION["u_username"] = $_data[$key]['s_username'];
                $_SESSION["u_password"] = $_data[$key]['s_password'];
                $_SESSION["u_email"] = $_data[$key]['s_email'];
                $_SESSION["u_profile"] = $_data[$key]['s_profile'];
                $_SESSION["u_phone"] = $_data[$key]['s_phone'];
                $_SESSION["u_firstname"] = $_data[$key]['s_firstname'];
                $_SESSION["u_lastname"] = $_data[$key]['s_lastname'];
                $_SESSION["u_fullname"] = $_data[$key]['s_firstname'] . " " . $_data[$key]['s_lastname'];
                $_SESSION["u_level"] = $_data[$key]['s_level'];
                $_SESSION["u_line"] = $_data[$key]['s_line'];
            }

            return $response->getBody()->write($util->resp(0, L::Success_0));
        } else {
            return $response->getBody()->write($util->resp(2001, L::Err_2001));
        }
    }
});

$app->map(['GET', 'POST'], '/Authen/UpdateProfile', function ($request, $response) use($db, $util) {
    $service = new AuthenService();
    $db->conn();


    $r = $request->getParsedBody();

    //valid form
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
        return $response->getBody()->write($util->resp(2003, $util->setMsg(L::lb_phoneMobile, L::Err_2003,L::ErrorLabelFormat_phone)));
    }

    if ($util->isEmpty($r['s_email'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_email, L::Err_2002)));
    } else if (!filter_var($r['s_email'], FILTER_VALIDATE_EMAIL) && !$util->isEmpty($r['s_email'])) {
        return $response->getBody()->write($util->resp(2004, $util->setMsg(L::lb_email, L::Err_2004)));
    } else if ($service->getValidEmail($db, $_SESSION['u_username'], $r['s_email'])) {
        return $response->getBody()->write($util->resp(2005, $util->setMsg(L::lb_email, L::Err_2005)));
    }

    if (!$util->isEmpty($r['s_line'])) {
        if ($util->isErrLineAdd($r['s_line'])) {
            return $response->getBody()->write($util->resp(2006, $util->setMsg(L::lb_lineID, L::Err_2006)));
        }
    }


    if ($service->updateProfile($db, $r)) {
        $db->commit();
        $_data = $service->getProfile($db, $_SESSION['u_username']);
        if (count($_data) > 0) {
            foreach ($_data as $key => $value) {
                $_SESSION["u_id"] = $_data[$key]['id'];
                $_SESSION["u_username"] = $_data[$key]['s_username'];
                $_SESSION["u_password"] = $_data[$key]['s_password'];
                $_SESSION["u_email"] = $_data[$key]['s_email'];
                $_SESSION["u_profile"] = $_data[$key]['s_profile'];
                $_SESSION["u_phone"] = $_data[$key]['s_phone'];
                $_SESSION["u_firstname"] = $_data[$key]['s_firstname'];
                $_SESSION["u_lastname"] = $_data[$key]['s_lastname'];
                $_SESSION["u_fullname"] = $_data[$key]['s_firstname'] . " " . $_data[$key]['s_lastname'];
                $_SESSION["u_level"] = $_data[$key]['s_level'];
                $_SESSION["u_line"] = $_data[$key]['s_line'];
            }

            return $response->getBody()->write($util->resp(0, L::Success_0, $_data));
        } else {
            return $response->getBody()->write($util->resp(2001, L::Err_2001));
        }
    } else {
        $db->rollback();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
    ;
});

$app->map(['GET', 'POST'], '/Authen/ChangePassword', function ($request, $response) use($db, $util) {
    $service = new AuthenService();
    $db->conn();


    $r = $request->getParsedBody();


    if ($util->isEmpty($r['s_password_old'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_passwordOld, L::Err_2002)));
    } else if ($r['s_password_old'] != $_SESSION['u_password']) {
        return $response->getBody()->write($util->resp(2004, $util->setMsg(L::lb_passwordOld, L::Err_2004)));
    }

    if ($util->isEmpty($r['s_password_new'])) {
        return $response->getBody()->write($util->resp(2002, $util->setMsg(L::lb_passwordNew, L::Err_2002)));
    }

    if ($r['s_password_new'] != $r['s_password_confirm']) {
        return $response->getBody()->write($util->resp(2004, $util->setMsg(L::lb_passwordNewConfirm, L::Err_2004)));
    } else if ($util->isEmptyReg($r['s_password_new'])) {
        $response->getBody()->write($util->resp(4002, L::Err_4002));
    }

    if ($service->changePassword($db, $r['s_password_new'])) {
        $db->commit();
        $_SESSION["u_password"] = $r['s_password_new'];
        return $response->getBody()->write($util->resp(0, L::Success_0));
    } else {
        $db->rollback();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }
});

$app->map(['GET', 'POST'], '/Authen/UploadProfile/{reqId}', function ($request, $response) use($db, $util) {
    $service = new AuthenService();
    $db->conn();
    $doc = new upload();
    $doc->set_docType(NULL);
    $doc->set_path("../assets/image/profile/");
    $doc->add_FileNameCustom($_FILES["file"], $_SESSION['u_username']);
    $flg = $doc->AddFileCustom();
    if ($flg) {
        $tmp = $doc->get_FilenameCustomResult();
        if ($service->uploadProfile($db, $tmp[0])) {
            if ($doc->deleteFile()) {
                $db->commit();
                $_SESSION['u_profile'] = $tmp[0];
                return $response->getBody()->write($util->resp(0, L::Success_0, $tmp[0]));
            } else {
                $db->rollback();
                $doc->clearFileAddFail();
                return $response->getBody()->write($util->resp(2001, L::Err_2001));
            }
        } else {
            $doc->clearFileAddFail();
            return $response->getBody()->write($util->resp(2001, L::Err_2001));
        }
    } else {
        $doc->clearFileAddFail();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
//        return $response->getBody()->write($util->resp(2001, L::Err_ . $doc->get_errorMessage()));
    }
});

$app->map(['GET', 'POST'], '/Authen/Logout', function ($request, $response) {
    session_start();
    session_destroy();
    return $response->withStatus(200)->withHeader('Location', $_SESSION['CONTEXT']);
});



