<?php

/**
 *
 * @package    acMenuPagePlugin
 * @subpackage plugin
 * @author     Anycode
 * @version    SVN: $Id: acMenuPageCurrentMenu.class.php,v 1.1 2009-11-24 13:21:22 davide Exp $
 */
class acMenuPageCurrentMenu
{
	private static $instance = null;
	private static $route_name = null;
	
	public static function getCurrentRouteName()
	{
		if (self::$route_name == null)
		{
			$route = sfContext::getInstance()->getRouting()->getCurrentInternalUri(true);
			self::$route_name = substr($route, 0, strpos($route, '?'));			
		}
		return self::$route_name;
	}
	
	public static function getInstance()
	{
		if (self::$instance == null)
		{
			// esamina i parametri della request
			$request = sfContext::getInstance()->getRequest();
			$response = sfContext::getInstance()->getResponse();
			
			$slug = $request->getParameter('ac_menu_page_slug');
			$culture = $request->getParameter('sf_culture', sfContext::getInstance()->getUser()->getCulture());
			$route = self::getCurrentRouteName();
	
			if (!$slug)
			{
				// se non c'è lo slug è un'azione symfony
				self::$instance = Doctrine::getTable('acMenu')->findOneByRouteAndCulture($route, $culture);

				if (self::$instance)
				{
					// setta titolo e meta della pagina
					$response->setTitle(self::$instance->getName());
					$response->addMeta('description', self::$instance->getTitle());
					$response->addMeta('language', $request->getParameter('sf_culture', sfCOntext::getInstance()->getUser()->getCulture()));							
				}					
			}
			else
			{
				// se c'è lo slug è una pagina editabile
				self::$instance = Doctrine::getTable('acMenu')->findOneJoinAllBySlugAndCulture($slug, $culture);

				if (self::$instance)
				{
					// setta titolo e meta della pagina
					$response->setTitle(self::$instance->getPage()->getTitle());
					$response->addMeta('description', self::$instance->getPage()->getDescription());
					$response->addMeta('keywords', self::$instance->getPage()->getKeywords());
					$response->addMeta('language', $request->getParameter('sf_culture', sfCOntext::getInstance()->getUser()->getCulture()));							
				}				
			}
		}
      
		return self::$instance;
	}	
}