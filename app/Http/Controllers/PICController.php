<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\MajorDetail;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PICController extends Controller
{
    public function showModuls()
    {
        $title = 'All Moduls';

        $user = Auth::user();

        // Ambil major_id dari major_detail berdasarkan user login
        $majorDetail = MajorDetail::where('user_id', $user->id)->first();

        if (!$majorDetail) {
            return back()->with('error', 'Major detail tidak ditemukan untuk user ini.');
        }

        $majorId = $majorDetail->major_id;

        // Ambil semua instructor dari major yang sesuai
        $instructorIds = Instructor::where('majors_id', $majorId)->pluck('id');

        // Ambil semua modul dari instructor tersebut
        $moduls = Modul::with(['modulDetails', 'instructor.users'])
            ->whereIn('instructor_id', $instructorIds)
            ->where('is_active', 1)
            ->get();

        return view('modul.index', compact('title', 'moduls'));

        // $moduls = Modul::with([
        //     'modulDetails',
        //     'instructor.user',
        //     'instructor.major'
        // ])
        //     ->where('is_active', 1)
        //     ->whereHas('instructor', function ($query) {
        //         $query->where('majors_id', 1); // Ganti angka 1 kalau mau dinamis
        //     })
        //     ->get();
        // return view('modul.index', compact('title', 'moduls'));

        //old
        // $moduls = Modul::with([
        //     'modulDetails',
        //     'instructor.user',
        //     'instructor.major'
        // ])
        //     ->where('is_active', 1)
        //     ->whereHas('instructor', function ($query) {
        //         $query->where('majors_id', 1); // Ganti angka 1 kalau mau dinamis
        //     })
        //     ->get();

        // return view('modul.index', compact('title', 'moduls'));
    }
}
