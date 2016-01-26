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
	$document->addScript(JURI::base()."components/com_jsecure/js/ip.js");
		
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
	
	
	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1' and $JSecureConfig->include_ip == '1' )
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
<legend><?php  echo JText::_('IP_CONFIG');?></legend>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('IP_TYPE'); ?>">
			<?php echo JText::_('IP_TYPE'); ?>
		</span>
		</td>
		<td class="paramlist_value">
			<select name="iptype" id="iptype" style="width:100px" onchange="javascript: ipLising(this);">
				<option value="0" <?php echo ($JSecureConfig->iptype == 0)?"selected":''; ?>><?php echo JText::_('BLOCKED_IP'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->iptype == 1)?"selected":''; ?>><?php echo JText::_('WHISH_IP'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('IP_TYPE'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>			
	</tr>	
	<tr id="BipLisingAddbox">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('ADD_IP'); ?>">
				<?php echo JText::_('ADD_IP'); ?>
			</span>
		</td>
		<td>
        	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
            <td align="left" width="58" valign="bottom"><input type="text" name="blacklist_ip1" id="blacklist_ip1" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /><b>&nbsp;.</b></td>
			<td align="left" width="58" valign="bottom"><input type="text" name="blacklist_ip2" id="blacklist_ip2" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /><b>&nbsp;.</b></td>
			<td align="left" width="58" valign="bottom"><input type="text" name="blacklist_ip3" id="blacklist_ip3" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /><b>&nbsp;.</b></td>
			<td align="left" width="58" valign="bottom"><input type="text" name="blacklist_ip4" id="blacklist_ip4" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /></td>
			<td align="left"><input type="button" id="add_ipB" name="" value="<?php echo JText::_('ADD'); ?>" onclick="addIpB('blacklist_ip', 'blacklist_ips');" /></td>
            </tr>
            </table>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('IP_RANGE'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>			
	</tr>
	<tr id="BipLisingIpbox">
		<td width="100" align="right" class="key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('ACCESS_IP'); ?>">
			<?php echo JText::_('ACCESS_IP_BLACKLIST'); ?>
			</span>
		</td>
		<td>
			<textarea cols="80" rows="10" class="text_area" type="text" name="iplistB" id="blacklist_ips"><?php echo $JSecureConfig->iplistB; ?></textarea>
		</td>
	</tr>
    <tr id="WipLisingAddbox">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('ADD_IP'); ?>">
				<?php echo JText::_('ADD_IP'); ?>
			</span>
		</td>
		<td>
        	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
            <td align="left" width="58" valign="bottom"><input type="text" name="whitelist_ip1" id="whitelist_ip1" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /><b>&nbsp;.</b></td>
			<td align="left" width="58" valign="bottom"><input type="text" name="whitelist_ip2" id="whitelist_ip2" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /><b>&nbsp;.</b></td>
			<td align="left" width="58" valign="bottom"><input type="text" name="whitelist_ip3" id="whitelist_ip3" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /><b>&nbsp;.</b></td>
			<td align="left" width="58" valign="bottom"><input type="text" name="whitelist_ip4" id="whitelist_ip4" value="" size="3" maxlength="3" onkeyup="isNumeric(this)" /></td>
			<td align="left"><input type="button" id="add_ipW" name="" value="<?php echo JText::_('ADD'); ?>" onclick="addIpW('whitelist_ip', 'whitelist_ips');" /></td>
            </tr>
            </table>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('IP_RANGE'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
    <tr id="WipLisingIpbox">
		<td width="100" align="right" class="key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('ACCESS_IP'); ?>">
			<?php echo JText::_('ACCESS_IP_WHITELIST'); ?>
			</span>
		</td>
		<td>
			<textarea cols="80" rows="10" class="text_area" type="text" name="iplistW" id="whitelist_ips"><?php echo $JSecureConfig->iplistW; ?></textarea>
		</td>
	</tr>
	</table>
</fieldset>
<input type="hidden" name="task" value="" />
<script type="text/javascript">
ipLising(document.getElementById('iptype'));
</script>
<?php
}
?>
<input type="hidden" name="option" value="com_jsecure"/>


</form>




