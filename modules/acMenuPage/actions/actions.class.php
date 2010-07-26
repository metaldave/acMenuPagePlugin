<?php

/**
 * acMenuPage actions.
 *
 * @package    Anycode
 * @subpackage acMenuPage
 * @author     Davide
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class acMenuPageActions extends sfActions
{

	public function executeShowPage(sfWEbRequest $request)
	{
		
		$this->menu = acMenuPageCurrentMenu::getInstance();
		
		if (!$this->menu)
			$this->forward404();
	
		$this->page = $this->menu->getPage();
			
		/*$response = sfContext::getInstance()->getResponse();
		$response->setTitle($this->page->getTitle());
		$response->addMeta('description', $this->page->getDescription());
		$response->addMeta('keywords', $this->page->getKeywords());
		$response->addMeta('language', $request->getParameter('sf_culture', $this->getUser()->getCulture()));		*/
	}
	
	public function executeOldLinks(sfWebRequest $request)
	{
		$url = str_replace($request->getUriPrefix().$request->getPathInfoPrefix(),'',$request->getUri());		
		$menu_old_url = Doctrine::getTable('acMenuOldUrl')->findOneByUrl($url);
		if ($menu_old_url)
		{
			$menu = Doctrine::getTable('acMenu')->findOneByIdAndCulture($menu_old_url->getMenuId(), $menu_old_url->getCulture());			
			if ($menu)
			{
				$this->redirect($request->getPathInfoPrefix().'/'.$menu_old_url->getCulture().'/'.$menu->Translation[$menu_old_url->getCulture()]->ac_menu_page_slug.'.html', 301);
			}
			$this->forward404('pagina non trovata: '.$url);
		}
		
		$this->forward404('url non trovato: '.$url);
	}
}
