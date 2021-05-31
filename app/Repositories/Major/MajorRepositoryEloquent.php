<?php

namespace App\Repositories\Major;

use App\Repositories\RepositoryEloquent;

class MajorRepositoryEloquent extends RepositoryEloquent implements MajorRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Major::class;
    }
}
