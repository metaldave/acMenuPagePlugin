<?php if (isset($menu) && $menu):?>
	<?php use_helper('I18N') ?>

	<div class="ac_menu_page_breadcrumb">
		<span class="breadcrumb_message">
			<?php echo __('ac_menu_page_breadcrumb_message', null, 'ac_menu_page') ?>
		</span>
		
		<?php $first_item = true ?>
		<?php // pagina home (se c'è) ?>
		<?php if (sfConfig::get('app_ac_menu_page_breadcrumb_home_text') && $route != '@homepage'):?>
			<span class="breadcrumb_item">
				<?php echo link_to(sfConfig::get('app_ac_menu_page_breadcrumb_home_text'), '@homepage') ?>
				<?php $first_item = false ?>
			</span>
		<?php endif?>	
		
		<?php // link ai padri ?>
		<?php if ($ancestors = $menu->getNode()->getAncestors()): ?>
			<?php foreach ($ancestors as $ancestor):?>
				<?php if(!$first_item):?>
					<span class="breadcrumb_separator"><?php echo sfConfig::get('app_ac_menu_page_breadcrumb_separator');?></span>
				<?php endif?>
				<span class="breadcrumb_item">
					<?php include_partial('acMenuPage/menuItem', array('menu_item'=>$ancestor)); ?>
					<?php $first_item = false ?>
				</span> 			
			<?php endforeach ?>
		<?php endif ?>
		
		<?php // pagina corrente ?>
		<?php if(!$first_item):?>
			<span class="breadcrumb_separator"><?php echo sfConfig::get('app_ac_menu_page_breadcrumb_separator');?></span>
		<?php endif?>
		<span class="breadcrumb_item">
			<?php echo $menu->getName() ?>
		</span>
	</div>

<?php endif ?>

