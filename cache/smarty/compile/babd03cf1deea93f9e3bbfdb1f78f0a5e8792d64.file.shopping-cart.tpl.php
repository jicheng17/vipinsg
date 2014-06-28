<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:09:04
         compiled from "/var/www/vipinsg/themes/theme895/modules/loyalty/shopping-cart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140321027953ae78203f3827-37377363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'babd03cf1deea93f9e3bbfdb1f78f0a5e8792d64' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/loyalty/shopping-cart.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140321027953ae78203f3827-37377363',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'points' => 0,
    'voucher' => 0,
    'guest_checkout' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7820416159_28271653',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7820416159_28271653')) {function content_53ae7820416159_28271653($_smarty_tpl) {?>

<!-- MODULE Loyalty -->
<p id="loyalty">
	<i class="icon-money"></i> 
	<?php if ($_smarty_tpl->tpl_vars['points']->value>0){?>
		<?php echo smartyTranslate(array('s'=>'By checking out this shopping cart you can collect up to','mod'=>'loyalty'),$_smarty_tpl);?>
 <b>
		<?php if ($_smarty_tpl->tpl_vars['points']->value>1){?><?php echo smartyTranslate(array('s'=>'%d loyalty points','sprintf'=>$_smarty_tpl->tpl_vars['points']->value,'mod'=>'loyalty'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d loyalty point','sprintf'=>$_smarty_tpl->tpl_vars['points']->value,'mod'=>'loyalty'),$_smarty_tpl);?>
<?php }?></b>
		<?php echo smartyTranslate(array('s'=>'that can be converted into a voucher of','mod'=>'loyalty'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['voucher']->value),$_smarty_tpl);?>
<?php if (isset($_smarty_tpl->tpl_vars['guest_checkout']->value)&&$_smarty_tpl->tpl_vars['guest_checkout']->value){?><sup>*</sup><?php }?>.<br />
		<?php if (isset($_smarty_tpl->tpl_vars['guest_checkout']->value)&&$_smarty_tpl->tpl_vars['guest_checkout']->value){?><sup>*</sup> <?php echo smartyTranslate(array('s'=>'Not available for Instant checkout order','mod'=>'loyalty'),$_smarty_tpl);?>
<?php }?>
	<?php }else{ ?>
		<?php echo smartyTranslate(array('s'=>'Add some products to your shopping cart to collect some loyalty points.','mod'=>'loyalty'),$_smarty_tpl);?>

	<?php }?>
</p>
<!-- END : MODULE Loyalty --><?php }} ?>