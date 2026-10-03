<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Skills & Keahlian') }}
            </h2>

            <a
                href="{{ route('skills.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                + Tambah Keahlian
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

            {{-- Skills List --}}
            @if ($skills->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($skills as $skill)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
                            <div class="p-6">
                                {{-- Header & Badges --}}
                                <div class="flex items-start justify-between gap-2 mb-3">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('skills.show', $skill) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ $skill->name }}
                                        </a>
                                    </h3>

                                    @if ($skill->category)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300">
                                            {{ $skill->category }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Level Badge --}}
                                @if ($skill->level)
                                    <div class="mb-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 dark:bg-purple-900/40 text-purple-800 dark:text-purple-300">
                                            Tingkat: {{ $skill->level }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Proficiency Progress Bar --}}
                                @if ($skill->proficiency !== null)
                                    <div class="mb-4">
                                        <div class="flex justify-between text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                                            <span>Kemahiran</span>
                                            <span>{{ $skill->proficiency }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div
                                                class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300"
                                                style="width: {{ min(max($skill->proficiency, 0), 100) }}%"
                                            ></div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Description --}}
                                @if ($skill->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3">
                                        {{ $skill->description }}
                                    </p>
                                @endif
                            </div>

                            {{-- Actions Footer --}}
                            <div class="bg-gray-50 dark:bg-gray-800/60 border-t border-gray-100 dark:border-gray-700 px-6 py-3 flex items-center justify-between">
                                <a
                                    href="{{ route('skills.show', $skill) }}"
                                    class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline"
                                >
                                    Lihat Detail
                                </a>

                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('skills.edit', $skill) }}"
                                        class="text-xs font-medium text-amber-600 dark:text-amber-400 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('skills.destroy', $skill) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus keahlian {{ $skill->name }}?');"
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">Belum Ada Keahlian</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Mulai tambahkan keahlian teknis atau soft skill ke portofolio Anda.</p>
                    <a
                        href="{{ route('skills.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        + Tambah Keahlian Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
