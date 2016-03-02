<?php
class nsiApp extends DefaultApplication
{
   /**
   * Constructor
   * @return true
   */
   function run()
   {	  
   	  $cmd = getUserField('cmd');
      //echo $cmd; print_r($_REQUEST);exit;
      switch ($cmd)
      { 
      	case 'load_search_list': $screen = $this->loadSearchList();   break;
      	case 'filter_list'     : $screen = $this->filterList();       break;
		case 'search_pw'       : $screen = $this->searchPWHistory();  break;
		case 'search_pwr'      : $screen = $this->searchPWRHistory(); break;
		case 'write_pw'        : $screen = $this->showPwPage();       break;
		case 'pw_notice'       : $screen = $this->showPwNoticePage(); break;
		case 'modify_pw'       : $screen = $this->showModifyPwPage(); break;
		case 'delete_pw'       : $screen = $this->deletePW();         break;
		case 'pw_save'         : $screen = $this->savePw();           break;
		case 'pwr_save'        : $screen = $this->savePwr();          break;
		case 'notice_save'     : $screen = $this->saveNotice();       break;
		case 'pwr'             : $screen = $this->showPwResultPage(); break;
		case 'modify_pwr'      : $screen = $this->showModifyPwrPage();break;
		case 'send_pwr_sms'    : $screen = $this->sendPWRSMS();       break;
		case 'send_pw_sms'     : $screen = $this->sendPWSMS();        break;
		case 'pw_report'       : $screen = $this->showPwReportPage(); break;
		case 'log'             : $screen = $this->showSMSLogPage();   break;
		case 'export'          : $screen = $this->exportToExcel();    break;
		case 'send2pwr'        :  $screen = $this->send2PWR();        break;
		case 'pw_copy'         : $screen = $this->copyPW4Emailing();  break;
        default                : $screen = $this->showPwPage();
      }
      
      if($cmd != 'load_search_list' && $cmd != 'filter_list')
        echo $this->displayScreen($screen);      
        
      return true;
   }

   function showPwPage()
   {
      $data['pw_originator_group_list']  = getGroupNameList();
      $data['pw_executor_group_list']    = $data['pw_originator_group_list'];
   	  $data['outage_list']               = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
   	  $data['pw_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
   	  $data['pw_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');
      $data['pw_execution_date']         = date('Y-m-d');
      $data['cmd']                       = 'pw_save';
      $data['search_list']               = getSearchList('group');

   	  $data['pw_notice_type']           = '';
   	  $data['pw_severity']              = '';
   	  $data['pw_originator_group']      = '';
      $data['pw_list']                  = getPWList(date('Y-m-d'));

      return createPage(PW_TEMPLATE, $data);
   }
   
   function showPwResultPage()
   {
      $data['pwr_list']         = getPWRList(date('Y-m-d'));
      $data['pwr_status_list']  = array('Done'=>'Done','Cancelled'=>'Cancelled','Postponded'=>'Postponded', 'On Going' =>'On Going', 'Partially Done' => 'Partially Done', 'Fallen Back' =>  'Fallen Back');
   	  $data['outage_list']      = array('No'=>'No','Yes'=>'Yes','NA'=>'NA');

      $data['pwr_originator_group_list']  = getGroupNameList();
      $data['pwr_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
      $data['pwr_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');

      return createPage(PWR_TEMPLATE, $data);
   }
   
   function showModifyPwPage()
   {
   	  $pw_id = getUserField('pw_id');

      $data = getPWDetails($pw_id);

      $data['pw_originator_group_list']  = getGroupNameList();
      $data['pw_executor_group_list']    = $data['pw_originator_group_list'];
      $data['pwr_status_list']           = array('Done'=>'Done','Cancelled'=>'Cancelled','Postponded'=>'Postponded', 'On Going' =>'On Going', 'Partially Done' => 'Partially Done', 'Fallen Back' =>  'Fallen Back');
   	  $data['outage_list']               = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
   	  $data['pw_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
   	  $data['pw_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');
   	  
      $data['cmd']              = 'pw_save';

      $data['pw_list']     = getPWList(date('Y-m-d'));
      
      return createPage(PW_TEMPLATE, $data);
   }
   
   function showModifyPwrPage()
   {
   	  $pw_id = getUserField('pw_id');

      $data = getPWRDetails($pw_id);

      $data['pwr_status_list']  = array('Done'=>'Done','Cancelled'=>'Cancelled','Postponded'=>'Postponded', 'On Going' =>'On Going', 'Partially Done' => 'Partially Done', 'Fallen Back' =>  'Fallen Back');
   	  $data['outage_list']      = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
      $data['cmd']              = 'pwr_save';

      $data['pwr_list']          = getPWRList(date('Y-m-d'));
      return createPage(PWR_TEMPLATE, $data);
   }
   
   function savePw()
   {
          $pw_id                            = getUserField('pw_id');
          $data['pw_execution_date']        = getUserField('pw_execution_date');
          $data['outage_flag']              = getUserField('outage_flag');
          $data['pw_name']                  = getUserField('pw_name');
          $data['pw_impact']                = getUserField('pw_impact');
          $data['pw_st']                    = getUserField('pw_st');
     	  $data['pw_et']                    = getUserField('pw_et');
     	  $data['pw_sms1']                  = getUserField('pw_sms1');
     	  $data['pw_sms2']                  = getUserField('pw_sms2');
     	  $data['pw_sms3']                  = getUserField('pw_sms3');
     	  $data['pw_sms4']                  = getUserField('pw_sms4');
     	  $data['pw_sms5']                  = getUserField('pw_sms5');
     	  $data['pw_smsto']                 = implode(';', getUserField('recipient_list'));
     	  $data['pw_notice_type']           = getUserField('pw_notice_type');
     	  $data['pw_severity']              = getUserField('pw_severity');
     	  $data['pw_originator_group']      = getUserField('pw_originator_group');
     	  $data['pw_executor_group']        = getUserField('pw_executor_group');

          $info['table']  = PW_TBL;
          $info['debug']  = false;
          $info['data']   = $data;
          
          if($pw_id !='')
          {
             $info['where']   = "pw_id=$pw_id";
             $ret             = update($info);
          }
          else
          {
        	 $data['sent_time']                = '';
        	 $data['flag']                     = '';
             $data['pw_id']                    = "''";
             $ret                              = insert($info);
          }

          return $this->showPwPage();
   }
   
   function savePwr()
   {
          $pw_id                             = getUserField('pw_id');
          $data['pwr_status']                = getUserField('pwr_status');
          $data['outage_flag']               = getUserField('outage_flag');
          $data['pwr_impact']                = getUserField('pwr_impact');
     	  $data['pwr_sms1']                  = getUserField('pwr_sms1');
     	  $data['pwr_sms2']                  = getUserField('pwr_sms2');
     	  $data['pwr_sms3']                  = getUserField('pwr_sms3');
     	  $data['pwr_sms4']                  = getUserField('pwr_sms4');
     	  $data['pwr_sms5']                  = getUserField('pwr_sms5');
     	  $data['pwr_smsto']                 = implode(';', getUserField('recipient_list'));

          $info['table']  = PWR_TBL;
          $info['debug']  = false;
          $info['data']   = $data;

          if($pw_id !='')
          {
             $info['where']   = "pw_id=$pw_id";
             $ret             = update($info);
          }

          return $this->showPwResultPage();
   }
   
   function deletePW()
   {
          $pw_id          = getUserField('pw_id');

          $info['table']  = PW_TBL;
          $info['debug']  = false;
          $info['where']  = "pw_id=$pw_id";

          $ret             = delete($info);
          
          return $this->showPwPage();
   }

   function searchPWHistory()
   {
     $dateFrom              = getUserField('date_from') ? getUserField('date_from') : date("Y-m-d");
	 $dateTo                = getUserField('date_to')   ? getUserField('date_to')   : date("Y-m-d");
	 $searchMessageType     = getUserField('search_message_type');
	 $searchGroupName       = getUserField('search_group_name');
	 $searchFaultSeverity   = getUserField('search_fault_severity');
	 $searchOutage          = getUserField('search_outage');
	 
	 //set searching criteria
	 $whereClouse = "pw_execution_date between '$dateFrom' and '" . $dateTo . "'";
	 
	 if($searchMessageType)
	   $whereClouse .= " and pw_notice_type='$searchMessageType'";
	 if($searchGroupName)
	   $whereClouse .= " and pw_originator_group='$searchGroupName'";
	 if($searchFaultSeverity)
	   $whereClouse .= " and pw_severity='$searchFaultSeverity'";
	 if($searchOutage)
	   $whereClouse .= " and outage_flag='$searchOutage'";
	   
	 $info['table']  = PW_TBL;
   	 $info['debug']  = false;
   	 $info['where']  = $whereClouse . " order by pw_id asc";
	 
	 $result = select($info);

     if(count($result))
            foreach($result as $key => $object)
            {
              $pwList[$object->pw_id]->pw_sms1     = nl2br($object->pw_sms1);
              $pwList[$object->pw_id]->pw_sms2     = nl2br($object->pw_sms2);
              $pwList[$object->pw_id]->pw_sms3     = nl2br($object->pw_sms3);
              $pwList[$object->pw_id]->pw_sms4     = nl2br($object->pw_sms4);
              $pwList[$object->pw_id]->pw_sms5     = nl2br($object->pw_sms5);
              $pwList[$object->pw_id]->pw_smsto    = formatSMStoFORview($object->pw_smsto);
              $pwList[$object->pw_id]->flag        = $object->flag;
            }
            
     $data['pw_list']               = $pwList;
	 $data['date_from']             = $dateFrom;
	 $data['date_to']               = $dateTo;
	 $data['search_message_type']   = $searchMessageType;
	 $data['search_group_name']     = $searchGroupName;
	 $data['search_fault_severity'] = $searchFaultSeverity;
	 $data['search_outage']         = $searchOutage;

     $data['pw_originator_group_list']  = getGroupNameList();
     $data['pw_executor_group_list']    = $data['pw_originator_group_list'];
     $data['outage_list']               = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
   	 $data['pw_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
   	 $data['pw_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');

     return createPage(PW_TEMPLATE, $data);
   }
   
   function searchPWRHistory()
   {
     $dateFrom              = getUserField('date_from') ? getUserField('date_from') : date("Y-m-d");
	 $dateTo                = getUserField('date_to')   ? getUserField('date_to')   : date("Y-m-d");
	 $searchMessageType     = getUserField('search_message_type');
	 $searchGroupName       = getUserField('search_group_name');
	 $searchFaultSeverity   = getUserField('search_fault_severity');
	 $searchOutage          = getUserField('search_outage');

	 //set searching criteria
	 $whereClouse = "pw_execution_date between '$dateFrom' and '" . $dateTo . "'";

	 if($searchMessageType)
	   $whereClouse .= " and pwr_notice_type='$searchMessageType'";
	 if($searchGroupName)
	   $whereClouse .= " and pwr_originator_group='$searchGroupName'";
	 if($searchFaultSeverity)
	   $whereClouse .= " and pwr_severity='$searchFaultSeverity'";
	 if($searchOutage)
	   $whereClouse .= " and outage_flag='$searchOutage'";

	 $info['table']  = PWR_TBL;
   	 $info['debug']  = false;
   	 $info['where']  = $whereClouse . " order by pw_id asc";
   	 
	 $result = select($info);

     if(count($result))
            foreach($result as $key => $object)
            {
              $pwrList[$object->pw_id]->pwr_sms1     = nl2br($object->pwr_sms1);
              $pwrList[$object->pw_id]->pwr_sms2     = nl2br($object->pwr_sms2);
              $pwrList[$object->pw_id]->pwr_sms3     = nl2br($object->pwr_sms3);
              $pwrList[$object->pw_id]->pwr_sms4     = nl2br($object->pwr_sms4);
              $pwrList[$object->pw_id]->pwr_sms5     = nl2br($object->pwr_sms5);
              $pwrList[$object->pw_id]->pwr_smsto    = formatSMStoFORview($object->pwr_smsto);
              $pwrList[$object->pw_id]->flag         = $object->flag;
            }

     $data['pwr_list']              = $pwrList;
	 $data['date_from']             = $dateFrom;
	 $data['date_to']               = $dateTo;
	 $data['search_message_type']   = $searchMessageType;
	 $data['search_group_name']     = $searchGroupName;
	 $data['search_fault_severity'] = $searchFaultSeverity;
	 $data['search_outage']         = $searchOutage;

     $data['pwr_originator_group_list']  = getGroupNameList();
     $data['pw_executor_group_list']     = $data['pw_originator_group_list'];
     $data['outage_list']                = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
   	 $data['pwr_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
   	 $data['pwr_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');
     $data['pwr_status_list']            = array('Done'=>'Done','Cancelled'=>'Cancelled','Postponded'=>'Postponded');

     return createPage(PWR_TEMPLATE, $data);
   }
   
   function loadSearchList()
   {
   	 $type       = getUserField('type');   	 
   	 $dataString = implode(getSearchList($type), '*$#@');
   	
   	 echo $dataString; 
   }

   function sendPWSMS()
   {
     $username   = getFromSession('username');

   	 $pw_id      = getUserField('pw_id');
   	 $data       = getPWsmsData($pw_id);

	 //send SMS
     $sentRecipients = array();
	 $smpp = new SMPPClass();
     $smpp->SetSender(SMS_FROM);

     $recipients = getAllRecipients($data['to']);
     $to         = implode(";" , $data['to']);

     if(count($recipients)) //array
     {
    	 if(count($data['sms']))
    	 {
    	 foreach($data['sms'] as $key => $sms)
    	 {
             $sms = preg_replace('/’/',"\'",$sms);
             $chr = chr(hexdec('0x11'));
             $sms = str_replace("_",$chr,$sms);
	    	 $smpp->Start(SMPP_HOST, SMPP_PORT, SYSTEM_ID, PASSWORD, "");
             foreach($recipients as $key => $mobileno)
             {
                  $smpp->Send("$mobileno", stripslashes($sms), false);
 		     }
 		     
             logPWSMS("''",$pw_id,$sms,$to,date('Y-m-d H:i:s'),$username, $data);
   		     sleep(2);
    	 }
         copyThisPW2PWRtbl($pw_id);
         updateSMSflag(PW_TBL,$pw_id);
        }
        else echo "No Data found to send!";
     }
     else echo "No Data found to send!";
     $smpp->End();

   	 echo "$pw_id";
   	 exit;
   }

   function sendPWRSMS()
   {
     $username   = getFromSession('username');

   	 $pw_id      = getUserField('pw_id');
   	 $data       = getPWRsmsData($pw_id);

	 //send SMS
	 $sentRecipients = array();
	 $smpp = new SMPPClass();
     $smpp->SetSender(SMS_FROM);

     $recipients = getAllRecipients($data['to']);
     $to         = implode(";" , $data['to']);

     if(count($recipients)) //array
     {
    	 if(count($data['sms']))
    	 {
    	 foreach($data['sms'] as $key => $sms)
    	 {
             $sms = preg_replace('/’/',"\'",$sms);
             $chr = chr(hexdec('0x11'));
             $sms = str_replace("_",$chr,$sms);
	    	 $smpp->Start(SMPP_HOST, SMPP_PORT, SYSTEM_ID, PASSWORD, "");
             foreach($recipients as $key => $mobileno)
             {
   		         $smpp->Send("$mobileno", stripslashes($sms), false);
   		     }
             logPWRSMS("''",$pw_id,$sms,$to,date('Y-m-d H:i:s'),$username, $data);
   		     sleep(2);
         }
         updateSMSflag(PWR_TBL,$pw_id);
    	 }
         else echo "No Data found to send!";
     }
     else echo "No Data found to send!";
     $smpp->End();

   	 echo "$pw_id";
   	 exit;
   }
   
   function filterList()
   { 
   	 $type       = getUserField('type');
   	 $cond       = getUserField('cond');
   	 $dataString = implode(getSearchList($type, $cond), '*$#@');
   	
   	 echo $dataString;   	 
   }
   
   function showPwReportPage()
   {
     $dateFrom              = getUserField('date_from') ? getUserField('date_from') : date("Y-m-d");
	 $dateTo                = getUserField('date_to')   ? getUserField('date_to')   : date("Y-m-d");
	 $searchMessageType     = getUserField('search_message_type');
	 $searchGroupName       = getUserField('search_group_name');
	 $searchFaultSeverity   = getUserField('search_fault_severity');
	 $searchOutage          = getUserField('search_outage');

	 //set searching criteria
	 $whereClouse = "pw_execution_date between '$dateFrom' and '" . $dateTo . "' and pwr_notice_type='General PW' and flag='Sent'";

	 if($searchMessageType)
	   $whereClouse .= " and pwr_notice_type='$searchMessageType'";
	 if($searchGroupName)
	   $whereClouse .= " and pwr_originator_group='$searchGroupName'";
	 if($searchFaultSeverity)
	   $whereClouse .= " and pwr_severity='$searchFaultSeverity'";
	 if($searchOutage)
	   $whereClouse .= " and outage_flag='$searchOutage'";

     $data['report_data_list']      = getReportData($whereClouse);
     
	 $data['date_from']             = $dateFrom;
	 $data['date_to']               = $dateTo;
	 $data['search_message_type']   = $searchMessageType;
	 $data['search_group_name']     = $searchGroupName;
	 $data['search_fault_severity'] = $searchFaultSeverity;
	 $data['search_outage']         = $searchOutage;

     $data['pwr_originator_group_list']  = getGroupNameList();
     $data['outage_list']                = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
   	 $data['pwr_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
   	 $data['pwr_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');
     $data['pwr_status_list']            = array('Done'=>'Done','Cancelled'=>'Cancelled','Postponded'=>'Postponded');

     return createPage(PW_REPORT_TEMPLATE, $data);
   }
   
   function showSMSLogPage()
   {
   
     $dateFrom              = getUserField('date_from') ? getUserField('date_from') : date("Y-m-d");
	 $dateTo                = getUserField('date_to')   ? getUserField('date_to')   : date("Y-m-d");
	 $searchMessageType     = getUserField('search_message_type');
	 $searchGroupName       = getUserField('search_group_name');
	 $searchFaultSeverity   = getUserField('search_fault_severity');
	 $searchOutage          = getUserField('search_outage');

	 //set searching criteria
	 $whereClouse = "pw_execution_date between '$dateFrom' and '" . increaseDate($dateTo) . "'";

	 if($searchMessageType)
	   $whereClouse .= " and pwr_notice_type='$searchMessageType'";
	 if($searchGroupName)
	   $whereClouse .= " and pwr_originator_group='$searchGroupName'";
	 if($searchFaultSeverity)
	   $whereClouse .= " and pwr_severity='$searchFaultSeverity'";
	 if($searchOutage)
	   $whereClouse .= " and outage_flag='$searchOutage'";
	   
     $data['report_data_list']      = getSMSLogData($whereClouse);

	 $data['date_from']             = $dateFrom;
	 $data['date_to']               = $dateTo;
	 $data['search_message_type']   = $searchMessageType;
	 $data['search_group_name']     = $searchGroupName;
	 $data['search_fault_severity'] = $searchFaultSeverity;
	 $data['search_outage']         = $searchOutage;

     $data['pwr_originator_group_list']  = getGroupNameList();
     $data['outage_list']                = array('No'=>'No', 'Yes'=>'Yes','NA'=>'NA');
   	 $data['pwr_severity_list']          = array('Minor'=>'Minor','Major'=>'Major','Critical'=>'Critical','NA'=>'NA');
   	 $data['pwr_notice_type_list']       = array('General PW'=>'General PW','Mgmt PW'=>'Mgmt PW','PW Notice'=>'PW Notice','Emergency PW'=>'Emergency PW');
     $data['pwr_status_list']            = array('Done'=>'Done','Cancelled'=>'Cancelled','Postponded'=>'Postponded');

     return createPage(PW_LOG_TEMPLATE, $data);
   }
   
   function exportToExcel()
   {
     $where = getFromSession('s');

     $data['report_data_list']      = getReportData($where);

     foreach($data['report_data_list'] as $key => $obj)
     {
         $data['report_data_list'][$key]->a_text = strip_tags($data['report_data_list'][$key]->a_text);
         $data['report_data_list'][$key]->b_text = strip_tags($data['report_data_list'][$key]->b_text);
     }

     $filename = "CM_Report.xls";
     $file     = $_SERVER['DOCUMENT_ROOT'] . "/nm_tx/pw/report/$filename";
     $type     = filetype($file);
     
     error_reporting(0);
     
     header("Content-Type: file");
     header("Content-Disposition: attachment;filename=$filename");
     header("Content-Transfer-Encoding: binary");
     header('Pragma: no-cache');
     header('Expires: 0');
     set_time_limit(0);

     echo createPage(EXPORT_TEMPLATE , $data); exit;
    }

   function copyPW4Emailing()
   {
     $pwt  = $_REQUEST['type'];
     $pws  = ($pwt=='pw')  ? 'checked' : '';
     $pwrs = ($pwt=='pwr') ? 'checked' : '';

     $pwd  = $_REQUEST['pw_execution_date'];
     $is   = ($_REQUEST['include']=='on') ? 'checked' : '';

     if($pwd=='') $pwd=date('Y-m-d');

     $lnk = 1;

     if($lnk)
     {
        $sql = "select pw_id," . $pwt."_sms1," . $pwt."_sms2," . $pwt."_sms3," . $pwt."_sms4," . $pwt."_sms5" . ',' . $pwt . '_smsto';
        $sql = $sql . " from $pwt" . "_tbl where pw_execution_date='$pwd'";

        $result = mysql_query($sql);

        if(count($result))
        while($row = mysql_fetch_object($result))
        {
              $sms1 = ($pwt=='pw') ? $row->pw_sms1 : $row->pwr_sms1;
              $sms2 = ($pwt=='pw') ? $row->pw_sms2 : $row->pwr_sms2;
              $sms3 = ($pwt=='pw') ? $row->pw_sms3 : $row->pwr_sms3;
              $sms4 = ($pwt=='pw') ? $row->pw_sms4 : $row->pwr_sms4;
              $sms5 = ($pwt=='pw') ? $row->pw_sms5 : $row->pwr_sms5;
              $smsto= ($pwt=='pw') ? $row->pw_smsto: $row->pwr_smsto;

              $contents = $contents . "\n" . $sms1;

              if($sms2!='') $contents = $contents . "\n" . $sms2;
              if($sms3!='') $contents = $contents . "\n" . $sms3;
              if($sms4!='') $contents = $contents . "\n" . $sms4;
              if($sms5!='') $contents = $contents . "\n" . $sms5;

              if($is=='checked') $contents = $contents . "\nSMS To: " . $smsto;

              $contents = $contents . "\n\n";
       }
     }

     $data['data']  = $contents;
     $data['pws']   = $pws;
     $data['pwrs']  = $pwrs;
     $data['pwd']   = $pwd;
     $data['is']    = $is;

     return createPage(CM_PW_COPY_TEMPLATE, $data);
   }
}
