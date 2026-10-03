<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    /**
     * Menampilkan semua sertifikasi milik user.
     */
    public function index()
    {
        $certifications = Certification::where('user_id', Auth::id())
            ->latest('issue_date')
            ->get();

        return view('certifications.index', compact('certifications'));
    }

    /**
     * Menampilkan form tambah sertifikasi.
     */
    public function create()
    {
        return view('certifications.create');
    }

    /**
     * Menyimpan sertifikasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Certification::create($validated);

        return redirect()
            ->route('certifications.index')
            ->with('success', 'Sertifikasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail sertifikasi.
     */
    public function show(Certification $certification)
    {
        $this->authorizeCertification($certification);

        return view('certifications.show', compact('certification'));
    }

    /**
     * Menampilkan form edit sertifikasi.
     */
    public function edit(Certification $certification)
    {
        $this->authorizeCertification($certification);

        return view('certifications.edit', compact('certification'));
    }

    /**
     * Memperbarui sertifikasi.
     */
    public function update(Request $request, Certification $certification)
    {
        $this->authorizeCertification($certification);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);

        $certification->update($validated);

        return redirect()
            ->route('certifications.index')
            ->with('success', 'Sertifikasi berhasil diperbarui.');
    }

    /**
     * Menghapus sertifikasi.
     */
    public function destroy(Certification $certification)
    {
        $this->authorizeCertification($certification);

        $certification->delete();

        return redirect()
            ->route('certifications.index')
            ->with('success', 'Sertifikasi berhasil dihapus.');
    }

    /**
     * Memastikan sertifikasi milik user yang sedang login.
     */
    private function authorizeCertification(Certification $certification): void
    {
        abort_if($certification->user_id !== Auth::id(), 403);
    }
}

