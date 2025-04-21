<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{
    public function index()
    {
        $title = 'Instructor List';
        $instructors = Instructor::with('users', 'majors')->get();
        $users = User::orderBy('id', 'desc')->get();
        $majors = Major::orderBy('id', 'desc')->get();

        return view('dashboard.instructor', compact('title', 'instructors', 'users', 'majors'));
    }

    public function store(Request $request)
    {
        $data = [
            'majors_id' => $request->major,
            'user_id' => $request->user,
            'title' => $request->title,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_active' => '1'
        ];

        if ($request->hasFile('photo_profile')) {
            $file = $request->file('photo_profile')->store('photo_instructor', 'public');
            $data['photo'] = $file;
        }

        Instructor::create($data);
        return redirect()->route('instructors.index')->with('success', 'Instructor created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $instructor = Instructor::findOrFail($id);

        $data = [
            'majors_id' => $request->major,
            'user_id' => $request->user,
            'title' => $request->title,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_active' => $request->is_active ?? '1'
        ];

        if ($request->hasFile('photo_profile')) {
            if ($instructor->photo) {
                File::delete(public_path('storage/' . $instructor->photo));
            }

            $file = $request->file('photo_profile')->store('photo_instructor', 'public');
            $data['photo'] = $file;
        }

        $instructor->update($data);
        return redirect()->route('instructors.index')->with('success', 'Instructor updated successfully.');
    }

    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();
        return redirect()->route('instructors.index')->with('success', 'Instructor deleted successfully.');
    }
}
