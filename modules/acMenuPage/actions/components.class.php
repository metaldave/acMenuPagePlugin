<?php

/**
 * acMenuPage components.
 *
 * @package    Anycode
 * @subpackage acMenuPage
 * @author     Davide
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class acMenuPageComponents extends sfComponents
{
	public function executeShowMenu()	
	{		
		$q =  Doctrine_Query::Create()
				->select('m.*, t.*')
				->from('acMenu m')
				->leftJoin('m.Translation t')
				->addWhere('m.visible = ?', true);
		
		$treeObject = Doctrine::getTable('acMenu')->getTree();
		$treeObject->setBaseQuery($q);
				
		$options = array();
		if (isset($this->root_id))
		{
	  		$options['root_id'] = $this->root_id;  			
		}
		
		$this->tree = $treeObject->fetchTree($options);					
	}
	
	public function executeSelectCurrentMenu()
	{
		$this->menu = acMenuPageCurrentMenu::getInstance();
	}
	
	public function executeBreadcrumb()
	{
		if (sfConfig::get('app_ac_menu_page_breadcrumb'))
		{	
			$this->menu = acMenuPageCurrentMenu::getInstance();
			$this->route = acMenuPageCurrentMenu::getCurrentRouteName();
			
			$q = Doctrine_Query::Create()
				->select('m.*, t.*')
				->from('acMenu m')
				->leftJoin('m.Translation t')
				->addWhere('t.lang = ?', sfContext::getInstance()->getRequest()->getParameter('sf_culture', sfContext::getInstance()->getUser()->getCulture()));
			Doctrine::getTable('acMenu')->getTree()->setBaseQuery($q);
			
		}
	}
	
	public function executeChangeLanguage()
	{
		$languages = sfConfig::get('app_ac_menu_page_languages');
		$current_menu = acMenuPageCurrentMenu::getInstance();
		
		if ($current_menu)
		{
		 	// carica tutte le lingue di questo menù (per trovarne gli url)
		 	$menu_with_translations = Doctrine::getTable('acMenu')
		 		->createQuery('m')
		 		->leftJoin('m.Translation t')
		 		->addWhere('m.id = ?', $current_menu->getId())
		 		->execute();
	
		 	$this->menu = $menu_with_translations[0];
		}
	}
	
}
