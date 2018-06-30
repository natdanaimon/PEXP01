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

$app->map(['GET', 'POST'], '/Authen/RundbOld', function ($request, $response) use($db, $util) {
    
    $db->conn();
    
    $rows = mysql_num_rows(mysql_query("select * from tb_config"));

if($rows < 1){
	

$sql = "
CREATE TABLE `tb_config` (
  `s_logo` varchar(250) NOT NULL,
  `s_address` text NOT NULL,
  `s_sign` varchar(250) NOT NULL,
  `s_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
mysql_query($sql);
$sql = "INSERT INTO `tb_config` (`s_logo`, `s_address`, `s_sign`, `s_name`) VALUES
('default.jpg', '3/113 หมู่บ้านกลางเมือง URBANION\r\nซอย ศรีนครินทร์ 46/1 แขวงหนองบอน เขตประเวศ กทม 10250', 'default.png', 'รชยา รุ่งพัชรภากุล');
";
mysql_query($sql);
$sql = "
CREATE TABLE `tb_level` (
  `s_level` varchar(10) NOT NULL,
  `s_level_desc_th` varchar(100) NOT NULL,
  `s_level_desc_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
";
mysql_query($sql);
$sql = "
INSERT INTO `tb_level` (`s_level`, `s_level_desc_th`, `s_level_desc_en`) VALUES
('S', 'เจ้าหน้าที่ระดับหัวหน้า', 'Super Admin'),
('N', 'เจ้าหน้าที่', 'Admin')
";
mysql_query($sql);
$sql = "
CREATE TABLE `tb_staff` (
  `id` int(11) NOT NULL,
  `s_username` varchar(50) NOT NULL,
  `s_password` varchar(50) NOT NULL,
  `s_firstname` varchar(100) NOT NULL,
  `s_lastname` varchar(100) NOT NULL,
  `s_phone` varchar(100) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_line` varchar(100) NOT NULL,
  `s_profile` varchar(100) NOT NULL,
  `s_level` varchar(100) NOT NULL,
  `s_status` varchar(100) NOT NULL,
  `s_create_by` varchar(50) NOT NULL,
  `s_update_by` varchar(50) NOT NULL,
  `d_create` datetime NOT NULL,
  `d_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
";
mysql_query($sql);
$sql = "
INSERT INTO `tb_staff` (`id`, `s_username`, `s_password`, `s_firstname`, `s_lastname`, `s_phone`, `s_email`, `s_line`, `s_profile`, `s_level`, `s_status`, `s_create_by`, `s_update_by`, `d_create`, `d_update`) VALUES
(1, 'admin', '1111', 'Johnfsf', 'Smith', '0987654321', 'admin@gmail.com', '', 'admin.png', 'S', 'A', '', '1', '0000-00-00 00:00:00', '2018-05-29 14:49:59'),
(2, 'staff01', '1111', 'staff', '01', '000-000-0000', 'a@gmail.com', '', 'default.png', 'N', 'A', '1', '1', '2018-05-29 13:29:10', '2018-05-29 13:29:10')
";
mysql_query($sql);
$sql = "
CREATE TABLE `tb_status` (
  `s_type` varchar(50) NOT NULL,
  `s_key` varchar(50) NOT NULL,
  `s_value_en` varchar(100) NOT NULL,
  `s_value_th` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
";
mysql_query($sql);
$sql = "
INSERT INTO `tb_status` (`s_type`, `s_key`, `s_value_en`, `s_value_th`) VALUES
('AC', 'A', 'Active', 'ใช้งาน'),
('AC', 'C', 'Cancel', 'ยกเลิก')
";
mysql_query($sql);
$sql = "
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_staff` (`s_username`,`s_status`,`s_level`)
  ";
mysql_query($sql);
$sql = "
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`s_type`,`s_key`)
";
mysql_query($sql);
$sql = "
ALTER TABLE `tb_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT
";
mysql_query($sql);
echo "Create table complete";
  }else{
		echo "Already table";
	}
  
    
});


$app->map(['GET', 'POST'], '/Authen/Rundb', function ($request, $response) use($db, $util) {
    
    $r = $request->getParsedBody();
    $_SESSION['export_namesss'] = "aaaaaaa".$r[s_name];
    if($_FILES["s_product"]["name"]){
			$type = explode('.', $_FILES["s_product"]["name"]);
			$type = strtolower($type[count($type)-1]);
			$url = "../image/pdf/product/";
			$name = 'default.'.$type;
			if(in_array($type, array("jpg", "jpeg", "gif", "png")))
				if(is_uploaded_file($_FILES["s_product"]["tmp_name"]))
					if(move_uploaded_file($_FILES["s_product"]["tmp_name"],$url.$name))
			$s_product =  $name;
			$_SESSION['export_product'] = $s_product;
			$datass['export_product'] = $s_product;
		}
		
if($_FILES["s_slip"]["name"]){
			$type = explode('.', $_FILES["s_slip"]["name"]);
			$type = strtolower($type[count($type)-1]);
			$url = "../image/pdf/slip/";
			$name = 'default.'.$type;
			if(in_array($type, array("jpg", "jpeg", "gif", "png")))
				if(is_uploaded_file($_FILES["s_slip"]["tmp_name"]))
					if(move_uploaded_file($_FILES["s_slip"]["tmp_name"],$url.$name))
			$s_slip =  $name;
			$_SESSION['export_slip'] = $s_slip;
			$datass['export_slip'] = $s_slip;
		}
		
	$_SESSION['export_name'] = $r[s_name];
	$_SESSION['export_phone'] = $r[s_phone];
	$_SESSION['export_type'] = $r[s_type];
	$_SESSION['export_price'] = $r[i_price];
	$_SESSION['export_commission1'] = $r[i_commission1];
	$_SESSION['export_vat1'] = $r[i_vat1];
	$_SESSION['export_finish'] = $r[d_finish];
	
	$datass['export_name'] = $r[s_name];
	$datass['export_phone'] = $r[s_phone];
	$datass['export_type'] = $r[s_type];
	$datass['export_price'] = $r[i_price];
	$datass['export_commission1'] = $r[i_commission1];
	$datass['export_vat1'] = $r[i_vat1];
	$datass['export_finish'] = $r[d_finish];
	
	$datass['s_address'] = $_SESSION['s_address'];
$datass['s_logo'] = $_SESSION['s_logo'];
$datass['s_sign'] = $_SESSION['s_sign'];
$datass['s_name'] = $_SESSION['s_name'];
$datass['export_title_name'] = date('ymdHis').'_'.$r[s_name];

$files = glob('../bill/export/pdf/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
$url = "http://minniesurgery.com/ticket/bill/export/session.php?cre=1";
 $ch = curl_init($url);
 $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
  //$data['agent_ref'] = $order_id;
  curl_setopt( $ch, CURLOPT_ENCODING, "utf-8" );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_USERAGENT, $agent);
  curl_setopt($ch, CURLOPT_POST, true); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, $datass);
  $data = curl_exec($ch);
  curl_close($ch);

return $response->getBody()->write($util->resp(0, $datass['export_title_name'], 1));
  
    //echo $datass['export_title_name'].".pdf";
});



