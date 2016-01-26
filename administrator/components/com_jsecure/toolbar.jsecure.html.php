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
 * @version     $Id: toolbar.jsecure.html.php  $
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
class TOOLBAR_jsecure {
			  
	function _help(){
		JToolBarHelper::title( JText::_( 'jSecure Authentication Help' ), 'generic.png' );
		JToolBarHelper::cancel();
	} 
	function _directory(){
		JToolBarHelper::title( JText::_( 'jSecure Authentication Help' ), 'generic.png' );
		JToolBarHelper::cancel();
		
	}
	function _AUTH(){
		JToolBarHelper::title( JText::_( 'jSecure Authentication' ), 'generic.png' );
		JToolBarHelper::preferences('com_jsecure');
	}
	
	function _LOG(){
		JToolBarHelper::title( JText::_( 'jSecure Authentication' ), 'generic.png' );
		JToolBarHelper::cancel();
	}

	function _DEFAULT(){
		$version=  JVERSION;
		 if(substr_compare($version, "1.6", 0, 3)==0)
		 JToolBarHelper::preferences('com_jsecure');
		JToolBarHelper::title( JText::_( 'jSecure Authentication' ), 'generic.png' );
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		JToolBarHelper::custom( 'help', 'help.png', 'help.png', 'Help', false, false );
	}
function _HOME(){
		JToolBarHelper::title( JText::_( 'jSecure Authentication' ), 'generic.png' );
		$version=  JVERSION;
		if(substr_compare($version, "1.6", 0, 3)!=0)
		JToolBarHelper::preferences('com_jsecure');
		
	}
	
}

?>