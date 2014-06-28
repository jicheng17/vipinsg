{if $htmlitems.items}
<div id="htmlcontent_home" class="row">
    <ul class="htmlcontent-home clearfix">
        {foreach name=items from=$htmlitems.items item=hItem}
        	<li class="htmlcontent-item col-xs-12 col-sm-6 col-md-6{if $smarty.foreach.items.last} last{/if} item-{$smarty.foreach.items.iteration}">
            	<div class="inner">
                    {if $hItem.url}
                        <a href="{$hItem.url}" class="item-link"{if $hItem.target == 1} target="_blank"{/if}>
                    {/if}
                        {if $hItem.image}
                            <img src="{$module_dir}images/{$hItem.image}" class="item-img" alt="" />
                        {/if}
                        {if $hItem.title && $hItem.title_use == 1}
                            <h3 class="item-title">{$hItem.title}</h3>
                        {/if}
                        {if $hItem.html}
                            <div class="item-html">
                            	<div class="content">
                                	{$hItem.html}
                                </div>
                            </div>
                        {/if}
                    {if $hItem.url}
                        </a>
                    {/if}
                </div>
            </li>
        {/foreach}
    </ul>
</div>
{/if}
