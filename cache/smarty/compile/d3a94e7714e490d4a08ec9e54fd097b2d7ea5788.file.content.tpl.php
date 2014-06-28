<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:36:10
         compiled from "/var/www/vipinsg/admin_vipinsg/themes/default/template/controllers/cms_content/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133116358753ae7e7ae016b1-70405232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3a94e7714e490d4a08ec9e54fd097b2d7ea5788' => 
    array (
      0 => '/var/www/vipinsg/admin_vipinsg/themes/default/template/controllers/cms_content/content.tpl',
      1 => 1403802536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133116358753ae7e7ae016b1-70405232',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cms_breadcrumb' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7e7ae71b34_71020180',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7e7ae71b34_71020180')) {function content_53ae7e7ae71b34_71020180($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['cms_breadcrumb']->value)){?>
	<div class="cat_bar">
		<span style="color: #3C8534;"><?php echo smartyTranslate(array('s'=>'Current category'),$_smarty_tpl);?>
 :</span>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['cms_breadcrumb']->value;?>

	</div>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }} ?>