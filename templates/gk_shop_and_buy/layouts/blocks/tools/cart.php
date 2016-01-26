<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// getting user ID
$user = JFactory::getUser();
$userID = $user->get('id');

?>

<?php if($this->API->modules('cart')) : ?>	
<div id="gkPopupCart">	
	<div class="gkPopupWrap">
		<i class="gk-icon-cross"></i>
		<div id="gkAjaxCart"></div>
	</div>
</div>
<?php endif; ?>