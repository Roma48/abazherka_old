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
 * @version     $Id: admin.jsecure.php  $
 */
// no direct access
defined('_JEXEC') or die('Restricted Access');
/*JSubMenuHelper::addEntry(JText::_('COM_JSECURE_BASIC'), 'index.php?option=com_jsecure&task=basic',false);
JSubMenuHelper::addEntry(JText::_('MAIL_CONFIG'), 'index.php?option=com_jsecure&task=mail',false);
JSubMenuHelper::addEntry(JText::_('IP_CONFIG'), 'index.php?option=com_jsecure&task=ip',false);
JSubMenuHelper::addEntry(JText::_('MASTER_PASSWORD'), 'index.php?option=com_jsecure&task=masterpwd',false);
JSubMenuHelper::addEntry(JText::_('EMAIL_MASTER'), 'index.php?option=com_jsecure&task=mastermail',false);
JSubMenuHelper::addEntry(JText::_('LOG'), 'index.php?option=com_jsecure&task=keeplog',false);
JSubMenuHelper::addEntry(JText::_('LOGIN_CONTROL'), 'index.php?option=com_jsecure&task=logincontrol',false);
JSubMenuHelper::addEntry(JText::_('SUPER_ADMIN_ID'), 'index.php?option=com_jsecure&task=adminid',false);
JSubMenuHelper::addEntry(JText::_('META_TAG_CONTROL'), 'index.php?option=com_jsecure&task=metatags',false);
JSubMenuHelper::addEntry(JText::_('ADMIN_PASSWORD_PROT'), 'index.php?option=com_jsecure&task=pwdprotect',false);
JSubMenuHelper::addEntry(JText::_('COM_JSECURE_LOG'), 'index.php?option=com_jsecure&task=log',false);
JSubMenuHelper::addEntry(JText::_('COM_JSECURE_DIRECTORIES'), 'index.php?option=com_jsecure&task=directory',false);
JSubMenuHelper::addEntry(JText::_('COM_JSECURE_HELP'), 'index.php?option=com_jsecure&task=help',false);*/
// Require the base controller
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'controller.php');

if (!JFactory::getUser()->authorise('core.manage', 'com_jsecure')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::base()."components/com_jsecure/css/jsecure.css");
$task	= JRequest::getCmd('task');

// Create the controller
$controller    = new jsecureControllerjsecure();


// Perform the Request task
if (!jsecureControllerjsecure::isMasterLogged())
{	
	if (JRequest::getCmd('task') == 'login')
		$controller->execute('login');
	else 
		$controller->execute($task);
}
else
	$controller->execute($task);

// Redirect if set by the controller
$controller->redirect();

?>