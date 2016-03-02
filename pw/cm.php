<?php

$pwt  = $_REQUEST['type'];
$pws  = ($pwt=='pw')  ? 'checked' : '';
$pwrs = ($pwt=='pwr') ? 'checked' : '';
$pwt  = ($pwt=='') ? 'pw' : $pwt;

$pwd  = $_REQUEST['pw_execution_date'];
$is   = ($_REQUEST['include']=='on') ? 'checked' : '';

if($pwd=='') $pwd=date('Y-m-d');
$con = mysql_connect('127.0.0.1','root','');
if($con) $lnk = mysql_select_db('nm_tx',$con) or die("Could not find: " . mysql_error());

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

       $data = $data . "\n" . $sms1;
       
       if($sms2!='') $data = $data . "\n" . $sms2;
       if($sms3!='') $data = $data . "\n" . $sms3;
       if($sms4!='') $data = $data . "\n" . $sms4;
       if($sms5!='') $data = $data . "\n" . $sms5;
       
       if($is=='checked') $data = $data . "\nSMS To: " . $smsto;
       
       $data = $data . "\n\n";
   }
}

echo "<form method=post action=cm.php>";
echo "<table><tr><td><input type=radio value=pw name=type $pws>PW&nbsp;&nbsp;<input type=radio value=pwr name=type $pwrs>PWR" .
     "&nbsp;&nbsp;<input type=checkbox name=include $is><b>Include_SMS_To</b>".
     "&nbsp;&nbsp;Date:&nbsp;<input type=text name=pw_execution_date value=$pwd>&nbsp;[<b>Format&nbsp;2012-04-22</b>]".
     "&nbsp;&nbsp;&nbsp<input type=submit value='Get Data'></td></tr>" .
     "<tr><td><textarea cols=160 rows=30>$data</textarea> </td></tr>" .
     "</table>";
echo "</form>";



?>
