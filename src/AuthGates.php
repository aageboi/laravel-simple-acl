<?php

namespace Aageboi\Acl;

use Aageboi\Acl\Entities\Role;
use Aageboi\Acl\Entities\User;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = Illuminate\Support\Facades\Auth::user();
        $user = auth()->user();

        if ($user) {
            // integrate user model with package model
            $puser            = User::find($user->id);
            $roles            = Role::with('permissions')->get();
            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
                }

            }

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function ($user) use ($roles, $puser) {
                    return count(array_intersect($puser->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }

        return $next($request);
    }
}
