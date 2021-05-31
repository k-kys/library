<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use DOMDocument;
use Illuminate\Http\Request;


class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    // STUDENT
    public function show($id)
    {
        $book  = $this->bookRepository->show($id);

        return view('student.book-detail', compact('book'));
    }

    // ADMIN
    public function index(Request $request)
    {
        $books = $this->bookRepository->index($request->keyword);

        return view('admin.book.index', compact('books'));
    }

    public function create()
    {

        $categories = $this->bookRepository->getCategory();
        $majors = $this->bookRepository->getMajor();

        return view('admin.book.add', compact('categories', 'majors'));
    }

    public function store(Request $request)
    {
        $path = '/storage/images/book/description/';
        $description = $this->bookRepository->getDescription(null, $request, $path);
        $result = $this->bookRepository->createBook($request, $description);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.book');
    }

    public function edit($id)
    {
        $book = $this->bookRepository->find($id);
        $categories = $this->bookRepository->getCategory();
        $majors = $this->bookRepository->getMajor();

        return view('admin.book.edit', compact('book', 'categories', 'majors'));
    }

    public function update(Request $request, $id)
    {
        $path = '/storage/images/book/description/';
        $description = $this->bookRepository->getDescription($this->bookRepository->find($id)->description, $request, $path);
        $result = $this->bookRepository->updateBook($id, $request, $description);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.book');
    }

    public function delete($id)
    {
        $check = $this->bookRepository->checkBook($id);
        if ($check == true) {
            $result = $this->bookRepository->delete($id);
            toast($result['message'], $result['type']);

            return redirect()->route('admin.book');
        }
        toast('Sách đang được mượn, không thể xóa', 'error');

        return back();
    }
}
