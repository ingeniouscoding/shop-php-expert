{extends file="base.tpl"}

{block name=title}Корзина{/block}

{block name=content}

    <h1>Корзина</h1>

    {if $products}
        <table>
            <thead>
                <th>№</th>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена за единицу</th>
                <th>Общая стоимость</th>
                <th>Действия</th>
            </thead>
            <tbody>
                {foreach $products as $item name=products}
                    <tr>
                        <td>
                            {$smarty.foreach.products.iteration}
                        </td>
                        <td>
                            <a href="/product/{$item['id']}/">{$item['name']}</a>
                        </td>
                        <td>
                            <input type="number" id="itemCount_{$item['id']}" min="0" value="1"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                onchange="conversionPrice({$item['id']});">
                        </td>
                        <td>
                            <span id="itemPrice_{$item['id']}">
                                {$item['price']}
                            </span>
                        </td>
                        <td>
                            <span id="itemTotalPrice_{$item['id']}">
                                {$item['price']}
                            </span>
                        </td>
                        <td>
                            <button id="addCart_{$item['id']}"
                                onclick="addToCart({$item['id']})"
                                class="hide-me">
                                Восстановить
                            </button>
                            <button id="removeCart_{$item['id']}"
                                onclick="removeFromCart({$item['id']})">
                                Убрать из корзины
                            </button>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        В корзине пусто.
    {/if}

{/block}
