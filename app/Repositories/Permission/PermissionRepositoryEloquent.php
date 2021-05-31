<?php

namespace App\Repositories\Permission;

use App\Repositories\RepositoryEloquent;

class PermissionRepositoryEloquent extends RepositoryEloquent implements PermissionRepositoryInterface
{
    public function getModel()
    {
        return \Spatie\Permission\Models\Permission::class;
    }
}
