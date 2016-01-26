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
	$document->addScript(JURI::base()."components/com_jsecure/js/pwdprotect.js");
		
	jimport('joomla.environment.browser');
    $doc =& JFactory::getDocument();
    $browser = &JBrowser::getInstance();
    $browserType = $browser->getBrowser();
    $browserVersion = $browser->getMajor();
    if(($browserType == 'msie') && ($browserVersion = 7))
    {
    	$document->addScript(JURI::base()."components/com_jsecure/js/tabs.js");
    }
	$app        =& JFactory::getApplication();
?>

<?php
	

	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1' and $JSecureConfig->include_adminpwdpro == '1' )
{
JError::raiseWarning(404, JText::_('NOT_AUTHERIZED'));	
$link = "index.php?option=com_jsecure";
$app->redirect($link);
}
else{
?>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" onsubmit="return submitbutton();" autocomplete="off">
<fieldset class="adminform">
<legend><?php  echo JText::_('ADMIN_PASSWORD_PROT');?></legend>
<strong>This feature allows you to protect administrator directory access with .htaccess and .htpasswd file</strong>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('ADMIN_PASSWORD_ENABLED'); ?>">
			<?php echo JText::_('ADMIN_PASSWORD_ENABLED'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select name="adminpasswordpro" id="adminpasswordpro" style="width:100px" onchange="javascript: hideAdminPassword(this);">
				<option value="0" <?php echo ($JSecureConfig->adminpasswordpro == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->adminpasswordpro == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('ADMINPASSWORDPROTECTION_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
		<tr id="admin_username">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('ADMIN_USERNAME'); ?>">
					<?php echo JText::_('ADMIN_USERNAME'); ?>
			</span>
		</td>
		<td class="paramlist_value">
			<input type="text" name="admin_username" value="" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('ADMIN_USERNAME_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>			
	</tr>
	<tr id="admin_password">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('ADMIN_PASSWORD'); ?>">
					<?php echo JText::_('ADMIN_PASSWORD'); ?>
			</span>
		</td>
		<td class="paramlist_value">
			<input type="password" name="admin_password" value="" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('ADMIN_PASSWORD_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>			
	</tr>
    <tr id="verify_admin_password">
			<td width="150">
			<span class="editlinktip hasTip" title="<?php echo JText::_('REENTER_ADMIN_PASSWORD'); ?>">
			<?php echo JText::_('REENTER_ADMIN_PASSWORD'); ?></span>
			</td>
			<td><input type="password" name="re_admin_password" class="textarea" value="" size="50" /></td>
            <td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('REENTER_ADMIN_PASSWORD_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>	
		</tr>
	</table>
</fieldset>
<input type="hidden" value="<?php echo $JSecureConfig->adminpasswordpro;?>" name="passwordproconfig" />
<input type="hidden" name="task" value="" />
<script type="text/javascript">
hideAdminPassword(document.getElementById('adminpasswordpro'));
</script>
<?php
}


?>

<input type="hidden" name="option" value="com_jsecure"/>

</form>




