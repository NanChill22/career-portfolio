<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Menampilkan semua project milik user.
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->latest('start_date')
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Menampilkan form tambah project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Menyimpan project baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'project_url' => 'nullable|url|max:255',
            'repository_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project/Proyek berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail project.
     */
    public function show(Project $project)
    {
        $this->authorizeProject($project);

        return view('projects.show', compact('project'));
    }

    /**
     * Menampilkan form edit project.
     */
    public function edit(Project $project)
    {
        $this->authorizeProject($project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Memperbarui project.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'project_url' => 'nullable|url|max:255',
            'repository_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project/Proyek berhasil diperbarui.');
    }

    /**
     * Menghapus project.
     */
    public function destroy(Project $project)
    {
        $this->authorizeProject($project);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project/Proyek berhasil dihapus.');
    }

    /**
     * Memastikan project milik user yang sedang login.
     */
    private function authorizeProject(Project $project): void
    {
        abort_if($project->user_id !== Auth::id(), 403);
    }
}

