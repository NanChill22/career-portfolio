<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail CV') }}
            </h2>

            <a href="{{ route('cvs.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6">
                        <h3 class="text-2xl font-bold">
                            {{ $cv->title }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Dibuat pada {{ $cv->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">

                        <div class="mb-5">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Template
                            </p>

                            <p class="mt-1 text-base">
                                {{ $cv->template }}
                            </p>
                        </div>

                        <div class="mb-5">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                File CV
                            </p>

                            @if ($cv->file_path)
                                <a href="{{ asset('storage/' . $cv->file_path) }}"
                                    target="_blank"
                                    class="mt-1 inline-block text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Lihat / Download CV
                                </a>
                            @else
                                <p class="mt-1 text-gray-500 dark:text-gray-400">
                                    File CV belum tersedia.
                                </p>
                            @endif
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <a href="{{ route('cvs.edit', $cv) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <form action="{{ route('cvs.destroy', $cv) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus CV ini?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>