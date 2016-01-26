<?php

// No direct access.
defined('_JEXEC') or die;

?>

<footer id="gkFooter" class="gkPage">
	<?php if($this->API->modules('footer_nav')) : ?>
	<div id="gkFooterNav">
		<jdoc:include type="modules" name="footer_nav" style="<?php echo $this->module_styles['footer_nav']; ?>" modnum="<?php echo $this->API->modules('footer_nav'); ?>" />
	</div>
	<?php endif; ?>

	<?php if($this->API->get('#', '') !== '') : ?>
	<p id="gkCopyrights"><?php echo $this->API->get('#', ''); ?></p>
	<?php else : ?>
	<p id="gkCopyrights">Copyright 2014 C Abazherka || All rights reserved</p>
	<?php endif; ?>

</footer>
