<?php

function loadPage(Smarty $smarty, string $controllerName, string $actionName = 'index'): void
{
    include_once PathPrefix . $controllerName . PathPostfix;

    $action = $actionName . 'Action';
    $action($smarty);
}

function dd($value = null, bool $die = true): void
{
    echo 'Debug <br /><pre>';
    print_r($value);
    echo '</pre>';

    if ($die) {
        die();
    }
}
