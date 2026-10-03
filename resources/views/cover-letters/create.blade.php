<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buat Surat Lamaran Kerja') }}
            </h2>

            <a href="{{ route('cover-letters.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="coverLetterGenerator({
        userName: '{{ addslashes($user->name) }}',
        userSkills: '{{ addslashes($skills) }}',
        latestExp: '{{ addslashes($latestExp ? $latestExp->position . ' di ' . $latestExp->company : '') }}'
    })">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Form Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('cover-letters.store') }}" method="POST">
                        @csrf

                        <!-- Judul Surat Lamaran -->
                        <div class="mb-5">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Judul / Dokumen Surat <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                x-model="title"
                                value="{{ old('title') }}"
                                placeholder="Contoh: Surat Lamaran Web Developer - PT ABC"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Perusahaan & Posisi (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                            <div>
                                <label for="company" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Nama Perusahaan Target
                                </label>
                                <input
                                    type="text"
                                    name="company"
                                    id="company"
                                    x-model="company"
                                    value="{{ old('company') }}"
                                    placeholder="Contoh: PT Teknologi Bangsa"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                @error('company')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="position" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Posisi / Jabatan yang Dilamar
                                </label>
                                <input
                                    type="text"
                                    name="position"
                                    id="position"
                                    x-model="position"
                                    value="{{ old('position') }}"
                                    placeholder="Contoh: Fullstack Laravel Developer"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- AI / Smart Template Generator Box --}}
                        <div class="mb-6 p-4 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-200 dark:border-indigo-900/60">
                            <div class="flex items-center justify-between flex-wrap gap-3 mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="p-1.5 rounded-lg bg-indigo-600 text-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    </span>
                                    <div>
                                        <h4 class="text-sm font-bold text-indigo-950 dark:text-indigo-200">
                                            Smart Auto-Generator Surat Lamaran
                                        </h4>
                                        <p class="text-xs text-indigo-700 dark:text-indigo-300">
                                            Susun draf surat secara otomatis menggunakan data profil, skill, dan posisi yang dilamar.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <select
                                        x-model="selectedStyle"
                                        class="text-xs rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    >
                                        <option value="id_formal">Formal (Bahasa Indonesia)</option>
                                        <option value="en_professional">Professional (English)</option>
                                        <option value="id_fresh">Fresh Graduate / Entry-Level (ID)</option>
                                    </select>

                                    <button
                                        type="button"
                                        @click="generateContent()"
                                        class="inline-flex items-center px-3.5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md text-xs font-bold uppercase tracking-wider shadow-sm transition"
                                    >
                                        ✨ Generate
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Isi Surat Lamaran -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="content" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Isi Surat Lamaran
                                </label>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Anda bebas mengedit & menyesuaikan teks di bawah ini
                                </span>
                            </div>

                            <textarea
                                name="content"
                                id="content"
                                x-model="content"
                                rows="14"
                                placeholder="Tuliskan isi surat lamaran atau gunakan tombol '✨ Generate' di atas..."
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm leading-relaxed"
                            >{{ old('content') }}</textarea>

                            @error('content')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('cover-letters.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-5 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Simpan Surat Lamaran
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        function coverLetterGenerator(userData) {
            return {
                title: '{{ old('title') }}',
                company: '{{ old('company') }}',
                position: '{{ old('position') }}',
                content: @json(old('content', '')),
                selectedStyle: 'id_formal',

                generateContent() {
                    const comp = this.company.trim() || '[Nama Perusahaan]';
                    const pos = this.position.trim() || '[Posisi yang Dilamar]';
                    const name = userData.userName || '[Nama Anda]';
                    const skills = userData.userSkills ? `di antaranya: ${userData.userSkills}` : 'yang relevan dengan bidang ini';
                    const expNote = userData.latestExp ? `Didukung dengan pengalaman saya sebagai ${userData.latestExp}, ` : '';

                    if (this.selectedStyle === 'id_formal') {
                        this.content = `Dengan hormat,\n\nSehubungan dengan informasi lowongan pekerjaan yang saya dapatkan mengenai posisi ${pos} di ${comp}, melalui surat ini saya bermaksud untuk mengajukan diri guna bergabung dengan tim profesional di perusahaan yang Bapak/Ibu pimpin.\n\n${expNote}saya memiliki keahlian dan kompetensi dalam bidang ini, ${skills}. Saya terbiasa bekerja secara mandiri maupun berkolaborasi dalam tim untuk mencapai target yang telah ditetapkan dengan penuh tanggung jawab dan ketelitian.\n\nBesar harapan saya untuk diberikan kesempatan menghadiri sesi wawancara guna menjelaskan lebih mendalam mengenai kualifikasi, pengalaman, dan bagaimana saya dapat memberikan kontribusi nyata bagi kemajuan ${comp}.\n\nAtas perhatian dan kesempatan yang Bapak/Ibu berikan, saya ucapkan terima kasih.`;
                    } else if (this.selectedStyle === 'en_professional') {
                        this.content = `Dear Hiring Manager,\n\nI am writing to express my strong interest in the ${pos} position at ${comp}. With a solid foundation in technical and problem-solving skills, including expertise in ${userData.userSkills || 'relevant industry tools and frameworks'}, I am eager to contribute effectively to your organization's goals.\n\n${userData.latestExp ? `My previous background as a ${userData.latestExp} has allowed me to hone my capabilities in high-paced environments and deliver impactful results.` : 'Throughout my career and academic journey, I have consistently demonstrated a commitment to continuous learning and high-quality deliverables.'}\n\nI welcome the opportunity to discuss how my skill set and enthusiasm align with the vision of ${comp}. Thank you for your time, consideration, and review of my application.`;
                    } else if (this.selectedStyle === 'id_fresh') {
                        this.content = `Dengan hormat,\n\nSaya menulis surat ini untuk menyatakan ketertarikan saya yang besar pada posisi ${pos} di ${comp}. Sebagai seorang individu yang antusias dan berdedikasi tinggi, saya siap mengaplikasikan kemampuan dan pengetahuan yang saya miliki untuk berkontribusi positif bagi kemajuan perusahaan.\n\nSaya telah membekali diri dengan serangkaian keterampilan kunci, ${skills}. Saya memiliki kemampuan adaptasi yang cepat, motivasi belajar yang tinggi, serta komunikasi yang baik dalam lingkungan kerja yang dinamis.\n\nSaya sangat menyambut baik kesempatan untuk berdiskusi lebih lanjut dalam tahap wawancara. Terima kasih banyak atas waktu dan perhatian yang Bapak/Ibu luangkan.`;
                    }

                    if (!this.title) {
                        this.title = `Surat Lamaran ${pos} - ${comp}`;
                    }
                }
            }
        }
    </script>
</x-app-layout>