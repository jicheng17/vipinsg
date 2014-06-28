<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:08:50
         compiled from "/var/www/vipinsg/themes/theme895/modules/sendtoafriend/sendtoafriend-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210882905753ae7812c1bc71-84148685%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70efec4122d7a19ca55a540fd246889abc7eb59a' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/sendtoafriend/sendtoafriend-extra.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210882905753ae7812c1bc71-84148685',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
    'stf_secure_key' => 0,
    'stf_product' => 0,
    'stf_product_cover' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7812cac5b3_24805215',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7812cac5b3_24805215')) {function content_53ae7812cac5b3_24805215($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vipinsg/tools/smarty/plugins/modifier.escape.php';
?>
<script text="javascript">

$('document').ready(function(){
	$('#send_friend_button').fancybox({
		autoScale : true,
		'hideOnContentClick': false,
		'hideOnOverlayClick': true
	});

	$('#sendEmail').click(function(){
        
        var name = $('#friend_name').val();
        var email = $('#friend_email').val();
        var id_product = $('#id_product_comment_send').val();
		if (name && email && !isNaN(id_product))
		{
			$.ajax({
				url: "<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
sendtoafriend_ajax.php",
				type: "POST",
				headers: {"cache-control": "no-cache"},
				data: {action: 'sendToMyFriend', secure_key: '<?php echo $_smarty_tpl->tpl_vars['stf_secure_key']->value;?>
', name: name, email: email, id_product: id_product},
				dataType: "json",
				success: function(result) {
					$.fancybox.close();
                    var msg = result ? "<?php echo smartyTranslate(array('s'=>'Your e-mail has been sent successfully','mod'=>'sendtoafriend'),$_smarty_tpl);?>
" : "<?php echo smartyTranslate(array('s'=>'Your e-mail could not be sent. Please check the e-mail address and try again.','mod'=>'sendtoafriend'),$_smarty_tpl);?>
";
                    var title = "<?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
";
                    fancyMsgBox(msg, title);
				}
			});
		}
		else
			$('#send_friend_form_error').text("<?php echo smartyTranslate(array('s'=>'You did not fill required fields','mod'=>'sendtoafriend','js'=>1),$_smarty_tpl);?>
");
	});
});

</script>
<li class="sendtofriend">
	<a id="send_friend_button" href="#send_friend_form"><i class="icon-envelope"></i><?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</a>
</li>

<div style="display: none;"> 
	<div id="send_friend_form">
    	<div id="send_friend_form_content">
			<h1 class="title clearfix"><?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</h1>
            <div class="row">
            <div class="col-xs-12 col-sm-6 titled_box">
            	<h2 class="product_name"><span><?php echo $_smarty_tpl->tpl_vars['stf_product']->value->name;?>
</span></h2>
                <div class="product media clearfix">
                    <img class="img-thumbnail pull-left" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['stf_product']->value->link_rewrite,$_smarty_tpl->tpl_vars['stf_product_cover']->value,'small_default'), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['stf_product']->value->name, 'html', 'UTF-8');?>
" />
                    <div class="product_desc">
                        <?php echo $_smarty_tpl->tpl_vars['stf_product']->value->description_short;?>

                    </div>
                </div>
			</div>
            <div class="col-xs-12 col-sm-6">
			<div class="send_friend_form_content">
				<div id="send_friend_form_error" class="alert alert-danger" style="display:none;"></div>
				<div class="form_container titled_box">
					<h2 class="intro_form "><span><?php echo smartyTranslate(array('s'=>'Recipient','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 :</span></h2>
					<p class="form-group">
						<label for="friend_name"><?php echo smartyTranslate(array('s'=>'Name of your friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :</label>
						<input class="form-control" id="friend_name" name="friend_name" type="text" value=""/>
					</p>
					<p class="form-group">
						<label for="friend_email"><?php echo smartyTranslate(array('s'=>'E-mail address of your friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :</label>
						<input class="form-control" id="friend_email" name="friend_email" type="email" value=""/>
					</p>
					<p class="txt_required"><sup class="required">*</sup> <?php echo smartyTranslate(array('s'=>'Required fields','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</p>
				</div>
			</div>
            </div>
            </div>
            <p class="submit sendfrend_footer">
					<input id="id_product_comment_send" name="id_product" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['stf_product']->value->id;?>
" />
					<button class="btn btn-default" onclick="$.fancybox.close();"><?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</button>
					<button id="sendEmail" class="btn btn-default" name="sendEmail" type="submit" /><?php echo smartyTranslate(array('s'=>'Send','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</button>
                    <!--input id="sendEmail" class="btn btn-inverse" name="sendEmail" type="submit" value="<?php echo smartyTranslate(array('s'=>'Send','mod'=>'sendtoafriend'),$_smarty_tpl);?>
" /-->
				</p>
	</div>
</div>
</div>
<?php }} ?>