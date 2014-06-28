<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:01
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75672299053ae7ccd172737-59240237%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04aabe444ae640c816448c2a47f34b019ea69010' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/popup.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75672299053ae7ccd172737-59240237',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newsletter' => 0,
    'minic' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7ccd1d4ba7_91367838',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7ccd1d4ba7_91367838')) {function content_53ae7ccd1d4ba7_91367838($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['newsletter']->value){?>
<div id="newsletter" class="popup">
	<div class="inner">
	    <div class="header">
	        <h4><?php echo smartyTranslate(array('s'=>'Help Us!','mod'=>'minicslider'),$_smarty_tpl);?>
</h4> <!-- Title -->
	        <span class="close-popup" data-popup="#newsletter">x</span> <!-- Close Button -->
	    </div>
	    <div class="popup-content"> <!-- Content -->
	        <div class="container"> <!-- Container -->
	            <p><?php echo smartyTranslate(array('s'=>'By clicking to the YES button you agree to share some basic information with us.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
	            <p><b><?php echo smartyTranslate(array('s'=>'Don`t worry we`ll be discrete with this information','mod'=>'minicslider'),$_smarty_tpl);?>
:</b></p>
	            <ul>
	                <li><?php echo smartyTranslate(array('s'=>'Domain','mod'=>'minicslider'),$_smarty_tpl);?>
: <b><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['domain'];?>
</b></li>
	                <li><?php echo smartyTranslate(array('s'=>'Version','mod'=>'minicslider'),$_smarty_tpl);?>
: <b><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['version'];?>
</b></li>
	                <li><?php echo smartyTranslate(array('s'=>'PS Version','mod'=>'minicslider'),$_smarty_tpl);?>
: <b><?php echo $_smarty_tpl->tpl_vars['minic']->value['info']['psVersion'];?>
</b></li>
	            </ul>
	            <form>
	                <p><?php echo smartyTranslate(array('s'=>'If you want to riecive news about our updates, new modules, give us your e-mail address.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
	                <div>
	                    <label><?php echo smartyTranslate(array('s'=>'Email','mod'=>'minicslider'),$_smarty_tpl);?>
:</label>
	                    <input type="text" id="sendInfoEmail" name="infoEmail" />
	                </div>  
	            </form>
	            <h3><?php echo smartyTranslate(array('s'=>'Thank you for your help!','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
	        </div> <!-- /END Container -->
	        <div class="buttons"> <!-- Buttons Holder -->
	            <a href="#" id="sendInfo" class="submit-popup button-small green" data-popup="#newsletter"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'minicslider'),$_smarty_tpl);?>
</a>  <!-- Action Button -->
	            <a href="#" id="cancelInfo" class="close-popup button-small grey" data-popup="#newsletter"><?php echo smartyTranslate(array('s'=>'No','mod'=>'minicslider'),$_smarty_tpl);?>
</a>  <!-- Close Button -->
	        </div> <!-- /END Buttons Holder -->
	    </div> <!-- /END Content -->
	</div>
</div>
<?php }?><?php }} ?>