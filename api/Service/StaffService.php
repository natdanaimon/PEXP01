<?php

@session_start();

class StaffService {

    function inquiryStaff($db) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  id , s_username , CONCAT (s_firstname,' ' ,s_lastname) s_firstname ,s_email, s_phone , s_status , s_level ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= " WHERE 1=1 ";
        $strSql .= " AND s_username <> '$_SESSION[u_username]' ";
        if($_SESSION[u_level]=='N'){
             $strSql .= " AND s_level ='N' ";
        }
        $strSql .= "Order by s_level desc , s_firstname asc ";
        $_data = $db->Search_Data_FormatJson($strSql);
        return $_data;
    }
    
    function inquiryStaffbyID($db,$keyId){
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  * ";
        $strSql .= "FROM ";
        $strSql .= "  tb_staff  ";
        $strSql .= " where id = $keyId ";
        $_data = $db->Search_Data_FormatJson($strSql);
        return $_data;
        
    }

    function create($db, $r) {
        $strSql = "";
        $strSql .= "insert into  tb_staff ";
        $strSql .= " ( "
                . " s_username, "
                . " s_password, "
                . " s_firstname, "
                . " s_lastname, "
                . " s_phone, "
                . " s_email, "
                . " s_line, "
                . " s_profile, "
                . " s_level, "
                . " s_status, "
                . " s_create_by, "
                . " s_update_by, "
                . " d_create, "
                . " d_update "
                . " ) ";
        $strSql .= " values ";
        $strSql .= " ( "
                . " '$r[s_user]' , "
                . " '$r[s_pass]' , "
                . " '$r[s_firstname]' , "
                . " '$r[s_lastname]' , "
                . " '$r[s_phone]' , "
                . " '$r[s_email]' , "
                . " '$r[s_line]' , "
                . " 'default.png' , "
                . " '$r[level]' , "
                . " '$r[status]' , "
                . " '$_SESSION[u_username]' , "
                . " '$_SESSION[u_username]' , "
                . " now() ,"
                . " now() "
                . " ) ";
         $arr = array(
            array("query" => $strSql)
        );
        return $db->insert_for_upadte($arr);
    }

    function update($db, $r) {
        $strSql = "";
        $strSql .= " update tb_staff ";
        $strSql .= " set  "
                . " s_password='$r[s_pass]' , "
                . " s_firstname='$r[s_firstname]' , "
                . " s_lastname='$r[s_lastname]' , "
                . " s_phone='$r[s_phone]' , "
                . " s_email='$r[s_email]' , "
                . " s_line='$r[s_line]' , "
                . " s_level='$r[level]' , "
                . " s_status='$r[status]' , "
                . " s_update_by='$_SESSION[u_username]' , "
                . " d_update=now() "
                . " where id = $r[keyId] ";
         $arr = array(
            array("query" => $strSql)
        );
        return $db->insert_for_upadte($arr);
    }

}
