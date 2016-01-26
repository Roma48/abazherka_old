<style>
.tip-wrap { z-index:100; }
</style>
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
JHTML::_('behavior.mootools');
JHTML::_('script','system/modal.js', false, true);
JHTML::_('stylesheet','system/modal.css', array(), true);

$document =& JFactory::getDocument();
$document->addCustomTag('<script language="javascript" type="text/javascript" src="components/com_jsecure/js/auth.js"></script>');
$document->addCustomTag('<link rel="stylesheet" type="text/css" href="components/com_jsecure/css/styles.css" />');
 $document->addScriptDeclaration("window.onload = function(){showUpdates();}
");
$JSecureConfig = $this->JSecureConfig;
?>
<script type="text/javascript">
function show_confirm()
{
<?php
if(!($JSecureConfig->enableMasterPassword == '1' and !jsecureControllerjsecure::isMasterLogged() and $JSecureConfig->include_purgesessions == '1'))
{
?>
  if(confirm("<?php echo JText::_('CONFIRM_PURGE_SESSION'); ?>"))
	  return true;
  else
	  return false;
<?php
}
else
	{?>
	alert("Please enter master password");
	return false;
<?php }
?>	  
}
</script>
<?php
if($JSecureConfig->enableMasterPassword == '1' and !jsecureControllerjsecure::isMasterLogged())
{
?>
<form action="index.php" method="post" name="adminForm" autocomplete="off" class="masterpassfrm">
	<table class="adminlist" cellspacing="0" style="border-spacing:0">
		<tr>
			<td width="105"><?php echo JText::_('MASTER_PASSWORD'); ?></td>
			<td><input type="password" name="master_password" class="textarea" value="" size="50" /></td>
		</tr>
		<tr>
        	<td></td>
			<td><input type="submit" name="" value="<?php echo JText::_('JSECURE_LOGIN'); ?>" /></td>
		</tr>
	</table>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="option" value="com_jsecure" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="view" value="auth" />
</form>
<?php
}
?>
<table class="adminform">
  <tbody>
    <tr>
      <td width="50%" valign="top"><table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
            <td><h2><?php echo JText::_('SECURITY'); ?></h2>
               <div id="cpanel">
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=basic"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('BASIC_DESCRIPTION'); ?>"><img src="components/com_jsecure/images/bc-icon.png" border="0" /></label><span style="font-size:11px;"><?php echo JText::_( 'COM_JSECURE_BASIC' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=ip"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('IP_DESC'); ?>"><img src="components/com_jsecure/images/ip-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'IP_CONFIG' ); ?></span></a> </div>
                </div>

                
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=masterpwd"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MP_DESC'); ?>"><img src="components/com_jsecure/images/mp-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'MASTER_PASSWORD' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=logincontrol"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MLC_DESC'); ?>"><img src="components/com_jsecure/images/mlc-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'LOGIN_CONTROL' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=pwdprotect"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('PPWD_DESC'); ?>"><img src="components/com_jsecure/images/app-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'ADMIN_PASSWORD_PROT' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=directory"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('DIR_DESC'); ?>"><img src="components/com_jsecure/images/dl-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'COM_JSECURE_DIRECTORIES' ); ?></span></a> </div>
                </div>
				
              </div></td>
          </tr>
          <tr>
            <td><h2><?php echo JText::_('TOOLS'); ?></h2>
                <div id="cpanel">
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=mail"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MAIL_DESC'); ?>"><img src="components/com_jsecure/images/m-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'MAIL_CONFIG' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=mastermail"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MMAIL_DESC'); ?>"><img src="components/com_jsecure/images/mm-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'EMAIL_MASTER' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=adminid"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('AID_DESC'); ?>"><img src="components/com_jsecure/images/said-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'SUPER_ADMIN_ID' ); ?></span></a> </div>
                </div>
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=keeplog"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('KLOG_DESC'); ?>"><img src="components/com_jsecure/images/l-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'LOG' ); ?></span></a> </div>
                </div>
               <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=log"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('LOG_DESC'); ?>"><img src="components/com_jsecure/images/vl-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'COM_JSECURE_LOG' ); ?></span></a> </div>
                </div>
                 <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=metatags"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('MT_DESC'); ?>"><img src="components/com_jsecure/images/mtc-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'META_TAG_CONTROL' ); ?></span></a> </div>
                </div>
				
                <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=purgesessions" onclick="return show_confirm();"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('PS_DESC'); ?>"><img src="components/com_jsecure/images/ps-icon.png" border="0"/></label><span style="font-size:11px;"><?php echo JText::_( 'PURGE_SESSION' ); ?></span></a> </div>
                </div>

               
              </div></td>
          </tr>
          <tr><td><h2><?php echo JText::_('HELP'); ?></h2>
               <div id="cpanel">
                 <div style="float:left;">
                  <div class="icon"> <a href="index.php?option=com_jsecure&task=help"><label id="paramsshowAllChildren-lbl" for="paramsshowAllChildren" class="hasTip" title="<?php echo JText::_('HELP_DESC'); ?>"><img src="components/com_jsecure/images/h-icon.png" border="0"/><span style="font-size:11px;"></label><?php echo JText::_( 'COM_JSECURE_HELP' ); ?></span></a> </div>
                </div>
                </div>  
                </td>
          </tr>
        </table></td>
        <td valign="top" width="25%"> 
		<table cellpadding="4" cellspacing="0" border="1" class="adminform">
			
			<tr class="row0">
				<th colspan="2"  style="background-color:#FFF;">
						<div style="float:left;">
						<a href="http://www.joomlaserviceprovider.com" title="Joomla Service Provider" target="_blank"><img src="components/com_jsecure/images/logo.jpg" alt="Joomla Service Provider" border="none"/></a></div>
						<div style="text-align:center;margin-top:25px;"><h3><?php echo JText::_( 'jSecure Authentication' ); ?></h3></div>
						
				</th>
			</tr>
			<tr class="row1">
				<td width="100"><?php echo JText::_( 'VERSION_TEXT' ); ?></td>
				<td><?php echo JText::_( 'VERSION_DESCRIPTION' ); ?></td>
			</tr>
			<tr class="row2">
				<td><?php echo JText::_( 'SUPPORT' ); ?></td>
				<td><a href="http://www.joomlaserviceprovider.com/component/kunena/5-jsecure-authentication.html" target="_blank"><?php echo JText::_( 'JSECURE_AUTHENTICATION_FORUM' ); ?></a></td>
			</tr>
			<tr>
          <td><?php echo JText::_( 'UPDATES' ); ?></td>
         <td>
		 	<div id="image" name="image"><img src="components/com_jsecure/images/sh-ajax-loader-wide.gif" /></div>
		 	<div id="version"></div>
		  	<button id="chkupdates" class="btn btn-small" onclick="showUpdates();" href="#">Check For Update</button>	 
		</td>
        </tr>
		
		<tr id="show_notes">
          <td><?php echo JText::_( 'NOTES' ); ?></td>
          <td><div id="notes"></div></td>
        </tr>
		</table>
	</td>
    </tr>
  </tbody>
</table>