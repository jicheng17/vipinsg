<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/new.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152522803853ae7cccdfb736-98635639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17e09985f88e4e685ba0342e9c8d3e31d102b70e' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/new.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152522803853ae7cccdfb736-98635639',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'slider' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7cccf065c5_08976190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7cccf065c5_08976190')) {function content_53ae7cccf065c5_08976190($_smarty_tpl) {?><div id="new" class="minic-container">
    <form id="form-new" class="" method="post" action="<?php echo $_smarty_tpl->tpl_vars['slider']->value['postAction'];?>
" enctype="multipart/form-data">
        <div class="minic-top">
            <h3><?php echo smartyTranslate(array('s'=>'New slide','mod'=>'minicslider'),$_smarty_tpl);?>

                <a href="http://module.minic.ro/minic-slider-news/using-the-feedback-and-bug-report/" target="_blank" class="help"><?php echo smartyTranslate(array('s'=>'help & tips','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            </h3>
            <a href="#new" class="minic-close">x</a>
        </div>
        <div class="minic-content">
            <div class="title input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Title','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <input type="text" name="title" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'The title of the slide'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'This will be the title on the slide.','mod'=>'minicslider'),$_smarty_tpl);?>
" /> 
            </div>
            <div class="url input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Url','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <input type="text" name="url" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'Link of the slide'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'ex. http://myshop.com/promotions','mod'=>'minicslider'),$_smarty_tpl);?>
" />  
                <span><?php echo smartyTranslate(array('s'=>'Blank target','mod'=>'minicslider'),$_smarty_tpl);?>
</span>
                <input type="checkbox" name="target" class="tooltip" placeholder="1" title="<?php echo smartyTranslate(array('s'=>'Check this if you want to open the link in new window.','mod'=>'minicslider'),$_smarty_tpl);?>
" />         
            </div>
            <div class="image input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Image','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <input type="file" name="image" id="image-chooser" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'Choose an image, only .jpg, .png, .gif are allowed.','mod'=>'minicslider'),$_smarty_tpl);?>
" />
            </div>
            <div class="imageName input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Image name','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <input type="text" name="imageName" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'Image name'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Optional! The name of the uploaded image without extension. White spaces will be replaced with underscore ( _ )','mod'=>'minicslider'),$_smarty_tpl);?>
" />           
            </div>
            <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['single']==1){?>
            <div class="input-holder language">
                <label><?php echo smartyTranslate(array('s'=>'Language','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <select name="language" class="" title="<?php echo smartyTranslate(array('s'=>'The language of the slide.','mod'=>'minicslider'),$_smarty_tpl);?>
">
                    <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slider']->value['lang']['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
" <?php if ($_smarty_tpl->tpl_vars['lang']->value['id_lang']==$_smarty_tpl->tpl_vars['slider']->value['lang']['default']['id_lang']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
</option>
                    <?php } ?>
                </select>
            </div>
            <?php }?>
            <div class="alt input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Image alt','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <input type="text" name="alt" class="tooltip" placeholder="<?php echo smartyTranslate(array('s'=>'An alternate text for the image'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'The image alt, alternate text for the image','mod'=>'minicslider'),$_smarty_tpl);?>
" />
            </div>
            <div class="caption input-holder"> 
                <label><?php echo smartyTranslate(array('s'=>'Caption','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                <textarea type="text" name="caption" cols=40 rows=6 class="tooltip" title="<?php echo smartyTranslate(array('s'=>'Be carefull, too long text isnt good and FULL HTML is allowed.'),$_smarty_tpl);?>
" placeholder="<?php echo smartyTranslate(array('s'=>'The slide text','mod'=>'minicslider'),$_smarty_tpl);?>
"></textarea>                      
            </div>
            <div class="minic-comments"> 
                <h3><?php echo smartyTranslate(array('s'=>"Few important notes"),$_smarty_tpl);?>
</h3>
                <p><?php echo smartyTranslate(array('s'=>'The Nivo Slider is now'),$_smarty_tpl);?>
 <b><a href="http://nivo.dev7studios.com/2012/05/30/the-nivo-slider-is-responsive/" target="_blank"><?php echo smartyTranslate(array('s'=>'responsive','mod'=>'minicslider'),$_smarty_tpl);?>
</a></b>!</p>
                <p><?php echo smartyTranslate(array('s'=>'If you dont want title and/or captions text than leave empty those fields.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <p><?php echo smartyTranslate(array('s'=>'The images wont be resized automatically to the same size, you need to resize them manually!','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <p><?php echo smartyTranslate(array('s'=>'You can upload different sized images for different language.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <p><?php echo smartyTranslate(array('s'=>'If you want you can upload the same image to different language. They will be renamed but its better if you give them a normal name.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
                <p><?php echo smartyTranslate(array('s'=>'More than 8 image looks ugly if you use thumbnails in center column.','mod'=>'minicslider'),$_smarty_tpl);?>
</p>
            </div>
        </div>
        <div class="minic-bottom">
            <input type="submit" name="submitNewSlide" value="<?php echo smartyTranslate(array('s'=>'Add Slide','mod'=>'minicslider'),$_smarty_tpl);?>
" class="green button-large" />
            <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['single']==0){?>
                <input type="hidden" name="language" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['lang']['default']['id_lang'];?>
" />
            <?php }?>
            <a href="#new" class="minic-close button-large lgrey"><?php echo smartyTranslate(array('s'=>'Close','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
        </div>
    </form>
</div>
<?php }} ?>