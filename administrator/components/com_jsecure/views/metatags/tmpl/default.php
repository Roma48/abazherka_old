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
	$document->addScript(JURI::base()."components/com_jsecure/js/metatags.js");
		
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

	
	if (!jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->enableMasterPassword == '1' and $JSecureConfig->include_metatags == '1' )
{
JError::raiseWarning(404, JText::_('NOT_AUTHERIZED'));
$link = "index.php?option=com_jsecure";
$app->redirect($link);
}
else{

?>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" onsubmit="return submitbutton();">
<fieldset class="adminform">
<legend><?php  echo JText::_('META_TAG_CONTROL');?></legend>
	<table class="admintable">
	<tr>
		<td class="paramlist_key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('META_TAG_CONTROL'); ?>">
			<?php echo JText::_('META_TAG_CONTROL_TITLE'); ?>
		</span>
		</td>
		<td class="paramlist_value" width="570">
			<select name="metatagcontrol" id="metatagcontrol" style="width:100px" onchange="javascript: hideAdminMetaTags(this);">
				<option value="0" <?php echo ($JSecureConfig->metatagcontrol == 0)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_NO'); ?></option>
				<option value="1" <?php echo ($JSecureConfig->metatagcontrol == 1)?"selected":''; ?>><?php echo JText::_('COM_JSECURE_YES'); ?></option>
			</select>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MTEATAGCONTROL_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>	
		</td>
	</tr>
   <tr id="tag_generator">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('METATAG_GENERATOR'); ?>">
					<?php echo JText::_('METATAG_GENERATOR'); ?>
			</span>
		</td>
		<td class="paramlist_value">
			<textarea name="metatag_generator" ><?php echo $JSecureConfig->metatag_generator;?></textarea>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('METATAGGENERATOR_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>			
	</tr>
	<tr id="tag_keywords">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('METATAG_KEYWORD'); ?>">
					<?php echo JText::_('METATAG_KEYWORD'); ?>
			</span>
		</td>
		<td class="paramlist_value">
			<textarea name="metatag_keywords" ><?php echo $JSecureConfig->metatag_keywords;?></textarea>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('METATAGKEYWORDS_DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>			
	</tr>
	<tr id="tag_description">
		<td class="paramlist_key">
			<span class="editlinktip hasTip" title="<?php echo JText::_('METATAG_DESCRIPTION'); ?>">
					<?php echo JText::_('METATAG_DESCRIPTION'); ?>
			</span>
		</td>
		<td class="paramlist_value">
			<textarea name="metatag_description"><?php echo $JSecureConfig->metatag_description;?></textarea>
		</td>
		<td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('METATAGDESCRIPTION__DESCRIPTION'); ?>">
					<img src="templates/bluestork/images/menu/icon-16-info.png" border="0">
				</label>
			</span>
		</td>			
	</tr>
    <tr id="tag_rights">
			<td width="150">
			<span class="editlinktip hasTip" title="<?php echo JText::_('METATAG_RIGHTS'); ?>">
			<?php echo JText::_('METATAG_RIGHTS'); ?></span>
			</td>
			<td><textarea name="metatag_rights" class="textarea" ><?php echo $JSecureConfig->metatag_rights;?></textarea></td>
            <td class="paramlist_description">
			<span class="editlinktip">
				<label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('METATAGRIGHTS_DESCRIPTION'); ?>">
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
<script type="text/javascript">
hideAdminMetaTags(document.getElementById('metatagcontrol'));
</script>

<input type="hidden" name="option" value="com_jsecure"/>


</form>




