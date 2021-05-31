<?php

namespace App\Repositories\Admin;

use App\Repositories\RepositoryInterface;
use Request;

interface AdminRepositoryInterface extends RepositoryInterface
{

    public function getRole();
    public function getPermission();
    public function updateImagePath($requestHasFile, $requestFile, $id);
    public function updateProfile($id, $request);
}
