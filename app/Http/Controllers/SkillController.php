<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    /**
     * Menampilkan semua skill milik user.
     */
    public function index()
    {
        $skills = Skill::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('skills.index', compact('skills'));
    }

    /**
     * Menampilkan form tambah skill.
     */
    public function create()
    {
        return view('skills.create');
    }

    /**
     * Menyimpan skill baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'proficiency' => 'nullable|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Skill::create($validated);

        return redirect()
            ->route('skills.index')
            ->with('success', 'Keahlian/Skill berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail skill.
     */
    public function show(Skill $skill)
    {
        $this->authorizeSkill($skill);

        return view('skills.show', compact('skill'));
    }

    /**
     * Menampilkan form edit skill.
     */
    public function edit(Skill $skill)
    {
        $this->authorizeSkill($skill);

        return view('skills.edit', compact('skill'));
    }

    /**
     * Memperbarui skill.
     */
    public function update(Request $request, Skill $skill)
    {
        $this->authorizeSkill($skill);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'proficiency' => 'nullable|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $skill->update($validated);

        return redirect()
            ->route('skills.index')
            ->with('success', 'Keahlian/Skill berhasil diperbarui.');
    }

    /**
     * Menghapus skill.
     */
    public function destroy(Skill $skill)
    {
        $this->authorizeSkill($skill);

        $skill->delete();

        return redirect()
            ->route('skills.index')
            ->with('success', 'Keahlian/Skill berhasil dihapus.');
    }

    /**
     * Memastikan skill milik user yang sedang login.
     */
    private function authorizeSkill(Skill $skill): void
    {
        abort_if($skill->user_id !== Auth::id(), 403);
    }
}

