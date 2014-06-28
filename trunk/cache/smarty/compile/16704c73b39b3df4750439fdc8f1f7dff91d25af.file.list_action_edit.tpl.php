<?php /* Smarty version Smarty-3.1.8, created on 2014-06-27 01:12:55
         compiled from "/var/www/vipinsg/admin_vipinsg/themes/default/template/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160181702553ac54976aba25-77173625%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16704c73b39b3df4750439fdc8f1f7dff91d25af' => 
    array (
      0 => '/var/www/vipinsg/admin_vipinsg/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1403802536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160181702553ac54976aba25-77173625',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ac54976b18c6_94197248',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ac54976b18c6_94197248')) {function content_53ac54976b18c6_94197248($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="edit" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/edit.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>