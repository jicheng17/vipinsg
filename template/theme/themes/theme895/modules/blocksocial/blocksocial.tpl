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

<section class="blocksocial block col-sm-3">
	<h4>{l s='Follow us' mod='blocksocial'}<i class="icon-plus-sign"></i></h4>
	<ul class="list-footer toggle_content">
		{if $facebook_url != ''}<li class="facebook"><a href="{$facebook_url|escape:html:'UTF-8'}">{l s='Facebook' mod='blocksocial'}</a></li>{/if}
		{if $twitter_url != ''}<li class="twitter"><a href="{$twitter_url|escape:html:'UTF-8'}">{l s='Twitter' mod='blocksocial'}</a></li>{/if}
		{if $rss_url != ''}<li class="rss"><a href="{$rss_url|escape:html:'UTF-8'}">{l s='RSS' mod='blocksocial'}</a></li>{/if}
	</ul>
</section>