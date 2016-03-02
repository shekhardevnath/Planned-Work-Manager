<?php
  function getSearchList($type=null, $cond=null)
  {
  	$list = array();
  	
  	if($type)
  	{
  		if($type == "employee")
  		{
  			$info['table']  = GP_EMPLOYEE_DB;
  			$info['fields'] = array("concat(emp_name,'||',right(phone_no,11)) as name");
  			$info['debug']  = false;
  			$info['where']  = $cond ? "emp_name like '%$cond%' or phone_no like '%$cond%' order by emp_name limit 0, 100" : "1 order by emp_name limit 0, 100";
  			
  			$result = select($info);
  		}
  		else if($type == "group")
  		{
  			$info['table']  = GP_SMS_GROUP;
  			$info['fields'] = array('distinct(group_name) as name');
  			$info['debug']  = false;
  			$info['where']  = $cond ? "group_name like '%$cond%' order by group_name limit 0, 100" : "1 order by group_name";
  			
  			$result = select($info);
  		}
  	}
  	
  	if($result)
   	 {   	 
   	   foreach($result as $row)
   	   {
   	   	 $list[] = $row->name;   	 	 
       }
     }
     
  	return $list;
  }
  
  function increaseDate($date)
  {

  	$dateParts   = explode('-', $date);  		
  	return date("Y-m-d", mktime(0, 0, 0, $dateParts[1], $dateParts[2]+1, $dateParts[0]));
  }
  
  function getPWList($date)
   {
        $data['pw_execution_date']      = getUserField('pw_execution_date');
        $data['where']                  = "pw_execution_date='$date'";
        $data['table']                  = PW_TBL;
        $data['debug']                  = false;

        $result         = select($data);

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

       return $pwList;
   }
   
   function getPWRList($date)
   {
        $data['pw_execution_date']      = $date;
        $data['where']                  = "pw_execution_date='$date'";
        $data['table']                  = PWR_TBL;
        $data['debug']                  = false;

        $result         = select($data);

        /*
        if(!count($result))  //if PW were not ported to pwr table
           copyPW2PWRtbl($date);
        else
           updatePW2PWRtbl($date , $result);

        $result         = select($data);
        */
        
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

        return $pwrList;
   }
   
   function copyPW2PWRtbl($date)
   {
            $data['table']  = PW_TBL;
            $data['where']  = "pw_execution_date='$date'";
            $result         = select($data);
            if(count($result))
            {
                $info['table']  = PWR_TBL;
                $info['debug']  = false;
                foreach($result as $key => $object)
                {
                   $data['pw_id']                     = $object->pw_id;
                   $data['pw_execution_date']         = $object->pw_execution_date;
                   $data['outage_flag']               = $object->outage_flag;
                   $data['pwr_name']                  = $object->pw_name;
                   $data['pwr_impact']                = $object->pw_impact;
                   $data['pwr_st']                    = $object->pw_st;
     	           $data['pwr_et']                    = $object->pw_et;
     	           $data['pwr_status']                = '';
     	           $data['pwr_sms1']                  = $object->pw_sms1;
     	           $data['pwr_sms2']                  = $object->pw_sms2;
     	           $data['pwr_sms3']                  = $object->pw_sms3;
     	           $data['pwr_sms4']                  = $object->pw_sms4;
     	           $data['pwr_sms5']                  = $object->pw_sms5;
     	           $data['pwr_smsto']                 = $result[0]->pw_smsto;
     	           $data['pwr_notice_type']           = $object->pw_notice_type;
     	           $data['pwr_severity']              = $object->pw_severity;
     	           $data['pwr_originator_group']      = $object->pw_originator_group;
     	           $data['pwr_executor_group']        = $object->pw_executor_group;
     	           $data['sent_time']                 = '';
     	           $data['flag']                      = '';
                   $info['data']                      = $data;
                   insert($info);
               }
            }
   }
   
   function copyThisPW2PWRtbl($pw_id)
   {
            $data['table']  = PW_TBL;
            $data['where']  = "pw_id='$pw_id'";
            $data['debug']  = false;
            $result         = select($data);
            if(count($result))
            {
                $info['table']  = PWR_TBL;
                $info['debug']  = false;
                foreach($result as $key => $object)
                {
                   $data['pw_id']                     = $object->pw_id;
                   $data['pw_execution_date']         = $object->pw_execution_date;
                   $data['outage_flag']               = $object->outage_flag;
                   $data['pwr_name']                  = $object->pw_name;
                   $data['pwr_impact']                = $object->pw_impact;
                   $data['pwr_st']                    = $object->pw_st;
     	           $data['pwr_et']                    = $object->pw_et;
     	           $data['pwr_status']                = '';
     	           $data['pwr_sms1']                  = $object->pw_sms1;
     	           $data['pwr_sms2']                  = $object->pw_sms2;
     	           $data['pwr_sms3']                  = $object->pw_sms3;
     	           $data['pwr_sms4']                  = $object->pw_sms4;
     	           $data['pwr_sms5']                  = $object->pw_sms5;
     	           $data['pwr_smsto']                 = $result[0]->pw_smsto;
     	           $data['pwr_notice_type']           = $object->pw_notice_type;
     	           $data['pwr_severity']              = $object->pw_severity;
     	           $data['pwr_originator_group']      = $object->pw_originator_group;
     	           $data['pwr_executor_group']        = $object->pw_executor_group;
     	           $data['sent_time']                 = '';
     	           $data['flag']                      = '';
                   //$info['data']                      = $data;
                   //insert($info);
               }
               if(alreadyInPWRTbl($pw_id))
               {
                   $info['where']                     = "pw_id=$pw_id";
                   $info['data']                      = $data;
                   update($info);
               }
               else
               {
                   $info['data']                      = $data;
                   insert($info);
               }
            }
   }

   function alreadyInPWRTbl($pw_id)
   {
        $info['table']  = PWR_TBL;
        $info['debug']  = false;
        $info['where']  = "pw_id=$pw_id";

        $result         = select($info);

        //$ret = count($result) && ($result[0]->flag != 'Sent');
        $ret = count($result);

        return $ret;
   }

   function updatePW2PWRtbl($date , $result)
   {
       $pw_id = "";
       
       if(count($result))
       {
           foreach($result as $key => $obj)
             $pw_id = ($pw_id =="") ? "'" . $obj->pw_id . "'" : "$pw_id,'" . $obj->pw_id . "'";
       }

       $data['table']  = PW_TBL;
       $data['where']  = "pw_execution_date='$date' and pw_id not in ($pw_id)";
       $data['debug']  = false;
       $result         = select($data);

       if(count($result))
       {
           $info['table']  = PWR_TBL;
           $info['debug']  = false;
           foreach($result as $key => $object)
           {
               $data['pw_id']                     = $object->pw_id;
               $data['pw_execution_date']         = $object->pw_execution_date;
               $data['outage_flag']               = $object->outage_flag;
               $data['pwr_name']                  = $object->pw_name;
               $data['pwr_impact']                = $object->pw_impact;
               $data['pwr_st']                    = $object->pw_st;
     	       $data['pwr_et']                    = $object->pw_et;
     	       $data['pwr_status']                = '';
     	       $data['pwr_sms1']                  = $object->pw_sms1;
     	       $data['pwr_sms2']                  = $object->pw_sms2;
     	       $data['pwr_sms3']                  = $object->pw_sms3;
     	       $data['pwr_sms4']                  = $object->pw_sms4;
     	       $data['pwr_sms5']                  = $object->pw_sms5;
     	       $data['pwr_smsto']                 = $result[0]->pw_smsto;
     	       $data['pwr_notice_type']           = $object->pw_notice_type;
     	       $data['pwr_severity']              = $object->pw_severity;
     	       $data['pwr_originator_group']      = $object->pw_originator_group;
     	       $data['pwr_executor_group']        = $object->pw_executor_group;
     	       $data['sent_time']                 = '';
     	       $data['flag']                      = '';
               $info['data']                      = $data;
               insert($info);
             }
       }
   }
   
   function formatSMStoFORview($pw_smsto)
   {
       $arr    = explode(";",$pw_smsto);
       
       $newstr = '';
       
       if (count($arr))
       {
          foreach($arr as $key=>$recipient)
          {
             $indi = explode("||" , $recipient);
             
             if(count($indi)>1)
             {
                $name      = getMaxPart(explode(" ",$indi[0]));
                $recipient = $name . "(" . substr($indi[1], 5, 6) . ")";
             }
             else
             {
                if(strlen($recipient)>10)
                  $recipient = substr($recipient,0,8) . "..";
             }
             
             $newstr .= ($newstr=='') ? $recipient : "+" . $recipient;
          }
       }

       return $newstr;
   }
   
   function getMaxPart($arr)
   {
      $c = count($arr);
      if($c>1)
      {
         for($i=1;$i<$c;++$i)
           $arr[0] = (strlen($arr[0])<strlen($arr[$i])) ? $arr[$i] : $arr[0];
      }
      
      return $arr[0];
   }
   
   function formatPWSMS($pwsms , $pw_id)
   {
       $arr    = explode("\n",$pwsms);
       $pwno   = substr($arr[0],0,strpos($arr[0],"<"));
       $action = "<a href={$SCRIPT_NAME}?cmd=modify_pw&pw_id=$pw_id>Modify</a>&nbsp|&nbsp;" .
                 "<a href={$SCRIPT_NAME}?cmd=delete_pw&pw_id=$pw_id>Delete</a>&nbsp;|&nbsp;" .
                 "<a href={$SCRIPT_NAME}?cmd=pw_notice&pw_id=$pw_id>Notice</a>";
       return preg_replace("/PW#\d+/","$pwno&nbsp($action)" , $pwsms , 1);
   }
   
   function getPWDetails($pw_id)
   {
   	  $info['table']  = PW_TBL;
   	  $info['debug']  = false;
   	  $info['where']  = "pw_id = $pw_id";

   	  $result = select($info);
   	  if(count($result))
   	  {
   	  	  $data['pw_id']                    = $pw_id;

          $data['pw_execution_date']        = $result[0]->pw_execution_date;
          $data['outage_flag']              = $result[0]->outage_flag;
          $data['pw_name']                  = $result[0]->pw_name;
          $data['pw_impact']                = $result[0]->pw_impact;
          $data['pw_st']                    = $result[0]->pw_st;
     	  $data['pw_et']                    = $result[0]->pw_et;
     	  $data['pw_sms1']                  = $result[0]->pw_sms1;
     	  $data['pw_sms2']                  = $result[0]->pw_sms2;
     	  $data['pw_sms3']                  = $result[0]->pw_sms3;
     	  $data['pw_sms4']                  = $result[0]->pw_sms4;
     	  $data['pw_sms5']                  = $result[0]->pw_sms5;
     	  $data['recipient_list']           = explode(';', $result[0]->pw_smsto);
     	  $data['pw_notice_type']           = $result[0]->pw_notice_type;
     	  $data['pw_severity']              = $result[0]->pw_severity;
     	  $data['pw_originator_group']      = $result[0]->pw_originator_group;
     	  $data['pw_executor_group']        = $result[0]->pw_executor_group;
     	  $data['flag']                     = $result[0]->flag;
   	  }
   	  
   	  return $data;
   }

   function getPWRDetails($pw_id)
   {
   	  $info['table']  = PWR_TBL;
   	  $info['debug']  = false;
   	  $info['where']  = "pw_id = $pw_id";

   	  $result = select($info);
   	  if(count($result))
   	  {
   	  	  $data['pw_id']                     = $pw_id;

          $data['pw_execution_date']         = $result[0]->pw_execution_date;
          $data['pwr_status']                = $result[0]->pwr_status;
          $data['outage_flag']               = $result[0]->outage_flag;
          $data['pwr_name']                  = $result[0]->pwr_name;
          $data['pwr_impact']                = $result[0]->pwr_impact;
          $data['pwr_st']                    = $result[0]->pwr_st;
     	  $data['pwr_et']                    = $result[0]->pwr_et;
     	  $data['pwr_sms1']                  = $result[0]->pwr_sms1;
     	  $data['pwr_sms2']                  = $result[0]->pwr_sms2;
     	  $data['pwr_sms3']                  = $result[0]->pwr_sms3;
     	  $data['pwr_sms4']                  = $result[0]->pwr_sms4;
     	  $data['pwr_sms5']                  = $result[0]->pwr_sms5;
     	  $data['recipient_list']            = explode(';', $result[0]->pwr_smsto);
     	  $data['pwr_notice_type']           = $result[0]->pwr_notice_type;
     	  $data['pwr_severity']              = $result[0]->pwr_severity;
     	  $data['pwr_originator_group']      = $result[0]->pwr_originator_group;
     	  $data['pwr_executor_group']        = $result[0]->pwr_executor_group;
     	  $data['flag']                      = $result[0]->flag;
   	  }

   	  return $data;
   }
   
   function getPWsmsData($pw_id)
   {
   	  $info['table']  = PW_TBL;
   	  $info['debug']  = false;
   	  $info['where']  = "pw_id = $pw_id";

   	  $result = select($info);

   	  $data = array();
   	  if(count($result[0]))
   	  {
         $sms[0] = trim($result[0]->pw_sms1);
         $contd  = trim($result[0]->pw_sms2);
         if($contd!="") $sms[1] = $contd;
         $contd  = trim($result[0]->pw_sms3);
         if($contd!="") $sms[2] = $contd;
         $contd  = trim($result[0]->pw_sms4);
         if($contd!="") $sms[3] = $contd;
         $contd  = trim($result[0]->pw_sms5);
         if($contd!="") $sms[4] = $contd;

         $smsto = explode(';' , $result[0]->pw_smsto);
         $data['sms']=$sms;
         $data['to'] =$smsto;
         
         $data['pw_execution_date']        = $result[0]->pw_execution_date;
         $data['pw_status']                = $result[0]->pw_status;
         $data['outage_flag']              = $result[0]->outage_flag;
         $data['pw_name']                  = $result[0]->pw_name;
         $data['pw_impact']                = $result[0]->pw_impact;
         $data['pw_st']                    = $result[0]->pw_st;
     	 $data['pw_et']                    = $result[0]->pw_et;
     	 $data['pw_sms1']                  = $result[0]->pw_sms1;
     	 $data['pw_sms2']                  = $result[0]->pw_sms2;
     	 $data['pw_sms3']                  = $result[0]->pw_sms3;
     	 $data['pw_sms4']                  = $result[0]->pw_sms4;
     	 $data['pw_sms5']                  = $result[0]->pw_sms5;
     	 $data['pw_notice_type']           = $result[0]->pw_notice_type;
     	 $data['pw_severity']              = $result[0]->pw_severity;
     	 $data['pw_originator_group']      = $result[0]->pw_originator_group;
     	 $data['pw_executor_group']        = $result[0]->pw_executor_group;
     	 $data['flag']                     = $result[0]->flag;
      }

     return $data;
   }

   function getPWRsmsData($pw_id)
   {
   	  $info['table']  = PWR_TBL;
   	  $info['debug']  = false;
   	  $info['where']  = "pw_id = $pw_id";

   	  $result = select($info);

   	  $data = array();
   	  if(count($result[0]))
   	  {
         $sms[0] = trim($result[0]->pwr_sms1);
         $contd  = trim($result[0]->pwr_sms2);
         if($contd!="") $sms[1] = $contd;
         $contd  = trim($result[0]->pwr_sms3);
         if($contd!="") $sms[2] = $contd;
         $contd  = trim($result[0]->pwr_sms4);
         if($contd!="") $sms[3] = $contd;
         $contd  = trim($result[0]->pwr_sms5);
         if($contd!="") $sms[4] = $contd;
         
         $smsto = explode(';' , $result[0]->pwr_smsto);
         $data['sms']=$sms;
         $data['to'] =$smsto;
         
         $data['pw_execution_date']         = $result[0]->pw_execution_date;
         $data['pwr_status']                = $result[0]->pwr_status;
         $data['outage_flag']               = $result[0]->outage_flag;
         $data['pwr_name']                  = $result[0]->pwr_name;
         $data['pwr_impact']                = $result[0]->pwr_impact;
         $data['pwr_st']                    = $result[0]->pwr_st;
     	 $data['pwr_et']                    = $result[0]->pwr_et;
         $data['pwr_status']                = $result[0]->pwr_status;
     	 $data['pwr_sms1']                  = $result[0]->pwr_sms1;
     	 $data['pwr_sms2']                  = $result[0]->pwr_sms2;
     	 $data['pwr_sms3']                  = $result[0]->pwr_sms3;
     	 $data['pwr_sms4']                  = $result[0]->pwr_sms4;
     	 $data['pwr_sms5']                  = $result[0]->pwr_sms5;
     	 $data['pwr_notice_type']           = $result[0]->pwr_notice_type;
     	 $data['pwr_severity']              = $result[0]->pwr_severity;
     	 $data['pwr_originator_group']      = $result[0]->pwr_originator_group;
     	 $data['pwr_executor_group']        = $result[0]->pwr_executor_group;
     	 $data['flag']                      = $result[0]->flag;
      }
      
     return $data;
   }
   
   function getMobileNo($to)
   {
       $strpos = strpos($to,"||");
       if($strpos)
       {
           $name     =  substr($to,0,$strpos);
           $mobileno =  array("+88" . substr($to,$strpos+2) => "+88" . substr($to,$strpos+2));
           return array(0=>$name,1=>$mobileno);
       }
       else
       {
      	  $info['table']  = SMS_GROUP_TBL;
    	  $info['debug']  = false;
   	      $info['where']  = "group_name='$to'";

    	  $result = select($info);

    	  $data = array();
    	  if(count($result))
          foreach($result as $key => $obj)
          $data[$obj->phone_no] = $obj->phone_no;
          
          return array(0=>$to,1=>$data);
       }
   }
   
   function getAllRecipients($to)
   {
       $all_recipients = array();

       foreach($to as $key => $to)
       {
          $smsto             = getMobileNo($to);  //$to single entry either xx||yy or xx
          $all_recipients    = array_merge($all_recipients , $smsto[1]);
       }

       return $all_recipients;
   }

   function logPWRSMS($log_id, $pw_id, $b_text, $smsto , $datetime, $sendby, $pwr_data)
   {
      $data['log_id']                 = $log_id;
      $data['pw_id']                  = $pw_id;
      $data['b_text']                 = $b_text;
      $data['b_recipient']            = $smsto;
      $data['pw_execution_date']      = $pwr_data['pw_execution_date'];
      $data['pwr_name']               = $pwr_data['pwr_name'];
      $data['outage_flag']            = $pwr_data['outage_flag'];
      $data['pwr_impact']             = $pwr_data['pwr_impact'];
      $data['pwr_st']                 = $pwr_data['pwr_st'];
      $data['pwr_et']                 = $pwr_data['pwr_et'];
      $data['pwr_status']             = $pwr_data['pwr_status'];
      $data['pwr_notice_type']        = $pwr_data['pwr_notice_type'];
      $data['pwr_severity']           = $pwr_data['pwr_severity'];
      $data['pwr_originator_group']   = $pwr_data['pwr_originator_group'];
      $data['pwr_executor_group']     = $pwr_data['pwr_executor_group'];
      $data['sent_time']              = $datetime;
      $data['sent_by']                = $sendby;

      $info['table']  = PWR_SMS_LOG_TBL;
   	  $info['debug']  = false;
   	  $info['data']   = $data;

   	  $result = insert($info);
   }
   
   function logPWSMS($log_id, $pw_id, $a_text, $smsto , $datetime, $sendby, $data)
   {
      $data['log_id']                = $log_id;
      $data['pw_id']                 = $pw_id;
      $data['a_text']                = $a_text;
      $data['a_recipient']           = $smsto;
      $data['pw_execution_date']     = $data['pw_execution_date'];
      $data['pw_name']               = $data['pw_name'];
      $data['outage_flag']           = $data['outage_flag'];
      $data['pw_impact']             = $data['pw_impact'];
      $data['pw_st']                 = $data['pw_st'];
      $data['pw_et']                 = $data['pw_et'];
      $data['pw_notice_type']        = $data['pw_notice_type'];
      $data['pw_severity']           = $data['pw_severity'];
      $data['pw_originator_group']   = $data['pw_originator_group'];
      $data['pw_executor_group']     = $data['pw_executor_group'];
      $data['sent_time']             = $datetime;
      $data['sent_by']               = $sendby;


      $info['table']  = PW_SMS_LOG_TBL;
   	  $info['debug']  = false;
   	  $info['data']   = $data;

   	  $result = insert($info);
   }

   function updateSMSflag($tbl, $pw_id)
   {
      $info['table']  = $tbl;
   	  $info['debug']  = false;
   	  $info['where']  = "pw_id=$pw_id";
   	  $data['flag']        = 'Sent';
   	  $data['sent_time']   = date('Y-m-d H:i:s');
   	  $info['data']   = $data;

      update($info);
   }
   
   function getReportData($where)
   {
      $info['table']  = PWR_TBL;
   	  $info['debug']  = false;
   	  $info['where']  = $where;
   	  $info['fields'] = array('pw_id','pw_execution_date as pw_date','pwr_sms1','pwr_sms2','pwr_sms3','pwr_sms4','pwr_sms5','pwr_status as status','pwr_severity as severity','pwr_originator_group as initiator','pwr_executor_group as executor','sent_time as b_sent_time','outage_flag');

      $result = select($info);
      $pws    = array();

      if(count($result))
            foreach($result as $key => $object)
            {
              $pwrList[$object->pw_id]->pw_date    = $object->pw_date;
              $pwrList[$object->pw_id]->b_text     = concatSMS($object->pwr_sms1,$object->pwr_sms2,$object->pwr_sms3,$object->pwr_sms4,$object->pwr_sms5);
              $pwrList[$object->pw_id]->status     = nl2br($object->status);
              $pwrList[$object->pw_id]->initiator  = $object->initiator;
              $pwrList[$object->pw_id]->executor   = $object->executor;
              $pwrList[$object->pw_id]->severity   = $object->severity;
              $pwrList[$object->pw_id]->b_sent_time= $object->b_sent_time;
              $pwrList[$object->pw_id]->outage_flag= $object->outage_flag;
              $pws[] = $object->pw_id;
            }

      $pw_ids = "";
      insertIntoSession('s',$where);
      
      if(count($pws))
      {
         $pw_ids = "('" . implode("','" , $pws) . "')";

         $info['table']  = PW_TBL;
   	     $info['debug']  = false;
   	     $info['where']  = "pw_id in " . $pw_ids;
   	     $info['fields'] = array('pw_id','pw_sms1','pw_sms2','pw_sms3','pw_sms4','pw_sms5','sent_time as a_sent_time');

         $result = select($info);

         if(count($result))
            foreach($result as $key => $object)
            {
              $pwrList[$object->pw_id]->a_text     = concatSMS($object->pw_sms1,$object->pw_sms2,$object->pw_sms3,$object->pw_sms4,$object->pw_sms5);
              $pwrList[$object->pw_id]->a_sent_time= $object->a_sent_time;
            }
       }
      return $pwrList;
   }

   function getSMSLogData($where)
   {
      $info['table']  = PWR_SMS_LOG_TBL;
   	  $info['debug']  = false;
   	  $info['where']  = $where;
   	  $info['fields'] = array('pw_execution_date as pw_date','b_text','sent_time as b_sent_time', 'sent_by','b_recipient');

      $result = select($info);
      $i      = 0;

      if(count($result))
            foreach($result as $key => $object)
            {
              $pwrList[++$i]->pw_date    = $object->pw_date;
              $pwrList[$i]->message      = nl2br($object->b_text);
              $pwrList[$i]->recipient    = formatSMStoFORview($object->b_recipient);
              $pwrList[$i]->sent_by      = $object->sent_by;
              $pwrList[$i]->sent_time    = $object->b_sent_time;
            }

      $info['table']  = PW_SMS_LOG_TBL;
      $info['debug']  = false;
      $info['where']  = preg_replace("/pwr/i","pw",$where);
      $info['fields'] = array('pw_execution_date as pw_date','a_text','sent_time as a_sent_time', 'sent_by','a_recipient');

      $result = select($info);
      //exit;
      if(count($result))
         foreach($result as $key => $object)
         {
              $pwrList[++$i]->pw_date    = $object->pw_date;
              $pwrList[$i]->message      = nl2br($object->a_text);
              $pwrList[$i]->recipient    = formatSMStoFORview($object->a_recipient);
              $pwrList[$i]->sent_by      = $object->sent_by;
              $pwrList[$i]->sent_time    = $object->a_sent_time;
         }

      return $pwrList;
   }

   function concatSMS($sms1,$sms2,$sms3,$sms4,$sms5)
   {
      $ret = nl2br($sms1);
      
      if($sms2!="")
      $ret = $ret . "\n" . nl2br($sms2);

      if($sms3!="")
      $ret = $ret . "\n" . nl2br($sms3);
      
      if($sms4!="")
      $ret = $ret . "\n" . nl2br($sms4);
      
      if($sms5!="")
      $ret = $ret . "\n" . nl2br($sms5);
      
      return $ret;
   }
   
   function getGroupNameList()
   {
      $group = array(
                      'BO'=>'BO',
                      'CM'=>'CM',
                      'CNR'=>'CNR',
                      'CSP_BSS'=>'CSP_BSS',
                      'CSP_CSS'=>'CSP_CSS',
                      'CSP_PSS'=>'CSP_PSS',
                      'CSP_IN'=>'CSP_IN',
                      'CSP'=>'CSP',
                      'GPIT-SOC'=>'GPIT-SOC',
                      'GSM_OSS'=>'GSM_OSS',
                      'I&C'=>'I&C',
                      'ITMED'=>'ITMED',
                      'ITCRM_CS'=>'ITCRM_CS',
                      'IT_RAFM-SYS'=>'IT_RAFM-SYS',
                      'IT_EDGE'=>'IT_EDGE',
                      'IT_BISO'=>'IT_BISO',
                      'OSS_Tools'=>'OSS_Tools',
                      'OSS_NMS'=>'OSS_NMS',
                      'PS'=>'PS',
                      'RTS_OTS'=>'RTS_OTS',
                      'RTS_MTS'=>'RTS_MTS',
                      'RTS_IPTS'=>'RTS_IPTS',
                      'RTS_RAN'=>'RTS_RAN',
                      'RSP_VASO'=>'RSP_VASO',
                      'RSP_RFSO'=>'RSP_RFSO',
                      'ROB'=>'ROB',
                      'ROD'=>'ROD',
                      'ROC'=>'ROC',
                      'ROBs'=>'ROBs',
                      'ROK'=>'ROK',
                      'ROS'=>'ROS',
                      'ROMy'=>'ROMy',
                      'RTS'=>'RTS',
                      'SBC'=>'SBC',
                      'NA'=>'NA');
      return $group;
   }
   
  function addActivity($activityType, $message)
  {
       $lnk = mysql_connect("localhost" , "root" , "");
       if($lnk)
       {
          @mysql_select_db("nm_tx" , $lnk);
       }

       $data['group_id']      = $_SESSION['group_id'];
       $data['sub_group_id']  = $_SESSION['sub_group_id'];
       $data['activity_type'] = $activityType; // 'string'
       $creator               = $_SESSION['username'];
       $create_date           = date("Y-m-d H:i:s");
       $holding_by            = $_SESSION['username'];
       $status                = 'Close';

       $query  = "INSERT INTO activity_manager (`activity_id`,`group_id`,`sub_group_id`,`activity_type`,`creator`,`create_date`,`holding_by`,`status`) VALUES ('','18','1','$activityType','$creator','$create_date','$creator','$status')";
       $result = mysql_query($query, $lnk);

       $activity_id   = mysql_insert_id();
       $assigned_by   = $creator;
       $assigned_to   = '';
       $assigned_date = date("Y-m-d H:i:s");
       $dead_line     = date("Y-m-d H:i:s");
       $comment       = $message; //Coments…

       $query  = "INSERT INTO activity_log (`activity_log_id`,`activity_id`,`assigned_by`,`assigned_to`,`assigned_date`,`dead_line`,`comment`) VALUES ('','$activity_id','$assigned_by','$assigned_to','$assigned_date','$dead_line','$comment')";
       $result = mysql_query($query, $lnk);

       mysql_close($lnk);
  }
?>
