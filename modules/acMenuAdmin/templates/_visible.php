<?php $object = $ac_menu ?>
<?php $field_name = 'Visible' ?>
<?php $route_name = 'ac_menu_object' ?>
<?php $route_name_params = '?action=toggleVisible&id='.$object->getId() ?>

<?php if (!$sf_request->isXmlHttpRequest()) echo '<span id="'.$route_name.$object->getId().'">'; ?>

    <?php $image = call_user_func(array($object, 'get'.$field_name)) ? '/sf/sf_admin/images/save.png' : '/sf/sf_admin/images/cancel.png'; ?>

    <a href="#" onCLick="$('#img<?php echo $route_name.$object->getId() ?>').attr('src','/images/admin/ajax-loader.gif'); $('#<?php echo $route_name.$object->getId() ?>').load('<?php echo url_for('@'.$route_name.$route_name_params) ?>'); return false;">
        <?php echo image_tag($image, array('id'=>'img'.$route_name.$object->getId())); ?>
    </a>

<?php if (!$sf_request->isXmlHttpRequest()) echo '</span>'; ?>