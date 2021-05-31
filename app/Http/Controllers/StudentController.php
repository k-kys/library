<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Student;
use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    private function id()
    {
        return Auth::guard('student')->id();
    }

    // USER - STUDENT
    public function home(Request $request)
    {
        $id = $this->id();
        $books = $this->studentRepository->home($request->keyword)->paginate(12);
        $totalBook = $this->studentRepository->getTotalBook($id);
        $paidBook = $this->studentRepository->getPaidBook($id);
        $unpaidBook = $this->studentRepository->getUnpaidBook($id);
        $numberOfPenalties = $this->studentRepository->getNumberOfPenalties($id);

        return view('student.home', compact('books', 'totalBook', 'paidBook', 'unpaidBook', 'numberOfPenalties'));
    }

    // public function getBookSearch(Request $request)
    // {
    //     $book  = Book::query();
    //     if ($request->has('filterCategory')) {
    //         $book->where('')
    //     }
    // }

    public function profile()
    {
        $profile = $this->studentRepository->profile($this->id());
        return view('student.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $result = $this->studentRepository->updateProfile($this->id(), $request);

        toast($result['message'], $result['type']);
        return redirect()->route('profile');
    }


    public function updatePassword(Request $request, $id)
    {
        return $this->studentRepository->updatePassword($id, $request->all());
    }


    // ADMIN
    public function index(Request $request)
    {
        $students = $this->studentRepository->index($request->keyword);

        return view('admin.student.index', compact('students'));
    }

    public function store(Request $request)
    {
        $result = $this->studentRepository->create($request->all());
        toast($result['message'], $result['type']);
        return redirect()->route('admin.student');
    }

    public function edit($id)
    {
        $student = $this->studentRepository->find($id);
        return view('admin.student.edit', compact('student'));
    }

    public function update($id, Request $request)
    {
        $result = $this->studentRepository->updateStudent($id, $request->all());
        toast($result['message'], $result['type']);
        return redirect()->route('admin.student');
    }

    public function delete($id)
    {
        $result = $this->studentRepository->delete($id);
        toast($result['message'], $result['type']);
        return redirect()->route('admin.student');
    }

    public function block($id)
    {
        $result = $this->studentRepository->block($id);
        toast($result['message'], $result['type']);
        return redirect()->route('admin.student');
    }

    public function unblock($id)
    {
        $result = $this->studentRepository->unblock($id);
        toast($result['message'], $result['type']);
        return redirect()->route('admin.student');
    }
}
