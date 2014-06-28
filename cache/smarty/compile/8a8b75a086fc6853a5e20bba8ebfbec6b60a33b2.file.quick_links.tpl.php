<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:32:33
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/hooks/quick_links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189891063353ae7da13d64b4-44569374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a8b75a086fc6853a5e20bba8ebfbec6b60a33b2' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/hooks/quick_links.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189891063353ae7da13d64b4-44569374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'minicslider' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7da13fd859_86523434',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7da13fd859_86523434')) {function content_53ae7da13fd859_86523434($_smarty_tpl) {?><li>
  <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminModules');?>
&configure=<?php echo $_smarty_tpl->tpl_vars['minicslider']->value;?>
" style="background: url('<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
logo.png') no-repeat center 25px #F8F8F8">
    <h4><?php echo smartyTranslate(array('s'=>'Minic Slider','mod'=>'minicslider'),$_smarty_tpl);?>
</h4>
    <p><?php echo smartyTranslate(array('s'=>'Powerfull image slider for advertising','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
  </a>
</li><?php }} ?>