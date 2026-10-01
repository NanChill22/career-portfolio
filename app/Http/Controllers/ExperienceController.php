<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Menampilkan semua pengalaman kerja user.
     */
    public function index()
    {
        $experiences = Experience::where('user_id', Auth::id())
            ->latest('start_date')
            ->get();

        return view('experiences.index', compact('experiences'));
    }

    /**
     * Menampilkan form tambah pengalaman.
     */
    public function create()
    {
        return view('experiences.create');
    }

    /**
     * Menyimpan pengalaman baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
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

        Experience::create($validated);

        return redirect()
            ->route('experiences.index')
            ->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengalaman.
     */
    public function show(Experience $experience) 
    {
        $this->authorizeExperience($experience);

        return view('experiences.show', compact('experience'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Experience $experience)
    {
        $this->authorizeExperience($experience);

        return view('experiences.edit', compact('experience'));
    }

    /**
     * Memperbarui pengalaman.
     */
    public function update(Request $request, Experience $experience)
    {
        $this->authorizeExperience($experience);

        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        return redirect()
            ->route('experiences.index')
            ->with('success', 'Pengalaman kerja berhasil diperbarui.');
    }

    /**
     * Menghapus pengalaman.
     */
    public function destroy(Experience $experience)
    {
        $this->authorizeExperience($experience);

        $experience->delete();

        return redirect()
            ->route('experiences.index')
            ->with('success', 'Pengalaman kerja berhasil dihapus.');
    }

    /**
     * Memastikan pengalaman milik user yang sedang login.
     */
    private function authorizeExperience(Experience $experience)
    {
        abort_if($experience->user_id !== Auth::id(), 403);
    }
}