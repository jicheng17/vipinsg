<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/modules/addsharethis/addsharethis_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:99545830653ae6fd99c31f9-15666167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f381d821dc754718a1657091c98f8c718eaca14' => 
    array (
      0 => '/var/www/vipinsg/modules/addsharethis/addsharethis_header.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99545830653ae6fd99c31f9-15666167',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fd99ca381_03123898',
  'variables' => 
  array (
    'product' => 0,
    'cover' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fd99ca381_03123898')) {function content_53ae6fd99ca381_03123898($_smarty_tpl) {?><meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['cover']->value['id_image'],'large_default');?>
" />

<?php }} ?>