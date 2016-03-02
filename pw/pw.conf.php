<?php
    // include the user class
    require_once(USER_CLASS);
    require_once(DOCUMENT_CLASS);
	require_once(EXT_DIR . '/smpp/smppclass.php');

    /**#@+
    * PATH Constant
    */

    // defines the template and template path
    define('TEMPLATE_DIR',                 APP_CONTENTS_DIR     . '/' . CURRENT_APP_PREFIX);
    define('REL_TEMPLATE_DIR',             REL_APP_CONTENTS_DIR . '/' . CURRENT_APP_PREFIX);    
     
    /**#@+
    * Template Constant
    */
    define('PW_TEMPLATE',              TEMPLATE_DIR . '/pw.html');
    define('PWR_TEMPLATE',             TEMPLATE_DIR . '/pwr.html');
    define('PW_REPORT_TEMPLATE',       TEMPLATE_DIR . '/pw_report.html');
    define('EXPORT_TEMPLATE',          TEMPLATE_DIR . '/report_export.html');
    define('PW_LOG_TEMPLATE',          TEMPLATE_DIR . '/sms_log.html');
	define('INCIDENT_HISTORY_TEMPLATE', TEMPLATE_DIR . '/incident_history.html');
    define('NSI_URL',                    REL_APP_DIR . '/pw/pw.php');
    define('CM_PW_COPY_TEMPLATE',      TEMPLATE_DIR . '/cm.html');

	//initialization for SMS starts 
    define('SMPP_HOST', "10.184.67.20");
    define('SMPP_PORT', 5566);
    define('SYSTEM_ID', "grinms");
    define('PASSWORD', "sh9876");
    define('SMS_FROM', "GP-SOC");
    //initialization for SMS ends
    define('PW_TBL' , 'pw_tbl');
    define('PWR_TBL', 'pwr_tbl');
    define('SMS_GROUP_TBL' , 'gp_sms_group');
    define('PW_SMS_LOG_TBL', 'pw_sms_log');
    define('PWR_SMS_LOG_TBL', 'pwr_sms_log');
    define('PW_SENT', 'PW sent');
    define('PWR_SENT', 'PWR sent');
?>
