<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $jobApplication->company_name }}
                    </h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $jobApplication->status_badge }}">
                        {{ $jobApplication->status_label }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Posisi: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $jobApplication->position }}</span>
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('job-applications.edit', $jobApplication) }}"
                    class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                    Edit Lamaran
                </a>
                <a href="{{ route('job-applications.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    ← Kembali ke List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900/50 dark:border-green-700 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Quick Status Changer Banner --}}
            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Ubah Status Lamaran:</span>
                    <form action="{{ route('job-applications.update-status', $jobApplication) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()"
                            class="text-sm font-semibold rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $jobApplication->status === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    Terakhir diperbarui: {{ $jobApplication->updated_at->diffForHumans() }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Left/Main column: Info & Notes --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- Informasi Lowongan --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">
                            Detail Lamaran
                        </h3>

                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <dt class="text-gray-500 dark:text-gray-400 font-medium">Perusahaan</dt>
                                <dd class="text-gray-900 dark:text-gray-100 font-semibold mt-1">{{ $jobApplication->company_name }}</dd>
                            </div>

                            <div>
                                <dt class="text-gray-500 dark:text-gray-400 font-medium">Posisi</dt>
                                <dd class="text-gray-900 dark:text-gray-100 font-semibold mt-1">{{ $jobApplication->position }}</dd>
                            </div>

                            <div>
                                <dt class="text-gray-500 dark:text-gray-400 font-medium">Lokasi / Tipe Kerja</dt>
                                <dd class="text-gray-900 dark:text-gray-100 mt-1">{{ $jobApplication->location ?: '-' }}</dd>
                            </div>

                            <div>
                                <dt class="text-gray-500 dark:text-gray-400 font-medium">Gaji Ditawarkan / Diharapkan</dt>
                                <dd class="text-emerald-600 dark:text-emerald-400 font-medium mt-1">{{ $jobApplication->salary_offered ?: '-' }}</dd>
                            </div>

                            <div>
                                <dt class="text-gray-500 dark:text-gray-400 font-medium">Tanggal Melamar</dt>
                                <dd class="text-gray-900 dark:text-gray-100 mt-1">{{ $jobApplication->applied_date ? $jobApplication->applied_date->translatedFormat('d F Y') : '-' }}</dd>
                            </div>

                            <div>
                                <dt class="text-gray-500 dark:text-gray-400 font-medium">Link Info Lowongan</dt>
                                <dd class="mt-1">
                                    @if ($jobApplication->job_url)
                                        <a href="{{ $jobApplication->job_url }}" target="_blank" rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1 text-indigo-600 dark:text-indigo-400 hover:underline">
                                            Buka Tautan Loker
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>

                    {{-- Catatan & Timeline --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">
                            Catatan Proses & Catatan Tambahan
                        </h3>

                        @if ($jobApplication->notes)
                            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-750 p-4 rounded-lg whitespace-pre-line border border-gray-200 dark:border-gray-700">
                                {{ $jobApplication->notes }}
                            </div>
                        @else
                            <div class="text-sm text-gray-500 dark:text-gray-400 italic py-4 text-center">
                                Belum ada catatan tambahan untuk lamaran ini. Anda dapat mencatat jadwal interview, nama recruiter, feedback, atau soal tes teknikal dengan mengklik tombol edit.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right column: Linked Documents & Delete --}}
                <div class="space-y-6">

                    {{-- Dokumen Terhubung --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">
                            Dokumen Lamaran
                        </h3>

                        <div class="space-y-4">
                            {{-- CV --}}
                            <div class="p-3 bg-sky-50 dark:bg-sky-950/40 rounded-lg border border-sky-200 dark:border-sky-800/60">
                                <div class="text-xs font-semibold text-sky-800 dark:text-sky-300 uppercase tracking-wider mb-1">
                                    Curriculum Vitae (CV)
                                </div>
                                @if ($jobApplication->cv)
                                    <div class="font-medium text-sm text-gray-900 dark:text-gray-100">
                                        {{ $jobApplication->cv->title }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                        Template: {{ $jobApplication->cv->template }}
                                    </div>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <a href="{{ route('cvs.show', $jobApplication->cv) }}"
                                            class="inline-flex items-center px-2.5 py-1 bg-sky-600 hover:bg-sky-700 text-white rounded text-xs font-medium transition">
                                            Lihat CV
                                        </a>
                                        <a href="{{ route('cvs.preview.pdf', $jobApplication->cv) }}" target="_blank"
                                            class="inline-flex items-center px-2.5 py-1 bg-purple-600 hover:bg-purple-700 text-white rounded text-xs font-medium transition">
                                            Preview PDF
                                        </a>
                                        <a href="{{ route('cvs.download.pdf', $jobApplication->cv) }}"
                                            class="inline-flex items-center px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-medium transition">
                                            Download
                                        </a>
                                    </div>
                                @else
                                    <p class="text-xs text-gray-500 dark:text-gray-400 italic">
                                        Tidak ada CV yang ditautkan ke lamaran ini.
                                    </p>
                                @endif
                            </div>

                            {{-- Cover Letter --}}
                            <div class="p-3 bg-purple-50 dark:bg-purple-950/40 rounded-lg border border-purple-200 dark:border-purple-800/60">
                                <div class="text-xs font-semibold text-purple-800 dark:text-purple-300 uppercase tracking-wider mb-1">
                                    Surat Lamaran (Cover Letter)
                                </div>
                                @if ($jobApplication->coverLetter)
                                    <div class="font-medium text-sm text-gray-900 dark:text-gray-100">
                                        {{ $jobApplication->coverLetter->title }}
                                    </div>
                                    @if ($jobApplication->coverLetter->company)
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                            Untuk: {{ $jobApplication->coverLetter->company }}
                                        </div>
                                    @endif
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <a href="{{ route('cover-letters.show', $jobApplication->coverLetter) }}"
                                            class="inline-flex items-center px-2.5 py-1 bg-purple-600 hover:bg-purple-700 text-white rounded text-xs font-medium transition">
                                            Lihat Surat
                                        </a>
                                        <a href="{{ route('cover-letters.preview.pdf', $jobApplication->coverLetter) }}" target="_blank"
                                            class="inline-flex items-center px-2.5 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-xs font-medium transition">
                                            Preview PDF
                                        </a>
                                        <a href="{{ route('cover-letters.download.pdf', $jobApplication->coverLetter) }}"
                                            class="inline-flex items-center px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-medium transition">
                                            Download
                                        </a>
                                    </div>
                                @else
                                    <p class="text-xs text-gray-500 dark:text-gray-400 italic">
                                        Tidak ada surat lamaran yang ditautkan.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Danger Zone: Hapus --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-red-200 dark:border-red-900/50 p-6">
                        <h4 class="text-sm font-semibold text-red-600 dark:text-red-400 uppercase tracking-wider mb-2">
                            Hapus Data Lamaran
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                            Tindakan ini akan menghapus riwayat lamaran ini secara permanen.
                        </p>
                        <form action="{{ route('job-applications.destroy', $jobApplication) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data lamaran ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-semibold text-xs uppercase tracking-widest transition">
                                Hapus Lamaran
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
