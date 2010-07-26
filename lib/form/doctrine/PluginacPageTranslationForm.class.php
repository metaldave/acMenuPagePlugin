<?php

/**
 * PluginacPageTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginacPageTranslationForm extends BaseacPageTranslationForm
{
	public function setupInheritance()
	{
		$this->useFields(array('title', 'content', 'description', 'keywords'));

		$this->widgetSchema['title']->setAttribute('size', 80);		
		$this->widgetSchema->setHelp('title', 'Titolo della pagina che compare come titolo della finestra del browser e nei risultati dei motori di ricerca');
		$this->widgetSchema->setLabel('title', 'Titolo');
		
		$this->widgetSchema['description'] = new sfWidgetFormTextarea(array(),array('cols'=>80, 'rows'=>3));
		$this->widgetSchema->setHelp('description', 'Descrizione della pagina per i motori di ricerca');
		$this->widgetSchema->setLabel('description', 'Descrizione');
		
		$this->widgetSchema['keywords']->setAttribute('size', 80);
		$this->widgetSchema->setHelp('keywords', 'Parole chiave per la pagina separate da virgola');

		if (sfConfig::get('app_ac_menu_page_use_ckeditor'))
		{
			//$secret = (isset($_COOKIE['kfm_secret'])) ? $_COOKIE['kfm_secret'] : md5(time());
			//setcookie('kfm_secret',$secret,0,'/');
			$this->widgetSchema['content'] = new sfWidgetFormCKEditor(array('jsoptions'=>array(
													'disableObjectResizing'=>false,
													'width'=>717+50,
													'height'=>400+200,
													//'filebrowserBrowseUrl'=>'/acMenuPagePlugin/js/kfm/index.php?kfm_secret='.$secret													
			))
			);
		}
		else
			$this->widgetSchema['content'] = new sfWidgetFormTextarea(array(),array('cols'=>80, 'rows'=>20));
		
		$this->widgetSchema->setLabel('content', 'Contenuto');
		
		$this->widgetSchema->setFormFormatterName('admin');
	}
}
