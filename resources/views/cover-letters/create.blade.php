<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Surat Lamaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('cover-letters.store') }}" method="POST">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-6">
                            <label for="title"
                                   class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Judul Surat Lamaran
                            </label>

                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                placeholder="Contoh: Lamaran Web Developer"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >

                            @error('title')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Perusahaan --}}
                        <div class="mb-6">
                            <label for="company"
                                   class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Nama Perusahaan
                            </label>

                            <input
                                type="text"
                                name="company"
                                id="company"
                                value="{{ old('company') }}"
                                placeholder="Contoh: PT Teknologi Indonesia"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('company')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Posisi --}}
                        <div class="mb-6">
                            <label for="position"
                                   class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Posisi yang Dilamar
                            </label>

                            <input
                                type="text"
                                name="position"
                                id="position"
                                value="{{ old('position') }}"
                                placeholder="Contoh: Web Developer"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('position')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Isi Surat --}}
                        <div class="mb-6">
                            <label for="content"
                                   class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Isi Surat Lamaran
                            </label>

                            <textarea
                                name="content"
                                id="content"
                                rows="12"
                                placeholder="Tuliskan isi surat lamaran..."
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('content') }}</textarea>

                            @error('content')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('cover-letters.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>