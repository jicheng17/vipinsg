<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:36:10
         compiled from "/var/www/vipinsg/admin_vipinsg/themes/default/template/helpers/list/list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63379438353ae7e7ad74007-71727434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '554547364707964df16ce7bdfac291fd2cf0ae44' => 
    array (
      0 => '/var/www/vipinsg/admin_vipinsg/themes/default/template/helpers/list/list_action_view.tpl',
      1 => 1403802536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63379438353ae7e7ad74007-71727434',
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
  'unifunc' => 'content_53ae7e7adedd76_74409922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7e7adedd76_74409922')) {function content_53ae7e7adedd76_74409922($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<img src="../img/admin/details.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>