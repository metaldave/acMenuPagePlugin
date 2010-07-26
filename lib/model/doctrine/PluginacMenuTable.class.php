<?php
/**
 */
class PluginacMenuTable extends Doctrine_Table
{
	public function getQueryForAdmin(Doctrine_Query $q)
	{
		$rootAlias = $q->getRootAlias();
		$q->leftJoin($rootAlias.'.Translation t');
		$q->leftJoin($rootAlias.'.Page p');	
		$q->orderBy($rootAlias.'.tree_name, '.$rootAlias.'.lft');		
		return $q;
	}
	
	public function findOneJoinAllBySlugAndCulture($slug, $culture)
	{
		return $this->createQuery('m')
			->leftJoin('m.Translation mt')		
			->leftJoin('m.Page p')
			->leftJoin('p.Translation pt')		
			->addWhere('mt.ac_menu_page_slug = ?', $slug)
			->addWhere('mt.lang = ?', $culture)
			->addWhere('pt.lang = ?', $culture)
			->fetchOne();		
	} 
	
	public function findOneByRouteAndCulture($route, $culture)
	{
		return $this->createQuery('m')
			->leftJoin('m.Translation mt')		
			->addWhere('m.route = ?', $route)
			->addWhere('mt.lang = ?', $culture)
			->fetchOne();		
	}
	
	public function findOneByIdAndCulture($id, $culture)
	{
		return $this->createQuery('m')
			->leftJoin('m.Translation mt')		
			->addWhere('m.id = ?', $id)
			->addWhere('mt.lang = ?', $culture)
			->fetchOne();		
	}
	
}