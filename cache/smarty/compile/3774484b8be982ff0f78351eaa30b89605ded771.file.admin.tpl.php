<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:29:00
         compiled from "/var/www/vipinsg/modules/minicslider/views/templates/admin/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141233184053ae7ccca24ee9-33590628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3774484b8be982ff0f78351eaa30b89605ded771' => 
    array (
      0 => '/var/www/vipinsg/modules/minicslider/views/templates/admin/admin.tpl',
      1 => 1403942684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141233184053ae7ccca24ee9-33590628',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'slider' => 0,
    'minic' => 0,
    'error' => 0,
    'confirmation' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae7ccca8bbb0_33759065',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae7ccca8bbb0_33759065')) {function content_53ae7ccca8bbb0_33759065($_smarty_tpl) {?><script type="text/javascript">
    $(document).ready(function() {

        // Sortable

        $("ul.languages").sortable({
            opacity: 0.6,
            cursor: 'move',
            handle: '.orderer',
            update: function(event, ui) {
                var list = $(this);
                var number;
                var response;
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $_smarty_tpl->tpl_vars['slider']->value['sortUrl'];?>
',
                    cache: false,
                    dataType : "json",
                    data: $(this).sortable("serialize"),
                    success: function(response){
                        if(response.success == "true"){
                            minic.showResponse($("#main-response"), "<?php echo smartyTranslate(array('s'=>'Saved successfull','mod'=>'minicslider'),$_smarty_tpl);?>
", 'conf');
                            var i = 1;
                            list.children("li").each(function(){
                                number = i;
                                if(i < 10){ 
                                    number = "0"+i; 
                                }
                                $(this).find(".order").text(number);
                                i++;
                            });
                        }else{
                            minic.showResponse($("#main-response"), "<?php echo smartyTranslate(array('s'=>'Something went wrong, please refresh the page and try again','mod'=>'minicslider'),$_smarty_tpl);?>
", 'error'); 
                        }
                    },
                    error: function(XMLHttpRequest) {
                        minic.showResponse($("#main-response"), "<?php echo smartyTranslate(array('s'=>'Something went wrong, please refresh the page and try again','mod'=>'minicslider'),$_smarty_tpl);?>
", 'error'); 
                        console.log(XMLHttpRequest);
                    }
                });
            }
        });         
    });
</script>
		
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."javascript.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="minic">
    <?php if ($_smarty_tpl->tpl_vars['error']->value){?>
        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('id'=>"main",'text'=>$_smarty_tpl->tpl_vars['error']->value,'class'=>'error'), 0);?>

    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['confirmation']->value){?>
        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('id'=>"main",'text'=>$_smarty_tpl->tpl_vars['confirmation']->value,'class'=>'conf'), 0);?>

    <?php }?>
    <div class="header">
        <div id="menu-top">
            <a href="http://module.minic.ro" id="minic-studio" class="social" title="Minic studio module site" target="_blank">minic studio</a>
            <a href="https://plus.google.com/114549918965076938738" class="social" title="Minic studio Google+ page" target="_blank"><i class="icon-googleplus"></i></a>
            <a href="https://github.com/minicstudio" class="social" title="Minic studio Github page" target="_blank"><i class="icon-github"></i></a>
            <a href="https://twitter.com/minicstudio" class="social" title="Minic studio Twitter page" target="_blank"><i class="icon-twitter"></i></a>
            <a href="https://www.facebook.com/minicmodule" class="social" title="Minic studio Facebook page" target="_blank"><i class="icon-facebook"></i></a>
            <div id="more-module">
                <span>Top Modules</span>
                <ul id="module-list">
                    <li><?php echo smartyTranslate(array('s'=>'No data available','mod'=>'minicslider'),$_smarty_tpl);?>
</li>
                </ul>
            </div>
            <a href="#newsletter" id="open-newsletter" class="open-popup" data-popup="#newsletter"><?php echo smartyTranslate(array('s'=>'Newsletter','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            <a href="#bug" id="open-bug" class="minic-open"><?php echo smartyTranslate(array('s'=>'Bug Report','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            <a href="#feedback" id="open-feedback" class="minic-open"><?php echo smartyTranslate(array('s'=>'Feedback','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
        </div>
        <div id="banner"></div>
        <div id="navigation">
            <a href="#new" id="new-button" class="minic-open"><?php echo smartyTranslate(array('s'=>'Add New','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
            <a href="#options" id="options-button" class="minic-open"><?php echo smartyTranslate(array('s'=>'Options','mod'=>'minicslider'),$_smarty_tpl);?>
</a>
        </div>
    </div>
    <!-- feedback -->
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."feedback.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- bug report -->
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."bug.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- Options -->
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- New -->
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."new.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- Slides -->
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."slides.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- newsletter popup -->
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['minic']->value['admin_tpl_path'])."popup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('newsletter'=>'1'), 0);?>

</div><?php }} ?>