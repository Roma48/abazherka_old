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
 * @version     $Id: toolbar.jsecure.php  $
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );
 //if (!jsecureControllerjsecure::isMasterLogged())
		//$task = 'auth'; 

	switch($task) {
		case 'help':
			TOOLBAR_jsecure::_help();
		break;
		case 'directory':
			TOOLBAR_jsecure::_directory();
		break;
		
		case 'auth':
			TOOLBAR_jsecure::_AUTH();
		break;

		case 'log':
			TOOLBAR_jsecure::_LOG();
		break;
        
		case 'adminid':
			TOOLBAR_jsecure::_help();
		break;
		case 'basic':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'ip':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		
		case 'logincontrol':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'pwdprotect':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'mail':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'mastermail':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'keeplog':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'metatags':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		case 'masterpwd':
			TOOLBAR_jsecure::_DEFAULT();
		break;
		default:
			TOOLBAR_jsecure::_HOME();
		break;
	}

?>