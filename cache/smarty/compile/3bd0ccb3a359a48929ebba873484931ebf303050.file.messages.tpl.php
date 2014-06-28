<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198515943453ae7cccb02da9-77625516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bd0ccb3a359a48929ebba873484931ebf303050' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/messages.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198515943453ae7cccb02da9-77625516',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'text' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7cccb38b16_84758282',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7cccb38b16_84758282')) {function content_53ae7cccb38b16_84758282($_smarty_tpl) {?><div id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
-response" <?php if (!isset($_smarty_tpl->tpl_vars['text']->value)){?>style="display:none;"<?php }?> class="message <?php if (isset($_smarty_tpl->tpl_vars['class']->value)){?><?php echo $_smarty_tpl->tpl_vars['class']->value;?>
<?php }?>">
	<div class="content"><?php if (isset($_smarty_tpl->tpl_vars['text']->value)){?><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
<?php }?></div>
	<span class="close"><i class="icon-remove-circle"></i></span>
</div><?php }} ?>