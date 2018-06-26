<?php

@session_start();

class AuthenService {

    function login($db, $r) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  * ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= "WHERE ";
        $strSql .= " s_username ='$r[user]' ";
        $strSql .= " AND s_password ='$r[pass]' ";
        $_data = $db->Search_Data_FormatJson($strSql);
        $db->close_conn();
        return $_data;
    }

    function getProfile($db, $user) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  * ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= "WHERE ";
        $strSql .= " s_username ='$user' ";
        $_data = $db->Search_Data_FormatJson($strSql);
        return $_data;
    }

    function updateProfile($db, $r) {

        $strSql = "";
        $strSql .= "update tb_staff ";
        $strSql .= "set  ";
        $strSql .= "s_firstname = '$r[s_firstname]', ";
        $strSql .= "s_lastname = '$r[s_lastname]', ";
        $strSql .= "s_phone = '$r[s_phone]', ";
        $strSql .= "s_line = '$r[s_line]', ";
        $strSql .= "s_email = '$r[s_email]' ";
        $strSql .= "where s_username = '$_SESSION[u_username]' ";
        $arr = array(
            array("query" => "$strSql")
        );
        $reslut = $db->insert_for_upadte($arr);
        return $reslut;
    }

    function getValidEmail($db, $user,$email) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  count(*) cnt ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= "WHERE ";
        $strSql .= " s_email ='$email' ";
        $strSql .= "AND s_username <> '$user' ";
        $_data = $db->Search_Data_FormatJson($strSql);
        return ($_data[0]['cnt'] == 0 ? FALSE : TRUE);;
    }

    function changePassword($db, $passNew) {
        $strSql = "";
        $strSql .= "update tb_staff ";
        $strSql .= "set  ";
        $strSql .= "s_password = '$passNew' ";
        $strSql .= "where s_username = '$_SESSION[u_username]' ";
        $arr = array(
            array("query" => "$strSql")
        );
        $reslut = $db->insert_for_upadte($arr);
        return $reslut;
    }

    function uploadProfile($db, $imageNew) {
        $strSql = "";
        $strSql .= "update tb_staff ";
        $strSql .= "set  ";
        $strSql .= "s_profile = '$imageNew' ";
        $strSql .= "where s_username = '$_SESSION[u_username]' ";
        $arr = array(
            array("query" => "$strSql")
        );
        $reslut = $db->insert_for_upadte($arr);
        return $reslut;
    }

}
