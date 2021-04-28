<?php

Route::group(['prefix' => config('acl.route.prefix'), 'as' => config('acl.route.as'), 'middleware' => ['web', 'auth']], function () {
    // Permissions
    Route::delete('permissions/destroy', 'Aageboi\Acl\Controllers\PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'Aageboi\Acl\Controllers\PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'Aageboi\Acl\Controllers\RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'Aageboi\Acl\Controllers\RolesController');
});