<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Modul;
use App\Models\ModulDetail;
use App\Models\Student;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index()
    {
        $title = 'Student List';
        $students = Student::with('users', 'majors')->get();
        $user_roles = UserRole::with('users')->where('role_id', 5)->get();
        $majors = Major::orderBy('id', 'desc')->get();

        // return $students;

        return view('dashboard.student', compact('title', 'students', 'user_roles', 'majors'));
    }

    public function showModuls()
    {
        $title = 'Moduls Active';
        $student = Student::with('users', 'majors')->get();

        $moduls = Modul::with(['modulDetails', 'instructor.users'])
            ->where('instructor_id', 1)
            ->where('is_active', 1)
            ->whereHas('instructor', function ($query) {
                $query->where('majors_id', 1);
            })
            ->get();

        return view('modul.index', compact('title', 'student', 'moduls'));
    }

    public function store(Request $request)
    {
        $data = [
            'majors_id' => $request->major,
            'user_id' => $request->user,
            'gender' => $request->gender,
            'date_of_birth' => $request->dob,
            'place_of_birth' => $request->pob,
            'is_active' => '1'
        ];

        if ($request->hasFile('photo_profile')) {
            $file = $request->file('photo_profile')->store('photo_students', 'public');
            $data['photo'] = $file;
        }

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $data = [
            'majors_id' => $request->major,
            'user_id' => $request->user,
            'gender' => $request->gender,
            'date_of_birth' => $request->dob,
            'place_of_birth' => $request->pob,
            'is_active' => $request->has('is_active') ? '1' : '0'
        ];

        if ($request->hasFile('photo')) {
            if ($student->photo) {
                File::delete(public_path('storage/' . $student->photo));
            }

            $file = $request->file('photo')->store('photo_students', 'public');
            $data['photo'] = $file;
        }

        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }
}
