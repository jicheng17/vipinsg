<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/modules/tmhtmlcontent/views/templates/hooks/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61997239353ae6fda2b6335-55126372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a277736c7597b8424a3f24d1b95d19c4585bd2f' => 
    array (
      0 => '/var/www/vipinsg/modules/tmhtmlcontent/views/templates/hooks/footer.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61997239353ae6fda2b6335-55126372',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fda2d9bd3_93234384',
  'variables' => 
  array (
    'htmlitems' => 0,
    'hItem' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fda2d9bd3_93234384')) {function content_53ae6fda2d9bd3_93234384($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['htmlitems']->value['items']){?>
<div id="htmlcontent_footer">
    <ul class="htmlcontent-home clearfix">
        <?php  $_smarty_tpl->tpl_vars['hItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['htmlitems']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['hItem']->key => $_smarty_tpl->tpl_vars['hItem']->value){
$_smarty_tpl->tpl_vars['hItem']->_loop = true;
?>
        	<li class="htmlcontent-item">
            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']){?>
                	<a href="<?php echo $_smarty_tpl->tpl_vars['hItem']->value['url'];?>
" class="item-link"<?php if ($_smarty_tpl->tpl_vars['hItem']->value['target']==1){?> target="_blank"<?php }?>>
                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['image']){?>
	                	<img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
images/<?php echo $_smarty_tpl->tpl_vars['hItem']->value['image'];?>
" class="item-img" alt="" />
	                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['title']&&$_smarty_tpl->tpl_vars['hItem']->value['title_use']==1){?>
                        <h3 class="item-title"><?php echo $_smarty_tpl->tpl_vars['hItem']->value['title'];?>
</h3>
	                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['html']){?>
	                	<div class="item-html">
                        	<?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>
                       
                        </div>
	                <?php }?>
            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']){?>
                	</a>
                <?php }?>
            </li>
        <?php } ?>
    </ul>
</div>
<?php }?>
<?php }} ?>