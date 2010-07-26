<?php use_stylesheet('/acMenuPagePlugin/css/admin.css') ?>

<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0">
      <thead>
      	<tr>
      		<th>Menu</th>
      		<th>Visibile</th>
      		<th>Azione / Pagina</th>
      		<th>Azioni</th>
      	</tr>
      </thead>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $ac_menu): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row ac_admin_menu_row <?php echo $odd ?> <?php if ($ac_menu->getLevel()==0) echo 'menu_root_name' ?>">
          	<td>
          		<span class="nome_menu">
	          		<?php if ($ac_menu->getLevel()==0): ?>
	          			menù <?php echo $ac_menu->getTreeName() ?>
	          		<?php else: ?>
	          			<?php echo str_repeat('&nbsp;',$ac_menu->getLevel()*5).image_tag('/acMenuPagePlugin/images/ramo.png').$ac_menu->getName() ?>
	          		<?php endif ?>
	          		&nbsp;&nbsp;&nbsp;
          		</span>
          	</td>
          	<td>
          		<?php if ($ac_menu->getLevel()>0): ?>
          			<?php include_partial('acMenuAdmin/visible', array('ac_menu' => $ac_menu))?>
          		<?php endif?>
          	</td>
          	<td>
          		<?php echo $ac_menu->getRoute() ? $ac_menu->getRoute() : $ac_menu->getPage();  ?>
          		<?php if ($ac_menu->getRoute()) echo image_tag('/acMenuPagePlugin/images/locked.png', array('title'=>'Questo menù è associato ad una pagina NON modificabile')) ?>
          		<?php if ($ac_menu->getLevel()>0 && !$ac_menu->getRoute() && !$ac_menu->getPageId()) echo image_tag('/acMenuPagePlugin/images/no-page.png', array('title'=>'Questo menù non è associato a nessuna pagina')) ?>
          		&nbsp;&nbsp;&nbsp;
          	</td>
         	<?php include_partial('acMenuAdmin/list_td_actions', array('ac_menu' => $ac_menu, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>  
  <?php endif; ?>  
</div>