<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/bug.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140015869453ae7cccb4d403-46570492%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '902a3191fbe7d64878b1ac5e0dcabb9368467019' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/bug.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140015869453ae7cccb4d403-46570492',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'minic' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7cccc1b4d2_12975578',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7cccc1b4d2_12975578')) {function content_53ae7cccc1b4d2_12975578($_smarty_tpl) {?><div id="bug" class="minic-container">
    <form id="form-bug" class="" method="post">
        <div class="minic-top">
            <h3><?php echo smartyTranslate(array('s'=>'Bug report','mod'=>'minicslider'),$_smarty_tpl);?>

                <a href="http://module.minic.ro/how-to-use-feedback-and-bug-report-in-our-modules/" target="_blank" class="help"><?php echo smartyTranslate(array('s'=>'help & tips','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            </h3>
            <a href="#bug" class="minic-close">x</a>
        </div>
        <div class="minic-content">
            <!-- Response -->
            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('id'=>'bug'), 0);?>

            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Your name','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
                <input id="bug-name" class="name" type="text" name="name" placeholder="John Doe" value="" />
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Your email','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
                <input id="bug-email" class="" type="text" name="email" placeholder="example@example.com" value="<?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['email'];?>
" />
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Site address','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
                <input id="bug-domain" class="" type="text" name="domain" placeholder="mydomain.com" value="<?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['domain'];?>
" />
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Message','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
                <textarea id="bug-message" class="" name="message" placeholder="Your message, request, suggestion, etc." rows="10" cols="49"></textarea>
            </div>
            <div class="minic-comments"> 
                <h3><?php echo smartyTranslate(array('s'=>'Notes','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
                <p><?php echo smartyTranslate(array('s'=>'Please describe the bug with as much detail as it`s possible, so we can understand the problem easier.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <h3><?php echo smartyTranslate(array('s'=>'Important!','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
                <p><?php echo smartyTranslate(array('s'=>'By clicking to the "Send" button you agree that we will get some basic information. If you do not wish to send your e-mail address uncheck the checkbox.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <ul>
                    <li><?php echo smartyTranslate(array('s'=>'The module name','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-module"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['module'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'By default this is the shop email address, feel free to modify.','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-email"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['email'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Your shops domain','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-domain"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['domain'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Prestashop version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-psversion"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['psVersion'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Module version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-version"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['version'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Server version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-server"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['server'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Php version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-php"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['php'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Mysql version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-mysql"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['mysql'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Theme name','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-theme"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['theme'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Browser version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span id="info-browser"><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['userInfo'];?>
</span></li>
                </ul>
            </div>
        </div>
        <div class="minic-bottom">
            <a href="#bug" id="send-bug" class="button-large green"><?php echo smartyTranslate(array('s'=>'Send','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            <a href="#bug" class="minic-close button-large lgrey"><?php echo smartyTranslate(array('s'=>'Close','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            <input id="info-module" type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['module'];?>
" />
            <input id="info-context" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['context'];?>
" name="context" />
        </div>
    </form>
</div><?php }} ?>