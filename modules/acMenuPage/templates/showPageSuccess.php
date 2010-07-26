<?php use_helper('JavascriptBase')?>
<?php use_javascript('/acMenuPagePlugin/js/prettyPhoto/js/jquery.prettyPhoto.js')?>
<?php use_stylesheet('/acMenuPagePlugin/js/prettyPhoto/css/prettyPhoto.css')?>


<div class="ac_menu_page_content">
	<?php echo $page->getContent(ESC_RAW) ?>
</div>

<?php echo javascript_tag('
	$(document).ready(function(){
			$("a[href*=/uploads/assets/images/]").prettyPhoto();
		});	

')?>