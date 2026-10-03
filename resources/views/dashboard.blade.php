<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Welcome Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            Selamat Datang, {{ Auth::user()->name }}! 👋
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Kelola resume portofolio karir, susun surat lamaran, dan pantau status lamaran pekerjaan Anda di satu tempat.
                        </p>
                    </div>
                    <a href="{{ route('job-applications.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-semibold text-xs uppercase tracking-widest transition">
                        Buka Job Tracker →
                    </a>
                </div>
            </div>

            {{-- Quick Access Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Experience --}}
                <a href="{{ route('experiences.index') }}"
                    class="p-5 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow transition group">
                    <div class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Karir</div>
                    <div class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Pengalaman Kerja</div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kelola riwayat pekerjaan & magang</p>
                </a>

                {{-- Education & Certifications --}}
                <a href="{{ route('education.index') }}"
                    class="p-5 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow transition group">
                    <div class="text-xs font-semibold text-sky-600 dark:text-sky-400 uppercase tracking-wider">Akademik</div>
                    <div class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-sky-600 dark:group-hover:text-sky-400">Pendidikan & Sertifikasi</div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Riwayat studi dan sertifikat profesi</p>
                </a>

                {{-- CV & Cover Letter --}}
                <a href="{{ route('cvs.index') }}"
                    class="p-5 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow transition group">
                    <div class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wider">Dokumen</div>
                    <div class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-purple-600 dark:group-hover:text-purple-400">CV & Cover Letter</div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Generate CV ATS & Surat Lamaran PDF</p>
                </a>

                {{-- Job Tracker --}}
                <a href="{{ route('job-applications.index') }}"
                    class="p-5 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow transition group">
                    <div class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Tracker</div>
                    <div class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Job Tracker</div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Monitor status proses lamaran kerja</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

