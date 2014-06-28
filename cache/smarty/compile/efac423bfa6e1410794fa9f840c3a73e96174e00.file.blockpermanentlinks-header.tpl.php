<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:05
         compiled from "/var/www/vipinsg/themes/theme895/modules/blockpermanentlinks/blockpermanentlinks-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132403795453ae6fd9a623b9-53429409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efac423bfa6e1410794fa9f840c3a73e96174e00' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blockpermanentlinks/blockpermanentlinks-header.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132403795453ae6fd9a623b9-53429409',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae6fd9aa3f40_78438665',
  'variables' => 
  array (
    'link' => 0,
    'come_from' => 0,
    'meta_title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae6fd9aa3f40_78438665')) {function content_53ae6fd9aa3f40_78438665($_smarty_tpl) {?>

<!-- Block permanent links module HEADER -->
<section class="header-box blockpermanentlinks-header">
    <ul id="header_links" class="hidden-xs">
        <!--li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index.php');?>
" class="header_links_home"><?php echo smartyTranslate(array('s'=>'home','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li-->
        <li id="header_link_contact"><a class="header_links_contact" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
        <li id="header_link_sitemap"><a class="header_links_sitemap" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
        <!--li id="header_link_bookmark">
            <script type="text/javascript">writeBookmarkLink('<?php echo $_smarty_tpl->tpl_vars['come_from']->value;?>
', '<?php echo addslashes(addslashes($_smarty_tpl->tpl_vars['meta_title']->value));?>
', '<?php echo smartyTranslate(array('s'=>'bookmark','mod'=>'blockpermanentlinks','js'=>1),$_smarty_tpl);?>
');</script>
        </li-->

        
    </ul>

    <div class="mobile-link-top header-button visible-xs">
        <h4 class="icon_wrapp">
             <span class="title-hed"></span><i class="arrow_header_top_menu arrow_header_top icon-reorder"></i>
        </h4>
        <ul id="mobilelink" class="list_header">
            <!--li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index.php');?>
" class="header_links_home"><?php echo smartyTranslate(array('s'=>'home','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li-->
            <li id="header_link_contact"><a class="header_links_contact" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
            <li id="header_link_sitemap"><a class="header_links_sitemap" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
            <!--li id="header_link_bookmark">
                <script type="text/javascript">writeBookmarkLink('<?php echo $_smarty_tpl->tpl_vars['come_from']->value;?>
', '<?php echo addslashes(addslashes($_smarty_tpl->tpl_vars['meta_title']->value));?>
', '<?php echo smartyTranslate(array('s'=>'bookmark','mod'=>'blockpermanentlinks','js'=>1),$_smarty_tpl);?>
');</script>
            </li-->
		</ul>
    </div>
</section>
<!-- /Block permanent links module HEADER -->


<?php }} ?>