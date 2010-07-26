
<div class="ac_menu_page_change_language">
	<?php foreach (sfConfig::get('app_ac_menu_page_languages') as $culture => $language):?>
		<span class="ac_menu_page_language<?php if ($sf_user->getCulture() == $culture) echo ' selected' ?>">
			<?php 
			if ($sf_user->getCulture() == $culture)
			{
				echo $language;
			}
			else
			{
				if (isset($menu) && isset($menu->Translation[$culture]))
				{
					if ($menu->getRoute())
					{
						echo link_to($language, $menu->getRoute().'?sf_culture='.$culture, array('title'=>$menu->Translation[$culture]->title));
					}
					else
					{
						echo link_to($language, '@ac_menu_page_show_page?sf_culture='.$culture.'&ac_menu_page_slug='.$menu->Translation[$culture]->ac_menu_page_slug, array('title'=>$menu->Translation[$culture]->title));
					}
				}
				else
				{
					echo link_to($language, '@homepage?sf_culture='.$culture, array('title'=>'Home'));
				}
			}
			
			?>
		
<?php /*	
			<?php if ($sf_user->getCulture() == $culture): ?>
				<?php echo $language; ?>
			<?php else: ?>
				<?php if (isset($menu)):?>
					<?php if (isset($menu->Translation[$culture])):?>					
						<?php if ($menu->getRoute()): ?>
							<?php echo link_to($language, $menu->getRoute().'?sf_culture='.$culture, array('title'=>$menu->Translation[$culture]->title))?>
						<?php else: ?>
							<?php echo link_to($language, '@ac_menu_page_show_page?sf_culture='.$culture.'&ac_menu_page_slug='.$menu->Translation[$culture]->ac_menu_page_slug, array('title'=>$menu->Translation[$culture]->title)); ?>
						<?php endif ?>
					<?php endif ?>
				<?php else:?>

				<?php endif?>
			<?php endif ?>	
*/?>					
		</span>
	<?php endforeach?>
</div>
