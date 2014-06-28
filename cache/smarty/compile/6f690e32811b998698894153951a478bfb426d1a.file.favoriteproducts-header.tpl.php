<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 14:48:21
         compiled from "/var/www/vipinsg/modules/favoriteproducts/views/templates/hook/favoriteproducts-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136220066553ae65358bf0c2-39082297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f690e32811b998698894153951a478bfb426d1a' => 
    array (
      0 => '/var/www/vipinsg/modules/favoriteproducts/views/templates/hook/favoriteproducts-header.tpl',
      1 => 1403802536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136220066553ae65358bf0c2-39082297',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae653592fd13_96002123',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae653592fd13_96002123')) {function content_53ae653592fd13_96002123($_smarty_tpl) {?>
<script type="text/javascript">
	var favorite_products_url_add = '<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','actions',array('process'=>'add'),true);?>
';
	var favorite_products_url_remove = '<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','actions',array('process'=>'remove'),true);?>
';
<?php if (isset($_GET['id_product'])){?>
	var favorite_products_id_product = '<?php echo intval($_GET['id_product']);?>
';
<?php }?> 
</script>
<?php }} ?>