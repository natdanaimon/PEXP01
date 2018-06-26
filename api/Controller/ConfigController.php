<?php

@session_start();

$app->map(['GET', 'POST'], '/Config/InquiryConfig', function ($request, $response) use($db, $util) {
    $service = new ConfigService();

    $_data = $service->inquiryConfig($db);
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
    
    if($_FILES["image-upload"]){
			
		}
		if($_FILES["s_logo"]["name"]){
			$type = explode('.', $_FILES["s_logo"]["name"]);
			$type = strtolower($type[count($type)-1]);
			$url = "../image/logo/";
			$name = 'default.'.$type;
			if(in_array($type, array("jpg", "jpeg", "gif", "png")))
				if(is_uploaded_file($_FILES["s_logo"]["tmp_name"]))
					if(move_uploaded_file($_FILES["s_logo"]["tmp_name"],$url.$name))
			
			$r['s_logo'] =  $name;
		}
		if($_FILES["s_sign"]["name"]){
			$type = explode('.', $_FILES["s_sign"]["name"]);
			$type = strtolower($type[count($type)-1]);
			$url = "../image/sign/";
			$name = 'default.'.$type;
			if(in_array($type, array("jpg", "jpeg", "gif", "png")))
				if(is_uploaded_file($_FILES["s_sign"]["tmp_name"]))
					if(move_uploaded_file($_FILES["s_sign"]["tmp_name"],$url.$name))
			
			$r['s_sign'] =  $name;
		}
    
    

    if ($service->update($db, $r)) {
        $db->commit();
        return $response->getBody()->write($util->resp(0, L::Success_0));
    } else {
        $db->rollback();
        return $response->getBody()->write($util->resp(2001, L::Err_2001));
    }

    return $response->getBody()->write($util->resp(0, L::Success_0));
});



