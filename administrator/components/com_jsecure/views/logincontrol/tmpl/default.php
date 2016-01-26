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
	$document->addScript(JURI::base()."components/com_jsecure/js/logincntrl.js");
		
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
	//echo $this->pane->startPane('config-pane');
	
	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1' and $JSecureConfig->include_logincontrol == '1' )
{
JError::raiseWarning(404, JText::_('NOT_AUTHERIZED'));
$link = "index.php?option=com_jsecure";
$app->redirect($link);	
//$controller    = new jsecureControllerjsecure();
//$controller->execute('auth');
}
else{
	//echo $this->pane->startPanel(JText::_('LOGIN_CONTROL'), 'mail');
?>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" onsubmit="return submitbutton();">
<fieldset class="adminform">
<legend><?php  echo JText::_('LOGIN_CONTROL');?></legend>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('CONFIGURATION_LOGIN_CONTROL_DESCRIPTION'); ?>">
					<?php echo JText::_('CONFIGURATION_LOGIN_CONTROL'); ?>
				</label>
			</span>		
		</td>
		<td class="paramlist_value" width="570">
			<select name="login_control" id="login_control" style="width:100px" >
				<option value="0" <?php echo ($JSecureConfig->login_control==0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->login_control==1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('CONFIGURATION_LOGIN_CONTROL_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>		
		</td>				
	</tr>	
	</table>
</fieldset>
<input type="hidden" name="task" value="" />
<?php
}
?>

<input type="hidden" name="option" value="com_jsecure"/>

</form>




