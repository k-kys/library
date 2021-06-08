<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookOutOnLoanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Models\Admin;
use App\Models\Book;
use App\Models\Category;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('test', function () {
    $book = Category::where('id', 8)->first()->books()->get();
    echo '<table border="1" cellspacing=0>';
    echo '<tr>
            <th>ID sách</th>
            <th>ISBN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Stock amount</th>
            <th>Image</th>
            <th>Created</th>
            <th>Updated</th>
        <tr/>';
    foreach ($book as $item) {
        echo '<tr>
        <td>' . $item->id . '</td>
        <td>' . $item->isbn . '</td>
        <td>' . $item->name . '</td>
        <td>' . $item->description . '</td>
        <td>' . $item->price . '</td>
        <td>' . $item->amount . '</td>
        <td>' . $item->stock_amount . '</td>
        <td>' . $item->image . '</td>
        <td>' . $item->created_at . '</td>
        <td>' . $item->updated_at . '</td>
        </tr>';
    }
    echo '</table>';
});

Route::get('/', [LoginController::class, 'checkLogin']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Test Summernote
Route::get('summernote-image', [ImageController::class, 'image'])->name('summernote.get');
Route::post('summernote-image', [ImageController::class, 'upload'])->name('summernote.image.upload');


Route::get('avatar/resize/{size}/{imagePath}', [ImageController::class, 'flyResizeAvatar'])->where('imagePath', '(.*)');
Route::get('book/resize/{size}/{imagePath}', [ImageController::class, 'flyResizeBook'])->where('imagePath', '(.*)');
Route::post('upload/image_book', [ImageController::class, 'uploadImageBook']);

Route::get('/login', [LoginController::class, 'getLogin'])->name('get_login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

// Student
Route::group(['prefix' => '/', 'middleware' => 'auth:student'], function () {
    Route::get('home', [StudentController::class, 'home'])->name('home');
    Route::get('search_book', [StudentController::class, 'getBookSearch'])->name('search_book');
    Route::get('borrow_pay', [BookOutOnLoanController::class, 'studentBorrowPay'])->name('borrow_pay');
    Route::get('order', [OrderController::class, 'order'])->name('order');
    Route::get('profile', [StudentController::class, 'profile'])->name('profile');
    Route::post('profile/{id}', [StudentController::class, 'updateProfile'])->name('update');
    Route::get('change_password', function () {
        return view('student.change-password');
    });
    Route::post('update_password/{id}', [StudentController::class, 'updatePassword'])->name('update_password');

    //

    Route::get('book_detail/{book_id}', [BookController::class, 'show'])->name('book_detail');
    // Route::get('order/check/{book_id}', [OrderController::class, 'checkOrder'])->name('check_order');
    Route::post('order', [OrderController::class, 'postOrder'])->name('post_order');
    Route::get('order/destroy/{order_id}', [OrderController::class, 'destroy'])->name('destroy_order');

    // Route::get('resize/{size}/{imagePath}', [StudentController::class, 'flyResize'])->where('imagePath', '(.*)');

});



// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('profile/{id}', [AdminController::class, 'updateProfile'])->name('update_profile');

    Route::get('change_password', function () {
        return view('admin.change-password');
    })->name('change_password');
    Route::post('update_password', [LoginController::class, 'adminUpdatePassword'])->name('update_password');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::post('store', [CategoryController::class, 'store'])->name('store_category');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit_category');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update_category');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete_category');
    });

    Route::group(['prefix' => 'major'], function () {
        Route::get('/', [MajorController::class, 'index'])->name('major');
        Route::post('store', [MajorController::class, 'store'])->name('store_major');
        Route::get('edit/{id}', [MajorController::class, 'edit'])->name('edit_major');
        Route::post('update/{id}', [MajorController::class, 'update'])->name('update_major');
        Route::get('delete/{id}', [MajorController::class, 'delete'])->name('delete_major');
    });

    Route::group(['prefix' => 'book'], function () {
        Route::get('/', [BookController::class, 'index'])->name('book');
        Route::get('add', [BookController::class, 'create'])->name('add_book');
        Route::post('store', [BookController::class, 'store'])->name('store_book');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('edit_book');
        Route::post('update/{id}', [BookController::class, 'update'])->name('update_book');
        Route::get('delete/{id}', [BookController::class, 'delete'])->name('delete_book');
    });

    Route::group(['prefix' => 'borrow_pay'], function () {
        Route::get('/', [BookOutOnLoanController::class, 'index'])->name('borrow_pay');
        Route::post('store', [BookOutOnLoanController::class, 'store'])->name('store_borrow_pay');
        Route::get('show/{id}', [BookOutOnLoanController::class, 'show'])->name('show_borrow_pay');
        Route::get('edit/{id}', [BookOutOnLoanController::class, 'edit'])->name('edit_borrow_pay');
        Route::post('update/{id}', [BookOutOnLoanController::class, 'update'])->name('update_borrow_pay');
        Route::get('return/{id}', [BookOutOnLoanController::class, 'getReturn'])->name('getReturn_borrow_pay');
        Route::post('return/{id}', [BookOutOnLoanController::class, 'postReturn'])->name('return_borrow_pay');
        Route::get('delete/{id}', [BookOutOnLoanController::class, 'delete'])->name('delete_borrow_pay');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('order');
        Route::get('accept/{order_id}', [OrderController::class, 'acceptOrder'])->name('accept_order');
        Route::get('refuse/{order_id}', [OrderController::class, 'refuseOrder'])->name('refuse_order');
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('/', [StudentController::class, 'index'])->name('student');
        Route::post('store', [StudentController::class, 'store'])->name('store_student');
        Route::get('show/{id}', [StudentController::class, 'show'])->name('show_student');
        Route::get('edit/{id}', [StudentController::class, 'edit'])->name('edit_student');
        Route::post('update/{id}', [StudentController::class, 'update'])->name('update_student');
        Route::get('block/{id}', [StudentController::class, 'block'])->name('block_student');
        Route::get('unblock/{id}', [StudentController::class, 'unblock'])->name('unblock_student');
        Route::get('delete/{id}', [StudentController::class, 'delete'])->name('delete_student');
    });

    Route::group(['prefix' => 'staff'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('staff');
        Route::post('store', [AdminController::class, 'store'])->name('store_staff');
        Route::get('show/{id}', [AdminController::class, 'show'])->name('show_staff');
        Route::get('edit/{id}', [AdminController::class, 'edit'])->name('edit_staff');
        Route::post('update/{id}', [AdminController::class, 'update'])->name('update_staff');
        Route::get('delete/{id}', [AdminController::class, 'delete'])->name('delete_staff');
        Route::get('role_permission/{id}', [AdminController::class, 'editRolePermission'])->name('edit_role_permission_staff');
        Route::post('role_permission/{id}', [AdminController::class, 'updateRolePermission'])->name('update_role_permission_staff');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role');
        Route::post('store', [RoleController::class, 'store'])->name('store_role');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit_role');
        Route::post('update/{id}', [RoleController::class, 'update'])->name('update_role');
        Route::get('delete/{id}', [RoleController::class, 'delete'])->name('delete_role');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission');
        Route::post('store', [PermissionController::class, 'store'])->name('store_permission');
        Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('delete_permission');
    });
});
