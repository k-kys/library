<?php

namespace App\Repositories\Borrowpay;

use App\Models\Book;
use App\Models\BookOutOnLoan;
use App\Models\Student;
use App\Repositories\RepositoryEloquent;

class BorrowpayRepositoryEloquent extends RepositoryEloquent implements BorrowpayRepositoryInterface
{
    public function getModel()
    {
        # code...
        return \App\Models\BookOutOnLoan::class;
    }

    public function getBorrowPay()
    {
        return $this->_model->join('students', 'books_out_on_loan.student_id', '=', 'students.id')->join('books', 'books_out_on_loan.book_id', '=', 'books.id')->select('books_out_on_loan.id', 'students.name as student_name', 'books.name as book_name', 'books_out_on_loan.number', 'books_out_on_loan.status', 'books_out_on_loan.updated_at')->get();
    }

    public function searchStudentOrBook($keyword)
    {
        return $this->_model->join('students', 'books_out_on_loan.student_id', '=', 'students.id')->join('books', 'books_out_on_loan.book_id', '=', 'books.id')->select('books_out_on_loan.id', 'students.name as student_name', 'books.name as book_name', 'books_out_on_loan.number', 'books_out_on_loan.status', 'books_out_on_loan.updated_at')->where('students.name', 'like', "%{$keyword}%")->orWhere('books.name', 'like', "%{$keyword}%")->get();
    }

    public function getStudent()
    {
        return Student::all();
    }

    public function getBook()
    {
        return Book::all();
    }

    public function getDateBorrow()
    {
        return date('Y-m-d');
    }

    public function getDueDate($dateExpiry)
    {
        $curDate = date('Y-m-d');
        $dueDate = ceil((strtotime($curDate) - strtotime($dateExpiry)) / 60 / 60 / 24);
        if ($dueDate < 0) {
            $dueDate = 0;
        }

        return $dueDate;
    }

    public function getFine($dueDate)
    {

        return $fine = $dueDate * 10000;
    }

    public function studentBorrowPay($id, $keyword)
    {
        $query = $this->_model->select('books_out_on_loan.id', 'books.name', 'books_out_on_loan.number', 'books_out_on_loan.date_borrowed', 'books_out_on_loan.date_expiration', 'books_out_on_loan.date_returned', 'books_out_on_loan.status', 'books_out_on_loan.amount_of_fine')->join('students', 'books_out_on_loan.student_id', '=', 'students.id')->join('books', 'books_out_on_loan.book_id', '=', 'books.id')->where('student_id', $id);
        if ($keyword) {
            $query->where('books.name', 'like', "%{$keyword}%");
        }
        return $query->orderByDesc('books_out_on_loan.id');
    }

    public function index($keyword)
    {
        if ($keyword) {
            return $this->searchStudentOrBook($keyword)->sortByDesc('updated_at');
        } elseif (!$keyword || $keyword == '') {
            return $this->getBorrowPay()->sortByDesc('updated_at');
        }
    }

    public function show($id)
    {
        $result = $this->_model->join('students', 'books_out_on_loan.student_id', '=', 'students.id')->join('books', 'books_out_on_loan.book_id', '=', 'books.id')->select('books_out_on_loan.id as id', 'students.name as student_name', 'books.name as book_name', 'books_out_on_loan.number', 'books_out_on_loan.date_borrowed', 'books_out_on_loan.date_expiration', 'books_out_on_loan.date_returned', 'books_out_on_loan.status', 'books_out_on_loan.amount_of_fine')->where('books_out_on_loan.id', $id)->first();
        return [
            'id' => $result->id,
            'student_name' => $result->student_name,
            'book_name' => $result->book_name,
            'number' => $result->number,
            'date_borrowed' => $result->date_borrowed,
            'date_expiration' => $result->date_expiration,
            'date_returned' => $result->date_returned,
            'status' => $result->status,
            'fine' => $result->amount_of_fine
        ];
    }

    public function create(array $data)
    {
        if ($data['number'] <= 0) {
            return [
                'message' => 'S??? l?????ng m?????n kh??ng ch??nh x??c',
                'type' => 'error'
            ];
        }

        $student = Student::find($data['student_id']);
        $book = Book::find($data['book_id']);
        if ($student && $book) {
            if ($book->stock_amount >= $data['number']) {
                $borrowPay = new BookOutOnLoan();
                $borrowPay->student_id = $data['student_id'];
                $borrowPay->book_id = $data['book_id'];
                $borrowPay->number = $data['number'];
                $borrowPay->date_borrowed = date('Y-m-d H:i:s');
                $borrowPay->date_expiration = $data['date_expiration'];
                $borrowPay->save();

                $book->stock_amount = $book->stock_amount - $data['number'];
                $book->save();

                return [
                    'message' => 'Th??m phi???u m?????n th??nh c??ng!',
                    'type' => 'success'
                ];
            }
            return [
                'message' => 'S??ch c??n l???i kh??ng ?????',
                'type' => 'warning'
            ];
        }
        return [
            'message' => 'Nh???p sinh vi??n ho???c s??ch sai',
            'type' => 'error'
        ];
    }

    public function updateBorrow($id, array $data)
    {
        $borrowPay = $this->find($id);
        if ($borrowPay) {
            $oldNumber = $borrowPay->number;

            $borrowPay->date_expiration = $data['date_expiration'];
            $borrowPay->updated_at = date('Y-m-d H:i:s');

            $book = Book::find($borrowPay->book_id);
            if ($data['number'] <= $book->stock_amount + $oldNumber) {
                $borrowPay->number = $data['number'];
                $borrowPay->save();

                $book->stock_amount = $book->stock_amount + $oldNumber - $data['number'];
                $book->save();

                return [
                    'message' => 'C???p nh???t phi???u m?????n th??nh c??ng',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => 'S??? s??ch c??n l???i trong kho kh??ng ?????',
                    'type' => 'error'
                ];
            }
        }
        return [
            'message' => 'M?? phi???u m?????n kh??ng ch??nh x??c',
            'type' => 'error'
        ];
    }

    public function returnBorrow($id, array $data)
    {
        $borrowPay = $this->find($id);
        if ($borrowPay) {
            $oldNumber = $borrowPay->number;

            $borrowPay->date_returned = date('Y-m-d H:i:s');
            $borrowPay->status = 1;
            $borrowPay->amount_of_fine = $data['fine'];
            $borrowPay->updated_at = date('Y-m-d H:i:s');
            $borrowPay->save();

            $book = Book::find($borrowPay->book_id);
            $book->stock_amount = $book->stock_amount + $oldNumber;
            $book->save();

            return [
                'message' => 'Tr??? s??ch th??nh c??ng!',
                'type' => 'success'
            ];
        }
        return [
            'message' => 'M?? phi???u m?????n kh??ng ch??nh x??c',
            'type' => 'error'
        ];
    }

    public function delete($id)
    {
        $borrowPay = $this->find($id);
        if ($borrowPay) {
            if ($borrowPay->status == 1) {
                $borrowPay->delete();
                return [
                    'message' => 'X??a phi???u m?????n th??nh c??ng!',
                    'type' => 'success'
                ];
            }
            return [
                'message' => 'Ch??a tr??? s??ch, kh??ng th??? x??a',
                'type' => 'warning'
            ];
        }
        return [
            'message' => 'M?? phi???u m?????n kh??ng ch??nh x??c',
            'type' => 'error'
        ];
    }
}
