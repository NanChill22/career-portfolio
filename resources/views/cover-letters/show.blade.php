<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Surat Lamaran') }}
            </h2>

            <a href="{{ route('cover-letters.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Informasi Surat --}}
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-6">
                            {{ $coverLetter->title }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Perusahaan
                                </p>

                                <p class="mt-1 font-medium">
                                    {{ $coverLetter->company ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Posisi
                                </p>

                                <p class="mt-1 font-medium">
                                    {{ $coverLetter->position ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Dibuat
                                </p>

                                <p class="mt-1 font-medium">
                                    {{ $coverLetter->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Terakhir Diperbarui
                                </p>

                                <p class="mt-1 font-medium">
                                    {{ $coverLetter->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Isi Surat --}}
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">

                        <h4 class="text-lg font-semibold mb-4">
                            Isi Surat Lamaran
                        </h4>

                        <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <div class="whitespace-pre-line leading-relaxed">
                                {{ $coverLetter->content ?? 'Belum ada isi surat.' }}
                            </div>
                        </div>

                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-end gap-3 mt-6">

                        <a href="{{ route('cover-letters.edit', $coverLetter) }}"
                           class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('cover-letters.destroy', $coverLetter) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus surat lamaran ini?')">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>