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

<!-- MODULE Block new products -->
<section id="new-products_block_right" class="block products_block column_box">
	<h4 class="title_block"><span>{l s='New products' mod='blocknewproducts'}</span> <i class="column_icon_toggle icon-plus-sign"></i></h4>
	<div class="block_content toggle_content">
	{if $new_products !== false}
		<ul class="products">
		{foreach from=$new_products item=newproduct name=myLoop}
        	<li class="clearfix {if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
     
                	<a class="products_block_img" href="{$newproduct.link|escape:'html'}" title="{$newproduct.legend|escape:html:'UTF-8'}"><img src="{$link->getImageLink($newproduct.link_rewrite, $newproduct.id_image, 'medium_default')|escape:'html'}" alt="{$newproduct.legend|escape:html:'UTF-8'}" /></a>
         
                <div>
                {if $newproduct.show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                	<p class="price_container clearfix">
						<span class="price">{if !$priceDisplay}{convertPrice price=$newproduct.price}{else}{convertPrice price=$newproduct.price_tax_exc}{/if}</span>
                    </p>
                {/if}
            	<h5 class="s_title_block">
					<a class="product_link" href="{$newproduct.link|escape:'html'}" title="{$newproduct.name|escape:html:'UTF-8'}">{$newproduct.name|strip_tags:'UTF-8'|truncate:35:'...'}</a>
            	</h5>
                </div>
            </li>
		{/foreach}
		</ul>
		<a href="{$link->getPageLink('new-products')|escape:'html'}" title="{l s='All new products' mod='blocknewproducts'}" class="btn btn-default button_large">{l s='All new products' mod='blocknewproducts'}</a>
	{else}
		<p>&raquo; {l s='Do not allow new products at this time.' mod='blocknewproducts'}</p>
	{/if}
	</div>
</section>
<!-- /MODULE Block new products -->