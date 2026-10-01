<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pendidikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800
                        overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('education.store') }}">
                        @csrf

                        {{-- Institution --}}
                        <div>
                            <x-input-label
                                for="institution"
                                :value="__('Institusi / Sekolah / Universitas')"
                            />

                            <x-text-input
                                id="institution"
                                name="institution"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('institution')"
                                required
                                autofocus
                                placeholder="Contoh: Universitas Peradaban"
                            />

                            <x-input-error
                                :messages="$errors->get('institution')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Degree --}}
                        <div class="mt-4">
                            <x-input-label
                                for="degree"
                                :value="__('Jenjang Pendidikan')"
                            />

                            <x-text-input
                                id="degree"
                                name="degree"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('degree')"
                                required
                                placeholder="Contoh: S1"
                            />

                            <x-input-error
                                :messages="$errors->get('degree')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Field of Study --}}
                        <div class="mt-4">
                            <x-input-label
                                for="field_of_study"
                                :value="__('Jurusan / Program Studi')"
                            />

                            <x-text-input
                                id="field_of_study"
                                name="field_of_study"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('field_of_study')"
                                placeholder="Contoh: Sistem Informasi"
                            />

                            <x-input-error
                                :messages="$errors->get('field_of_study')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Start Date --}}
                        <div class="mt-4">
                            <x-input-label
                                for="start_date"
                                :value="__('Tanggal Mulai')"
                            />

                            <x-text-input
                                id="start_date"
                                name="start_date"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('start_date')"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('start_date')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Current Education --}}
                        <div class="mt-4">
                            <label for="is_current" class="inline-flex items-center">
                                <input
                                    id="is_current"
                                    name="is_current"
                                    type="checkbox"
                                    value="1"
                                    {{ old('is_current') ? 'checked' : '' }}
                                    class="rounded border-gray-300
                                           dark:border-gray-700
                                           text-indigo-600 shadow-sm
                                           focus:ring-indigo-500"
                                >

                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    Saya masih menempuh pendidikan ini
                                </span>
                            </label>
                        </div>

                        {{-- End Date --}}
                        <div class="mt-4">
                            <x-input-label
                                for="end_date"
                                :value="__('Tanggal Selesai')"
                            />

                            <x-text-input
                                id="end_date"
                                name="end_date"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('end_date')"
                            />

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Kosongkan jika masih menempuh pendidikan.
                            </p>

                            <x-input-error
                                :messages="$errors->get('end_date')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Description --}}
                        <div class="mt-4">
                            <x-input-label
                                for="description"
                                :value="__('Deskripsi')"
                            />

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md
                                       border-gray-300 dark:border-gray-700
                                       dark:bg-gray-900
                                       dark:text-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                                placeholder="Contoh: Fokus pada pengembangan sistem informasi dan aplikasi berbasis web."
                            >{{ old('description') }}</textarea>

                            <x-input-error
                                :messages="$errors->get('description')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Buttons --}}
                        <div class="mt-6 flex items-center gap-3">

                            <a
                                href="{{ route('education.index') }}"
                                class="inline-flex items-center px-4 py-2
                                       bg-gray-200 dark:bg-gray-700
                                       border border-transparent rounded-md
                                       font-semibold text-xs
                                       text-gray-700 dark:text-gray-200
                                       uppercase tracking-widest
                                       hover:bg-gray-300 dark:hover:bg-gray-600
                                       transition ease-in-out duration-150"
                            >
                                Batal
                            </a>

                            <x-primary-button>
                                {{ __('Simpan Pendidikan') }}
                            </x-primary-button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>