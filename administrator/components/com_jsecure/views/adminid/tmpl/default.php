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
	$document->addScript(JURI::base()."components/com_jsecure/js/adminid.js");
		
	jimport('joomla.environment.browser');
    $doc =& JFactory::getDocument();
    $app        =& JFactory::getApplication();
    $browser = &JBrowser::getInstance();
    $browserType = $browser->getBrowser();
    $browserVersion = $browser->getMajor();
    if(($browserType == 'msie') && ($browserVersion = 7))
    {
    	$document->addScript(JURI::base()."components/com_jsecure/js/tabs.js");
    }
	
?>

<?php

	
	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1' and $JSecureConfig->include_adminid == '1' )
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
<legend><?php  echo JText::_('SUPER_ADMIN_ID');?></legend>
	<table class="admintable">
  <?php if(version_compare(JVERSION, '2.5.3', '<')): ?>
	<?php if($this->isSafeId):?>
	<tr>
	   <td colspan='3' class="safe_id"><strong><?php echo JText::_('CHANGE_SUPER_ADMIN_ID_DESC'); ?></strong></td>
	</tr>
	<tr>
	
		<td class="paramlist_value" width="168">
		<a href="index.php?option=com_jsecure&task=changeId" onclick="return show_confirm_id();"><input type="button" name="super_admin_id" value="Change Super Administrator ID" style="padding:2px 4px;" /></a>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('SUPER_ADMIN_ID_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
	<?php else: ?>
	<tr>
	   <td colspan='2' class="safe_id"><?php echo JText::_('SAFE_SUPER_ADMIN_ID'); ?></td>
	</tr>
	<?php endif; ?>
 <?php else: ?>
 <tr>
    <td colspan='2' class="safe_id"><?php echo JText::_('SAFE_SUPER_VERSION_NOT_SUPPORT'); ?></td>
 </tr>
 <?php endif; ?>
</table>
</fieldset>
<input type="hidden" name="task" value="" />
<?php
}
	

?>

<input type="hidden" name="option" value="com_jsecure"/>


</form>
<script>
function show_confirm_id()
{
  if(confirm("<?php echo JText::_('CONFIRM_SUPER_ADMIN_ID'); ?>"))
	  return true;
  else
	  return false;
}
 
</script>


