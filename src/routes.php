<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth']], function () {
    // Permissions
    Route::delete('permissions/destroy', 'Aageboi\Acl\Controllers\PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'Aageboi\Acl\Controllers\PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'Aageboi\Acl\Controllers\RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'Aageboi\Acl\Controllers\RolesController');
    Route::resource('users', 'Aageboi\Acl\Controllers\UsersController');
});