<?php 
	/**
	 * jSecure Authentication components for Joomla!
	 * jSecure Authentication extention prevents access to administration (back end)
	 * login page without appropriate access key.
	 *
	 * @author      $Author: Ajay Lulia $
	 * @copyright   Joomla Service Provider - 2012
	 * @package     jSecure3.0
	 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
	 * @version     $Id: default.php  $
	 */
	// No direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );

	$JSecureConfig = $this->JSecureConfig;
	$document =& JFactory::getDocument();
	$document->addCustomTag('<script language="javascript" type="text/javascript" src="components/com_jsecure/js/masterpwd.js"></script>');
	jimport('joomla.environment.browser');
    $doc =& JFactory::getDocument();
    $browser = &JBrowser::getInstance();
    $browserType = $browser->getBrowser();
    $browserVersion = $browser->getMajor();
    $app        =& JFactory::getApplication();
?>

<?php
	

	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1')
{
JError::raiseWarning(404, JText::_('NOT_AUTHERIZED'));	
$link = "index.php?option=com_jsecure";
$app->redirect($link);
}
else{
?>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" onsubmit="return submitbutton();" autocomplete="off">
<fieldset class="adminform">
<legend><?php  echo JText::_('MASTER_PASSWORD');?></legend>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Enable Master Password">
			<?php echo JText::_('MASTER_PASSWORD_ENABLED'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select name="enableMasterPassword" id="enablemasterpassword" style="width:100px" onchange="javascript: hideMasterPassword(this);">
				<option value="0" <?php echo ($JSecureConfig->enableMasterPassword == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->enableMasterPassword == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('ENABLEMASTERPASSWORD_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>	
	<tr id="master_password">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="Master Password">
					<?php echo JText::_('MASTER_PASSWORD'); ?>
			</span>
		</td>
		<td class="paramlist_value">
			<input type="password" name="master_password" value="" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MASTER_PASSWORD_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>			
	</tr>
    <tr id="verify_master_password">
			<td width="150"><?php echo JText::_('REENTER_MASTER_PASSWORD'); ?></td>
			<td><input type="password" name="ret_master_password" class="textarea" value="" size="50" /></td>
            <td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('REENTER_MASTER_PASSWORD_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>	
		</tr>
		</table>
		</fieldset>
		<fieldset class="adminform" id="legend">
        <legend><?php  echo JText::_('QUICK_SELECTION_TITLE');?></legend>
		<table class="admintable">
		<tr id="quick_select">
		<td>
			<span class="editlinktip hasTip" title="Quick selection">
					<strong><?php echo JText::_('QUICK_SELECTION'); ?></strong>
			</span>
			</td>
			<td>
			<button onclick="return doMassSelect(1);" class="btn1 btn1mini gray">All</button>
			<button onclick="return doMassSelect(0);" class="btn1 btn1mini gray">None</button>
		</td>
		 <td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('QUICK_SELECTION_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>	
		</tr>
	<tr id="include_basic_confg">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Basic configuration">
			<?php echo JText::_('INCLUDE_BASIC_CONF'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_basic_confg" id="include_basic_confg" style="width:100px">
				<option value="0" <?php echo ($JSecureConfig->include_basic_confg == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_basic_confg == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEPASSKEY_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_adminpwdpro">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Admin password protection">
			<?php echo JText::_('INCLUDE_ADMINPWDPRO'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_adminpwdpro" id="include_adminpwdpro" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_adminpwdpro == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_adminpwdpro == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEREDIRECT_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_mail">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Mail configuration">
			<?php echo JText::_('INCLUDE_MAIL'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_mail" id="include_mail" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_mail == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_mail == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEMAIL_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
		<tr id="include_ip">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="IP configuration">
			<?php echo JText::_('INCLUDE_IP'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_ip" id="include_ip" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_ip == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_ip == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEIP_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_mastermail">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Master mail configuration">
			<?php echo JText::_('INCLUDE_MASTERMAIL'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_mastermail" id="include_mastermail" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_mastermail == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_mastermail == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEMASTERMAIL_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_log">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Log configuration">
			<?php echo JText::_('INCLUDE_LOG'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_log" id="include_log" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_log == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_log == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDELOG_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_showlogs">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Show log menu">
			<?php echo JText::_('INCLUDE_SHOWLOG'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_showlogs" id="include_showlogs" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_showlogs == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_showlogs == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDESHOWLOG_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_directorylisting">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Directory Listing Menu">
			<?php echo JText::_('INCLUDE_DIRECTORYLISTING'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_directorylisting" id="include_directorylisting" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_directorylisting == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_directorylisting == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEDIRECTORYLISTING_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_adminid">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Directory Listing Menu">
			<?php echo JText::_('INCLUDE_ADMIN_ID'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_adminid" id="include_adminid" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_adminid == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_adminid == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('ADMIN_ID_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_logincontrol">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Directory Listing Menu">
			<?php echo JText::_('INCLUDE_LOGINCNTRL'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_logincontrol" id="include_logincontrol" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_logincontrol == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_logincontrol == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('LOGINCNTRL_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_metatags"> 
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Meta tags">
			<?php echo JText::_('INCLUDE_METATAGS'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_metatags" id="include_metatags" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_metatags == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_metatags == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDEMETATAGS_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<tr id="include_purgesessions">
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Purge sessions">
			<?php echo JText::_('INCLUDE_PURGE_SESSION'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select class="masterpwcheckbox" name="include_purgesessions" id="include_purgesessions" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->include_purgesessions == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->include_purgesessions == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('INCLUDE_PURGESESSION_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	</table>
</fieldset>
<input type="hidden" name="task" value="" />
<script type="text/javascript">
hideMasterPassword(document.getElementById('enablemasterpassword'));
</script>
<?php
}
	
?>
<script type="text/javascript">
function doMassSelect(value)
{
	$$('.masterpwcheckbox>option').setProperty('selected','');
	$$('.masterpwcheckbox').setProperty('value',value);
	return false;
}
</script>

<input type="hidden" name="option" value="com_jsecure"/>

</form>




