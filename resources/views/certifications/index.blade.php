<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Sertifikasi & Lisensi') }}
            </h2>

            <a
                href="{{ route('certifications.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                + Tambah Sertifikasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Alert --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 px-4 py-3 text-sm text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Certification List --}}
            @if ($certifications->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($certifications as $certification)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
                            <div class="p-6">
                                {{-- Header --}}
                                <div class="mb-3">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('certifications.show', $certification) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ $certification->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mt-0.5">
                                        {{ $certification->issuer }}
                                    </p>
                                </div>

                                {{-- Dates --}}
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-3 space-y-1">
                                    <p>
                                        <span class="font-medium">Terbit:</span> {{ $certification->issue_date->format('d M Y') }}
                                    </p>
                                    @if ($certification->expiration_date)
                                        <p>
                                            <span class="font-medium">Kedaluwarsa:</span> {{ $certification->expiration_date->format('d M Y') }}
                                        </p>
                                    @else
                                        <p class="text-emerald-600 dark:text-emerald-400 font-medium">
                                            Tidak Ada Kedaluwarsa
                                        </p>
                                    @endif
                                </div>

                                {{-- Credential ID / Link --}}
                                @if ($certification->credential_id)
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                                        <span class="font-medium">ID Kredensial:</span> <code class="bg-gray-100 dark:bg-gray-900 px-1.5 py-0.5 rounded text-gray-800 dark:text-gray-200">{{ $certification->credential_id }}</code>
                                    </p>
                                @endif

                                @if ($certification->credential_url)
                                    <div class="mb-3">
                                        <a
                                            href="{{ $certification->credential_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center text-xs text-indigo-600 dark:text-indigo-400 hover:underline gap-1"
                                        >
                                            <span>Lihat Kredensial Resmi</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                        </a>
                                    </div>
                                @endif

                                {{-- Description --}}
                                @if ($certification->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                        {{ $certification->description }}
                                    </p>
                                @endif
                            </div>

                            {{-- Actions Footer --}}
                            <div class="bg-gray-50 dark:bg-gray-800/60 border-t border-gray-100 dark:border-gray-700 px-6 py-3 flex items-center justify-between">
                                <a
                                    href="{{ route('certifications.show', $certification) }}"
                                    class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline"
                                >
                                    Lihat Detail
                                </a>

                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('certifications.edit', $certification) }}"
                                        class="text-xs font-medium text-amber-600 dark:text-amber-400 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('certifications.destroy', $certification) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikasi {{ $certification->name }}?');"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-xs font-medium text-red-600 dark:text-red-400 hover:underline"
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">Belum Ada Sertifikasi</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Tambahkan sertifikat kursus, lisensi profesional, atau sertifikasi keahlian Anda.</p>
                    <a
                        href="{{ route('certifications.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        + Tambah Sertifikasi Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
