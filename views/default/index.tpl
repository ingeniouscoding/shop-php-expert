{extends file="base.tpl"}

{block name=title}Главная страница{/block}

{block name=content}

    <div class="products">
        {foreach $products as $item}
            <div class="product-item">
                <a href="/product/{$item['id']}/">
                    <figcaption style="height: 125px;">
                        <img src="images/products/{$item['image']}" alt="{$item['name']}">
                    </figcaption>
                </a>
                <a href="/product/{$item['id']}/">
                    {$item['name']}
                </a>
            </div>
        {/foreach}
    </div>

{/block}
