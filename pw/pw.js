var prev_color = "";

function setDefaultGroups()
{
    var major_mgmt_groups = new Array('TOMC','TAMT','TM','TIMC','TPMC','E2E Service Mgt','BO');
    var minor_mgmt_groups = new Array('TOMC','TAMT','BO');
    var notice            = new Array('Commercial_Div_SMS_Recipient','BO');
    var others            = new Array('Combined(SOC_TRMC_NQP_ETOMC)');

    var pw_notice_type   = document.sendSMSForm.pw_notice_type.value;
    var pw_severity_type = document.sendSMSForm.pw_severity.value;

    if(pw_notice_type=='Mgmt PW' || pw_notice_type=='PW Notice')
    {
       if(pw_notice_type=='PW Notice')
       document.sendSMSForm.pw_severity.value='NA';

       document.sendSMSForm.pw_originator_group.value='NA';
       document.sendSMSForm.pw_executor_group.value='NA';
       document.sendSMSForm.outage_flag.value='NA';

       if(pw_severity_type=='Critical') setGroups(major_mgmt_groups);
       if(pw_severity_type=='Major') setGroups(major_mgmt_groups);
       if(pw_severity_type=='Minor') setGroups(minor_mgmt_groups);

       if(pw_notice_type=='PW Notice') setGroups(notice);
    }
}

function setGroups(arr)
{
	srcList  = document.getElementById('searching_list');
	destList = document.getElementById('recipient_list');

    destList.length = 0;

	noOfOptions = arr.length;
	for(var i=0; i<noOfOptions; i++)
	{
			newOpt = new Option(arr[i], arr[i]);
			destList.options[destList.length] = newOpt;
	}

	return false;
}

function checkPWType()
{
    var major_mgmt_groups = new Array('TOMC','TAMT','TM','TIMC','TPMC','E2E Service Mgt','BO');
    var minor_mgmt_groups = new Array('TOMC','TAMT','BO');
    var notice            = new Array('Commercial_Div_SMS_Recipient','BO');
    var others            = new Array('Combined(SOC_TRMC_NQP_ETOMC)');

    var pw_notice_type   = document.sendSMSForm.pw_notice_type.value;

    if(pw_notice_type=='General PW')
    {
       var initiator = document.sendSMSForm.pw_originator_group.value;
       var executor  = document.sendSMSForm.pw_executor_group.value;
       if(initiator!='NA') others[others.length] = initiator;

       if(initiator=='IN' || initiator=='VASO' || initiator=='PSS' || initiator=='GPIT-SOC')
       {
           others[others.length] = 'GPIT-SOC';
           if(executor!='NA' && initiator!=executor) others[others.length] = executor;
           setGroups(others);
       }
       setGroups(others);
    }
}

function setAsSeverity(obj)
{
    var major_mgmt_groups = new Array('TOMC','TAMT','TM','TIMC','TPMC','E2E Service Mgt','BO');
    var minor_mgmt_groups = new Array('TOMC','TAMT','BO');
    var notice            = new Array('Commercial_Div_SMS_Recipient','BO');
    var others            = new Array('Combined(SOC_TRMC_NQP_ETOMC)');

    var pw_notice_type   = document.sendSMSForm.pw_notice_type.value;

    if(pw_notice_type=='Mgmt PW')
    {
       if(obj.value=='Critical') setGroups(major_mgmt_groups);
       if(obj.value=='Major') setGroups(major_mgmt_groups);
       if(obj.value=='Minor') setGroups(minor_mgmt_groups);
    }
}

function loadSearchList(obj)
{
	var url  = '/nm_tx/pw/pw.php';
	var pars = 'cmd=load_search_list&type=' + obj.value;
	
	var myAjax = new Ajax.Request(
		url, 
		{
			method: 'get', 
			parameters: pars, 
			onComplete: getOutput
		});		
} 

function filterList(obj)
{
	var url  = '/nm_tx/pw/pw.php';
	var pars = 'cmd=filter_list&cond=' + obj.value + '&type=' + document.getElementById('option').value;
	
	var myAjax = new Ajax.Request(
		url, 
		{
			method: 'get', 
			parameters: pars, 
			onComplete: getOutput
		});
}
  
function getOutput(returnResponse)
{
	rspText   = returnResponse.responseText;
	dataArray = rspText.split('*$#@');
	srcList   = document.getElementById('searching_list');	
	
	//remove all
  for(i=srcList.options.length-1; i >= 0; i--)
  {   	
    srcList.removeChild(srcList.options[i]);    
  }
  
  //add new
  if(dataArray)
    for(i=0; i<dataArray.length; i++)
    {
    	newOpt = new Option(dataArray[i], dataArray[i]);
			srcList.options[i] = newOpt;
    }  	
}

function addSelectedOptions()
{
	srcList  = document.getElementById('searching_list');
	destList = document.getElementById('recipient_list');

	noOfOptions = srcList.length;
	for(var i=0; i<noOfOptions; i++)
	{
		if(srcList.options[i].selected)
		{
			newOpt = new Option(srcList.options[i].text, srcList.options[i].value);
			destList.options[destList.length] = newOpt;
		}
	}
	
	return false;	
}

function removeSelectedOptions()
{
	destList = document.getElementById('recipient_list');
	noOfOptions = destList.options.length;
	
  for(var i=(noOfOptions-1); i >= 0; i--)
  {   	
    if(destList.options[i].selected)
    {    	
      destList.removeChild(destList.options[i]);
    }
  }
  
  return false;
}

function doSubmitPW(objForm)
{
    var flag      = true;
    var first_msg = objForm.pw_sms1.value;
    first_msg     = first_msg.replace(/^\s+|\s+$/g, "");

    objForm.pw_sms1.value = first_msg;

    if(first_msg=="")
    {
       alert("Main Message cannot be empty.");
       document.getElementById('pw_tr1').bgColor="red";
       flag = false;
    }
    else
    {
         if(first_msg.length>480)
         {
            alert("Please reduce the message size of main Message.\nIt exceeded the max limit of 480 characters.");
            document.getElementById('pw_tr1').bgColor="red";
            flag = false;
         }
         else
         document.getElementById('pw_tr1').bgColor="#F8F8F8";
    }


    for(var i=2;i<=5;++i)
    {
      var showTR   = 'pw_tr'+i;
      var TR       = document.getElementById(showTR);

      if(TR.style.display=='inline')
      {
         var sms = document.getElementById('pw_sms'+i).value;
         sms     = sms.replace(/^\s+|\s+$/g, "");
         document.getElementById('pw_sms'+i).value = sms;
         if(sms.length>480)
         {
            var pos = (i==2) ? "2nd " : ((i==3) ? "3rd" : i+"th");
            alert("Please reduce the message size of "+pos+" part.\nIt exceeded the max limit of 480 characters.");
            document.getElementById('pw_tr'+i).bgColor="red";
            flag = false;
         }
         else
         document.getElementById('pw_tr'+i).bgColor="#F8F8F8";
      }
    }

    if(!objForm.recipient_list.length)
    {
       document.getElementById('recipient_label').bgColor="red";
       document.getElementById('recipient_box').bgColor="red";
       flag = false;
    }
	else
	{
        document.getElementById('recipient_label').bgColor="#F8F8F8";
        document.getElementById('recipient_box').bgColor="#F8F8F8";
		for(i = 0; i < objForm.recipient_list.length; i++)
		{
			objForm.recipient_list.options[i].selected = true;
		}
	}

	if(objForm.pw_notice_type.value=="")
	{
       document.getElementById('type_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('type_label').bgColor="#F8F8F8";

	if(objForm.pw_severity.value=="")
	{
       document.getElementById('severity_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('severity_label').bgColor="#F8F8F8";

	if(objForm.pw_originator_group.value=="")
	{
       document.getElementById('initiator_group_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('initiator_group_label').bgColor="#F8F8F8";

	if(objForm.pw_executor_group.value=="")
	{
       document.getElementById('executor_group_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('executor_group_label').bgColor="#F8F8F8";

	if(objForm.outage_flag.value=="")
	{
       document.getElementById('outage_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('outage_label').bgColor="#F8F8F8";

	if(objForm.pw_execution_date.value=="")
	{
       document.getElementById('date_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('date_label').bgColor="#F8F8F8";

	if(flag)
      return doConfirm('You are going to submit. Continue?');
    else
    {
       alert("Please fill-up/correct relevant fields with the Message.");
       return flag;
    }
}
function setDefaultExecutorGroup(obj)
{
   document.sendSMSForm.pw_executor_group.value = obj.value;
}

function doSubmitPWR(objForm)
{
    var flag      = true;
    var first_msg = objForm.pwr_sms1.value;
    first_msg     = first_msg.replace(/^\s+|\s+$/g, "");

    objForm.pwr_sms1.value = first_msg;

    if(first_msg=="")
    {
       alert("Main Message cannot be empty.");
       document.getElementById('pwr_tr1').bgColor="red";
       flag = false;
    }
    else
    {
         if(first_msg.length>480)
         {
            alert("Please reduce the message size of main Message.\nIt exceeded the max limit of 480 characters.");
            document.getElementById('pwr_tr1').bgColor="red";
            flag = false;
         }
         else
         document.getElementById('pwr_tr1').bgColor="#F8F8F8";
    }


    for(var i=2;i<=5;++i)
    {
      var showTR   = 'pwr_tr'+i;
      var TR       = document.getElementById(showTR);

      if(TR.style.display=='inline')
      {
         var sms = document.getElementById('pwr_sms'+i).value;
         sms     = sms.replace(/^\s+|\s+$/g, "");
         document.getElementById('pwr_sms'+i).value = sms;
         if(sms.length>480)
         {
            var pos = (i==2) ? "2nd " : ((i==3) ? "3rd" : i+"th");
            alert("Please reduce the message size of "+pos+" part.\nIt exceeded the max limit of 480 characters.");
            document.getElementById('pwr_tr'+i).bgColor="red";
            flag = false;
         }
         else
         document.getElementById('pwr_tr'+i).bgColor="#F8F8F8";
      }
    }

    if(!objForm.recipient_list.length)
    {
       alert("Please add relevant recipients for this Message");
       document.getElementById('recipient_label').bgColor="red";
       document.getElementById('recipient_box').bgColor="red";
       flag = false;
    }
	else
	{
        document.getElementById('recipient_label').bgColor="#F8F8F8";
        document.getElementById('recipient_box').bgColor="#F8F8F8";
		for(i = 0; i < objForm.recipient_list.length; i++)
		{
			objForm.recipient_list.options[i].selected = true;
		}
	}

	if(objForm.pwr_status.value=="")
	{
       document.getElementById('pwr_status').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('pwr_status').bgColor="#F8F8F8";

	if(objForm.outage_flag.value=="")
	{
       document.getElementById('outage_label').bgColor="red";
       flag = false;
    }
    else
       document.getElementById('outage_label').bgColor="#F8F8F8";

	if(flag)
      return doConfirm('You are going to submit. Continue?');
    else
    {
       alert("Please fill-up/correct relevant fields with the Message.");
       return flag;
    }
}

function getToPwPage()
{
   document.sendSMSForm.cmd.value = 'write_pw';
   document.sendSMSForm.submit();
}

function addPWContdPart()
{
    var TBL      = document.getElementById('msg_tbl');

    var max      = 6;
    for(var i=2;i<=5;++i)
    {
      var showTR   = 'pw_tr'+i;
      var TR       = document.getElementById(showTR);
      
      if(TR.style.display=='none')
      {
         TR.style.display = 'inline';
         max = i;
         return 1;
      }
    }
    
    if(max==6) alert('A Message can have at most 5 continued parts.');
}

function addPWRContdPart()
{
    var TBL      = document.getElementById('msg_tbl');

    var max      = 6;
    for(var i=2;i<=5;++i)
    {
      var showTR   = 'pwr_tr'+i;
      var TR       = document.getElementById(showTR);

      if(TR.style.display=='none')
      {
         TR.style.display = 'inline';
         max = i;
         return 1;
      }
    }

    if(max==6) alert('A Message can have at most 5 continued parts.');
}

function sendPWSMS(msgId, obj)
{
   var res = confirm("Are you sure, you checked the Message & Recipients?");

   if (!res) return false;

   document.getElementById('box'+msgId).src="/nm_tx/pw/images/sending.jpg";
   document.getElementById('box'+msgId).className = "disabled";

   var url  = '/nm_tx/pw/pw.php';
   var pars = 'cmd=send_pw_sms&pw_id=' + msgId;

	var myAjax = new Ajax.Request(
		url,
		{
			method: 'get',
			parameters: pars,
			onComplete: afterSending
		});
}

function sendPWRSMS(msgId, obj)
{
   var res = doConfirm('Are you sure, you checked the Message. Continue?');
   if (!res) return false;

   document.getElementById('box'+msgId).src="/nm_tx/pw/images/sending.jpg";
   document.getElementById('box'+msgId).className = "disabled";
   
   var url  = '/nm_tx/pw/pw.php';
   var pars = 'cmd=send_pwr_sms&pw_id=' + msgId;

	var myAjax = new Ajax.Request(
		url,
		{
			method: 'get',
			parameters: pars,
			onComplete: afterSending
		});
}

function afterSending(returnResponse)
{
  var pw_id = returnResponse.responseText;
  //document.getElementById('box'+pw_id).value="Sent, Send Again";
  //document.getElementById('box'+pw_id).disabled=false;
  document.getElementById('box'+pw_id).src="/nm_tx/pw/images/sms2.jpg";
  alert('SMS Sent!');
}
