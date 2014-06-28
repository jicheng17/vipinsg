<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53288266653ae6fda401727-50753734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '690e5ad542acea8b6c2177be24f0e4cd4c9673a8' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/footer.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53288266653ae6fda401727-50753734',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fda427254_02796028',
  'variables' => 
  array (
    'content_only' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'RightColumn' => 0,
    'HOOK_FOOTER' => 0,
    'PS_ALLOW_MOBILE_DEVICE' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fda427254_02796028')) {function content_53ae6fda427254_02796028($_smarty_tpl) {?>

		<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
				</div>

<!-- Right -->
			<?php if (isset($_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value)&&(str_replace(" ",'',$_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value))!=''){?><?php $_smarty_tpl->tpl_vars['RightColumn'] = new Smarty_variable(3, null, 0);?><?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['RightColumn']->value)&&$_smarty_tpl->tpl_vars['RightColumn']->value!=0){?>
				<div id="right_column" class="col-xs-12 col-sm-3 column">
					<?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>

				</div>
            <?php }?>
			</div>
            </div>
</div>
<!-- Footer -->
			<div class="page_wrapper_3 clearfix">
                <footer id="footer" class="container">
                <div class="row modules">
                    <?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

                     <?php if ($_smarty_tpl->tpl_vars['PS_ALLOW_MOBILE_DEVICE']->value){?>
                        <p class="center clearfix"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true);?>
?mobile_theme_ok"><?php echo smartyTranslate(array('s'=>'Browse the mobile site'),$_smarty_tpl);?>
</a></p>
                    <?php }?>
                </div>
                   
                </footer>
            </div>
	<?php }?>
	</body>
</html>
<?php }} ?>