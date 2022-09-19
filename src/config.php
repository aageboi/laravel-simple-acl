<?php

return [
    'user-model' => 'App\\User',
    'view' => 'acl::',
    'layout' => 'acl::layout',
    'route' => [
        'prefix' => 'admin/acl/',
        'as' => 'admin.acl.'
    ]
];