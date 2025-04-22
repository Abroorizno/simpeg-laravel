<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Modul;
use App\Models\ModulDetail;
use App\Models\PIC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulController extends Controller
{
    public function index()
    {
        $title = 'List of Modules';
        $user = Auth::user();

        // Ambil data instructor berdasarkan user_id
        $instructor = Instructor::where('user_id', $user->id)->first();

        if (!$instructor) {
            return back()->with('error', 'Instructor tidak ditemukan untuk user ini.');
        }

        // Ambil modul berdasarkan instructor_id
        $datas = Modul::with('instructor.users', 'modulDetails')->where('instructor_id', $instructor->id)->get();

        return view('modul.index', compact('title', 'datas', 'instructor'));
    }

    public function showModuls()
    {
        $title = 'Moduls Active';

        $modulses = Modul::with([
            'modulDetails',
            'instructor.user',
            'instructor.major'
        ])
            ->where('is_active', 1)
            ->whereHas('instructor', function ($query) {
                $query->where('majors_id', 1); // Ganti angka 1 kalau mau dinamis
            })
            ->get();

        return view('modul.index', compact('title', 'modulses'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Ambil data instructor berdasarkan user_id
        $instructor = Instructor::where('user_id', $user->id)->first();

        if (!$instructor) {
            return back()->with('error', 'Instructor tidak ditemukan untuk user ini.');
        }

        $data = [
            'name' => $request->name,
            'instructor_id' => $instructor->id,
            'description' => $request->desc,
            'is_active' => 1
        ];

        Modul::create($data);
        return redirect()->route('moduls.index')->with('success', 'Module created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $modul = Modul::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->desc,
            'is_active' => $request->is_active
        ];

        $modul->update($data);
        return redirect()->route('moduls.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(string $id)
    {
        $modul = Modul::findOrFail($id);

        // Delete related ModulDetails first
        ModulDetail::where('learning_modul_id', $id)->delete();

        // Delete the Modul record
        $modul->delete();
        return redirect()->route('moduls.index')->with('success', 'Module deleted successfully.');
    }
}
