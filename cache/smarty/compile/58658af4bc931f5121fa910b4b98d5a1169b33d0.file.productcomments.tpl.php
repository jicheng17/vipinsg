<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:08:50
         compiled from "/var/www/vipinsg/themes/theme895/modules/productcomments/productcomments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166976400953ae7812e8b0d1-18532487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '58658af4bc931f5121fa910b4b98d5a1169b33d0' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/productcomments/productcomments.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166976400953ae7812e8b0d1-18532487',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productcomments_controller_url' => 0,
    'secure_key' => 0,
    'productcomments_url_rewriting_activated' => 0,
    'moderation_active' => 0,
    'comments' => 0,
    'comment' => 0,
    'logged' => 0,
    'too_early' => 0,
    'allow_guests' => 0,
    'product' => 0,
    'productcomment_cover' => 0,
    'link' => 0,
    'criterions' => 0,
    'criterion' => 0,
    'id_product_comment_form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae78130b7ea0_40658677',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae78130b7ea0_40658677')) {function content_53ae78130b7ea0_40658677($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vipinsg/tools/smarty/plugins/modifier.escape.php';
?>
<script type="text/javascript">
var productcomments_controller_url = '<?php echo $_smarty_tpl->tpl_vars['productcomments_controller_url']->value;?>
';
var confirm_report_message = '<?php echo smartyTranslate(array('s'=>'Are you sure you want report this comment?','mod'=>'productcomments','js'=>1),$_smarty_tpl);?>
';
var secure_key = '<?php echo $_smarty_tpl->tpl_vars['secure_key']->value;?>
';
var productcomments_url_rewrite = '<?php echo $_smarty_tpl->tpl_vars['productcomments_url_rewriting_activated']->value;?>
';
var productcomment_added = '<?php echo smartyTranslate(array('s'=>'Your comment has been added!','mod'=>'productcomments','js'=>1),$_smarty_tpl);?>
';
var productcomment_added_moderation = '<?php echo smartyTranslate(array('s'=>'Your comment has been added and will be available once approved by a moderator','mod'=>'productcomments','js'=>1),$_smarty_tpl);?>
';
var productcomment_title = '<?php echo smartyTranslate(array('s'=>'New comment','mod'=>'productcomments','js'=>1),$_smarty_tpl);?>
';
var productcomment_ok = '<?php echo smartyTranslate(array('s'=>'OK','mod'=>'productcomments','js'=>1),$_smarty_tpl);?>
';
var moderation_active = <?php echo $_smarty_tpl->tpl_vars['moderation_active']->value;?>
;
</script>

<div id="idTab5">
	<div id="product_comments_block_tab">
	<?php if ($_smarty_tpl->tpl_vars['comments']->value){?>
		<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
$_smarty_tpl->tpl_vars['comment']->_loop = true;
?>
			<?php if ($_smarty_tpl->tpl_vars['comment']->value['content']){?>
			<div class="comment clearfix well well-sm">
				<div class="comment_author">
					<span><?php echo smartyTranslate(array('s'=>'Grade','mod'=>'productcomments'),$_smarty_tpl);?>
&nbsp</span>
					<div class="star_content clearfix">
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['name'] = "i";
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total']);
?>
						<?php if ($_smarty_tpl->tpl_vars['comment']->value['grade']<=$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']){?>
							<div class="star"></div>
						<?php }else{ ?>
							<div class="star star_on"></div>
						<?php }?>
					<?php endfor; endif; ?>
					</div>
					<div class="comment_author_infos">
						<strong><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['comment']->value['customer_name'], 'html', 'UTF-8');?>
</strong><br/>
						<em><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>smarty_modifier_escape($_smarty_tpl->tpl_vars['comment']->value['date_add'], 'html', 'UTF-8'),'full'=>0),$_smarty_tpl);?>
</em>
					</div>
				</div>
				<div class="comment_details">
					<h4 class="title_block"><?php echo $_smarty_tpl->tpl_vars['comment']->value['title'];?>
</h4>
					<p><?php echo nl2br(smarty_modifier_escape($_smarty_tpl->tpl_vars['comment']->value['content'], 'html', 'UTF-8'));?>
</p>
					<ul>
						<?php if ($_smarty_tpl->tpl_vars['comment']->value['total_advice']>0){?>
							<li><?php echo smartyTranslate(array('s'=>'%1$d out of %2$d people found this review useful.','sprintf'=>array($_smarty_tpl->tpl_vars['comment']->value['total_useful'],$_smarty_tpl->tpl_vars['comment']->value['total_advice']),'mod'=>'productcomments'),$_smarty_tpl);?>
</li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['logged']->value==1){?>
							<?php if (!$_smarty_tpl->tpl_vars['comment']->value['customer_advice']){?>
							<li><?php echo smartyTranslate(array('s'=>'Was this comment useful to you?','mod'=>'productcomments'),$_smarty_tpl);?>
<div class="clearfix"><button class="btn btn btn-default" data-is-usefull="1" data-id-product-comment="<?php echo $_smarty_tpl->tpl_vars['comment']->value['id_product_comment'];?>
"><?php echo smartyTranslate(array('s'=>'yes','mod'=>'productcomments'),$_smarty_tpl);?>
</button> <button class="btn btn btn-default" data-is-usefull="0" data-id-product-comment="<?php echo $_smarty_tpl->tpl_vars['comment']->value['id_product_comment'];?>
"><?php echo smartyTranslate(array('s'=>'no','mod'=>'productcomments'),$_smarty_tpl);?>
</button></div></li>
							<?php }?>
							<?php if (!$_smarty_tpl->tpl_vars['comment']->value['customer_report']){?>
							<li><span class="report_btn" data-id-product-comment="<?php echo $_smarty_tpl->tpl_vars['comment']->value['id_product_comment'];?>
"><?php echo smartyTranslate(array('s'=>'Report abuse','mod'=>'productcomments'),$_smarty_tpl);?>
</span></li>
							<?php }?>
						<?php }?>
					</ul>
				</div>
			</div>
			<?php }?>
		<?php } ?>
        <p class="align_center">
			<a id="new_comment_tab_btn" class="open-comment-form button btn btn-default" href="#new_comment_form"><?php echo smartyTranslate(array('s'=>'Write your review','mod'=>'productcomments'),$_smarty_tpl);?>
 !</a>
		</p>
	<?php }else{ ?>
		<?php if (($_smarty_tpl->tpl_vars['too_early']->value==false&&($_smarty_tpl->tpl_vars['logged']->value||$_smarty_tpl->tpl_vars['allow_guests']->value))){?>
		<p class="align_center">
			<a id="new_comment_tab_btn" class="open-comment-form" href="#new_comment_form"><?php echo smartyTranslate(array('s'=>'Be the first to write your review','mod'=>'productcomments'),$_smarty_tpl);?>
 !</a>
		</p>
		<?php }else{ ?>
		<p class="align_center"><?php echo smartyTranslate(array('s'=>'No customer comments for the moment.','mod'=>'productcomments'),$_smarty_tpl);?>
</p>
		<?php }?>
	<?php }?>	
	</div>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['product']->value)&&$_smarty_tpl->tpl_vars['product']->value){?>
<!-- Fancybox -->
<div style="display: none;">
	<div id="new_comment_form">
		<form action="#">
			<h1 class="title"><span><?php echo smartyTranslate(array('s'=>'Write your review','mod'=>'productcomments'),$_smarty_tpl);?>
</span></h1>
            <div class="row">
            	<div class="col-xs-12 col-sm-6 titled_box">
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value)&&$_smarty_tpl->tpl_vars['product']->value){?>
                    <div class="media clearfix">
                        <h2 class="product_name"><span><?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</span></h2>
                        <img class="img-thumbnail pull-left" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['productcomment_cover']->value,'small_default'), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value->name, 'html', 'UTF-8');?>
" />
                        <div class="product_desc">
                            <?php echo $_smarty_tpl->tpl_vars['product']->value->description_short;?>

                        </div>
                    </div>
                <?php }?>
                </div>
                <div class="col-xs-12 col-sm-6 titled_box">
                    <div class="new_comment_form_content">
                        <h2><span><?php echo smartyTranslate(array('s'=>'Write your review','mod'=>'productcomments'),$_smarty_tpl);?>
</span></h2>
        
                        <div id="new_comment_form_error" class="alert alert-danger" style="display: none;">
                        	                            <ul></ul>
                        </div>
        
                        <?php if (count($_smarty_tpl->tpl_vars['criterions']->value)>0){?>
                            <ul id="criterions_list">
                            <?php  $_smarty_tpl->tpl_vars['criterion'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['criterion']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['criterions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['criterion']->key => $_smarty_tpl->tpl_vars['criterion']->value){
$_smarty_tpl->tpl_vars['criterion']->_loop = true;
?>
                                <li class="form-group">
                                    <label><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['criterion']->value['name'], 'html', 'UTF-8');?>
:</label>
                                    <div class="star_content">
                                        <input class="star" type="radio" name="criterion[<?php echo round($_smarty_tpl->tpl_vars['criterion']->value['id_product_comment_criterion']);?>
]" value="1" />
                                        <input class="star" type="radio" name="criterion[<?php echo round($_smarty_tpl->tpl_vars['criterion']->value['id_product_comment_criterion']);?>
]" value="2" />
                                        <input class="star" type="radio" name="criterion[<?php echo round($_smarty_tpl->tpl_vars['criterion']->value['id_product_comment_criterion']);?>
]" value="3" checked="checked" />
                                        <input class="star" type="radio" name="criterion[<?php echo round($_smarty_tpl->tpl_vars['criterion']->value['id_product_comment_criterion']);?>
]" value="4" />
                                        <input class="star" type="radio" name="criterion[<?php echo round($_smarty_tpl->tpl_vars['criterion']->value['id_product_comment_criterion']);?>
]" value="5" />
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            <?php } ?>
                            </ul>
                        <?php }?>
        				<p class="form-group">
                        	<label for="comment_title"><?php echo smartyTranslate(array('s'=>'Title','mod'=>'productcomments'),$_smarty_tpl);?>
: <sup class="required">*</sup></label>
                        	<input class="form-control" id="comment_title" name="title" type="text" value=""/>
        				</p>
                        <p class="form-group">
                        	<label for="content"><?php echo smartyTranslate(array('s'=>'Comment','mod'=>'productcomments'),$_smarty_tpl);?>
: <sup class="required">*</sup></label>
                        	<textarea class="form-control" id="content" name="content"></textarea>
       					</p> 
                        <?php if ($_smarty_tpl->tpl_vars['allow_guests']->value==true&&$_smarty_tpl->tpl_vars['logged']->value==0){?>
                        <p class="form-group">
                        	<label><?php echo smartyTranslate(array('s'=>'Your name','mod'=>'productcomments'),$_smarty_tpl);?>
: <sup class="required">*</sup></label>
                        	<input class="form-control" id="commentCustomerName" name="customer_name" type="text" value=""/>
                        </p>
                        <?php }?>
                        
                    </div>
                </div>
             </div>
             <div id="new_comment_form_footer" class=" sendfrend_footer">
                            <input id="id_product_comment_send" name="id_product" type="hidden" value='<?php echo $_smarty_tpl->tpl_vars['id_product_comment_form']->value;?>
'></input>
                            <p class="fl required"><sup>*</sup> <?php echo smartyTranslate(array('s'=>'Required fields','mod'=>'productcomments'),$_smarty_tpl);?>
</p>
                            <p class="fr ">
                                <input id="submitNewMessage" class="btn btn-default" value="<?php echo smartyTranslate(array('s'=>'Send','mod'=>'productcomments'),$_smarty_tpl);?>
" name="submitMessage" type="submit" />
                                <input class="btn btn-default" type="button" value="<?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'productcomments'),$_smarty_tpl);?>
" onclick="$.fancybox.close();" />
                            </p>
                            <div class="clearfix"></div>
                        </div>
		</form><!-- /end new_comment_form_content -->
	</div>
</div>
<!-- End fancybox -->
<?php }?>
<?php }} ?>