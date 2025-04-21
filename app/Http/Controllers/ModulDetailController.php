<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\ModulDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulDetailController extends Controller
{
    public function index()
    {
        $title = 'Module Details';
        $modulDetail = ModulDetail::with('moduls')->get();

        return view('modul.details', compact('title', 'modulDetail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required_if:type,pdf|mimes:pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('upload_file')) {
            $filePath = $request->file('upload_file')->store('moduls', 'public');
        }

        $data = [
            'learning_modul_id' => $request->modul_id,
            'file_name' => $request->file_name,
            'file' => $filePath,
            'reference_link' => $request->link_references,
        ];

        ModulDetail::create($data);

        // return redirect()->back()->with('success', 'Materi berhasil disimpan.');
        return redirect()->route('moduls.index')->with('success', 'Modul Added!');
    }

    public function update(Request $request, string $id)
    {
        $modulDetail = ModulDetail::findOrFail($id);

        $request->validate([
            'file_path' => 'required_if:type,pdf|mimes:pdf|max:2048',
        ]);

        $filePath = $modulDetail->file; // Keep the existing file path
        if ($request->hasFile('upload_file')) {
            $filePath = $request->file('upload_file')->store('moduls', 'public'); // Update the file if a new one is uploaded
        }

        $data = [
            'learning_modul_id' => $request->modul_id,
            'file_name' => $request->file_name,
            'file' => $filePath,
            'reference_link' => $request->link_references,
        ];

        $modulDetail->update($data);
        return redirect()->route('moduls.index')->with('success', 'Modul Updated!');
    }

    public function destroy($id)
    {
        $modulDetail = ModulDetail::findOrFail($id);
        $modulDetail->delete();
        return redirect()->route('moduls.index')->with('success', 'Course Deleted!');
    }
}
