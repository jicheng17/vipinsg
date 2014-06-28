<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 14:48:21
         compiled from "/var/www/vipinsg/modules/feeder/feederHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100367955853ae653599e300-80412852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c74c9f8a512af54488d3e6f4e44f7d034ec340f' => 
    array (
      0 => '/var/www/vipinsg/modules/feeder/feederHeader.tpl',
      1 => 1403802536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100367955853ae653599e300-80412852',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'feedUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae65359a9262_30267581',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae65359a9262_30267581')) {function content_53ae65359a9262_30267581($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vipinsg/tools/smarty/plugins/modifier.escape.php';
?>

<link rel="alternate" type="application/rss+xml" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['meta_title']->value, 'html', 'UTF-8');?>
" href="<?php echo $_smarty_tpl->tpl_vars['feedUrl']->value;?>
" /><?php }} ?>