<?php

/**
 *
 * @package    acMenuPagePlugin
 * @subpackage plugin
 * @author     Anycode
 * @version    SVN: $Id: acMenuPageCaching.class.php,v 1.1 2009-11-24 13:21:22 davide Exp $
 */
class acMenuPageCaching
{
	public static function clearCacheForMenu($event)
	{
		// recupera il parametro 'object'
		$params = $event->getParameters();
		if (isset($params['object']))
		{
			$menu = $params['object'];
			// se 'object' è un acMenu salvato o cancellato
			if ('acMenu'==get_class($menu))			
			{
				// cancella la cache dei menu
				$frontend_cache_dir = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'frontend';
				$cache = new sfFileCache(array('cache_dir' => $frontend_cache_dir)); // Use the same settings as the ones defined in the frontend factories.yml			
				$cache->removePattern('/*/template/*/all/sf_cache_partial/acMenuPage/_showMenu/sf_cache_key/*');				
				$cache->removePattern('/*/template/*/all/sf_cache_partial/acMenuPage/_breadcrumb/sf_cache_key/'.$menu->getId().'_*');				
				$cache->removePattern('/*/template/*/all/sf_cache_partial/acMenuPage/_changeLanguage/sf_cache_key/'.$menu->getId().'_*');				
			}
		}		
	} 
}
