<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cvs = Auth::user()->cvs()->latest()->get();

        return view('cvs.index', compact('cvs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cvs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'template' => ['required', 'string', 'max:100'],
        ]);

        Auth::user()->cvs()->create($validated);

        return redirect()
            ->route('cvs.index')
            ->with('success', 'CV berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cv $cv): View
    {
        abort_unless($cv->user_id === Auth::id(), 403);

        return view('cvs.show', compact('cv'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cv $cv): View
    {
        abort_unless($cv->user_id === Auth::id(), 403);

        return view('cvs.edit', compact('cv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cv $cv): RedirectResponse
    {
        abort_unless($cv->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'template' => ['required', 'string', 'max:100'],
        ]);

        $cv->update($validated);

        return redirect()
            ->route('cvs.index')
            ->with('success', 'CV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cv $cv): RedirectResponse
    {
        abort_unless($cv->user_id === Auth::id(), 403);

        $cv->delete();

        return redirect()
            ->route('cvs.index')
            ->with('success', 'CV berhasil dihapus.');
    }
}