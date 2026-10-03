<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Data Lamaran Kerja') }}
            </h2>
            <a href="{{ route('job-applications.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('job-applications.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Nama Perusahaan -->
                            <div>
                                <label for="company_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Nama Perusahaan <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="company_name"
                                    id="company_name"
                                    value="{{ old('company_name') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: PT Shopee International Indonesia"
                                    required
                                >
                                @error('company_name')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Posisi / Jabatan -->
                            <div>
                                <label for="position" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Posisi yang Dilamar <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="position"
                                    id="position"
                                    value="{{ old('position') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: Fullstack Laravel Developer"
                                    required
                                >
                                @error('position')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Lokasi / Model Kerja -->
                            <div>
                                <label for="location" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Lokasi / Model Kerja
                                </label>
                                <input type="text"
                                    name="location"
                                    id="location"
                                    value="{{ old('location') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: Remote / Jakarta Selatan / Hybrid"
                                >
                                @error('location')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gaji yang Ditawarkan / Diharapkan -->
                            <div>
                                <label for="salary_offered" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Gaji Ditawarkan / Diharapkan
                                </label>
                                <input type="text"
                                    name="salary_offered"
                                    id="salary_offered"
                                    value="{{ old('salary_offered') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: Rp 8.000.000 - Rp 12.000.000"
                                >
                                @error('salary_offered')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Lamar -->
                            <div>
                                <label for="applied_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Tanggal Melamar <span class="text-red-500">*</span>
                                </label>
                                <input type="date"
                                    name="applied_date"
                                    id="applied_date"
                                    value="{{ old('applied_date', date('Y-m-d')) }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                @error('applied_date')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Awal -->
                            <div>
                                <label for="status" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Status Lamaran <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    @foreach ($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', 'applied') === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Link Lowongan -->
                        <div>
                            <label for="job_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Link Lowongan / Info Loker (URL)
                            </label>
                            <input type="url"
                                name="job_url"
                                id="job_url"
                                value="{{ old('job_url') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="https://linkedin.com/jobs/view/... atau https://glints.com/..."
                            >
                            @error('job_url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dokumen yang Digunakan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-4 bg-gray-50 dark:bg-gray-750 rounded-lg border border-gray-200 dark:border-gray-700">
                            <!-- Pilih CV -->
                            <div>
                                <label for="cv_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Hubungkan ke Dokumen CV
                                </label>
                                <select name="cv_id" id="cv_id"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Tanpa Tautan CV --</option>
                                    @foreach ($cvs as $cv)
                                        <option value="{{ $cv->id }}" {{ old('cv_id') == $cv->id ? 'selected' : '' }}>
                                            {{ $cv->title }} ({{ $cv->template }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cv_id')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pilih Surat Lamaran -->
                            <div>
                                <label for="cover_letter_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Hubungkan ke Surat Lamaran
                                </label>
                                <select name="cover_letter_id" id="cover_letter_id"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Tanpa Tautan Surat Lamaran --</option>
                                    @foreach ($coverLetters as $cl)
                                        <option value="{{ $cl->id }}" {{ old('cover_letter_id') == $cl->id ? 'selected' : '' }}>
                                            {{ $cl->title }} {{ $cl->company ? "($cl->company)" : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cover_letter_id')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label for="notes" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Catatan / Tahapan / Kontak Recruiter
                            </label>
                            <textarea
                                name="notes"
                                id="notes"
                                rows="4"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: Interview User via Google Meet tgl 10 Okt pk 14.00 WIB. Kontak HR: bu Dina (08123456789)..."
                            >{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('job-applications.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Simpan Lamaran
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
