<?php /* Smarty version 2.6.6, created on 2015-06-03 12:48:45
         compiled from C:/wamp/www//nm_tx/standard/user_home/default_home.html */ ?>
<html>
<head>
<title>SOC Back Office Support</title>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['SYSTEM_COMMON_CSS_DIR']; ?>
/default.project.css" type="text/css">
<link rel="stylesheet" href="/nm_tx/standard/user_home/user_home.css">

<script language="JavaScript" src="<?php echo $this->_tpl_vars['SYSTEM_COMMON_JAVASCRIPT_DIR']; ?>
/messages.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['SYSTEM_COMMON_JAVASCRIPT_DIR']; ?>
/common.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['SYSTEM_COMMON_JAVASCRIPT_DIR']; ?>
/sorttable.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['SYSTEM_COMMON_JAVASCRIPT_DIR']; ?>
/CalendarPopup.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['REL_TEMPLATE_DIR']; ?>
/<?php echo $this->_tpl_vars['SYSTEM_APP_PREFIX']; ?>
.js"></script>
<script language="JavaScript" src="/nm_tx/standard/user_home/user_home.js"></script>
</head>

<body>

<table border="0" cellpadding="0" cellspacing="0" class="mainTable" width="100%">
	<tr>
		<td style="width:80px">&nbsp;</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="1" width="100%" bgcolor="white">
				<tr>
					<td>  
						<!-- header include call starts here -->
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['USER_HEADER'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <!-- header include call ends here -->
					</td>
				</tr>
				<tr>
					<td>  
					  <table valign="top" cellpadding="0" cellspacing="0" width="100%" border=0 bgcolor="white">
              <tr>
                <td bgcolor="#000000">
                  <table align="center" border="0">
                    <tr height="25" class="tab">
                    	<?php if ($this->_tpl_vars['USER_TYPE'] == 'BO'): ?>
                    	<td id=0 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu0",'0') class="menueBorderLeft" style="font-size: 14px">&nbsp;Activity & Performance&nbsp; </td>
                    	<?php endif; ?>
                    	
                      <td id=1 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu1",'1') class="menueBorderLeft" style="font-size: 14px">&nbsp;Fault Manager&nbsp; </td>
                      <td id=2 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu2",'2') class="menueBorderLeft" style="font-size: 14px">&nbsp;HC Portal&nbsp; </td>
                      <td id=3 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu3",'3') class="menueBorder" style="font-size: 14px">&nbsp;OnCall&nbsp; </td>
                      <!--
                      <td id=7 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu7",'7') class="menueBorder" style="font-size: 14px">&nbsp;Analysis&nbsp;</td>
                      -->
                      <?php if ($this->_tpl_vars['USER_TYPE'] == 'BO' || $this->_tpl_vars['USER_TYPE'] == 'NSS'): ?>
                      <!--
                      <td id=2 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu2",'2') style="font-size: 14px"> &nbsp;Remote Support&nbsp; </td>                                            
                      <td id=4 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu4",'4') style="font-size: 14px">&nbsp;ADM&nbsp;</td>
                      <td id=5 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu5",'5') class="menueBorderLeft" style="font-size: 14px">&nbsp;Microwave&nbsp;</td>
                      <td id=6 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu6",'6') class="menueBorderLeft" style="font-size: 14px">&nbsp;Report&nbsp;</td>                      
                      -->
                      <td id=4 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu4",'4') class="menueBorderRight" style="font-size: 14px">&nbsp;Important Links&nbsp;</td>                      
                      <?php endif; ?>                      
                      <td id=5 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu5",'5') class="menueBorderRight" style="font-size: 14px">&nbsp;Access & Support&nbsp;</td>
                      <?php if ($this->_tpl_vars['USER_TYPE'] == 'BO' || $this->_tpl_vars['USERNAME'] == 'aalim' || $this->_tpl_vars['USERNAME'] == 'kalim' || $this->_tpl_vars['USER_TYPE'] == 'NSS'): ?>
                        <td id=8 align=center onmouseout=btnTimer() onmouseover=showLayer("Menu8",'8') class="menueBorderRight" style="font-size: 14px">&nbsp;PW Management&nbsp;</td>
                      <?php endif; ?>
                    </tr>
                  </table>
                  <div id=Menu0 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/acvt_manager/acvt_manager.php"> &nbsp;Activity & Performance &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>                      
                    </table>
                  </div>       
                  <div id=Menu1 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/fault_manager/fault_manager.php?cmd=edit"> &nbsp;Fault Entry &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr> 
                      <?php if ($this->_tpl_vars['USER_TYPE'] == 'BO'): ?>
                      <!--
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/tbased_fault_log/tbased_fault_log.php"> &nbsp;Fault Log Entry &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      -->
                      <?php endif; ?>
                      
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/fault_manager/fault_manager.php"> &nbsp;Fault View &nbsp;</a> &nbsp; &nbsp;</td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/search_page/search_page.php"> &nbsp;Fault Search &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id=Menu2 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/hc_portal/hc_portal.php"> &nbsp;HC Portal &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id=Menu3 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/oncall/oncall.php"> &nbsp;OnCall</a> &nbsp; &nbsp;
                        </td>
                      </tr>                      
                    </table>
                  </div>
                  <div id=Menu4 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/mpbn/mpbn_bw.php"> &nbsp;MPBN BW Viewer</a> &nbsp; &nbsp;
                        </td>
                      </tr>                      
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/mpbn_link/mpbn_link.php"> &nbsp;MPBN Link Info</a> &nbsp; &nbsp;
                        </td>
                      </tr>
					  <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/gptts_kpi/gptts_kpi.php"> &nbsp;GPTTS KPI</a> &nbsp; &nbsp;
                        </td>
                      </tr>
					  <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/mni_portal/mni_portal.php"> &nbsp;MNI Portal</a> &nbsp; &nbsp;
                        </td>
                      </tr>
					  <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/tr_follow_up/tr_follow_up.php"> &nbsp;Ticket Followup</a> &nbsp; &nbsp;
                        </td>
                      </tr>
					  <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/tr_follow_up/tr_follow_up.php?page=esm"> &nbsp;ESM Ticket Followup</a> &nbsp; &nbsp;
                        </td>
                      </tr>
					  <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/nsi/nsi.php"> &nbspNetwork Service Incident</a> &nbsp; &nbsp;
                        </td>
                      </tr>                        
                      <!--tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=write_pw"> &nbsp;PW&nbsp;&nbsp;&nbsp;&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=pwr"> &nbsp;PWR&nbsp;&nbsp;&nbsp;&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=pw_report"> &nbsp;CM Report&nbsp;&nbsp;&nbsp;&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/cm.php"> &nbsp;Copy PW/PWR&nbsp;&nbsp;&nbsp;&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=log"> &nbsp;SMS Log&nbsp;&nbsp;&nbsp;&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr-->
					  <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/imp_links/imp_links.php"> &nbsp;Imp TX Links</a> &nbsp; &nbsp;
                        </td>
                      </tr>                      
                    </table>
                  </div>
                  <!--
                  <div id=Menu4 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                    	<tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/imp_links/imp_links.php?link=mpbn"> &nbsp;MPBN &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/imp_links/imp_links.php?link=dwdm"> &nbsp;DWDM &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>                      
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/tr_follow_up/tr_follow_up.php"> &nbsp;Ticket Followup &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                    </table>
                  </div>
                  -->
                  <div id=Menu5 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/subleased/subleased.php"> &nbsp;Subleased Client&nbsp;&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>                      
                    </table>
                  </div>
                  </div>
                  <div id=Menu6 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="#"> &nbsp;Availability &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id=Menu7 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="http://gp-pc-1004865/mpbn/mpbn_bw.php" target="_blank"> &nbsp;MPBN Bandwidth &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="#"> &nbsp;OF Link Down &nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id=Menu8 style="position: absolute; border: 1px solid #000000; visibility:hidden; z-ndex: 1">
                    <table bgcolor=#ffeecc cellspacing=0 cellpadding=0 style="border-collapse: collapse;">
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="http://10.12.1.61:7007/workspace/faces/jsf/security/logout.xhtml">&nbsp;NERM CR Module&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="http://10.12.1.53:7021/MagicBoxCR/LogoutAction.do">&nbsp;CR Viewer (MagicBox)&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=write_pw">&nbsp;PW Notification&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=pwr">&nbsp;PWR Notification&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=pw_copy">&nbsp;Copy PW/PWR&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=pw_report">&nbsp;CM Report&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="/nm_tx/pw/pw.php?cmd=log">&nbsp;SMS Log&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                      <tr height=25 onmouseout=menuOut(this,'#ffeecc') onmouseover=menuOver(this,'#FFFFFF')>
                        <td bgcolor=#000000>&nbsp; &nbsp;</td><td align=left>
                          <a class=asd href="\\Fileserver2\network operation\BO Info\ALIM_CM" target="_blank">&nbsp;Guidelines&nbsp;</a> &nbsp; &nbsp;
                        </td>
                      </tr>
                    </table>
                  </div>
                </td>
              </tr>
              <tr>
              	<td>
              		<!-- main contents block starts here -->
              		<?php if ($this->_tpl_vars['contents']): ?>              		
                  <?php echo $this->_tpl_vars['contents']; ?>

                  <?php else: ?>
                  <table cellpadding="0" cellspacing="1" border="0" bgcolor="white" width="100%">
                  	<tr align="center"  height="600">
                  		<td width="250" background="<?php echo $this->_tpl_vars['SYSTEM_COMMON_IMAGE_DIR']; ?>
/back5.gif">
                  			<?php if ($this->_tpl_vars['USER_TYPE'] == 'NM_TX'): ?>
                  			<br><p align="center"> <font color="black" size="4" style="font-family: Telenor"><b><u> Notice Board </u></b></font></p>
                  			<div align="center"> 
                  				<marquee scrollamount="2" direction="up" loop="true" width="90%"  height="600">                   					
                  						<font color="black" size="3" style="font-family: Telenor"><b>
                  							Roster Phase-02 with Government Holly Day Leave has been published.
                  						</font>                  					
                          </marquee>
                        </div>
                        <?php endif; ?>    
                  		</td>                  		
                  		<td valign="top" background="<?php echo $this->_tpl_vars['SYSTEM_COMMON_IMAGE_DIR']; ?>
/back1.png">
                  		&nbsp
                  		</td>
                  	</tr>
                  </table>
                  <?php endif; ?>
                  <!-- main contents block ends here -->
              	</td>
              </tr>
              <tr>
              	<td>
              		<!-- footer include call starts here -->
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @constant('FOOTER'), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                  <!-- footer include call ends here -->    
              	</td>
              </tr>
            </table>	
					</td>
				</tr>
			</table>
		</td>
		<td style="width:80px">&nbsp;</td>
	</tr>
</table>
</body>
</html>