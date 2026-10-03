<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Surat Lamaran') }}
            </h2>

            <a href="{{ route('cover-letters.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Buat Surat Lamaran
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($coverLetters->count() > 0)

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            No
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Judul
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Perusahaan
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Posisi
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Dibuat
                                        </th>

                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($coverLetters as $coverLetter)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{ $coverLetter->title }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $coverLetter->company ?? '-' }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $coverLetter->position ?? '-' }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $coverLetter->created_at->format('d/m/Y') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <div class="flex items-center justify-center gap-2">

                                                    <a href="{{ route('cover-letters.show', $coverLetter) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                                        Detail
                                                    </a>

                                                    <a href="{{ route('cover-letters.preview.pdf', $coverLetter) }}" target="_blank"
                                                       class="inline-flex items-center px-3 py-1.5 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 transition">
                                                        Preview
                                                    </a>

                                                    <a href="{{ route('cover-letters.download.pdf', $coverLetter) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 transition">
                                                        PDF
                                                    </a>

                                                    <a href="{{ route('cover-letters.edit', $coverLetter) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 transition">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('cover-letters.destroy', $coverLetter) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus surat lamaran ini?')"
                                                          class="inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                                            Hapus
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else

                        <div class="text-center py-10">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Belum ada surat lamaran
                            </h3>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Silakan buat surat lamaran pertama Anda.
                            </p>

                            <a href="{{ route('cover-letters.create') }}"
                               class="inline-flex items-center mt-4 px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition">
                                + Buat Surat Lamaran
                            </a>
                        </div>

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>