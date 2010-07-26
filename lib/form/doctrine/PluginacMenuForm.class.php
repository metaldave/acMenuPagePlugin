<?php

/**
 * PluginacMenu form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginacMenuForm extends BaseacMenuForm
{
	
	public function setupInheritance()
	{
		$this->useFields(array('route', 'page_id'));
				
		$choices = array_merge(array(''=>''),sfConfig::get('app_ac_menu_page_routes'));
		$this->widgetSchema['route'] = new sfWidgetFormChoice(array('choices'=>$choices));
		$this->validatorSchema['route'] = new sfValidatorChoice(array('choices'=>array_keys($choices), 'required' => false));
		$this->widgetSchema->setLabel('route', 'Azione');
		
		$this->widgetSchema->setLabel('page_id', 'Pagina');
		
		// father, se iempito il nuovo nodo viene inserito come primo figlio del nodoindicato
		$this->widgetSchema['father'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['father'] = new sfValidatorPass();
		
		// brother, se riempito (e father è vuoto) il nuovo nodo viene inserito come prossimo fratello del nodo indicato
		$this->widgetSchema['brother'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['brother'] = new sfValidatorPass();
		
		
		$languaes = sfConfig::get('app_ac_menu_page_languages');
		$this->embedI18n(array_keys($languaes));
		foreach ($languaes as $culture=>$name)
		{
			$this->widgetSchema->setLabel($culture, $name);
		}
		
		$this->widgetSchema->moveField('route',sfWidgetFormSchema::LAST);
		$this->widgetSchema->moveField('page_id',sfWidgetFormSchema::LAST);
	}

	public function doSave($con = null)
	{		
		parent::doSave($con);
		
		if ($this->getValue('father'))
		{
			$father = Doctrine::getTable('acMenu')->find($this->getValue('father'));
			$this->getObject()->getNode()->insertAsLastChildOf($father);
		}
		elseif ($this->getValue('brother'))
		{
			$brother = Doctrine::getTable('acMenu')->find($this->getValue('brother'));
			$this->getObject()->getNode()->insertAsNextSiblingOf($brother);
		}
		elseif ($this->getObject()->isNew())
		{
			throw new Exception('Impossibile creare un elemento senza padre');
		}
	
	}	
}
