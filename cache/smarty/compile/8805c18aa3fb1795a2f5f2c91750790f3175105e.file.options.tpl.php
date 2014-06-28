<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/options.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49412058053ae7cccc308e3-98090786%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8805c18aa3fb1795a2f5f2c91750790f3175105e' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/options.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49412058053ae7cccc308e3-98090786',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'slider' => 0,
    'effect' => 0,
    'current' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7cccdf5af5_87329651',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7cccdf5af5_87329651')) {function content_53ae7cccdf5af5_87329651($_smarty_tpl) {?><div id="options" class="minic-container">
    <form id="form-option" class="" method="post" action="<?php echo $_smarty_tpl->tpl_vars['slider']->value['postAction'];?>
">
        <div class="minic-top">
            <h3><?php echo smartyTranslate(array('s'=>'Options','mod'=>'minicslider'),$_smarty_tpl);?>

                <a href="#" target="_blank" class="help"><?php echo smartyTranslate(array('s'=>'help & tips','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            </h3>
            <a href="#options" class="minic-close">x</a>
        </div>
        <div class="minic-content">
            <!-- Animation type -->
            <h3 style="width:100%;"><?php echo smartyTranslate(array('s'=>'Animation type','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>  
            <div class="select">      
                <div class="used">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'These are the animation effects, choose one or more and click to the Add button.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Unused effects','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                    <select multiple="multiple" id="select1" name="nivo_effect[]" >
                        <?php  $_smarty_tpl->tpl_vars['effect'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['effect']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slider']->value['options']['effect']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['effect']->key => $_smarty_tpl->tpl_vars['effect']->value){
$_smarty_tpl->tpl_vars['effect']->_loop = true;
?>
                            <option><?php echo $_smarty_tpl->tpl_vars['effect']->value;?>
</option>
                        <?php } ?>
                    </select>   
                    <input name="left2right" value="<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
" type="button" id="add" class="button-small green tooltip" title="<?php echo smartyTranslate(array('s'=>'Click to add effect','mod'=>'minicslider'),$_smarty_tpl);?>
">
                </div> 
                <div class="unused">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'These are the used animation effects, you can select and remove them, if its empty then all will be used ( random ).'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Used effects','mod'=>'minicslider'),$_smarty_tpl);?>
</label>
                    <select multiple="multiple" id="select2" name="nivo_current[]" >
                        <?php  $_smarty_tpl->tpl_vars['current'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['current']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slider']->value['options']['current']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['current']->key => $_smarty_tpl->tpl_vars['current']->value){
$_smarty_tpl->tpl_vars['current']->_loop = true;
?>
                            <option><?php echo $_smarty_tpl->tpl_vars['current']->value;?>
</option>
                        <?php } ?>
                    </select>   
                    <input name="right2left" value="<?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>
" type="button" id="remove" class="button-small grey tooltip" title="<?php echo smartyTranslate(array('s'=>'Click to remove effect','mod'=>'minicslider'),$_smarty_tpl);?>
">
                </div> 
            </div>    
            <!-- Slice and Box animation -->
            <h3><?php echo smartyTranslate(array('s'=>'Slice and Box animation configuration','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Slices','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="slices" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['slices'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'The number of Slices for Slice animation','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'BoxCols','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="cols" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['cols'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'The number of Cols for Box animations','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'BoxRows','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="rows" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['rows'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'The number of Rows for Box animations','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <!-- Animation configuration -->
            <h3><?php echo smartyTranslate(array('s'=>'Animation configuration','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Speed','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="speed" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['speed'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'Slide transition speed in miliseconds (default is 0.5 sec)','mod'=>'minicslider'),$_smarty_tpl);?>
">                    
            </div>    
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Pause Time','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="pause" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['pause'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'How long each slide will be shown in miliseconds (default is 3 sec)','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Starting slide','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="startSlide" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['startSlide'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'The starting slide, begining with 0. So if you have 5 slides and you want to start with the last slide than you write 4.','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <h3><?php echo smartyTranslate(array('s'=>'Width and Height configuration','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Slider min width','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="min_width" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['min_width'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'Minimum width of the slider. For example: 500px or 20%','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Slider max width','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="max_width" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['max_width'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'Maximum width of the slider. For example: 1800px or 80%','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <div class="input-holder">
                <label><?php echo smartyTranslate(array('s'=>'Slider max height','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                <input type="text" name="max_height" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['max_height'];?>
" class="tooltip" title="<?php echo smartyTranslate(array('s'=>'Maximum height of the slider. For example: 500px or 50%','mod'=>'minicslider'),$_smarty_tpl);?>
">
            </div>
            <div class="right">
                <h3><?php echo smartyTranslate(array('s'=>'Other options','mod'=>'minicslider'),$_smarty_tpl);?>
</h3>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'Pause the slider on mouse hover.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Pause on Mouse Hover','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['hover']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-hover" class="" name="hover"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['hover'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'Turn it ON if you dont want the slider to auto slide.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Manual slide','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['manual']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-manual" class="" name="manual"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['manual'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'If you want previous and next buttons on the two side of the slider, then turn this on.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Prev/Next button','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['buttons']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-buttons" class="" name="buttons"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['buttons'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'This controls the navigation, by default these are the litle dots under the slider.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Control','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['control']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-control" class="" name="control"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['control'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'Turn it on if you want thumbnails in the place of the ( control ) litle dots.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Thumbnails','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['thumbnail']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-thumbnail" class="" name="thumbnail"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['thumbnail'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'Turn it ON if you want the slider to start with a random slide.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Random slide','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['random']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-random" class="" name="random"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['random'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'Turn on if you want to use different slides for different languages, otherwise the default language slides will be used for all the languages.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'I need multilanguage','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['single']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-single" class="" name="single"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['single'];?>
" checked="true" />
                    </div>
                </div>
                <div class="switch-holder">
                    <label><i class="icon-info-sign tooltip" title="<?php echo smartyTranslate(array('s'=>'Turn on if you want to use the Minic Slider only on the home page.'),$_smarty_tpl);?>
"></i><?php echo smartyTranslate(array('s'=>'Home only','mod'=>'minicslider'),$_smarty_tpl);?>
: </label>
                    <div class="switch small <?php if ($_smarty_tpl->tpl_vars['slider']->value['options']['front']){?>active<?php }else{ ?>inactive<?php }?>">
                        <input type="radio" id="r-front" class="" name="front"  value="<?php echo $_smarty_tpl->tpl_vars['slider']->value['options']['front'];?>
" checked="true" />
                    </div>
                </div> 
            </div> 
        </div>
        <div class="minic-bottom">
            <input type="submit" name="submitMinicOptions" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'minicslider'),$_smarty_tpl);?>
" id="submitOptions" class="button-large green" />
            <a href="#options" class="minic-close button-large lgrey"><?php echo smartyTranslate(array('s'=>'Close','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
        </div>
    </form>
</div><?php }} ?>