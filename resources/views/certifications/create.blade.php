<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Sertifikasi') }}
            </h2>

            <a
                href="{{ route('certifications.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
            >
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('certifications.store') }}" method="POST">
                        @csrf

                        <!-- Nama Sertifikasi -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Nama Sertifikasi / Lisensi <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: AWS Certified Solutions Architect, Fullstack Web Developer"
                                required
                            >
                            @error('name')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Penerbit / Organisasi -->
                        <div class="mb-4">
                            <label for="issuer" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Lembaga Penerbit / Organisasi <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="issuer"
                                id="issuer"
                                value="{{ old('issuer') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: Amazon Web Services, Dicoding Indonesia, Coursera, Google"
                                required
                            >
                            @error('issuer')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Terbit & Tanggal Kedaluwarsa (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="issue_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Tanggal Terbit <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="issue_date"
                                    id="issue_date"
                                    value="{{ old('issue_date') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                @error('issue_date')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="expiration_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Tanggal Kedaluwarsa (Opsional)
                                </label>
                                <input
                                    type="date"
                                    name="expiration_date"
                                    id="expiration_date"
                                    value="{{ old('expiration_date') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kosongkan jika sertifikasi berlaku seumur hidup.</p>
                                @error('expiration_date')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ID Kredensial & URL Kredensial (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="credential_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    ID Kredensial / No. Sertifikat
                                </label>
                                <input
                                    type="text"
                                    name="credential_id"
                                    id="credential_id"
                                    value="{{ old('credential_id') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: CERT-123456"
                                >
                                @error('credential_id')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="credential_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    URL / Link Kredensial
                                </label>
                                <input
                                    type="url"
                                    name="credential_url"
                                    id="credential_url"
                                    value="{{ old('credential_url') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="https://..."
                                >
                                @error('credential_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Deskripsi / Catatan Tambahan
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Jelaskan keahlian atau materi yang dipelajari pada sertifikasi ini..."
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('certifications.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                            >
                                Simpan Sertifikasi
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
