<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BookOutOnLoan;
use App\Repositories\Borrowpay\BorrowpayRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookOutOnLoanController extends Controller
{
    protected $borrowpayRepository;

    public function __construct(BorrowpayRepositoryInterface $borrowpayRepository)
    {
        $this->borrowpayRepository = $borrowpayRepository;
    }

    // ! STUDENT
    public function studentBorrowPay(Request $request)
    {
        $borrowPay = $this->borrowpayRepository->studentBorrowPay(Auth::guard('student')->id(), $request->keyword)->paginate(3);
        return view('student.borrow-pay', compact('borrowPay'));
    }



    // ! ADMIN
    public function index(Request $request)
    {
        $borrowPays = $this->borrowpayRepository->index($request->keyword);
        $books = $this->borrowpayRepository->getBook();
        $students = $this->borrowpayRepository->getStudent();
        $dateBorrowed = $this->borrowpayRepository->getDateBorrow();

        return view('admin.borrow_pay.index', compact('borrowPays', 'books', 'students', 'dateBorrowed'));
    }

    public function show($id)
    {
        $result = $this->borrowpayRepository->show($id);

        return $result;
    }

    public function store(Request $request)
    {
        $result = $this->borrowpayRepository->create($request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.borrow_pay');
    }

    public function edit($id)
    {
        $borrowPay = $this->borrowpayRepository->find($id);

        return view('admin.borrow_pay.edit', compact('borrowPay'));
    }

    public function update($id, Request $request)
    {
        $update = $this->borrowpayRepository->updateBorrow($id, $request->all());
        toast($update['message'], $update['type']);

        return redirect()->route('admin.borrow_pay');
    }

    public function getReturn($id)
    {
        $borrowPay = $this->borrowpayRepository->find($id);
        $dueDate = $this->borrowpayRepository->getDueDate($borrowPay->date_expiration);
        $fine = $this->borrowpayRepository->getFine($dueDate);

        return view('admin.borrow_pay.pay', compact('borrowPay', 'dueDate', 'fine'));
    }

    public function postReturn($id, Request $request)
    {
        $return = $this->borrowpayRepository->returnBorrow($id, $request->all());
        toast($return['message'], $return['type']);

        return redirect()->route('admin.borrow_pay');
    }

    public function delete($id)
    {
        $result = $this->borrowpayRepository->delete($id);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.borrow_pay');
    }
}
