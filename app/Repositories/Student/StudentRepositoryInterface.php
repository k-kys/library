<?php

namespace App\Repositories\Student;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface StudentRepositoryInterface extends RepositoryInterface
{
    // STUDENT
    public function getTotalBook($id);
    public function getPaidBook($id);
    public function getUnpaidBook($id);
    public function getNumberOfPenalties($id);
    public function home($keyword);
    public function profile($id);
    public function updateProfile($id, $request);
    public function updatePassword($id, $data);
    // ADMIN
    public function updateStudent($id, array $data);
    public function block($id);
    public function unblock($id);
}
