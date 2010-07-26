<?php

/**
 * acMenuPagePluginConfiguration configuration.
 * 
 * @package    acMenuPagePlugin
 * @subpackage config
 * @author     Anycode
 * @version    SVN: $Id: acMenuPagePluginConfiguration.class.php,v 1.1 2009-11-24 13:21:07 davide Exp $
 */
class acMenuPagePluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
	public function initialize()
	{
		// routing per i vari moduli
	    foreach (array('acMenuAdmin', 'acPageAdmin', 'acMenuPage') as $module)
	    {
			if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
			{
				$this->dispatcher->connect('routing.load_configuration', array('acMenuPageRouting', 'addRouteFor'.$module));
			}
	    }
	    
	    // controllo della cache per i moduli di admin
	    if (in_array('acMenuAdmin', sfConfig::get('sf_enabled_modules', array())))
	    {
	    	$this->dispatcher->connect('admin.delete_object', array('acMenuPageCaching', 'clearCacheForMenu'));
	    	$this->dispatcher->connect('admin.save_object', array('acMenuPageCaching', 'clearCacheForMenu'));
	    }
	    
	    // js e css per il modulo frontend
	    if (in_array('acMenuPage', sfConfig::get('sf_enabled_modules', array())))
	    {
	    	$this->dispatcher->connect('context.load_factories', array('acMenuPagePluginConfiguration', 'loadJsCss'));	
	    }
	}
	
	public static function loadJsCss($event)
	{
		sfContext::getInstance()->getResponse()->addStylesheet('/acMenuPagePlugin/css/menu.css');
		sfContext::getInstance()->getResponse()->addJavascript(sfConfig::get('app_ac_menu_page_jquery_url'));
	}
}
