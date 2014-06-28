<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:09:04
         compiled from "/var/www/vipinsg/themes/theme895/order-steps.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172203225853ae78207c7392-33400648%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdc330897f3423f554714ba25edbd5d9678a0a46' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/order-steps.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172203225853ae78207c7392-33400648',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'back' => 0,
    'multi_shipping' => 0,
    'opc' => 0,
    'current_step' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae78208532f7_33875266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae78208532f7_33875266')) {function content_53ae78208532f7_33875266($_smarty_tpl) {?>


<?php $_smarty_tpl->_capture_stack[0][] = array("url_back", null, null); ob_start(); ?>
<?php if (isset($_smarty_tpl->tpl_vars['back']->value)&&$_smarty_tpl->tpl_vars['back']->value){?>back=<?php echo $_smarty_tpl->tpl_vars['back']->value;?>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if (!isset($_smarty_tpl->tpl_vars['multi_shipping']->value)){?>
	<?php $_smarty_tpl->tpl_vars['multi_shipping'] = new Smarty_variable('0', null, 0);?>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['opc']->value){?>
<script>
	$(document).ready(function() {
       $ ('#order_steps li:even').addClass ('even');
       $ ('#order_steps li:odd').addClass ('odd');
	   $ ('.list-order-step li').last().addClass ('last');
	});
</script>
<!-- Steps -->
<ul id="order_steps" class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='summary'){?>step1<?php }elseif($_smarty_tpl->tpl_vars['current_step']->value=='login'){?>step2<?php }elseif($_smarty_tpl->tpl_vars['current_step']->value=='address'){?>step3<?php }elseif($_smarty_tpl->tpl_vars['current_step']->value=='shipping'){?>step4<?php }elseif($_smarty_tpl->tpl_vars['current_step']->value=='payment'){?>step5<?php }?>">
	<li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='summary'){?>step_current<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address'||$_smarty_tpl->tpl_vars['current_step']->value=='login'){?>step_done<?php }else{ ?>step_todo<?php }?><?php }?>">
		<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address'||$_smarty_tpl->tpl_vars['current_step']->value=='login'){?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true);?>
">
			<span><span>01</span> <?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>
</span>
		</a>
		<?php }else{ ?>
			<span><span>01</span> <?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>
</span>
		<?php }?>
	</li>
	<li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='login'){?>step_current<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address'){?>step_done<?php }else{ ?>step_todo<?php }?><?php }?>">
		<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address'){?>
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,(Smarty::$_smarty_vars['capture']['url_back'])."&step=1&multi-shipping=".($_smarty_tpl->tpl_vars['multi_shipping']->value)), ENT_QUOTES, 'UTF-8');?>
">
			<span><span>02</span> <?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>
</span>
		</a>
		<?php }else{ ?>
			<span><span>02</span> <?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>
</span>
		<?php }?>
	</li>
	<li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='address'){?>step_current<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'){?>step_done<?php }else{ ?>step_todo<?php }?><?php }?>">
		<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'){?>
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,(Smarty::$_smarty_vars['capture']['url_back'])."&step=1&multi-shipping=".($_smarty_tpl->tpl_vars['multi_shipping']->value)), ENT_QUOTES, 'UTF-8');?>
">
		<span><span>03</span> <?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</span>
		</a>
		<?php }else{ ?>
			<span><span>03</span> <?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</span>
		<?php }?>
	</li>
	<li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='shipping'){?>step_current<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'){?>step_done<?php }else{ ?>step_todo<?php }?><?php }?>">
		<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'){?>
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,(Smarty::$_smarty_vars['capture']['url_back'])."&step=2&multi-shipping=".($_smarty_tpl->tpl_vars['multi_shipping']->value)), ENT_QUOTES, 'UTF-8');?>
">
		<span><span>04</span> <?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>
</span>
		</a>
		<?php }else{ ?>
			<span><span>04</span> <?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>
</span>
		<?php }?>
	</li>
	<li id="step_end" class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'){?>step_current<?php }else{ ?>step_todo<?php }?>">
		<span><span>05</span> <?php echo smartyTranslate(array('s'=>'Payment'),$_smarty_tpl);?>
</span>
	</li>
</ul>
<!-- /Steps -->
<?php }?>
<?php }} ?>