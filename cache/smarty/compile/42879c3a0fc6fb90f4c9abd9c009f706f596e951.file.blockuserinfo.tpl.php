<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/modules/blockuserinfo/blockuserinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94031037753ae6fd9afdb03-22420346%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42879c3a0fc6fb90f4c9abd9c009f706f596e951' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blockuserinfo/blockuserinfo.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94031037753ae6fd9afdb03-22420346',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fd9b40ea9_96262914',
  'variables' => 
  array (
    'logged' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'order_process' => 0,
    'cart_qties' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fd9b40ea9_96262914')) {function content_53ae6fd9b40ea9_96262914($_smarty_tpl) {?>

<!-- Block user information module HEADER -->
<section class="blockuserinfo header-box">
	<span class="login-button">
    <?php if ($_smarty_tpl->tpl_vars['logged']->value){?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="logout user-button"><?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
    <?php }else{ ?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Login','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="login user-button" ><?php echo smartyTranslate(array('s'=>'Login','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
    <?php }?>
    </span>
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="user-button user-button-1" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Your Account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
</section>

<section id="header_user" class="blockuserinfo-cart header-box <?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>header_user_catalog<?php }?>">
		<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
		<div id="shopping_cart">
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'View my shopping cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
                <span class="shopping_cart_title"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
                <span class="ajax_cart_quantity" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value==0){?> style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cart_qties']->value;?>
</span>
                <span class="ajax_cart_product_txt<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value!=1){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'Product','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
                <span class="ajax_cart_product_txt_s<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value<2){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'Products','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
                 
                <span class="ajax_cart_no_product" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value>0){?> style="display:none;"<?php }?>><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
                <i class="opancart icon-angle-down"></i>
            </a>
		</div>
		<?php }?>
</section><?php }} ?>