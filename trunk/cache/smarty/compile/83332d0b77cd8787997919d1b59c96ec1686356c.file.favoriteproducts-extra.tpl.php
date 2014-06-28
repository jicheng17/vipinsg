<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:08:50
         compiled from "/var/www/vipinsg/themes/theme895/modules/favoriteproducts/favoriteproducts-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97145122853ae7812bf6561-11622304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83332d0b77cd8787997919d1b59c96ec1686356c' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/favoriteproducts/favoriteproducts-extra.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97145122853ae7812bf6561-11622304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isCustomerFavoriteProduct' => 0,
    'isLogged' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7812c18105_92181376',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7812c18105_92181376')) {function content_53ae7812c18105_92181376($_smarty_tpl) {?>

<?php if (!$_smarty_tpl->tpl_vars['isCustomerFavoriteProduct']->value&&$_smarty_tpl->tpl_vars['isLogged']->value){?>
<li id="favoriteproducts_block_extra_add" class="add favorite">
	<i class="icon-heart-empty"></i><?php echo smartyTranslate(array('s'=>'Add this product to my list of favorites.','mod'=>'favoriteproducts'),$_smarty_tpl);?>

</li>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['isCustomerFavoriteProduct']->value&&$_smarty_tpl->tpl_vars['isLogged']->value){?>
<li id="favoriteproducts_block_extra_remove" class="favorite">
	<i class="icon-heart-empty"></i><?php echo smartyTranslate(array('s'=>'Remove this product from my favorite\'s list. ','mod'=>'favoriteproducts'),$_smarty_tpl);?>

</li>
<?php }?>

<li id="favoriteproducts_block_extra_added" class="favorite">
	<i class="icon-heart"></i><?php echo smartyTranslate(array('s'=>'Remove this product from my favorite\'s list. ','mod'=>'favoriteproducts'),$_smarty_tpl);?>

</li>
<li id="favoriteproducts_block_extra_removed" class="favorite">
	<i class="icon-heart-empty"></i><?php echo smartyTranslate(array('s'=>'Add this product to my list of favorites.','mod'=>'favoriteproducts'),$_smarty_tpl);?>

</li><?php }} ?>