<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Keahlian') }}
            </h2>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('skills.edit', $skill) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                >
                    Edit
                </a>

                <a
                    href="{{ route('skills.index') }}"
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

                    {{-- Header Nama Skill & Kategori --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $skill->name }}
                            </h3>
                            @if ($skill->category)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Kategori: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $skill->category }}</span>
                                </p>
                            @endif
                        </div>

                        @if ($skill->level)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 dark:bg-purple-900/40 text-purple-800 dark:text-purple-300">
                                {{ $skill->level }}
                            </span>
                        @endif
                    </div>

                    {{-- Detail Info --}}
                    <div class="py-6 space-y-6">
                        @if ($skill->proficiency !== null)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tingkat Kemahiran (Proficiency)
                                </h4>
                                <div class="flex items-center gap-4">
                                    <div class="w-full max-w-md bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                        <div
                                            class="bg-indigo-600 h-3 rounded-full transition-all duration-300"
                                            style="width: {{ min(max($skill->proficiency, 0), 100) }}%"
                                        ></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-800 dark:text-gray-200">
                                        {{ $skill->proficiency }}%
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi / Catatan
                            </h4>
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-md text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line border border-gray-100 dark:border-gray-800">
                                {{ $skill->description ?: 'Tidak ada deskripsi yang ditambahkan.' }}
                            </div>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <form
                            action="{{ route('skills.destroy', $skill) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus keahlian ini?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition"
                            >
                                Hapus Keahlian
                            </button>
                        </form>

                        <a
                            href="{{ route('skills.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:underline"
                        >
                            Kembali ke Daftar Keahlian
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
