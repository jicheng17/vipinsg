<?php /* Smarty version Smarty-3.1.8, created on 2014-06-28 16:05:15
         compiled from "/var/www/vipinsg/themes/theme895/modules/blockwishlist/blockwishlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179018387253ae773b8afb93-43354115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da555b35764bdcaf14f76546fd3583944add4650' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blockwishlist/blockwishlist.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179018387253ae773b8afb93-43354115',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wishlist_products' => 0,
    'product' => 0,
    'link' => 0,
    'token' => 0,
    'wishlists' => 0,
    'wishlist' => 0,
    'id_wishlist' => 0,
    'wishlist_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae773b936127_71754361',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae773b936127_71754361')) {function content_53ae773b936127_71754361($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vipinsg/tools/smarty/plugins/modifier.escape.php';
?>

<section id="wishlist_block" class="block column_box">
	<h4 class="title_block"><span><?php echo smartyTranslate(array('s'=>'Wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
</span><i class="column_icon_toggle icon-plus-sign"></i></h4>
	<div class="block_content toggle_content">
		<div id="wishlist_block_list" class="expanded">
		<?php if ($_smarty_tpl->tpl_vars['wishlist_products']->value){?>
			<dl class="products">
			<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wishlist_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
				<dt class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']){?>last_item<?php }else{ ?>item<?php }?>">
					<span class="quantity-formated"><span class="quantity"><?php echo intval($_smarty_tpl->tpl_vars['product']->value['quantity']);?>
</span>x</span>
					<a class="cart_block_product_name"
					href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'], 'htmlall', 'UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],20,'...'), 'htmlall', 'UTF-8');?>
</a>
					<a class="ajax_cart_block_remove_link" href="javascript:;" onclick="javascript:WishlistCart('wishlist_block_list', 'delete', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
', <?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
, '0', '<?php if (isset($_smarty_tpl->tpl_vars['token']->value)){?><?php echo $_smarty_tpl->tpl_vars['token']->value;?>
<?php }?>');" title="<?php echo smartyTranslate(array('s'=>'remove this product from my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
" rel="nofollow"><i class="icon-trash"></i></a>
				</dt>
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?>
				<dd class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']){?>last_item<?php }else{ ?>item<?php }?>">
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail'),$_smarty_tpl);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['attributes_small'], 'htmlall', 'UTF-8');?>
</a>
				</dd>
				<?php }?>
			<?php } ?>
			</dl>
		<?php }else{ ?>
			<dl class="products">
				<dt><?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockwishlist'),$_smarty_tpl);?>
</dt>
			</dl>
		<?php }?>
		</div>
		<div class="lnk">
		<?php if ($_smarty_tpl->tpl_vars['wishlists']->value){?>
			<select name="wishlists" id="wishlists" class="form-control" onchange="WishlistChangeDefault('wishlist_block_list', $('#wishlists').val());">
			<?php  $_smarty_tpl->tpl_vars['wishlist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wishlist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wishlists']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['wishlist']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['wishlist']->iteration=0;
 $_smarty_tpl->tpl_vars['wishlist']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['wishlist']->key => $_smarty_tpl->tpl_vars['wishlist']->value){
$_smarty_tpl->tpl_vars['wishlist']->_loop = true;
 $_smarty_tpl->tpl_vars['wishlist']->iteration++;
 $_smarty_tpl->tpl_vars['wishlist']->index++;
 $_smarty_tpl->tpl_vars['wishlist']->first = $_smarty_tpl->tpl_vars['wishlist']->index === 0;
 $_smarty_tpl->tpl_vars['wishlist']->last = $_smarty_tpl->tpl_vars['wishlist']->iteration === $_smarty_tpl->tpl_vars['wishlist']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['first'] = $_smarty_tpl->tpl_vars['wishlist']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['last'] = $_smarty_tpl->tpl_vars['wishlist']->last;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['wishlist']->value['id_wishlist'];?>
"<?php if ($_smarty_tpl->tpl_vars['id_wishlist']->value==$_smarty_tpl->tpl_vars['wishlist']->value['id_wishlist']||($_smarty_tpl->tpl_vars['id_wishlist']->value==false&&$_smarty_tpl->getVariable('smarty')->value['foreach']['i']['first'])){?> selected="selected"<?php }?>><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['wishlist']->value['name'],22,'...'), 'htmlall', 'UTF-8');?>
</option>
			<?php } ?>
			</select>
		<?php }?>
			<a class="btn btn-default button_large" href="<?php echo $_smarty_tpl->tpl_vars['wishlist_link']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>
"> <?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
		</div>
	</div>
</section><?php }} ?>