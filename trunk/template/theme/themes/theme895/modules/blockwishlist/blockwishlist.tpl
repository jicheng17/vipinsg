{*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<section id="wishlist_block" class="block column_box">
	<h4 class="title_block"><span>{l s='Wishlist' mod='blockwishlist'}</span><i class="column_icon_toggle icon-plus-sign"></i></h4>
	<div class="block_content toggle_content">
		<div id="wishlist_block_list" class="expanded">
		{if $wishlist_products}
			<dl class="products">
			{foreach from=$wishlist_products item=product name=i}
				<dt class="{if $smarty.foreach.i.first}first_item{elseif $smarty.foreach.i.last}last_item{else}item{/if}">
					<span class="quantity-formated"><span class="quantity">{$product.quantity|intval}</span>x</span>
					<a class="cart_block_product_name"
					href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:20:'...'|escape:'htmlall':'UTF-8'}</a>
					<a class="ajax_cart_block_remove_link" href="javascript:;" onclick="javascript:WishlistCart('wishlist_block_list', 'delete', '{$product.id_product}', {$product.id_product_attribute}, '0', '{if isset($token)}{$token}{/if}');" title="{l s='remove this product from my wishlist' mod='blockwishlist'}" rel="nofollow"><i class="icon-trash"></i></a>
				</dt>
				{if isset($product.attributes_small)}
				<dd class="{if $smarty.foreach.i.first}first_item{elseif $smarty.foreach.i.last}last_item{else}item{/if}">
					<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html'}" title="{l s='Product detail'}">{$product.attributes_small|escape:'htmlall':'UTF-8'}</a>
				</dd>
				{/if}
			{/foreach}
			</dl>
		{else}
			<dl class="products">
				<dt>{l s='No products' mod='blockwishlist'}</dt>
			</dl>
		{/if}
		</div>
		<div class="lnk">
		{if $wishlists}
			<select name="wishlists" id="wishlists" class="form-control" onchange="WishlistChangeDefault('wishlist_block_list', $('#wishlists').val());">
			{foreach from=$wishlists item=wishlist name=i}
				<option value="{$wishlist.id_wishlist}"{if $id_wishlist eq $wishlist.id_wishlist or ($id_wishlist == false and $smarty.foreach.i.first)} selected="selected"{/if}>{$wishlist.name|truncate:22:'...'|escape:'htmlall':'UTF-8'}</option>
			{/foreach}
			</select>
		{/if}
			<a class="btn btn-default button_large" href="{$wishlist_link}" title="{l s='My wishlists' mod='blockwishlist'}"> {l s='My wishlists' mod='blockwishlist'}</a>
		</div>
	</div>
</section>