<?php if ($menu):?>
	
	<?php use_helper('JavascriptBase')?>
	
	<?php javascript_tag() ?>
		$(document).ready(function() 
			{
				$('#menu_<?php echo $menu->getId()?>').addClass('selected');
				$('#menu_<?php echo $menu->getId()?>').parentsUntil('.level_0').addClass('selected');
			});
	<?php end_javascript_tag() ?> 
<?php endif?>