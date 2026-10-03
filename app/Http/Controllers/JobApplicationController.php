<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $status = $request->query('status');
        $search = $request->query('search');

        // Base query for counts
        $baseQuery = $user->jobApplications();

        $counts = [
            'total' => (clone $baseQuery)->count(),
            'applied' => (clone $baseQuery)->where('status', JobApplication::STATUS_APPLIED)->count(),
            'review' => (clone $baseQuery)->where('status', JobApplication::STATUS_REVIEW)->count(),
            'interview' => (clone $baseQuery)->where('status', JobApplication::STATUS_INTERVIEW)->count(),
            'offered' => (clone $baseQuery)->where('status', JobApplication::STATUS_OFFERED)->count(),
            'rejected' => (clone $baseQuery)->where('status', JobApplication::STATUS_REJECTED)->count(),
        ];

        // Filtered query
        $query = $user->jobApplications()
            ->with(['cv', 'coverLetter'])
            ->latest('applied_date')
            ->latest('id');

        if ($status && array_key_exists($status, JobApplication::STATUSES)) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(10)->withQueryString();

        return view('job-applications.index', compact('applications', 'counts', 'status', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = Auth::user();
        $cvs = $user->cvs()->latest()->get();
        $coverLetters = $user->coverLetters()->latest()->get();
        $statuses = JobApplication::STATUSES;

        return view('job-applications.create', compact('cvs', 'coverLetters', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'job_url' => ['nullable', 'url', 'max:2048'],
            'salary_offered' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'applied_date' => ['required', 'date'],
            'status' => ['required', Rule::in(array_keys(JobApplication::STATUSES))],
            'cv_id' => [
                'nullable',
                Rule::exists('cvs', 'id')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
            'cover_letter_id' => [
                'nullable',
                Rule::exists('cover_letters', 'id')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
            'notes' => ['nullable', 'string'],
        ]);

        $user->jobApplications()->create($validated);

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Data lamaran pekerjaan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication): View
    {
        abort_unless($jobApplication->user_id === Auth::id(), 403);

        $jobApplication->load(['cv', 'coverLetter']);
        $statuses = JobApplication::STATUSES;

        return view('job-applications.show', compact('jobApplication', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication): View
    {
        abort_unless($jobApplication->user_id === Auth::id(), 403);

        $user = Auth::user();
        $cvs = $user->cvs()->latest()->get();
        $coverLetters = $user->coverLetters()->latest()->get();
        $statuses = JobApplication::STATUSES;

        return view('job-applications.edit', compact('jobApplication', 'cvs', 'coverLetters', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication): RedirectResponse
    {
        abort_unless($jobApplication->user_id === Auth::id(), 403);

        $user = Auth::user();

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'job_url' => ['nullable', 'url', 'max:2048'],
            'salary_offered' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'applied_date' => ['required', 'date'],
            'status' => ['required', Rule::in(array_keys(JobApplication::STATUSES))],
            'cv_id' => [
                'nullable',
                Rule::exists('cvs', 'id')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
            'cover_letter_id' => [
                'nullable',
                Rule::exists('cover_letters', 'id')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
            'notes' => ['nullable', 'string'],
        ]);

        $jobApplication->update($validated);

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Data lamaran pekerjaan berhasil diperbarui.');
    }

    /**
     * Update status directly.
     */
    public function updateStatus(Request $request, JobApplication $jobApplication): RedirectResponse
    {
        abort_unless($jobApplication->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(JobApplication::STATUSES))],
        ]);

        $jobApplication->update($validated);

        return back()->with('success', 'Status lamaran berhasil diubah ke ' . ($jobApplication->status_label) . '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication): RedirectResponse
    {
        abort_unless($jobApplication->user_id === Auth::id(), 403);

        $jobApplication->delete();

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Data lamaran pekerjaan berhasil dihapus.');
    }
}

