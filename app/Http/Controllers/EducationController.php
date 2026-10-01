<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::where('user_id', Auth::id())
            ->latest('start_date')
            ->get();

        return view('education.index', compact('educations'));
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Education::create($validated);

        return redirect()
            ->route('education.index')
            ->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    public function show(Education $education)
    {
        $this->authorizeEducation($education);

        return view('education.show', compact('education'));
    }

    public function edit(Education $education)
    {
        $this->authorizeEducation($education);

        return view('education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $this->authorizeEducation($education);

        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $education->update($validated);

        return redirect()
            ->route('education.index')
            ->with('success', 'Pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $this->authorizeEducation($education);

        $education->delete();

        return redirect()
            ->route('education.index')
            ->with('success', 'Pendidikan berhasil dihapus.');
    }

    private function authorizeEducation(Education $education)
    {
        abort_if($education->user_id !== Auth::id(), 403);
    }
}