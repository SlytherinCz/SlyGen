<?php

namespace SlytherinCz\SlyGen\Helpers;

class HttpMethodMapping
{
    const INDEX = [
        'controllerMethod' => 'index',
        'httpMethod' => ['GET','HEAD'],
        "requiresSlug" => false
    ];

    const SHOW = [
        'controllerMethod' => 'show',
        'httpMethod' => ['GET','HEAD'],
        "requiresSlug" => true
    ];

    const UPDATE = [
        'controllerMethod' => 'update',
        'httpMethod' => ['PUT'],
        "requiresSlug" => true
    ];

    const CREATE = [
        'controllerMethod' => 'create',
        'httpMethod' => ['POST'],
        "requiresSlug" => false
    ];

    const DELETE = [
        'controllerMethod' => 'delete',
        'httpMethod' => ['DELETE'],
        "requiresSlug" => true
    ];
}