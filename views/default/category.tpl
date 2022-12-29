{extends file="base.tpl"}

{block name=title}Товары категории {$category['name']}{/block}

{block name=content}

    <h1>Товары категории {$category['name']}</h1>

    <div class="products">
        {foreach $products as $item}
            <div class="product-item">
                <a href="/product/{$item['id']}/">
                    <figcaption style="height: 125px;">
                        <img src="/images/products/{$item['image']}" alt="{$item['name']}">
                    </figcaption>
                </a>
                <a href="/product/{$item['id']}/">
                    {$item['name']}
                </a>
            </div>
        {/foreach}
    </div>
    <div class="products">
        {foreach $childrenCategories as $item}
            <h2><a href="/category/{$item['id']}/">{$item['name']}</a></h2>
        {/foreach}
    </div>

    {if !$products && !$childrenCategories}
        <h2>Нет товаров в данной категории</h2>
    {/if}

{/block}
