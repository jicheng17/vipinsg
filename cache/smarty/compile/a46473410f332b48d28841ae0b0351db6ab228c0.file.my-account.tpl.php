<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/modules/loyalty/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:76580132453ae6fda257781-04320088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a46473410f332b48d28841ae0b0351db6ab228c0' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/loyalty/my-account.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76580132453ae6fda257781-04320088',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fda262010_28187869',
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fda262010_28187869')) {function content_53ae6fda262010_28187869($_smarty_tpl) {?>

<!-- MODULE Loyalty -->
<li class="loyalty"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('loyalty','default',array('process'=>'summary')), ENT_QUOTES, 'UTF-8');?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'My loyalty points','mod'=>'loyalty'),$_smarty_tpl);?>
"><i class="icon-money"></i> <?php echo smartyTranslate(array('s'=>'My loyalty points','mod'=>'loyalty'),$_smarty_tpl);?>
</a></li>
<!-- END : MODULE Loyalty --><?php }} ?>