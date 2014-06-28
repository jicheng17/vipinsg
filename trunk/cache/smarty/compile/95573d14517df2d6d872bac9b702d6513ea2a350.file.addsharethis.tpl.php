<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:08:50
         compiled from "/var/www/vipinsg/modules/addsharethis/addsharethis.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176293403953ae7812cc0c21-35971138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95573d14517df2d6d872bac9b702d6513ea2a350' => 
    array (
      0 => '/var/www/vipinsg/modules/addsharethis/addsharethis.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176293403953ae7812cc0c21-35971138',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
    'addsharethis_data' => 0,
    'conf_row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7812cf3df0_23991027',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7812cf3df0_23991027')) {function content_53ae7812cf3df0_23991027($_smarty_tpl) {?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
css/addsharethis.css"/>
<?php if (isset($_smarty_tpl->tpl_vars['addsharethis_data']->value)){?>
<div id="ShareDiv" class="addsharethis">
<div class="addsharethisinner">
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    
    <script type="text/javascript">stLight.options({publisher: "<?php echo $_smarty_tpl->tpl_vars['conf_row']->value;?>
", nativeCount:true });</script>
    
	<?php if (isset($_smarty_tpl->tpl_vars['addsharethis_data']->value['twitter'])){?>
		<?php echo $_smarty_tpl->tpl_vars['addsharethis_data']->value['twitter'];?>

	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['addsharethis_data']->value['google'])){?>
		<?php echo $_smarty_tpl->tpl_vars['addsharethis_data']->value['google'];?>

	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['addsharethis_data']->value['pinterest'])){?>
		<?php echo $_smarty_tpl->tpl_vars['addsharethis_data']->value['pinterest'];?>

	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['addsharethis_data']->value['facebook'])){?>
		<?php echo $_smarty_tpl->tpl_vars['addsharethis_data']->value['facebook'];?>

	<?php }?>
</div>
</div>
<?php }?>

<?php }} ?>