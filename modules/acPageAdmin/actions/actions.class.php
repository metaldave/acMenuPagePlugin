<?php

require_once dirname(__FILE__).'/../lib/acPageAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/acPageAdminGeneratorHelper.class.php';

/**
 * acPageAdmin actions.
 *
 * @package    Anycode
 * @subpackage acPageAdmin
 * @author     Davide
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class acPageAdminActions extends autoAcPageAdminActions
{
	public function executeNew(sfWebRequest $request)
	{
		$this->form = $this->configuration->getForm();
		$this->ac_page = $this->form->getObject();
		
		if ($request->getParameter('menu_id'))
			$this->form->setDefault('menu_id',$request->getParameter('menu_id'));
	}
	
	public function executeDelete(sfWebRequest $request)
 	{
		$request->checkCSRFProtection();

		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

		try
		{
			if ($this->getRoute()->getObject()->delete())
			{
				$this->getUser()->setFlash('notice', 'The item was deleted successfully.');
			}
 		}
 		catch (Exception $e)
 		{
 			$this->getUser()->setFlash('error', 'La pagina non può essere cancellata perché è collegata ad un menù.');
 		}

		$this->redirect('@ac_page');
	}	
}
