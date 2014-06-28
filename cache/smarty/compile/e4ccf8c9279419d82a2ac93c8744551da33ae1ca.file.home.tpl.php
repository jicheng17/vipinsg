<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/modules/tmhtmlcontent/views/templates/hooks/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68155538653ae6fd9f2a196-91535957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4ccf8c9279419d82a2ac93c8744551da33ae1ca' => 
    array (
      0 => '/var/www/vipinsg/modules/tmhtmlcontent/views/templates/hooks/home.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68155538653ae6fd9f2a196-91535957',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fda01a088_73750123',
  'variables' => 
  array (
    'htmlitems' => 0,
    'hItem' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fda01a088_73750123')) {function content_53ae6fda01a088_73750123($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['htmlitems']->value['items']){?>
<div id="htmlcontent_home" class="row">
    <ul class="htmlcontent-home clearfix">
        <?php  $_smarty_tpl->tpl_vars['hItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['htmlitems']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['hItem']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['hItem']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['hItem']->key => $_smarty_tpl->tpl_vars['hItem']->value){
$_smarty_tpl->tpl_vars['hItem']->_loop = true;
 $_smarty_tpl->tpl_vars['hItem']->iteration++;
 $_smarty_tpl->tpl_vars['hItem']->last = $_smarty_tpl->tpl_vars['hItem']->iteration === $_smarty_tpl->tpl_vars['hItem']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['last'] = $_smarty_tpl->tpl_vars['hItem']->last;
?>
        	<li class="htmlcontent-item col-xs-12 col-sm-6 col-md-6<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['items']['last']){?> last<?php }?> item-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration'];?>
">
            	<div class="inner">
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
                            	<div class="content">
                                	<?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>

                                </div>
                            </div>
                        <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']){?>
                        </a>
                    <?php }?>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<?php }?>
<?php }} ?>