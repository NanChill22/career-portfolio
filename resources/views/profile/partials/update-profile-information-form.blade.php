<section x-data="{
    avatarPreview: '{{ $user->avatar_url }}',
    removeAvatar: false,
    fileChosen(event) {
        if (event.target.files.length > 0) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.avatarPreview = e.target.result;
                this.removeAvatar = false;
            };
            reader.readAsDataURL(file);
        }
    },
    clearAvatar() {
        this.avatarPreview = 'https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF';
        this.removeAvatar = true;
        this.$refs.avatarInput.value = '';
    }
}">
    <header class="border-b border-gray-200 dark:border-gray-700 pb-5">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            {{ __('Informasi Data Pribadi') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Lengkapi informasi profil dan data diri Anda untuk keperluan pembuatan CV ATS, lamaran kerja, dan portofolio profesional.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-8 space-y-8">
        @csrf
        @method('patch')
        <input type="hidden" name="remove_avatar" :value="removeAvatar ? '1' : '0'">

        {{-- 1. FOTO PROFIL / AVATAR --}}
        <div class="bg-gray-50 dark:bg-gray-750/50 p-5 rounded-xl border border-gray-100 dark:border-gray-700/60">
            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ __('Foto Profil') }}
            </h3>

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="relative group">
                    <img :src="avatarPreview" alt="{{ $user->name }}" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-md ring-2 ring-indigo-500/30">
                </div>

                <div class="space-y-2 text-center sm:text-left">
                    <div class="flex flex-wrap items-center gap-3">
                        <label for="avatar" class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            {{ __('Unggah Foto') }}
                        </label>
                        <input id="avatar" name="avatar" type="file" accept="image/*" class="hidden" x-ref="avatarInput" @change="fileChosen">

                        @if ($user->avatar)
                            <button type="button" @click="clearAvatar()" class="inline-flex items-center px-3 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 rounded-lg text-xs font-semibold transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                {{ __('Hapus Foto') }}
                            </button>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Format yang didukung: JPG, PNG, WEBP. Maksimal 2MB. Foto formal direkomendasikan untuk keperluan lamaran.') }}
                    </p>
                    <x-input-error class="mt-1" :messages="$errors->get('avatar')" />
                </div>
            </div>
        </div>

        {{-- 2. DATA UTAMA / IDENTITAS --}}
        <div>
            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700/60 pb-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
                {{ __('Identitas & Target Profesi') }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap --}}
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap & Gelar')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="misal: Budi Santoso, S.Kom" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                {{-- Headline / Posisi Target --}}
                <div>
                    <x-input-label for="headline" :value="__('Headline Profesi / Target Role')" />
                    <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full" :value="old('headline', $user->headline)" placeholder="misal: Full Stack Web Developer / IT Support" />
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Judul profesi yang akan tampil di header CV / resume Anda.</p>
                    <x-input-error class="mt-2" :messages="$errors->get('headline')" />
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('gender', $user->gender) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $user->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        <option value="Lainnya" {{ old('gender', $user->gender) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <x-input-label for="birth_date" :value="__('Tanggal Lahir')" />
                    <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                </div>
            </div>
        </div>

        {{-- 3. KONTAK & DOMISILI --}}
        <div>
            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700/60 pb-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {{ __('Kontak & Domisili') }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                {{ __('Email Anda belum diverifikasi.') }}
                                <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Kirim ulang email verifikasi.') }}
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Nomor WhatsApp / HP --}}
                <div>
                    <x-input-label for="phone" :value="__('Nomor WhatsApp / HP')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" placeholder="misal: 081234567890" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                {{-- Kota / Domisili --}}
                <div>
                    <x-input-label for="city" :value="__('Kota / Domisili Saat Ini')" />
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" placeholder="misal: Jakarta Selatan, DKI Jakarta" />
                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                </div>

                {{-- Alamat Lengkap --}}
                <div>
                    <x-input-label for="address" :value="__('Alamat Lengkap (Opsional)')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" placeholder="misal: Jl. Mawar No. 12, Kel. Menteng" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>
            </div>
        </div>

        {{-- 4. TAUTAN PROFESIONAL & PORTOFOLIO --}}
        <div>
            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700/60 pb-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                {{ __('Tautan Profesional & Portofolio Online') }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- LinkedIn --}}
                <div>
                    <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                    <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', $user->linkedin_url)" placeholder="https://linkedin.com/in/username" />
                    <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
                </div>

                {{-- GitHub --}}
                <div>
                    <x-input-label for="github_url" :value="__('GitHub URL')" />
                    <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $user->github_url)" placeholder="https://github.com/username" />
                    <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
                </div>

                {{-- Portfolio URL --}}
                <div>
                    <x-input-label for="portfolio_url" :value="__('Website / Portofolio URL')" />
                    <x-text-input id="portfolio_url" name="portfolio_url" type="url" class="mt-1 block w-full" :value="old('portfolio_url', $user->portfolio_url)" placeholder="https://myportfolio.com" />
                    <x-input-error class="mt-2" :messages="$errors->get('portfolio_url')" />
                </div>
            </div>
        </div>

        {{-- 5. RINGKASAN PROFESIONAL / BIO --}}
        <div>
            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700/60 pb-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                {{ __('Ringkasan Profesional / Tentang Saya (Bio)') }}
            </h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                {{ __('Tulis ringkasan singkat 2-4 kalimat mengenai latar belakang, keahlian utama, dan pencapaian Anda. Bagian ini akan digunakan oleh CV dan surat lamaran.') }}
            </p>

            <textarea id="bio" name="bio" rows="4" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" placeholder="Contoh: Web Developer berpengalaman lebih dari 2 tahun dalam membangun aplikasi web berbasis Laravel dan React. Terbiasa mengelola RESTful API, database MySQL, dan kolaborasi tim Agile...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="flex items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <x-primary-button class="px-6 py-2.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Simpan Perubahan Data Pribadi') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center gap-1.5 text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-3 py-1.5 rounded-lg border border-emerald-200 dark:border-emerald-800"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ __('Data Pribadi berhasil diperbarui!') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
