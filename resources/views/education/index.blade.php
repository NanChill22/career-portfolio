<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Education') }}
            </h2>

            <a
                href="{{ route('education.create') }}"
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
                + Tambah Pendidikan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div
                    class="mb-6 rounded-lg
                           bg-green-100 dark:bg-green-900/30
                           border border-green-200 dark:border-green-800
                           px-4 py-3 text-sm
                           text-green-700 dark:text-green-300"
                >
                    {{ session('success') }}
                </div>
            @endif


            {{-- Education List --}}
            @if ($educations->count())

                <div class="space-y-6">

                    @foreach ($educations as $education)

                        <div
                            class="bg-white dark:bg-gray-800
                                   overflow-hidden shadow-sm sm:rounded-lg"
                        >

                            <div class="p-6">

                                {{-- Header --}}
                                <div class="flex items-start justify-between gap-4">

                                    <div>

                                        <h3
                                            class="text-lg font-semibold
                                                   text-gray-900 dark:text-gray-100"
                                        >
                                            {{ $education->institution }}
                                        </h3>

                                        <p
                                            class="mt-1 text-sm font-medium
                                                   text-gray-600 dark:text-gray-300"
                                        >
                                            {{ $education->degree }}

                                            @if ($education->field_of_study)
                                                - {{ $education->field_of_study }}
                                            @endif
                                        </p>

                                        <p
                                            class="mt-2 text-sm
                                                   text-gray-500 dark:text-gray-400"
                                        >
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


                                    {{-- Status --}}
                                    @if ($education->is_current)

                                        <span
                                            class="inline-flex items-center rounded-full
                                                   bg-green-100 dark:bg-green-900/30
                                                   px-3 py-1 text-xs font-medium
                                                   text-green-700 dark:text-green-300"
                                        >
                                            Sedang Berjalan
                                        </span>

                                    @endif

                                </div>


                                {{-- Description --}}
                                @if ($education->description)

                                    <div
                                        class="mt-4 text-sm
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        {{ $education->description }}
                                    </div>

                                @endif


                                {{-- Action --}}
                                <div class="mt-5 flex items-center gap-4">

                                    {{-- Detail --}}
                                    <a
                                        href="{{ route('education.show', $education) }}"
                                        class="inline-flex items-center
                                               text-sm font-medium
                                               text-gray-600 dark:text-gray-400
                                               hover:text-gray-900 dark:hover:text-gray-200"
                                    >
                                        Detail
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('education.edit', $education) }}"
                                        class="inline-flex items-center
                                               text-sm font-medium
                                               text-indigo-600 dark:text-indigo-400
                                               hover:text-indigo-800 dark:hover:text-indigo-300"
                                    >
                                        Edit
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('education.destroy', $education) }}"
                                        method="POST"
                                        class="inline-flex items-center m-0"
                                        onsubmit="return confirm('Yakin ingin menghapus pendidikan ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center
                                                   text-sm font-medium
                                                   text-red-600 dark:text-red-400
                                                   hover:text-red-800 dark:hover:text-red-300"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


            @else

                {{-- Empty State --}}
                <div
                    class="bg-white dark:bg-gray-800
                           overflow-hidden shadow-sm sm:rounded-lg"
                >

                    <div class="p-6 text-center">

                        <h3
                            class="text-lg font-medium
                                   text-gray-900 dark:text-gray-100"
                        >
                            Belum ada data pendidikan
                        </h3>

                        <p
                            class="mt-2 text-sm
                                   text-gray-500 dark:text-gray-400"
                        >
                            Tambahkan riwayat pendidikan untuk melengkapi CV kamu.
                        </p>

                        <a
                            href="{{ route('education.create') }}"
                            class="inline-flex items-center mt-5 px-4 py-2
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
                            + Tambah Pendidikan
                        </a>

                    </div>

                </div>

            @endif

        </div>
    </div>

</x-app-layout>
```
