<div class="left-column">

    <div class="left-menu">
        <h3 class="menu-caption">Меню</h3>
        <ul>
            {foreach $categories as $item}
                <li>
                    <a href="/category/{$item['id']}/">{$item['name']}</a>
                    {if isset($item['children'])}
                        <ul>
                            {foreach $item['children'] as $child}
                                <li><a href="/category/{$child['id']}/">{$child['name']}</a></li>
                            {/foreach}
                        </ul>
                    {/if}
                </li>
            {/foreach}
        </ul>
    </div>

    <div class="menu-catpion">Корзина</div>
    <a href="/cart/">В корзине</a>
    <span id="cartCountItems">
        {if $cartCountItems > 0}
            {$cartCountItems}
        {else}
            пусто
        {/if}
    </span>

</div>
