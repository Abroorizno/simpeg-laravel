<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\MajorDetail;
use App\Models\UserRole;
use Illuminate\Http\Request;

class MajorDetailController extends Controller
{
    public function index()
    {
        $title = 'Majors List';
        $datas = MajorDetail::with('majors', 'user')->orderBy('id', 'desc')->get();
        $majors = Major::orderBy('id', 'desc')->get();
        $user_roles = UserRole::with('users')->where('role_id', 1)->get();

        return view('dashboard.majordetail', compact('title', 'datas', 'majors', 'user_roles'));
    }

    public function store(Request $request)
    {
        $data = [
            'majors_id' => $request->major,
            'user_id' => $request->user
        ];

        MajorDetail::create($data);

        return redirect()->route('major_details.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = [
            'majors_id' => $request->major,
            'user_id' => $request->user,
        ];

        MajorDetail::where('id', $id)->update($data);

        return redirect()->route('major_details.index')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        MajorDetail::where('id', $id)->delete();

        return redirect()->route('major_details.index')->with('success', 'Data Berhasil Dihapus');
    }
}
