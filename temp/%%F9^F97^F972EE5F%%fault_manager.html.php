<?php /* Smarty version 2.6.6, created on 2010-01-11 22:45:39
         compiled from C:/wamp/www/nm_tx/fault_manager/fault_manager.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'C:/wamp/www/nm_tx/fault_manager/fault_manager.html', 28, false),array('function', 'html_options', 'C:/wamp/www/nm_tx/fault_manager/fault_manager.html', 87, false),)), $this); ?>
<body>	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
      <td align="right" width="10" height="10"><img src="/nm_tx/common/image/table/top_lft.gif"></td>
      <td background="/nm_tx/common/image/table/top_mid.gif"></td>
      <td align="left" width="10" height="10"><img src="/nm_tx/common/image/table/top_rht.gif"></td>
    </tr>
    <tr>
  	  <td align="right" width="10" background="/nm_tx/common/image/table/lft_border.gif"></td>
  	  <td bgcolor="#FFFFFF" align="left" class="contentArea" background="<?php echo $this->_tpl_vars['SYSTEM_COMMON_IMAGE_DIR']; ?>
/back1.png">
  	  	<table  class="contentHeader" border="0" width="100%">
  	  		<tr>
  	  		  <tr>
              <td class="contentHeaderText">Fault Manager</td>              
            </tr>
  	  	  </tr>
  	  	</table>  	  	
  	  	<br>
  	  	
  	  	<!--Fault Details starts here-->  	  	
  	  	<?php if ($this->_tpl_vars['show_details'] != ""): ?>  	  	
  	  	<table bgcolor="#FFFFFF" cellspacing="3" cellpadding="8">
  	  		<tr class="tbl_header" align="center">
  	  			<td colspan="2">Details of Fault No. <?php echo $this->_tpl_vars['fault_id']; ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Problem Type</td>
  	  			<td bgcolor="#DCE8FA"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][0]->fault_type)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Problem Category</td>
  	  			<td bgcolor="#DCE8FA"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][0]->problem_category)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Problem Component</td>
  	  			<td bgcolor="#DCE8FA"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][0]->problem_component)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1">Impact</td>
  	  			<td bgcolor="#DCE8FA"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][0]->impact)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1">Findings</td>
  	  			<td bgcolor="#DCE8FA"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][0]->finding)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>BO Comments</td>
  	  			<td bgcolor="#DCE8FA"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][0]->nm_tx_comment)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1">Status</td>
  	  			<td bgcolor="#DCE8FA"><b><?php echo $this->_tpl_vars['list'][0]->status; ?>
</b></td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Submit By</td>
  	  			<td bgcolor="#DCE8FA"><?php echo $this->_tpl_vars['list'][0]->submit_by; ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Submit Date</td>
  	  			<td bgcolor="#DCE8FA"><?php echo $this->_tpl_vars['list'][0]->submit_date; ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Last Updated By</td>
  	  			<td bgcolor="#DCE8FA"><?php echo $this->_tpl_vars['list'][0]->last_updated_by; ?>
</td>
  	  		</tr>
  	  		<tr>
  	  			<td bgcolor="#83A2D1" nowrap>Last Update Date</td>
  	  			<td bgcolor="#DCE8FA"><?php echo $this->_tpl_vars['list'][0]->last_update_date; ?>
</td>
  	  		</tr>
  	  	</table>  	  	
  	  	<!--Fault Details end here-->
  	  	
  	  	<?php elseif ($this->_tpl_vars['fault_id'] != ""): ?>
  	  	<!-- Fault Update Form Starts Here-->
  	  	<form name="faultManagerForm" action="<?php echo $this->_tpl_vars['SCRIPT_NAME']; ?>
" method="POST" onsubmit="return doUpdateFault('<?php echo $this->_tpl_vars['status']; ?>
');" enctype="multipart/form-data">
  	  		<input type="hidden" name="cmd" value="update_fault">
  	  		<input type="hidden" name="fault_id" value="<?php echo $this->_tpl_vars['fault_id']; ?>
">
  	  		<input type="hidden" name="pre_status" value="<?php echo $this->_tpl_vars['status']; ?>
">
  	  		<table border="0">
  	  			<tr>
  	  				<td valign="top">
  	  					<table border="0">
  	  						<tr>
  	  							<td>
  	  								<label class="label">Status</label><br>
  	  				        <select name="status" id="status">  	  					  
  	  					        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['status_list'],'output' => $this->_tpl_vars['status_list'],'selected' => $this->_tpl_vars['status']), $this);?>

  	  				        </select>
  	  							</td>
  	  							<td>
  	  								<label class="label">Severity</label><br>
  	  				        <select name="severity">  	  					  
  	  					        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['severity_list'],'output' => $this->_tpl_vars['severity_list'],'selected' => $this->_tpl_vars['severity']), $this);?>

  	  				        </select>
  	  							</td>
  	  						</tr>
  	  					</table>
  	  				</td>
  	  			</tr>
  	  			<tr>
  	  			  <td>
  	  			  	<br>  	  				
  	  			  	<label class="label">Comment</label> <br>
  	  			  	<textarea name="comment" id="comment" rows="7" cols="70"></textarea>
  	  			  </td>
  	  		  </tr>
  	  		  <tr>
  	  			  <td>
  	  			  	<br><br>
  	  			  	<input type="submit" class="submit" name="submit" value="Update">
  	  			  	<input type="reset" class="reset" name="reset" value="Reset">
  	  			  </td>
  	  		  </tr>
  	  		</table>
  	  	</form>
  	  	<!-- Fault Update Form Ends Here-->
  	  	
  	  	<?php else: ?>  	  	
  	  	<!-- Fault Entry Form Starts Here-->
  	  	<form name="faultManagerForm" action="<?php echo $this->_tpl_vars['SCRIPT_NAME']; ?>
" method="POST" onsubmit="return doSubmitFault('You are going to Submit Fault. Continue?');" enctype="multipart/form-data">
  	  	<input type="hidden" name="cmd" value="add">
  	  	<input type="hidden" name="no_of_fault" id="no_of_fault" value="1">
  	  	<table border="0">
  	  		<tr>  	  			
  	  			<td valign="top" colspan="3">  	  				
  	  				<label class="label">Problem Type</label><br>
  	  				<select name="fault_type" id='fault_type' onChange="window.location='/nm_tx/fault_manager/fault_manager.php?cmd=edit&fault_type='+this.value;">
  	  					<option value="">Select a Type</option>
  	  					<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['fault_type_list'],'output' => $this->_tpl_vars['fault_type_list'],'selected' => $this->_tpl_vars['fault_type']), $this);?>

  	  				</select>
  	  			</td>
  	  			<td valign="top">
  	  				<label class="label">Problem Category</label> <br>
  	  				<select name="problem_category" id="problem_category">
  	  					<option value="">Select a Category</option>
  	  					<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['category_list'],'output' => $this->_tpl_vars['category_list']), $this);?>

  	  					<option value="Other">Other</option>
  	  				</select>
  	  			</td>
  	  			<!--
  	  			<td valign="top" colspan="3">  	  				
  	  				<label class="label">Severity</label><br>
  	  				<select name="severity">
  	  					<option value="">Select a Severity</option>
  	  					<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['severity_list'],'output' => $this->_tpl_vars['severity_list']), $this);?>

  	  				</select>
  	  			</td>
  	  			-->
  	  		</tr>  	  		
  	  	</table>  	  	
  	  	<br><br>  	
  	  	<table border="1">
  	  		<tbody id='add_fault_table'>  	  		
  	  		<tr>
  	  			<td><label class="label">Problem Component</label></td>
  	  			<td><label class="label">Node A</label></td>
  	  			<td><label class="label">Node B</label></td>
  	  			<td><label class="label">Impact</label></td>
  	  			<td><label class="label">Findings</label></td>
  	  			<td><label class="label">Attachment</label></td>	
  	  			<td><label class="label">Action</label></td>
  	  		</tr>
  	  		<tr>
  	  			<td><input type="text" value="" name="problem_component1" size="20" maxlength="20"></td>
  	  			<td><input type="text" value="" name="node_a1" size="12" maxlength="10"></td>
  	  			<td><input type="text" value="" name="node_b1" size="12" maxlength="10"></td>
  	  			<td><textarea name="impact1" rows="2" cols="28"></textarea></td>
  	  			<td><textarea name="finding1" rows="2" cols="28"></textarea></td>
  	  			<td><input type="file" name="attachment1" size="25"></td>	
  	  			<td align="center"><input type="button" name="action" size="25" value="X"></td>	
  	  		</tr>
  	  		<!--	
  	  		<tr>
  	  			<td valign="top">
  	  				<label class="label">Problem Category</label> <br>
  	  				<select name="problem_category">
  	  					<option value="">Select a Category</option>
  	  					<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['category_list'],'output' => $this->_tpl_vars['category_list']), $this);?>

  	  					<option value="Other">Other</option>
  	  				</select>
  	  			</td>
  	  			<td>  	  				
  	  				<label class="label">Problem Components</label> <br>
  	  			  <input type="text" value="" name="problem_component" size="40">
  	  			</td>
  	  		</tr>  	  		
  	  		<tr>
  	  			<td colspan="2">
  	  				<br>
  	  				<label class="label">Comment</label> <br>
  	  				<textarea name="comment" rows="7" cols="70"></textarea>
  	  			</td>
  	  		</tr>
  	  		<tr>
  	  			<td valign="top">
  	  				<br>
  	  				<label class="label">Priority</label><br>
  	  				<select name="priority">
  	  					<option value="">Select a Priority</option>
  	  					<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['priority_list'],'output' => $this->_tpl_vars['priority_list']), $this);?>

  	  				</select>
  	  			</td>
  	  			<td valign="top">
  	  				<br>
  	  				<label class="label">Attachment</label><br>
              <input type="file" name="attachment" size="35">
  	  			</td>
  	  		</tr>
  	  		-->  	  		  	  		
  	  	  </tbody>
  	  	</table>
  	  	<table border="0">
  	  		<tr>
  	  			<td colspan="5"><br><a href="JavaScript:void(0);" onClick="addRow();">Add More</a></td>
  	  		</tr>
  	  		<tr>
  	  			<td>
  	  				<br><br>
  	  				<input type="submit" class="submit" name="submit" value="Submit">
  	  				<input type="reset" class="reset" name="reset" value="Reset">
  	  			</td>
  	  		</tr>
  	  	</table>
  	  	</form>
  	  	<!-- Fault Entry Form Ends Here-->
  	  	<?php endif; ?>
  	  	
  	  	<br>
  	  </td>
  	  <td align="left" width="10" background="/nm_tx/common/image/table/rht_border.gif"></td>
    </tr>
    <tr>
      <td align="right" width="10" height="10"><img src="/nm_tx/common/image/table/bttm_lft.gif"></td>
      <td background="/nm_tx/common/image/table/bttm_mid.gif"></td>
      <td align="left" width="10" height="10"><img src="/nm_tx/common/image/table/bttm_rht.gif"></td>
    </tr>  
	</table>
</body>