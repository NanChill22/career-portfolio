<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Experience') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('experiences.store') }}" method="POST">

                        @csrf

                        <!-- Perusahaan -->
                        <div class="mb-4">
                            <label for="company" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Perusahaan
                            </label>

                            <input
                                type="text"
                                name="company"
                                id="company"
                                value="{{ old('company') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                placeholder="Contoh: PT Teknologi Indonesia"
                                required
                            >

                            @error('company')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Posisi -->
                        <div class="mb-4">
                            <label for="position" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Posisi
                            </label>

                            <input
                                type="text"
                                name="position"
                                id="position"
                                value="{{ old('position') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                placeholder="Contoh: Web Developer"
                                required
                            >

                            @error('position')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="mb-4">
                            <label for="start_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                required
                            >

                            @error('start_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="mb-4">
                            <label for="end_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            >

                            @error('end_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Masih bekerja -->
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input
                                    type="checkbox"
                                    name="is_current"
                                    value="1"
                                    {{ old('is_current') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                >

                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    Saya masih bekerja di perusahaan ini
                                </span>
                            </label>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Deskripsi
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                placeholder="Jelaskan pekerjaan, tanggung jawab, atau pencapaian..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center gap-3">

                            <a
                                href="{{ route('experiences.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white"
                            >
                                Simpan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>