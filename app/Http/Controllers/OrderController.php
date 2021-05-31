<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookOutOnLoan;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order()
    {
        $orders = Order::join('books', 'orders.book_id', '=', 'books.id')->select('orders.id', 'books.name as book_name', 'orders.number', 'orders.created_at')->where('student_id', Auth::user()->id)->paginate(2);

        return view('student.order', compact('orders'));
    }
    public function checkOrder($book_id, Request $request)
    {
        $book = Book::find($book_id);
        $number = $request->number;

        return view('student.check-order', compact('book', 'number'));
    }

    public function postOrder(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        if ($book->stock_amount >= $request->number) {
            $order = new Order();
            $order->book_id = $request->book_id;
            $order->student_id = Auth::user()->id;
            $order->number = $request->number;
            $order->created_at = date('Y-m-d H:i:s');
            $order->save();

            $book->stock_amount = $book->stock_amount - $request->number;
            $book->save();
            toast('Đặt mượn sách thành công', 'success');

            return back();
        }
        toast('Không còn sách trong kho', 'error');

        return back();
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $book = Book::find($order->book_id);
        $book->stock_amount = $book->stock_amount + $order->number;
        $book->save();
        $order->delete();
        toast('Xoá đặt mượn thành công!', 'success');

        return redirect()->route('order');
    }

    // Admin
    public function index()
    {
        $orders = Order::join('books', 'orders.book_id', '=', 'books.id')->join('students', 'orders.student_id', '=', 'students.id')->select('orders.id', 'students.name as student_name', 'books.name as book_name', 'orders.number', 'orders.created_at')->get();

        return view('admin.borrow_pay.order', compact('orders'));
    }

    public function acceptOrder($order_id)
    {
        $order = Order::find($order_id);

        $borrowPay = new BookOutOnLoan();
        $borrowPay->student_id = $order->student_id;
        $borrowPay->book_id = $order->book_id;
        $borrowPay->number = $order->number;
        $borrowPay->date_borrowed = date('Y-m-d H:i:s');
        $borrowPay->date_expiration = date('Y-m-d H:i:s', strtotime($borrowPay->date_borrowed . ' + 30 days'));
        $borrowPay->save();

        $order->delete();
        toast('Đã thêm vào phiếu mượn', 'success');

        return redirect()->route('admin.order');
    }

    public function refuseOrder($order_id)
    {
        $order = Order::find($order_id);
        $book = Book::find($order->book_id);
        $book->stock_amount = $book->stock_amount + $order->number;
        $book->save();
        $order->delete();
        toast('Đã huỷ yêu cầu mượn', 'danger');

        return redirect()->route('admin.order');
    }
}
