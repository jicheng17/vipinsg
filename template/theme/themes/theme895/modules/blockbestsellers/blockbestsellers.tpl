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

<!-- MODULE Block best sellers -->
<section id="blockbestsellers" class="block products_block column_box">
	<h4><span>{l s='Top sellers' mod='blockbestsellers'}</span><i class="column_icon_toggle icon-plus-sign"></i></h4>
	<div class="block_content toggle_content">
	{if $best_sellers|@count > 0}
	<ul>
		{foreach from=$best_sellers item=product name=myLoop}
		{if $smarty.foreach.myLoop.iteration <= 3}
		<li class="clearfix">
			{if $smarty.foreach.myLoop.iteration <= 3}
			<a class="products_block_img" href="{$product.link}" title="{$product.legend|escape:html:'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'small_default')|escape:'html'}" alt="{$product.legend|escape:html:'UTF-8'}" /></a>
			<div>
			{/if}
				<h5><a class="product_link" href="{$product.link|escape:'html'}" title="{$product.name|escape:html:'UTF-8'}">{$product.name|strip_tags|escape:html:'UTF-8'|truncate:35:'...'}</a></h5>
			{if $smarty.foreach.myLoop.iteration <= 3}
			<p class="product_descr">{$product.description_short|strip_tags|escape:html:'UTF-8'|truncate:75:'...'}</p>
			</div>
			{/if}
		</li>
		{/if}
		{/foreach}
	</ul>
	<a href="{$link->getPageLink('best-sales')|escape:'html'}" title="{l s='All best sellers' mod='blockbestsellers'}" class="btn btn-default button_large">{l s='All best sellers' mod='blockbestsellers'}</a>
	{else}
		<p>{l s='No best sellers at this time' mod='blockbestsellers'}</p>
	{/if}
	</div>
</section>