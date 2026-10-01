<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Pendidikan') }}
            </h2>

            <a
                href="{{ route('education.index') }}"
                class="text-sm text-gray-600 dark:text-gray-400
                       hover:text-gray-900 dark:hover:text-gray-200"
            >
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800
                        overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-2xl font-bold
                                       text-gray-900 dark:text-gray-100">
                                {{ $education->institution }}
                            </h3>

                            <p class="mt-2 text-base
                                      text-gray-600 dark:text-gray-300">
                                {{ $education->degree }}

                                @if ($education->field_of_study)
                                    - {{ $education->field_of_study }}
                                @endif
                            </p>
                        </div>

                        @if ($education->is_current)
                            <span class="inline-flex items-center rounded-full
                                         bg-green-100 dark:bg-green-900/30
                                         px-3 py-1 text-xs font-medium
                                         text-green-700 dark:text-green-300">
                                Sedang Berjalan
                            </span>
                        @endif
                    </div>

                    <div class="mt-6">
                        <p class="text-sm font-medium
                                  text-gray-700 dark:text-gray-300">
                            Periode Pendidikan
                        </p>

                        <p class="mt-1 text-sm
                                  text-gray-500 dark:text-gray-400">
                            {{ $education->start_date?->format('M Y') }}
                            -
                            @if ($education->is_current)
                                Sekarang
                            @elseif ($education->end_date)
                                {{ $education->end_date->format('M Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    @if ($education->description)
                        <div class="mt-6">
                            <p class="text-sm font-medium
                                      text-gray-700 dark:text-gray-300">
                                Deskripsi
                            </p>

                            <p class="mt-2 text-sm leading-relaxed
                                      text-gray-600 dark:text-gray-300">
                                {{ $education->description }}
                            </p>
                        </div>
                    @endif

                    <div class="mt-8 flex items-center gap-3">

                        <a
                            href="{{ route('education.edit', $education) }}"
                            class="inline-flex items-center px-4 py-2
                                   bg-gray-800 dark:bg-gray-200
                                   border border-transparent rounded-md
                                   font-semibold text-xs
                                   text-white dark:text-gray-800
                                   uppercase tracking-widest
                                   hover:bg-gray-700 dark:hover:bg-white
                                   focus:outline-none focus:ring-2
                                   focus:ring-indigo-500 focus:ring-offset-2
                                   transition ease-in-out duration-150"
                        >
                            Edit
                        </a>

                        <a
                            href="{{ route('education.index') }}"
                            class="inline-flex items-center px-4 py-2
                                   bg-white dark:bg-gray-800
                                   border border-gray-300 dark:border-gray-500
                                   rounded-md font-semibold text-xs
                                   text-gray-700 dark:text-gray-300
                                   uppercase tracking-widest
                                   hover:bg-gray-50 dark:hover:bg-gray-700
                                   focus:outline-none focus:ring-2
                                   focus:ring-indigo-500 focus:ring-offset-2
                                   transition ease-in-out duration-150"
                        >
                            Kembali
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>