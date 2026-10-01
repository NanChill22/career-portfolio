<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat CV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('cvs.store') }}" method="POST">
                        @csrf

                        {{-- Judul CV --}}
                        <div class="mb-6">
                            <label for="title"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Judul CV
                            </label>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="{{ old('title') }}"
                                placeholder="Contoh: CV Software Developer"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >

                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Template --}}
                        <div class="mb-6">
                            <label for="template"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Template CV
                            </label>

                            <select
                                id="template"
                                name="template"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                                <option value="">-- Pilih Template --</option>

                                <option value="default"
                                    {{ old('template') === 'default' ? 'selected' : '' }}>
                                    Template Default
                                </option>

                                <option value="modern"
                                    {{ old('template') === 'modern' ? 'selected' : '' }}>
                                    Template Modern
                                </option>

                                <option value="simple"
                                    {{ old('template') === 'simple' ? 'selected' : '' }}>
                                    Template Simple
                                </option>
                            </select>

                            @error('template')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('cvs.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Simpan CV
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>