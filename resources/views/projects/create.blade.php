<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Proyek') }}
            </h2>

            <a
                href="{{ route('projects.index') }}"
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

                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf

                        <!-- Judul Proyek -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Judul / Nama Proyek <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: E-Commerce Store, Aplikasi Manajemen Tugas"
                                required
                            >
                            @error('title')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori & Teknologi (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="category" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Kategori Proyek
                                </label>
                                <input
                                    type="text"
                                    name="category"
                                    id="category"
                                    value="{{ old('category') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: Web App, Mobile App, UI/UX Design, IoT"
                                >
                                @error('category')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="technologies" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Teknologi yang Digunakan
                                </label>
                                <input
                                    type="text"
                                    name="technologies"
                                    id="technologies"
                                    value="{{ old('technologies') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: Laravel, Tailwind CSS, Vue.js, MySQL (pisahkan dengan koma)"
                                >
                                @error('technologies')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Mulai & Tanggal Selesai (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Tanggal Mulai
                                </label>
                                <input
                                    type="date"
                                    name="start_date"
                                    id="start_date"
                                    value="{{ old('start_date') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                @error('start_date')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Tanggal Selesai (Opsional)
                                </label>
                                <input
                                    type="date"
                                    name="end_date"
                                    id="end_date"
                                    value="{{ old('end_date') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                @error('end_date')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- URL Live Demo & URL Repository (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="project_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    URL Live Demo / Website
                                </label>
                                <input
                                    type="url"
                                    name="project_url"
                                    id="project_url"
                                    value="{{ old('project_url') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="https://myproject.com"
                                >
                                @error('project_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="repository_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    URL Repository GitHub / GitLab
                                </label>
                                <input
                                    type="url"
                                    name="repository_url"
                                    id="repository_url"
                                    value="{{ old('repository_url') }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="https://github.com/username/project"
                                >
                                @error('repository_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Deskripsi Proyek
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Jelaskan fitur utama, masalah yang dipecahkan, atau peran Anda dalam pengembangan proyek ini..."
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('projects.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                            >
                                Simpan Proyek
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
