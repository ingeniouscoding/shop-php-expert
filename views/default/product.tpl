{extends file="base.tpl"}

{block name=content}

    <h3>{$product['name']}</h3>
    <img src="/images/products/{$product['image']}" alt="{$product['name']}" style="width: 574px;">

    <div class="product-price">
        Стоимость: {$product['price']}
        <button id="addCart_{$product['id']}"
            onclick="addToCart({$product['id']})"
            {if $inCart} class="hide-me" {/if}>
            Добавить в корзину
        </button>
        <button id="removeCart_{$product['id']}"
            onclick="removeFromCart({$product['id']})"
            {if !$inCart} class="hide-me" {/if}>
            Убрать из корзины
        </button>
    </div>

    <p>Описание<br />{$product['description']}</p>

{/block}
