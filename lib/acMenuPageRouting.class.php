<?php

/**
 *
 * @package    acMenuPagePlugin
 * @subpackage plugin
 * @author     Anycode
 * @version    SVN: $Id: acMenuPageRouting.class.php,v 1.1 2009-11-24 13:21:22 davide Exp $
 */
class acMenuPageRouting
{
	static public function addRouteForacMenuPage(sfEvent $event)
	{
		$r = $event->getSubject();
		
		$pattern = sfConfig::get('app_ac_menu_page_culture_in_route',true) ? '/:sf_culture' : '';
		$pattern .= '/:ac_menu_page_slug.html';
		
		$r->appendRoute('ac_menu_page_show_page', new sfDoctrineRoute(
			$pattern, // pattern
			array('module' => 'acMenuPage', 'action' => 'showPage'), // defaults
			array('sf_method'=>'get'), //requirements
			array('model'=>'acPage', 'type'=>'object') // options
		));
		
		$r->appendRoute('ac_menu_page_old_links', new sfRoute(
			'/*',
			array('module' => 'acMenuPage', 'action' => 'oldLinks') // defaults
		));
	}

	static public function addRouteForacMenuAdmin(sfEvent $event)
	{
	    $event->getSubject()->prependRoute('ac_menu', new sfDoctrineRouteCollection(array(
	      'name'                => 'ac_menu',
	      'model'               => 'acMenu',
	      'module'              => 'acMenuAdmin',
	      'prefix_path'         => 'acMenuAdmin',
	      'with_wildcard_routes' => true,
	      'requirements'        => array(),
	    )));
		
	    $event->getSubject()->prependRoute('ac_menu_change_culture', new sfRoute(
	    	'/acMenuAdmin/changeCulture/:sf_culture',
	    	array('module'=>'acMenuAdmin', 'action'=>'changeCulture')
	    ));
	}
	
	static public function addRouteForacPageAdmin(sfEvent $event)
	{
	    $event->getSubject()->prependRoute('ac_page', new sfDoctrineRouteCollection(array(
	      'name'                => 'ac_page',
	      'model'               => 'acPage',
	      'module'              => 'acPageAdmin',
	      'prefix_path'         => 'acPageAdmin',
	      'with_wildcard_routes' => true,
	      'requirements'        => array(),
	    )));

	}	
}