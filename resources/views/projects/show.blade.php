<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Proyek') }}
            </h2>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('projects.edit', $project) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                >
                    Edit
                </a>

                <a
                    href="{{ route('projects.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                >
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header Proyek & Kategori --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $project->title }}
                            </h3>

                            @if ($project->start_date || $project->end_date)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Periode:
                                    <span class="font-medium text-gray-700 dark:text-gray-300">
                                        {{ $project->start_date ? $project->start_date->format('M Y') : '' }}
                                        @if ($project->start_date && $project->end_date) - @endif
                                        {{ $project->end_date ? $project->end_date->format('M Y') : ($project->start_date ? 'Sekarang' : '') }}
                                    </span>
                                </p>
                            @endif
                        </div>

                        @if ($project->category)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300">
                                {{ $project->category }}
                            </span>
                        @endif
                    </div>

                    {{-- Detail Info --}}
                    <div class="py-6 space-y-6">

                        {{-- Technologies --}}
                        @if ($project->technologies)
                            <div>
                                <h4 class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-2">
                                    Teknologi & Tools
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach (explode(',', $project->technologies) as $tech)
                                        <span class="px-3 py-1 rounded-md text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                            {{ trim($tech) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Quick Links Live Demo & Repository --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if ($project->project_url)
                                <div class="p-4 bg-indigo-50 dark:bg-indigo-950/40 rounded-lg border border-indigo-100 dark:border-indigo-900 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs text-indigo-700 dark:text-indigo-300 uppercase font-semibold">Live Demo</span>
                                        <p class="text-sm text-indigo-900 dark:text-indigo-200 truncate mt-0.5 max-w-xs">
                                            {{ $project->project_url }}
                                        </p>
                                    </div>
                                    <a
                                        href="{{ $project->project_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition"
                                    >
                                        Buka &rarr;
                                    </a>
                                </div>
                            @endif

                            @if ($project->repository_url)
                                <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs text-gray-600 dark:text-gray-400 uppercase font-semibold">Repository Kode</span>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 truncate mt-0.5 max-w-xs">
                                            {{ $project->repository_url }}
                                        </p>
                                    </div>
                                    <a
                                        href="{{ $project->repository_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center px-3 py-1.5 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition"
                                    >
                                        GitHub &rarr;
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <h4 class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-2">
                                Deskripsi Proyek
                            </h4>
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-md text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line border border-gray-100 dark:border-gray-800">
                                {{ $project->description ?: 'Tidak ada deskripsi yang ditambahkan.' }}
                            </div>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <form
                            action="{{ route('projects.destroy', $project) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition"
                            >
                                Hapus Proyek
                            </button>
                        </form>

                        <a
                            href="{{ route('projects.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:underline"
                        >
                            Kembali ke Daftar Proyek
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
