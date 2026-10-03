<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Surat Lamaran') }}
            </h2>

            <a href="{{ route('cover-letters.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ copied: false }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Main Action Banner --}}
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 rounded-xl shadow-lg p-6 sm:p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/40 text-emerald-100 border border-emerald-300/30 mb-2">
                            Surat Lamaran Siap Pakai
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold tracking-tight">
                            {{ $coverLetter->title }}
                        </h3>
                        <p class="mt-1 text-sm text-emerald-100">
                            Ditujukan untuk <strong>{{ $coverLetter->position ?: 'Posisi Pekerjaan' }}</strong> di <strong>{{ $coverLetter->company ?: 'Perusahaan Target' }}</strong>
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        {{-- Copy Button --}}
                        <button
                            type="button"
                            @click="
                                navigator.clipboard.writeText(`{{ addslashes($coverLetter->content) }}`);
                                copied = true;
                                setTimeout(() => copied = false, 2500);
                            "
                            class="inline-flex items-center px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/30 rounded-lg font-semibold text-xs text-white uppercase tracking-widest backdrop-blur-sm transition"
                        >
                            <svg x-show="!copied" class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                            <svg x-show="copied" class="w-4 h-4 mr-1.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span x-text="copied ? 'Tersalin!' : 'Copy Teks'"></span>
                        </button>

                        <a
                            href="{{ route('cover-letters.preview.pdf', $coverLetter) }}"
                            target="_blank"
                            class="inline-flex items-center px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/30 rounded-lg font-semibold text-xs text-white uppercase tracking-widest backdrop-blur-sm transition"
                        >
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Preview PDF
                        </a>

                        <a
                            href="{{ route('cover-letters.download.pdf', $coverLetter) }}"
                            class="inline-flex items-center px-5 py-2.5 bg-white text-emerald-900 hover:bg-emerald-50 rounded-lg font-bold text-xs uppercase tracking-widest shadow-md transition"
                        >
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            {{-- Document Preview Box --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    {{-- Metadata --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-6 border-b border-gray-100 dark:border-gray-700 text-sm">
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Perusahaan</span>
                            <p class="font-medium text-gray-800 dark:text-gray-200 mt-0.5">{{ $coverLetter->company ?: '-' }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Posisi</span>
                            <p class="font-medium text-gray-800 dark:text-gray-200 mt-0.5">{{ $coverLetter->position ?: '-' }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Dibuat</span>
                            <p class="font-medium text-gray-800 dark:text-gray-200 mt-0.5">{{ $coverLetter->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Terakhir Diedit</span>
                            <p class="font-medium text-gray-800 dark:text-gray-200 mt-0.5">{{ $coverLetter->updated_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    {{-- Letter Document Body preview --}}
                    <div class="py-6">
                        <h4 class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-3">
                            Pratinjau Isi Surat Lamaran:
                        </h4>

                        <div class="p-6 bg-gray-50 dark:bg-gray-900/60 rounded-xl border border-gray-200/70 dark:border-gray-800 font-sans text-sm leading-relaxed text-gray-800 dark:text-gray-200 whitespace-pre-line shadow-inner">
{{ $coverLetter->content ?? 'Belum ada isi surat lamaran.' }}
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <form action="{{ route('cover-letters.destroy', $coverLetter) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat lamaran ini?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                Hapus Surat
                            </button>
                        </form>

                        <a href="{{ route('cover-letters.edit', $coverLetter) }}"
                            class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 transition">
                            Edit Surat Lamaran
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>