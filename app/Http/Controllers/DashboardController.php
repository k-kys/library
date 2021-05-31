<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookOutOnLoan;
use App\Models\Order;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $tblMuonSach = 'books_out_on_loan';
        $tblSinhVien = 'students';
        $tblSach = 'books';
        $tblOrder = 'orders';

        $totalAmount = Book::selectRaw('sum(amount) as total_amount')->first()->total_amount;
        $totalStockAmount = Book::selectRaw('sum(stock_amount) as total_stock_amount')->first()->total_stock_amount;
        $totalBorrow = BookOutOnLoan::selectRaw('count(id) as count')->first()->count;
        // $borrowing = BookOutOnLoan::selectRaw('count(id) as count')->where('status', 0)->first()->count;

        $totalStudent = Student::selectRaw('count(id) as total_student')->first()->total_student;
        // $studentBlock = Student::selectRaw('count(id) as student_block')->where('status', 0)->first()->student_block;

        // ! LẤY DỮ LIỆU ra table
        $orders = Order::join("{$tblSach}", "{$tblOrder}.book_id", '=', "{$tblSach}.id")->join("{$tblSinhVien}", "{$tblOrder}.student_id", '=', "{$tblSinhVien}.id")->select("{$tblOrder}.id", "{$tblSinhVien}.name as student_name", "{$tblSach}.name as book_name", "{$tblOrder}.number", "{$tblOrder}.created_at")->orderByDesc('created_at')->limit(5)->get();

        $recentBorrows = BookOutOnLoan::join("{$tblSinhVien}", "{$tblMuonSach}.student_id", '=', "{$tblSinhVien}.id")->join("{$tblSach}", "{$tblMuonSach}.book_id", '=', "{$tblSach}.id")->select("{$tblMuonSach}.id", "{$tblSinhVien}.name as student_name", "{$tblSach}.name as book_name", "{$tblMuonSach}.number", "{$tblMuonSach}.status", "{$tblMuonSach}.created_at")->orderByDesc('created_at')->limit(10)->get();

        $recentReturned = BookOutOnLoan::join("{$tblSinhVien}", "{$tblMuonSach}.student_id", '=', "{$tblSinhVien}.id")->join("{$tblSach}", "{$tblMuonSach}.book_id", '=', "{$tblSach}.id")->select("{$tblMuonSach}.id", "{$tblSinhVien}.name as student_name", "{$tblSach}.name as book_name", "{$tblMuonSach}.number", "{$tblMuonSach}.status", "{$tblMuonSach}.updated_at")->where("{$tblMuonSach}.status", 1)->orderByDesc('updated_at')->limit(10)->get();

        // $borrowTheMostPreviousMonth = ;
        // $borrowTheMost = ;

        $newBook = Book::select('id', 'name', 'amount', 'price', 'image', 'created_at')->orderByDesc('created_at')->limit(5)->get();
        // $deleteBook = ;

        // $studentPunished = BookOutOnLoan::join("{$tblSinhVien}", "{$tblMuonSach}.student_id", '=', "{$tblSinhVien}.id")->join("{$tblSach}", "{$tblMuonSach}.book_id", '=', "{$tblSach}.id")->select("{$tblSinhVien}.name as student_name", "{$tblSach}.name as book_name", "{$tblMuonSach}.amount_of_fine", "{$tblMuonSach}.updated_at")->where('amount_of_fine', '>', 0)->orderByDesc('updated_at')->limit(10)->get();
        // dd($recentBorrow);
        $studentRegisterRecent = Student::select('id', 'name', 'image', 'created_at')->orderByDesc('created_at')->limit(8)->get();

        return view('admin.dashboard', compact('totalAmount', 'totalStockAmount', 'totalBorrow', 'totalStudent', 'orders', 'recentBorrows', 'recentReturned', 'newBook', 'studentRegisterRecent'));
    }
}
