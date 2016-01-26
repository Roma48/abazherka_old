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
	$document->addScript(JURI::base()."components/com_jsecure/js/mail.js");
		
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
	
	
	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1' and $JSecureConfig->include_mail == '1' )
{
JError::raiseWarning(404, JText::_('NOT_AUTHERIZED'));
$link = "index.php?option=com_jsecure";
$app->redirect($link);	
//$controller    = new jsecureControllerjsecure();
//$controller->execute('auth');
}
else{
	
?>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" onsubmit="return submitbutton();">
<fieldset class="adminform">
<legend><?php  echo JText::_('MAIL_CONFIG');?></legend>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="Enable">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('SEND_MAIL_DESCRIPTION'); ?>">
					<?php echo JText::_('SEND_MAIL'); ?>
				</label>
			</span>
		</td>
		<td class="paramlist_value">
			<select name="sendemail" id="sendemail" style="width:100px" onchange="javascript: checkMailStatus(this);">
				<option value="0" <?php echo ($JSecureConfig->sendemail==0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->sendemail==1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('SEND_MAIL_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>
	</tr>
	<tr id="sendMailDetails">
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('SEND_MAIL_DETAILS_DESCRIPTION'); ?>">
					<?php echo JText::_('SEND_MAIL_DETAILS'); ?>
				</label>
			</span>
		</td>
		<td class="paramlist_value">
			<select name="sendemaildetails" style="width:150px">
				<option value="1" <?php echo ($JSecureConfig->sendemaildetails == 1)?"selected":''; ?>><?php echo JText::_('SEND_CORRECT_KEY'); ?></option>
				<option value="2" <?php echo ($JSecureConfig->sendemaildetails == 2)?"selected":''; ?>><?php echo JText::_('SEND_WRONG_KEY'); ?></option>
				<option value="3" <?php echo ($JSecureConfig->sendemaildetails == 3)?"selected":''; ?>><?php echo JText::_('SEND_BOTH'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('SEND_MAIL_DETAILS_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>		
		</td>
	</tr>
	<tr id="emailid">
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('EMAIL_ID_DESCRIPTION'); ?>">
					<?php echo JText::_('EMAIL_ID'); ?>
				</label>
			</span>		
		</td>
		<td class="paramlist_value">
			<input name="emailid" type="text" value="<?php echo $JSecureConfig->emailid; ?>" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('EMAIL_ID_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>		
		</td>				
	</tr>
	<tr id="emailsubject">
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('EMAIL_SUBJECT_DESCRIPTION'); ?>">
					<?php echo JText::_('EMAIL_SUBJECT'); ?>
				</label>
			</span>		
		</td>
		<td class="paramlist_value">
			<input name="emailsubject" type="text" value="<?php echo $JSecureConfig->emailsubject; ?>" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('EMAIL_SUBJECT_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>		
		</td>			
	</tr>
	</table>
</fieldset>
<input type="hidden" name="task" value="" />
<script type="text/javascript">
checkMailStatus(document.getElementById('sendemail'));
</script>
<?php
}
	

?>
<input type="hidden" name="option" value="com_jsecure"/>
</form>




