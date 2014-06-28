<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/feedback.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10262372853ae7ccca9d3b2-76040979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd141f852dd0630e84bb5faad05325c8e748cf99e' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/feedback.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10262372853ae7ccca9d3b2-76040979',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'minic' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7cccb00c79_05476917',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7cccb00c79_05476917')) {function content_53ae7cccb00c79_05476917($_smarty_tpl) {?><div id="feedback" class="minic-container">
	<form id="form-feed" class="" method="post">
        <div class="minic-top">
            <h3><?php echo smartyTranslate(array('s'=>'Feedback','mod'=>'minicslider'),$_smarty_tpl);?>

                <a href="http://module.minic.ro/how-to-use-feedback-and-bug-report-in-our-modules/" target="_blank" class="help"><?php echo smartyTranslate(array('s'=>'help & tips','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            </h3>
            <a href="#feedback" class="minic-close">x</a>
        </div>
        <div class="minic-content">
            <!-- Response -->
            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('id'=>'feedback'), 0);?>

    		<div class="input-holder">
    			<label><?php echo smartyTranslate(array('s'=>'Your name','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
    			<input id="feedback-name" class="name" type="text" name="name" placeholder="John Doe" value="" />
    		</div>
    		<div class="input-holder">
    			<label><?php echo smartyTranslate(array('s'=>'Your email','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
    			<input id="feedback-email" class="" type="text" name="email" placeholder="example@example.com" value="<?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['email'];?>
" />
    		</div>
    		<div class="input-holder">
    			<label><?php echo smartyTranslate(array('s'=>'Site address','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
    			<input id="feedback-domain" class="" type="text" name="domain" placeholder="mydomain.com" value="<?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['domain'];?>
" />
    		</div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Message','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
                <textarea id="feedback-message" class="" name="message" placeholder="Your message, request, suggestion, etc." rows="10" cols="49"></textarea>
            </div>
            <div class="minic-comments"> 
                <h3><?php echo smartyTranslate(array('s'=>'Notes','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
                <p><?php echo smartyTranslate(array('s'=>'Feel free to give us a feedback about our work (we really like to hear few good words) or write down your idea / request and if we think its good we`ll concider to implement into future versions.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <h3><?php echo smartyTranslate(array('s'=>'Important!','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
                <p><?php echo smartyTranslate(array('s'=>'By clicking to the "Send" button you agree that we will get some basic information. If you do not wish to send your e-mail address uncheck the checkbox.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <ul>
                    <li><?php echo smartyTranslate(array('s'=>'By default this is the shop email address, feel free to modify.'),$_smarty_tpl);?>
: <span><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['email'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Your shops domain','mod'=>'minicslider'),$_smarty_tpl);?>
: <span><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['domain'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Prestashop version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['psVersion'];?>
</span></li>
                    <li><?php echo smartyTranslate(array('s'=>'Module version','mod'=>'minicslider'),$_smarty_tpl);?>
: <span><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['version'];?>
</span></li>
                </ul>
            </div>
        </div>
        <div class="minic-bottom">
            <a href="#feedback" id="send-feedback" class="button-large green"><?php echo smartyTranslate(array('s'=>'Send','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            <a href="#feedback" class="minic-close button-large lgrey"><?php echo smartyTranslate(array('s'=>'Close','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
        </div>
	</form>
</div><?php }} ?>