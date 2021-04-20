<?php

namespace Aageboi\Acl;

use Aageboi\Acl\Entities\Role;

trait HasACL
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}