<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail & Generator CV') }}
            </h2>

            <div class="flex items-center gap-2">
                <a href="{{ route('cvs.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Main Action Box: Export ATS --}}
            <div class="bg-gradient-to-r from-indigo-700 to-blue-800 rounded-xl shadow-lg p-6 sm:p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-500/40 text-indigo-100 border border-indigo-300/30 mb-2">
                            ATS-Friendly Ready
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold tracking-tight">
                            {{ $cv->title }}
                        </h3>
                        <p class="mt-1 text-sm text-indigo-100">
                            CV ini otomatis menyusun seluruh riwayat Pengalaman, Pendidikan, Keahlian, Proyek, dan Sertifikasi Anda menjadi format standar A4 ATS.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        <a
                            href="{{ route('cvs.preview.pdf', $cv) }}"
                            target="_blank"
                            class="inline-flex items-center px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/30 rounded-lg font-semibold text-xs text-white uppercase tracking-widest backdrop-blur-sm transition"
                        >
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Preview PDF
                        </a>

                        <a
                            href="{{ route('cvs.download.pdf', $cv) }}"
                            class="inline-flex items-center px-5 py-2.5 bg-white text-indigo-900 hover:bg-indigo-50 rounded-lg font-bold text-xs uppercase tracking-widest shadow-md transition"
                        >
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Download PDF ATS
                        </a>
                    </div>
                </div>
            </div>

            {{-- CV Data Preview Overview --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-lg font-bold mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
                        Informasi Dokumen CV
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Nama Kandidat</span>
                            <p class="text-base font-medium mt-1">{{ Auth::user()->name }}</p>
                        </div>

                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Format Template</span>
                            <p class="text-base font-medium mt-1 uppercase">{{ $cv->template }} (ATS A4 Single-Column)</p>
                        </div>

                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Tanggal Dibuat</span>
                            <p class="text-base font-medium mt-1">{{ $cv->created_at->format('d F Y') }}</p>
                        </div>
                    </div>

                    {{-- Live Portfolio Summary --}}
                    <div class="bg-gray-50 dark:bg-gray-900/40 rounded-lg p-5 border border-gray-100 dark:border-gray-800">
                        <h5 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                            Data Portofolio yang Akan Termuat di CV Ini:
                        </h5>
                        <ul class="grid grid-cols-2 sm:grid-cols-5 gap-3 text-center">
                            <li class="p-3 bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700">
                                <span class="block text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ Auth::user()->experiences()->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Pengalaman</span>
                            </li>
                            <li class="p-3 bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700">
                                <span class="block text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ Auth::user()->education()->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Pendidikan</span>
                            </li>
                            <li class="p-3 bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700">
                                <span class="block text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ Auth::user()->skills()->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Skill</span>
                            </li>
                            <li class="p-3 bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700">
                                <span class="block text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ Auth::user()->projects()->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Proyek</span>
                            </li>
                            <li class="p-3 bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700">
                                <span class="block text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ Auth::user()->certifications()->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Sertifikasi</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <form action="{{ route('cvs.destroy', $cv) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus CV ini?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                Hapus CV
                            </button>
                        </form>

                        <a href="{{ route('cvs.edit', $cv) }}"
                            class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 transition">
                            Edit Judul CV
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>