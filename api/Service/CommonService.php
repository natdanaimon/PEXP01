<?php

@session_start();

class CommonService {

    function DropdownLevel($db) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= " s_level s_key, s_level_desc_$_SESSION[lang] s_value ";
        $strSql .= "FROM ";
        $strSql .= "  tb_level  ";
        if ($_SESSION[u_level] == 'N') {
            $strSql .= " WHERE s_level ='N' ";
        }
        $_data = $db->Search_Data_FormatJson($strSql);
        $db->close_conn();
        $dropDown = array();
        foreach ($_data as $key => $value) {
            $tmp = array(
                'key' => $_data[$key]['s_key'],
                'value' => $_data[$key]['s_value']
            );
            array_push($dropDown, $tmp);
        }
        return $dropDown;
    }

    function DropdownStatusAC($db) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  s_key, s_value_$_SESSION[lang] s_value ";
        $strSql .= "FROM ";
        $strSql .= "  tb_status  ";
        $strSql .= "WHERE  s_type = 'AC'  ";
        $_data = $db->Search_Data_FormatJson($strSql);
        $db->close_conn();

        $dropDown = array();
        foreach ($_data as $key => $value) {
            $tmp = array(
                'key' => $_data[$key]['s_key'],
                'value' => $_data[$key]['s_value']
            );
            array_push($dropDown, $tmp);
        }
        return $dropDown;
    }

    function DeleteALL($db, $table, $field, $listID) {
        $arr = array();
        for ($i = 0; $i < count($listID); $i++) {
            $strSql = "";
            $strSql .= "update $table ";
            $strSql .= "set  ";
            $strSql .= "s_status = 'C' ";
            $strSql .= "where $field = '$listID[$i]' ";
            array_push($arr, array("query" => $strSql));
        }
        $reslut = $db->insert_for_upadte($arr);
        return $reslut;
    }

    function Delete($db, $table, $field, $key) {
        $arr = array();
        $strSql = "";
        $strSql .= "update $table ";
        $strSql .= "set  ";
        $strSql .= "s_status = 'C' ";
        $strSql .= "where $field = '$key' ";
        array_push($arr, array("query" => $strSql));

        $reslut = $db->insert_for_upadte($arr);
        return $reslut;
    }

    function getValidEmail($db, $user, $email) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  count(*) cnt ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= "WHERE ";
        $strSql .= " s_email ='$email' ";
        $strSql .= "AND s_username <> '$user' ";
        $_data = $db->Search_Data_FormatJson($strSql);
        return ($_data[0]['cnt'] == 0 ? FALSE : TRUE);
        
    }

    function getValidUser($db,$user,$keyId) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  count(*) cnt ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= "WHERE ";
        $strSql .= " s_username ='$user' ";
        if($keyId!=NULL || $keyId!=""){
            $strSql .= "AND id <> $keyId ";
        }
        
        $_data = $db->Search_Data_FormatJson($strSql);
        return ($_data[0]['cnt'] == 0 ? FALSE : TRUE);
    }

}
