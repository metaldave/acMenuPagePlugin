<?php

/**
 * PluginacMenu
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class PluginacMenu extends BaseacMenu
{
	public function __toString()
	{
		return $this->name ? $this->name : 'menù '.$this->tree_name;
	}
	
/*	public function getRoutingRule($culture=null)
	{
		if (!$culture)
			$culture = sfContext::getInstance()->getRequest()->getParameter('sf_culture', sfContext::getInstance()->getUser()->getCulture());
		
		$route = null;
		if ($this->route)
			$route = $this->route;
		elseif ($this->page_id)
			$route = 'ac_menu_page_show_page';
		
		if ($route)
			$route .= '?sf_culutre='.$culture;
			
		return $route;
	}
	*/
	
}