<div class="<?php echo $class ?>">
	<?php 
	foreach ($tree as $node)
	{	
		if (!isset($level))
		{
			$level = $node->getLevel()+1;
			echo '<ul id="ac_menu_'.$node->getTreeName().'" class="level_0">';
		}
		else
		{
			// chiude i tag <ul> o <li> precedentemente aperti
			$diff = $node->getLevel() - $level;
			$tag = ($diff>0)? '<ul>' : '</ul></li>'; 
			for ($i=0; $i<abs($diff); $i++)
			{
				echo $tag;
			}
			
				
			// apre il <li> e stampa il link (il partial)
			if ($node->getNode()->hasChildren())
				$li_attributes = ' id="menu_'.$node->getId().'" class="level_'.$node->getLevel().' more"';
			else	
				$li_attributes = ' id="menu_'.$node->getId().'" class="level_'.$node->getLevel().'"';
			
			echo "<li$li_attributes>";			
			include_partial('acMenuPage/menuItem', array('menu_item'=>$node));
			
			// se non ha figli chiudo il <li>
			if (!$node->getNode()->hasChildren())
				echo '</li>';
			
			$level = $node->getLevel();
		}		
	}
	if (count($tree))
		echo '</ul>';
	?>
</div>