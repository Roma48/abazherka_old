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
$document->addScript(JURI::base()."components/com_jsecure/js/basic.js");
$document =& JFactory::getDocument();

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


if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1'and $JSecureConfig->include_basic_confg == '1')
{
JError::raiseWarning(404, JText::_('NOT_AUTHERIZED'));
$link = "index.php?option=com_jsecure";
$app->redirect($link);
}
else{
	
?>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" onsubmit="return submitbutton();" autocomplete="off">
<fieldset class="adminform">
<legend><?php  echo JText::_('BASIC_CONFIG');?></legend>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="Enable">
			<?php echo JText::_('ENABLE'); ?>
		</span>
		</td>
		<td class="paramlist_value">
			<select name="publish" id="publish" style="width:100px">
				<option value="0" <?php echo ($JSecureConfig->publish == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->publish == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('PUBLISHED_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>			
	</tr>	
	<tr>
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('KEY_DESCRIPTION'); ?>">
					<?php echo JText::_('PASS_KEY'); ?>
				</label>
			</span>		
		</td>
		<td class="paramlist_value">
			<select name="passkeytype" style="width:100px">
				<?php
				$url  = $form = '';
				$url  = ($JSecureConfig->passkeytype == "url")? "selected" : "";
				$form = ($JSecureConfig->passkeytype == "form")? "selected" : "";
				if($form == '')
					$url = "selected";	 	
				?>
				<option value="url" <?php echo $url; ?>><?php echo JText::_('URL'); ?></option>
				<option value="form" <?php echo $form; ?>><?php echo JText::_('FORM'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">	
		</td>			
	</tr>
	<tr>
		<td class="paramlist_key">
					<?php echo JText::_('KEY'); ?>
		</td>
		<td class="paramlist_value">
			<input type="password" name="key" value="" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('KEY_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>			
	</tr>
	<tr>
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('REDIRECT_OPTIONS_DESCRIPTION'); ?>">
					<?php echo JText::_('REDIRECT_OPTIONS'); ?>
				</label>
			</span>		
		</td>
		<td class="paramlist_value">
			<select name="options" id="options" style="width:150px" onchange="javascript: hideCustomPath(this);">
				<option value="0" <?php echo ($JSecureConfig->options == 0)?"selected":''; ?>><?php echo JText::_('REDIRECT_INDEX'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->options == 1)?"selected":''; ?>><?php echo JText::_('CUSTOM_PATH'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('REDIRECT_OPTIONS_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>		
		</td>			
	</tr>
	<tr id="custom_path">
		<td class="paramlist_key">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('CUSTOM_PATH_DESCRIPTION'); ?>">
					<?php echo JText::_('CUSTOM_PATH'); ?>
				</label>
			</span>		
		</td>
		<td class="paramlist_value">
			<input name="custom_path" type="text" value="<?php echo $JSecureConfig->custom_path; ?>" size="50" />
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('CUSTOM_PATH_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>		
		</td>				
	</tr>
	</table>

<input name="sendemail" type="hidden" value="<?php echo $JSecureConfig->sendemail; ?>" size="50" />
<input type="hidden" name="option" value="com_jsecure"/>
<input type="hidden" name="task" value="saveBasic" />
</fieldset>
</form>
<?php

	

?>
				<?php
				$i=0;$k = 0;
				foreach($this->data as $row){
					$user = JUser::getInstance($row->userid);
					$k = 1 - $k;	$i++;
				}
}
				?>
			

<script type="text/javascript">
 if(document.getElementById('options') != null)
 {
	hideCustomPath(document.getElementById('options'));
	}
</script>

