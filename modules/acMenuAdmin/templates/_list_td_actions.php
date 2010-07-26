<?php 
	$no_edit      = $ac_menu->getLevel()==0;
	$no_edit_page = $ac_menu->getLevel()==0 || $ac_menu->getRoute();
	$no_move_up   = $ac_menu->getLevel()==0 || !$ac_menu->getNode()->getPrevSibling();
	$no_move_down = $ac_menu->getLevel()==0 || !$ac_menu->getNode()->getNextSibling();
	$no_delete    = $ac_menu->getLevel()==0;
?>

<td>
	<ul class="sf_admin_td_actions">
		<span class="<?php if ($no_edit) echo 'hide'; ?>">
			<?php echo $helper->linkToEdit($ac_menu, array(  'label' => 'Modifica menù',  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
		</span>
		<li class="sf_admin_action_editpage <?php if ($no_edit_page) echo 'hide'; ?>">
			<?php echo link_to(__('Modifica pagina', array(), 'messages'), 'acMenuAdmin/ListEditPage?id='.$ac_menu->getId(), array()) ?>
		</li>
		<span class="<?php if ($no_delete) echo 'hide'; ?>">
			<?php echo $helper->linkToDelete($ac_menu, array(  'label' => 'Elimina',  'confirm' => 'Sicuro di voler eliminare questo menù e tutti i suoi menù figli?\\n(le pagine collegate non verranno eliminate)\\nL\'operazione non potrà essere annullata!',  'params' =>   array(  ),  'class_suffix' => 'delete',)) ?>
		</span>
		<li class="sf_admin_action_moveup <?php if ($no_move_up) echo 'hide'; ?>">
			<?php echo link_to(__('Su', array(), 'messages'), 'acMenuAdmin/ListMoveUp?id='.$ac_menu->getId(), array()) ?>
		</li>
		<li class="sf_admin_action_movedown <?php if ($no_move_down) echo 'hide'; ?>">
			<?php echo link_to(__('Giù', array(), 'messages'), 'acMenuAdmin/ListMoveDown?id='.$ac_menu->getId(), array()) ?>
		</li>
		<li class="sf_admin_action_addchildren">
			<?php echo link_to(__('Sottomenu', array(), 'messages').' di '.$ac_menu, 'acMenuAdmin/ListAddChildren?id='.$ac_menu->getId(), array()) ?>
		</li>
	</ul>
</td>
