<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:08:50
         compiled from "/var/www/vipinsg/themes/theme895/modules/blocksharefb/blocksharefb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151579808453ae7812be1b28-28091402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9f8073266327da97073d33c08e605bb364a5149' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blocksharefb/blocksharefb.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151579808453ae7812be1b28-28091402',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_link' => 0,
    'product_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7812be8625_40790385',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7812be8625_40790385')) {function content_53ae7812be8625_40790385($_smarty_tpl) {?>
<li id="left_share_fb">
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $_smarty_tpl->tpl_vars['product_link']->value;?>
&amp;t=<?php echo $_smarty_tpl->tpl_vars['product_title']->value;?>
" class="js-new-window"><i class="icon-facebook-sign"></i><?php echo smartyTranslate(array('s'=>'Share on Facebook','mod'=>'blocksharefb'),$_smarty_tpl);?>
</a>
</li><?php }} ?>