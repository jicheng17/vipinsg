<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/modules/blockwishlist/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203338688653ae6fda263d38-82021730%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cec53c655b67061ee220ef14098956b2d6d55a0' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blockwishlist/my-account.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203338688653ae6fda263d38-82021730',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fda26f357_45300121',
  'variables' => 
  array (
    'wishlist_link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fda26f357_45300121')) {function content_53ae6fda26f357_45300121($_smarty_tpl) {?>

<!-- MODULE WishList -->
<li class="lnk_wishlist">
	<a href="<?php echo $_smarty_tpl->tpl_vars['wishlist_link']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><i class="icon-heart-empty"></i><?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</li>
<!-- END : MODULE WishList --><?php }} ?>