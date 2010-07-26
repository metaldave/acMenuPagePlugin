<?php
/*
 * partial che stampa il link di un menu
 * parametro: $menu_item (di classe acMenu)
 */

	$a_attributes = $menu_item->getTitle() ? array('title'=>$menu_item->getTitle()) : null;
	if ($menu_item->getRoute())
	{			
		echo link_to($menu_item->getName(), $menu_item->getRoute(), $a_attributes);
		//echo link_to($menu_item->getName(), 'ac_menu_page_show_page', $menu_item, $a_attributes);
	}
	elseif ($menu_item->getPageId())
	{
		echo link_to($menu_item->getName(), 'ac_menu_page_show_page', $menu_item, $a_attributes);
	}
	else
	{
		echo '<a>'.$menu_item->getName().'</a>';
	}

?>