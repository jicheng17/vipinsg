<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/modules/favoriteproducts/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14152036153ae6fda234189-69955673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '849d67d83c43228932f8313faaceedcddb4e663c' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/favoriteproducts/my-account.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14152036153ae6fda234189-69955673',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fda240e81_16756736',
  'variables' => 
  array (
    'link' => 0,
    'in_footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fda240e81_16756736')) {function content_53ae6fda240e81_16756736($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vipinsg/tools/smarty/plugins/modifier.escape.php';
?>

<li class="favoriteproducts">
	<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','account'), 'htmlall', 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'My favorite products.','mod'=>'favoriteproducts'),$_smarty_tpl);?>
">
		<?php if (!$_smarty_tpl->tpl_vars['in_footer']->value){?><i class="icon-heart"></i><?php }?>
		<?php echo smartyTranslate(array('s'=>'My favorite products.','mod'=>'favoriteproducts'),$_smarty_tpl);?>

	</a>
</li>
<?php }} ?>