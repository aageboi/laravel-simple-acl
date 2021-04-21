# Laravel Simple ACL


1. You can install this package via Composer by running this command: `composer require aageboi/laravel-simple-acl`

2. Register the service provider in config/app.php in the providers array:

'providers' => [
    ...
    Aageboi\Acl\AclServiceProvider::class
],

3. Publish config file:

`php artisan vendor:publish`

