<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/modules/blocktopmenu/blocktopmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34825254953ae6fd9d401d6-79606605%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb6ec3866edf380a433d65065011d84a55b485a1' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blocktopmenu/blocktopmenu.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34825254953ae6fd9d401d6-79606605',
  'function' => 
  array (
  ),
  'cache_lifetime' => 31536000,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fd9d55a95_22640548',
  'variables' => 
  array (
    'MENU' => 0,
    'MENU_SEARCH' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fd9d55a95_22640548')) {function content_53ae6fd9d55a95_22640548($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vipinsg/tools/smarty/plugins/modifier.escape.php';
?><?php if ($_smarty_tpl->tpl_vars['MENU']->value!=''){?>
</div>
<div class="menu_wrapper">
	<div class="container">
        <div id="menu-wrap" class="clearfix desktop">
            <div id="menu-trigger"><?php echo smartyTranslate(array('s'=>'Categories','mod'=>'blocktopmenu'),$_smarty_tpl);?>
<i class="menu-icon icon-plus-sign-alt"></i></div>
                <ul id="menu-custom">
                <?php echo $_smarty_tpl->tpl_vars['MENU']->value;?>

                    <?php if ($_smarty_tpl->tpl_vars['MENU_SEARCH']->value){?>
                        <li class="search">
                            <form id="searchbox" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8');?>
" method="get">
                                        <input type="hidden" name="controller" value="search" />
                                <input type="hidden" value="position" name="orderby"/>
                                <input type="hidden" value="desc" name="orderway"/>
                                <input type="text" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo smarty_modifier_escape($_GET['search_query'], 'htmlall', 'UTF-8');?>
<?php }?>" placeholder="Search..." />
                            </form>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <script type="text/javascript">
		$(document).ready(function() {
            $('#menu-custom li:has(ul)').addClass('hasSub');
			var i=1;
			$('#menu-custom > li').each(function() {
                $(this).addClass('cat-'+ i);
				i++;
            });
        });
	</script>
<?php }?><?php }} ?>