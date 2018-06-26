<?php

@session_start();

class ConfigService {

    function inquiryConfig($db) {
        $strSql = "";
        $strSql .= "SELECT ";
        $strSql .= "  * ";
        $strSql .= "FROM ";
        $strSql .= "  tb_config  ";

        $_data = $db->Search_Data_FormatJson($strSql);
        return $_data;
    }
    

    function update($db, $r) {
        $strSql = "";
        $strSql .= " update tb_config ";
        $strSql .= " set  "
                . " s_address='$r[s_address]'  ";
//                . " s_firstname='$r[s_firstname]' , "
//                . " s_lastname='$r[s_lastname]' , "

         $arr = array(
            array("query" => $strSql)
        );
        return $db->insert_for_upadte($arr);
    }

}
