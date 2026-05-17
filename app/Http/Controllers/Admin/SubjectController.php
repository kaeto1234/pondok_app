<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'book_name' => 'nullable|string|max:100',
            'author' => 'nullable|string|max:100',
            'description' => 'nullable',
        ]);

        Subject::create($request->all());
        return redirect()->route('admin.subjects.index')->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        return redirect()->route('admin.subjects.index')->with('success', 'Mata pelajaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Mata pelajaran berhasil dihapus');
    }
}