<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Portofolio Proyek') }}
            </h2>

            <a
                href="{{ route('projects.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                + Tambah Proyek
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Alert --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 px-4 py-3 text-sm text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Projects Grid --}}
            @if ($projects->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($projects as $project)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
                            <div class="p-6">
                                {{-- Header & Category --}}
                                <div class="flex items-start justify-between gap-2 mb-3">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ $project->title }}
                                        </a>
                                    </h3>

                                    @if ($project->category)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300">
                                            {{ $project->category }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Dates --}}
                                @if ($project->start_date || $project->end_date)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                        {{ $project->start_date ? $project->start_date->format('M Y') : '' }}
                                        @if ($project->start_date && $project->end_date) - @endif
                                        {{ $project->end_date ? $project->end_date->format('M Y') : ($project->start_date ? 'Sekarang' : '') }}
                                    </p>
                                @endif

                                {{-- Technologies Badges --}}
                                @if ($project->technologies)
                                    <div class="flex flex-wrap gap-1.5 mb-3">
                                        @foreach (explode(',', $project->technologies) as $tech)
                                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                {{ trim($tech) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Description --}}
                                @if ($project->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-3">
                                        {{ $project->description }}
                                    </p>
                                @endif

                                {{-- Links Preview --}}
                                <div class="flex flex-wrap gap-3 pt-2">
                                    @if ($project->project_url)
                                        <a
                                            href="{{ $project->project_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                            Live Demo
                                        </a>
                                    @endif

                                    @if ($project->repository_url)
                                        <a
                                            href="{{ $project->repository_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-700 dark:text-gray-300 hover:underline"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                            Repository
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Actions Footer --}}
                            <div class="bg-gray-50 dark:bg-gray-800/60 border-t border-gray-100 dark:border-gray-700 px-6 py-3 flex items-center justify-between">
                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline"
                                >
                                    Lihat Detail
                                </a>

                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('projects.edit', $project) }}"
                                        class="text-xs font-medium text-amber-600 dark:text-amber-400 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('projects.destroy', $project) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek {{ $project->title }}?');"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-xs font-medium text-red-600 dark:text-red-400 hover:underline"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">Belum Ada Proyek</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Pamerkan karya dan proyek terbaik yang pernah Anda kerjakan.</p>
                    <a
                        href="{{ route('projects.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        + Tambah Proyek Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
