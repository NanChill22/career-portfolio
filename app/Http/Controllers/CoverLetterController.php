<?php

namespace App\Http\Controllers;

use App\Models\CoverLetter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CoverLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $coverLetters = Auth::user()
            ->coverLetters()
            ->latest()
            ->get();

        return view('cover-letters.index', compact('coverLetters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cover-letters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        Auth::user()
            ->coverLetters()
            ->create($validated);

        return redirect()
            ->route('cover-letters.index')
            ->with('success', 'Surat lamaran berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CoverLetter $coverLetter): View
    {
        abort_unless(
            $coverLetter->user_id === Auth::id(),
            403
        );

        return view(
            'cover-letters.show',
            compact('coverLetter')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoverLetter $coverLetter): View
    {
        abort_unless(
            $coverLetter->user_id === Auth::id(),
            403
        );

        return view(
            'cover-letters.edit',
            compact('coverLetter')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        CoverLetter $coverLetter
    ): RedirectResponse {
        abort_unless(
            $coverLetter->user_id === Auth::id(),
            403
        );

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $coverLetter->update($validated);

        return redirect()
            ->route('cover-letters.index')
            ->with('success', 'Surat lamaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        CoverLetter $coverLetter
    ): RedirectResponse {
        abort_unless(
            $coverLetter->user_id === Auth::id(),
            403
        );

        $coverLetter->delete();

        return redirect()
            ->route('cover-letters.index')
            ->with('success', 'Surat lamaran berhasil dihapus.');
    }
}