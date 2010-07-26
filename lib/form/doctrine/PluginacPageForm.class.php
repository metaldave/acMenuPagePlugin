<?php

/**
 * PluginacPage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginacPageForm extends BaseacPageForm
{
	public function setupInheritance()
	{
		$this->widgetSchema->setLabel('internal_name', 'Nome interno');
		$this->widgetSchema->setHelp('internal_name', 'non visibile nel sito, è usato per associare la pagina alle voci di menù');
		
		$this->widgetSchema['menu_id'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['menu_id'] = new sfValidatorPass();
				
		$languaes = sfConfig::get('app_ac_menu_page_languages');
		$this->embedI18n(array_keys($languaes));
		foreach ($languaes as $culture=>$name)
		{
			$this->widgetSchema->setLabel($culture, $name);
		}		
	}
	
	protected function doSave($con = null)
	{
		parent::doSave($con);
		
		if ($menu_id = $this->getValue('menu_id'))
		{
			$page_id = $this->getObject()->getId();
			if ($menu = Doctrine::getTable('acMenu')->find($menu_id))
			{
				$menu->setPageId($page_id);
				$menu->save();
				sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'admin.save_object', array('object' => $menu)));
			}			
		}		
	}
}
