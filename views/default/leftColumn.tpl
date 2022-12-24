<div class="left-menu">
    <h3 class="menu-caption">Меню</h3>
    <ul>
        {foreach $categories as $item}
            <li>
                <a href="#">{$item['name']}</a>
                {if isset($item['children'])}
                    <ul>
                        {foreach $item['children'] as $child}
                            <li><a href="#">{$child['name']}</a></li>
                        {/foreach}
                    </ul>
                {/if}
            </li>
        {/foreach}
    </ul>
</div>
