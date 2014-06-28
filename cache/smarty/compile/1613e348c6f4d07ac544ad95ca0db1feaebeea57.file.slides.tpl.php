<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/slides.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146903654553ae7cccf0a884-23263166%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1613e348c6f4d07ac544ad95ca0db1feaebeea57' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/slides.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146903654553ae7cccf0a884-23263166',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'minic' => 0,
    'slider' => 0,
    'lang' => 0,
    'iso' => 0,
    'slide' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7ccd15bbb6_36425722',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7ccd15bbb6_36425722')) {function content_53ae7ccd15bbb6_36425722($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('id'=>'sortable'), 0);?>

<div id="slides-list">
    <div id="slides-navigation">
        <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['single']==0){?>
            <a href="#<?php echo $_smarty_tpl->tpl_vars['slider']->value['lang']['default']['iso_code'];?>
_slides" class="navigation active">
                <img src="<?php echo $_smarty_tpl->tpl_vars['slider']->value['lang']['lang_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['slider']->value['lang']['default']['id_lang'];?>
.jpg" />
                <?php echo $_smarty_tpl->tpl_vars['slider']->value['lang']['default']['name'];?>

            </a>
        <?php }else{ ?>
            <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slider']->value['lang']['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                <a href="#<?php echo $_smarty_tpl->tpl_vars['lang']->value['iso_code'];?>
_slides" class="navigation <?php if ($_smarty_tpl->tpl_vars['lang']->value['iso_code']==$_smarty_tpl->tpl_vars['slider']->value['lang']['default']['iso_code']){?>active<?php }?>">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['slider']->value['lang']['lang_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
.jpg" />
                    <?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>

                </a>
            <?php } ?>    
        <?php }?>
    </div>
    <div class="slides-holder" style="width: <?php echo count($_smarty_tpl->tpl_vars['slider']->value['slides']);?>
00%;">
        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_smarty_tpl->tpl_vars['iso'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['slider']->value['slides']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
 $_smarty_tpl->tpl_vars['iso']->value = $_smarty_tpl->tpl_vars['lang']->key;
?>
            <ul id="<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
_slides" class="languages" style="width: <?php ob_start();?><?php echo count($_smarty_tpl->tpl_vars['slider']->value['slides']);?>
<?php $_tmp1=ob_get_clean();?><?php echo 100/$_tmp1;?>
%;">
                <?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value){
$_smarty_tpl->tpl_vars['slide']->_loop = true;
?>
                    <li id="order_<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_slide'];?>
h<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_order'];?>
" class="slide" >
                        <div class="slide-header <?php if ($_smarty_tpl->tpl_vars['slide']->value['active']!=1){?>inactive<?php }?>">
                            <i class="orderer icon-align-justify"></i>
                            <span class="order"><?php if ($_smarty_tpl->tpl_vars['slide']->value['id_order']<=9){?>0<?php }?><?php echo $_smarty_tpl->tpl_vars['slide']->value['id_order'];?>
</span>
                            <span class="title"><?php if ($_smarty_tpl->tpl_vars['slide']->value['title']){?><?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Untitled slide','mod'=>'minicslider'),$_smarty_tpl);?>
<?php }?></span>
                            <span class="<?php if ($_smarty_tpl->tpl_vars['slide']->value['active']==1){?>active<?php }else{ ?>deactivated<?php }?>"></span>
                            <span class="arrow"></span>
                        </div>
                        <div id="<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_order'];?>
" class="slide-body minic-container">
                            <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['slider']->value['postAction'];?>
" enctype="multipart/form-data">
                                <div class="minic-top">
                                    <h3><?php echo smartyTranslate(array('s'=>'Editing slide','mod'=>'minicslider'),$_smarty_tpl);?>

                                        <a href="http://module.minic.ro/minic-slider-news/using-the-feedback-and-bug-report/" target="_blank" class="help"><?php echo smartyTranslate(array('s'=>'help & tips','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
                                    </h3>
                                    <div class="title input-holder">
                                        <input type="text" name="title" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'The title of the slide'),$_smarty_tpl);?>
" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
" title="<?php echo smartyTranslate(array('s'=>'This will be the title on the slide.','mod'=>'minicslider'),$_smarty_tpl);?>
" /> 
                                    </div>
                                    <div class="switch-holder">
                                        <div class="switch large <?php if ($_smarty_tpl->tpl_vars['slide']->value['active']){?>active<?php }else{ ?>inactive<?php }?>">
                                            <input type="radio" class="" name="isActive"  value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['active'];?>
" checked="true" />
                                        </div>
                                    </div>
                                    <a href="#<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_order'];?>
" class="minic-close">x</a>
                                </div>
                                <div class="minic-content">
                                    <div class="image-holder input-holder">
                                        <label><?php echo smartyTranslate(array('s'=>'Image','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
uploads/<?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
" />
                                        <input type="file" name="newImage" class="file"/>
                                    </div>
                                    <div class="url input-holder">
                                      	<label><?php echo smartyTranslate(array('s'=>'Url','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                                      	<input type="text" name="url" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'Link of the slide'),$_smarty_tpl);?>
" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['url'];?>
" title="<?php echo smartyTranslate(array('s'=>'ex. http://myshop.com/promotions','mod'=>'minicslider'),$_smarty_tpl);?>
" />  
                                        <span><?php echo smartyTranslate(array('s'=>'Blank target','mod'=>'minicslider'),$_smarty_tpl);?>
: </span>
                                        <input type="checkbox" name="target" class="tooltip" value="1" <?php if ($_smarty_tpl->tpl_vars['slide']->value['target']==1){?>checked="true"<?php }?> title="<?php echo smartyTranslate(array('s'=>'Check this if you want to open the link in new window.','mod'=>'minicslider'),$_smarty_tpl);?>
" />         
                                    </div>
                                    <div class="alt input-holder">
                                        <label><?php echo smartyTranslate(array('s'=>'Image alt','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                                        <input type="text" name="alt" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'An alternate text for the image'),$_smarty_tpl);?>
" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['alt'];?>
" title="<?php echo smartyTranslate(array('s'=>'The image alt, alternate text for the image','mod'=>'minicslider'),$_smarty_tpl);?>
" />
                                    </div>
                                    <div class="caption input-holder"> 
                                      	<label><?php echo smartyTranslate(array('s'=>'Caption','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                                    	<textarea type="text" name="caption" class="tooltip" cols="40" rows="6" title="<?php echo smartyTranslate(array('s'=>'Be carefull, too long text isnt good and HTML is not allowed.'),$_smarty_tpl);?>
" placeholder="<?php echo smartyTranslate(array('s'=>'The slide text','mod'=>'minicslider'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['slide']->value['caption'];?>
</textarea>
                                    </div>   
                                </div>  
                                <div class="minic-bottom">
                                    <input type="hidden" name="slideId" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_slide'];?>
" />
                                    <input type="hidden" name="orderId" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_order'];?>
" />
                                    <input type="hidden" name="slideIso" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['lang_iso'];?>
" />
                                    <input type="hidden" name="oldImage" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
" />    
                                    <input type="submit" name="deleteSlide" value="<?php echo smartyTranslate(array('s'=>'Delete','mod'=>'minicslider'),$_smarty_tpl);?>
" id="delete-slide" class="button-large red disabled" />   
                                    <input type="submit" name="editSlide" value="<?php echo smartyTranslate(array('s'=>'Update','mod'=>'minicslider'),$_smarty_tpl);?>
" id="update-slide" class="button-large green" />       
                                    <a href="#<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_order'];?>
" class="button-large grey minic-close"><?php echo smartyTranslate(array('s'=>'Close','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
                                </div>    
                            </form>
                        </div>  
                    </li>                 
              <?php } ?>    
          </ul>               
      <?php } ?>
    </div>  
</div><?php }} ?>