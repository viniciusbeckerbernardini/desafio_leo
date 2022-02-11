<?php

function router()
{
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == "GET") {
        switch ($uri) {
            default:
                require_once("view/404.php");
                break;
        }

    }

    if ($method == "POST") {
        switch ($uri) {
            default:
                require_once("view/404.php");
                break;
        }

    }
}