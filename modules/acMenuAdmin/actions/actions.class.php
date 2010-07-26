<?php

require_once dirname(__FILE__).'/../lib/acMenuAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/acMenuAdminGeneratorHelper.class.php';

/**
 * acMenuAdmin actions.
 *
 * @package    Anycode
 * @subpackage acMenuAdmin
 * @author     Davide
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class acMenuAdminActions extends autoAcMenuAdminActions
{
	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

		// va cancellato il nodo e non il record (per non corrompere l'albero)
		if ($this->getRoute()->getObject()->deleteNode())
		{
			$this->getUser()->setFlash('notice', 'Il menù e tutti i suoi sottomenù sono stati eliminati');
		}

		$this->redirect('@ac_menu');
	}
	
	public function executeListEditPage(sfWebRequest $request)
	{
		$menu = $this->getRoute()->getObject();
		if (!$menu)
		{
			$this->getUser()->setFlash('error', 'menu non trovato');
			$this->redirect('@ac_menu');
		}
		
		if ($menu->getRoute())
		{
			$this->getUser()->setFlash('error', 'Il menù "'.$menu.'" è associato ad una pagina NON modificabile');
			$this->redirect('@ac_menu');			
		}
		
		if ($menu->getPageId())
		{
			$this->redirect('@ac_page_edit?id='.$menu->getPageId());
		}
		else
		{
			$this->redirect('@ac_page_new?menu_id='.$menu->getId());
		}		
	}
	
	public function executeListMoveUp(sfWebRequest $request)
	{
		$menu = $this->getRoute()->getObject();
		if (!$menu)
		{
			$this->getUser()->setFlash('error', 'menu non trovato');
			$this->redirect('@ac_menu');
		}
		
		$brother = $menu->getNode()->getPrevSibling();
		if (!$brother)
		{
			$this->getUser()->setFlash('error', 'il menu "'.$menu.'" è già al primo posto');
			$this->redirect('@ac_menu');
		}
		
		$menu->getNode()->moveAsPrevSiblingOf($brother);
		$this->getUser()->setFlash('notice', 'il menu "'.$menu.'" è stato spostato in alto di una posizione');
		$this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $menu)));
		$this->redirect('@ac_menu');
	}	

	public function executeListMoveDown(sfWebRequest $request)
	{
		$menu = $this->getRoute()->getObject();
		if (!$menu)
		{
			$this->getUser()->setFlash('error', 'menu non trovato');
			$this->redirect('@ac_menu');
		}
		
		$brother = $menu->getNode()->getNextSibling();
		if (!$brother)
		{
			$this->getUser()->setFlash('error', 'il menu "'.$menu.'" è già all\'ultimo posto');
			$this->redirect('@ac_menu');
		}
		
		$menu->getNode()->moveAsNextSiblingOf($brother);
		$this->getUser()->setFlash('notice', 'il menu "'.$menu.'" è stato spostato in basso di una posizione');
		$this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $menu)));
		$this->redirect('@ac_menu');
	}
	
	public function executeListAddChildren(sfWebRequest $request)
	{
		// prepara la form (viene creato un oggetto nuovo)
		$this->form = $this->configuration->getForm();
	    $this->ac_menu = $this->form->getObject();
	    	    
	    $this->form->setDefault('father', $request->getParameter('id'));
		
		$this->setTemplate('new');
	}
	
	public function executeChangeCulture(sfWebRequest $request)
	{
		$this->getUser()->setCulture($request->getParameter('sf_culture'));
		$this->redirect('@ac_menu');
	}
	
	public function executeToggleVisible(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		
		if($object)
		{
			$object->setVisible(!$object->getVisible());
			$object->save();
		}
		$this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $object)));
		return $this->renderPartial('acMenuAdmin/visible',array('ac_menu'=>$object));
	}	
		
}
