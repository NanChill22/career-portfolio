<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Pengalaman Kerja
            </h2>

            <a
                href="{{ route('experiences.index') }}"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
            >
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form
                        action="{{ route('experiences.update', $experience) }}"
                        method="POST"
                        class="space-y-6"
                    >
                        @csrf
                        @method('PUT')

                        {{-- Perusahaan --}}
                        <div>
                            <x-input-label
                                for="company"
                                value="Perusahaan"
                            />

                            <x-text-input
                                id="company"
                                name="company"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('company', $experience->company)"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('company')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Posisi --}}
                        <div>
                            <x-input-label
                                for="position"
                                value="Posisi / Jabatan"
                            />

                            <x-text-input
                                id="position"
                                name="position"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('position', $experience->position)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('position')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tanggal Mulai --}}
                        <div>
                            <x-input-label
                                for="start_date"
                                value="Tanggal Mulai"
                            />

                            <x-text-input
                                id="start_date"
                                name="start_date"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old(
                                    'start_date',
                                    $experience->start_date?->format('Y-m-d')
                                )"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('start_date')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div>
                            <x-input-label
                                for="end_date"
                                value="Tanggal Selesai"
                            />

                            <x-text-input
                                id="end_date"
                                name="end_date"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old(
                                    'end_date',
                                    $experience->end_date?->format('Y-m-d')
                                )"
                            />

                            <x-input-error
                                :messages="$errors->get('end_date')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Status masih bekerja --}}
                        <div>
                            <label class="inline-flex items-center">
                                <input
                                    type="checkbox"
                                    name="is_current"
                                    value="1"
                                    {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900"
                                >

                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    Saya masih bekerja di sini
                                </span>
                            </label>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <x-input-label
                                for="description"
                                value="Deskripsi Pekerjaan"
                            />

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('description', $experience->description) }}</textarea>

                            <x-input-error
                                :messages="$errors->get('description')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center gap-3 pt-2">

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            >
                                Update
                            </button>

                            <a
                                href="{{ route('experiences.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition ease-in-out duration-150"
                            >
                                Batal
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>

