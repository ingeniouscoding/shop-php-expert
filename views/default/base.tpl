<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name=title}{/block}</title>
    <link rel="stylesheet" href="{$templateWebPath}css/main.css">
    <script src="/js/main.js" defer></script>
</head>

<body>

    {include file="partials/header.tpl"}

    <div class="container">

        {include file="partials/leftColumn.tpl"}

        <main class="center-column">

            {block name=content}{/block}

        </main>

    </div>

    {include file="partials/footer.tpl"}

</body>

</html>
