<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Job Tracker (Pemantau Lamaran Kerja)') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Pantau alur proses rekrutmen dan status lamaran yang telah Anda kirimkan.
                </p>
            </div>

            <a href="{{ route('job-applications.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Tambah Lamaran
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900/50 dark:border-green-700 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary Stat Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <a href="{{ route('job-applications.index') }}"
                    class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ empty($status) ? 'border-indigo-500 ring-2 ring-indigo-500/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow transition">
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $counts['total'] }}</div>
                </a>

                <a href="{{ route('job-applications.index', ['status' => 'applied']) }}"
                    class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ $status === 'applied' ? 'border-blue-500 ring-2 ring-blue-500/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow transition">
                    <div class="text-xs font-medium text-blue-600 dark:text-blue-400 uppercase tracking-wider">Terkirim</div>
                    <div class="mt-1 text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $counts['applied'] }}</div>
                </a>

                <a href="{{ route('job-applications.index', ['status' => 'review']) }}"
                    class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ $status === 'review' ? 'border-amber-500 ring-2 ring-amber-500/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow transition">
                    <div class="text-xs font-medium text-amber-600 dark:text-amber-400 uppercase tracking-wider">Ditinjau</div>
                    <div class="mt-1 text-2xl font-bold text-amber-700 dark:text-amber-300">{{ $counts['review'] }}</div>
                </a>

                <a href="{{ route('job-applications.index', ['status' => 'interview']) }}"
                    class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ $status === 'interview' ? 'border-purple-500 ring-2 ring-purple-500/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow transition">
                    <div class="text-xs font-medium text-purple-600 dark:text-purple-400 uppercase tracking-wider">Interview</div>
                    <div class="mt-1 text-2xl font-bold text-purple-700 dark:text-purple-300">{{ $counts['interview'] }}</div>
                </a>

                <a href="{{ route('job-applications.index', ['status' => 'offered']) }}"
                    class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ $status === 'offered' ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow transition">
                    <div class="text-xs font-medium text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Diterima</div>
                    <div class="mt-1 text-2xl font-bold text-emerald-700 dark:text-emerald-300">{{ $counts['offered'] }}</div>
                </a>

                <a href="{{ route('job-applications.index', ['status' => 'rejected']) }}"
                    class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ $status === 'rejected' ? 'border-rose-500 ring-2 ring-rose-500/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow transition">
                    <div class="text-xs font-medium text-rose-600 dark:text-rose-400 uppercase tracking-wider">Ditolak</div>
                    <div class="mt-1 text-2xl font-bold text-rose-700 dark:text-rose-300">{{ $counts['rejected'] }}</div>
                </a>
            </div>

            {{-- Filter & Search Form --}}
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <form method="GET" action="{{ route('job-applications.index') }}" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
                    <div class="w-full sm:w-auto flex flex-1 flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari perusahaan, posisi, lokasi, atau catatan..."
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>

                        <div class="w-full sm:w-48">
                            <select name="status"
                                onchange="this.form.submit()"
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Status</option>
                                @foreach (\App\Models\JobApplication::STATUSES as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full sm:w-auto justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-xs font-semibold uppercase tracking-wider transition">
                            Cari
                        </button>
                        @if (request('search') || request('status'))
                            <a href="{{ route('job-applications.index') }}"
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-md text-xs font-semibold uppercase tracking-wider transition">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Table / Data List --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($applications->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Perusahaan & Posisi
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Lokasi / Gaji
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Dokumen
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tgl Melamar
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($applications as $app)
                                        <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-750 transition">
                                            {{-- Company & Position --}}
                                            <td class="px-4 py-4">
                                                <div class="font-bold text-gray-900 dark:text-gray-100">
                                                    {{ $app->company_name }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                                    {{ $app->position }}
                                                </div>
                                                @if ($app->job_url)
                                                    <div class="mt-1">
                                                        <a href="{{ $app->job_url }}" target="_blank" rel="noopener noreferrer"
                                                            class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline inline-flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                            </svg>
                                                            Link Lowongan
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>

                                            {{-- Location & Salary --}}
                                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                <div>{{ $app->location ?: '-' }}</div>
                                                @if ($app->salary_offered)
                                                    <div class="text-xs font-medium text-emerald-600 dark:text-emerald-400 mt-0.5">
                                                        {{ $app->salary_offered }}
                                                    </div>
                                                @endif
                                            </td>

                                            {{-- Attached Documents --}}
                                            <td class="px-4 py-4 text-xs space-y-1">
                                                @if ($app->cv)
                                                    <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-sky-50 dark:bg-sky-950/50 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800">
                                                        <span class="font-semibold">CV:</span>
                                                        <a href="{{ route('cvs.show', $app->cv_id) }}" class="hover:underline truncate max-w-[120px]">
                                                            {{ $app->cv->title }}
                                                        </a>
                                                    </div>
                                                @endif
                                                @if ($app->coverLetter)
                                                    <div>
                                                        <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-purple-50 dark:bg-purple-950/50 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                                                            <span class="font-semibold">Surat:</span>
                                                            <a href="{{ route('cover-letters.show', $app->cover_letter_id) }}" class="hover:underline truncate max-w-[120px]">
                                                                {{ $app->coverLetter->title }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (!$app->cv && !$app->coverLetter)
                                                    <span class="text-gray-400 dark:text-gray-500">-</span>
                                                @endif
                                            </td>

                                            {{-- Applied Date --}}
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                                {{ $app->applied_date ? $app->applied_date->format('d M Y') : '-' }}
                                            </td>

                                            {{-- Status & Quick Update --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <form action="{{ route('job-applications.update-status', $app) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" onchange="this.form.submit()"
                                                        class="text-xs font-semibold rounded-full px-3 py-1 border cursor-pointer {{ $app->status_badge }}">
                                                        @foreach (\App\Models\JobApplication::STATUSES as $statusKey => $statusName)
                                                            <option value="{{ $statusKey }}" {{ $app->status === $statusKey ? 'selected' : '' }}>
                                                                {{ $statusName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('job-applications.show', $app) }}"
                                                        class="inline-flex items-center px-2.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-semibold uppercase tracking-wider transition"
                                                        title="Lihat Detail">
                                                        Detail
                                                    </a>

                                                    <a href="{{ route('job-applications.edit', $app) }}"
                                                        class="inline-flex items-center px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded text-xs font-semibold uppercase tracking-wider transition"
                                                        title="Edit Lamaran">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('job-applications.destroy', $app) }}" method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data lamaran ini?');"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-2.5 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold uppercase tracking-wider transition"
                                                            title="Hapus">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $applications->links() }}
                        </div>

                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>

                            <h3 class="mt-3 text-lg font-medium text-gray-900 dark:text-gray-100">
                                @if (request('search') || request('status'))
                                    Tidak ada data lamaran yang cocok dengan filter
                                @else
                                    Belum ada data lamaran pekerjaan
                                @endif
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                                @if (request('search') || request('status'))
                                    Coba atur ulang filter pencarian untuk melihat semua data.
                                @else
                                    Mulai catat setiap lowongan pekerjaan yang Anda lamar agar proses rekrutmen lebih terstruktur dan termonitor.
                                @endif
                            </p>

                            <div class="mt-6">
                                @if (request('search') || request('status'))
                                    <a href="{{ route('job-applications.index') }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                        Reset Filter
                                    </a>
                                @else
                                    <a href="{{ route('job-applications.create') }}"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-semibold text-xs uppercase tracking-widest transition">
                                        + Catat Lamaran Pertama
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
