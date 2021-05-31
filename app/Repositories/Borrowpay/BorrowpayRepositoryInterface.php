<?php

namespace App\Repositories\Borrowpay;

use App\Repositories\RepositoryInterface;

interface BorrowpayRepositoryInterface extends RepositoryInterface
{
    public function getBorrowPay();
    public function searchStudentOrBook($keyword);
    public function getStudent();
    public function getBook();
    public function getDateBorrow();
    public function getDueDate($dateExpiry);
    public function getFine($dueDate);
    public function studentBorrowPay($id, $keyword);
    public function index($keyword);
    public function show($id);
    public function updateBorrow($id, array $attributes);
    public function returnBorrow($id, array $attributes);
    // public function deleteBorrowPay($id);
}
