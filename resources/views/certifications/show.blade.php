<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Sertifikasi') }}
            </h2>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('certifications.edit', $certification) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                >
                    Edit
                </a>

                <a
                    href="{{ route('certifications.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                >
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header Nama Sertifikasi & Penerbit --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $certification->name }}
                            </h3>
                            <p class="text-base font-semibold text-indigo-600 dark:text-indigo-400 mt-1">
                                {{ $certification->issuer }}
                            </p>
                        </div>

                        <div>
                            @if ($certification->expiration_date)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300">
                                    Berlaku s/d {{ $certification->expiration_date->format('d M Y') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300">
                                    Seumur Hidup / Tidak Kedaluwarsa
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Detail Info --}}
                    <div class="py-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-800">
                                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Tanggal Terbit</span>
                                <p class="text-base font-medium text-gray-800 dark:text-gray-200 mt-1">
                                    {{ $certification->issue_date->format('d F Y') }}
                                </p>
                            </div>

                            <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-800">
                                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">ID Kredensial</span>
                                <p class="text-base font-medium text-gray-800 dark:text-gray-200 mt-1">
                                    {{ $certification->credential_id ?: '-' }}
                                </p>
                            </div>
                        </div>

                        @if ($certification->credential_url)
                            <div class="p-4 bg-indigo-50 dark:bg-indigo-950/40 rounded-lg border border-indigo-100 dark:border-indigo-900 flex items-center justify-between flex-wrap gap-2">
                                <div>
                                    <span class="text-xs text-indigo-700 dark:text-indigo-300 uppercase font-semibold">Tautan Verifikasi Sertifikat</span>
                                    <p class="text-sm text-indigo-900 dark:text-indigo-200 truncate mt-0.5">
                                        {{ $certification->credential_url }}
                                    </p>
                                </div>
                                <a
                                    href="{{ $certification->credential_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition"
                                >
                                    Buka Sertifikat &rarr;
                                </a>
                            </div>
                        @endif

                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi / Catatan
                            </h4>
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-md text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line border border-gray-100 dark:border-gray-800">
                                {{ $certification->description ?: 'Tidak ada deskripsi yang ditambahkan.' }}
                            </div>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <form
                            action="{{ route('certifications.destroy', $certification) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikasi ini?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition"
                            >
                                Hapus Sertifikasi
                            </button>
                        </form>

                        <a
                            href="{{ route('certifications.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:underline"
                        >
                            Kembali ke Daftar Sertifikasi
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
