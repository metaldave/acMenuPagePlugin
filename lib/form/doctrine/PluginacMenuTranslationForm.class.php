<?php

/**
 * PluginacMenuTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginacMenuTranslationForm extends BaseacMenuTranslationForm
{
	public function setupInheritance()
	{
		$this->useFields(array('name', 'title'));
		
		$this->widgetSchema['name']->setAttribute('size', 20);
		$this->widgetSchema->setHelp('name', 'Voce visualizzata nel menù');
		$this->widgetSchema->setLabel('name', 'Nome');
		
		$this->widgetSchema['title']->setAttribute('size', 80);
		$this->widgetSchema->setHelp('title', 'Viene visualizzata come tooltip quando ci si ferma col mouse sulla voce di menù');
		$this->widgetSchema->setLabel('title', 'Titolo');
		
		$this->widgetSchema->setFormFormatterName('admin');
		
	}
}
