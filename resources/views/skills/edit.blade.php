<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Keahlian') }}
            </h2>

            <a
                href="{{ route('skills.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
            >
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('skills.update', $skill) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Skill -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Nama Keahlian / Skill <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $skill->name) }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: Laravel, PHP, UI/UX Design, Public Speaking"
                                required
                            >
                            @error('name')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori & Tingkat Kemahiran (Grid) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Kategori -->
                            <div>
                                <label for="category" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Kategori
                                </label>
                                <input
                                    type="text"
                                    name="category"
                                    id="category"
                                    value="{{ old('category', $skill->category) }}"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Contoh: Backend, Frontend, Soft Skill, Database"
                                >
                                @error('category')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tingkat Level -->
                            <div>
                                <label for="level" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Level Kemahiran
                                </label>
                                <select
                                    name="level"
                                    id="level"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">-- Pilih Level (Opsional) --</option>
                                    <option value="Beginner" {{ old('level', $skill->level) == 'Beginner' ? 'selected' : '' }}>Beginner / Pemula</option>
                                    <option value="Intermediate" {{ old('level', $skill->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate / Menengah</option>
                                    <option value="Advanced" {{ old('level', $skill->level) == 'Advanced' ? 'selected' : '' }}>Advanced / Mahir</option>
                                    <option value="Expert" {{ old('level', $skill->level) == 'Expert' ? 'selected' : '' }}>Expert / Ahli</option>
                                </select>
                                @error('level')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Persentase Kemahiran (Proficiency) -->
                        <div class="mb-4">
                            <label for="proficiency" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Persentase Kemahiran (0 - 100%)
                            </label>
                            <input
                                type="number"
                                name="proficiency"
                                id="proficiency"
                                min="0"
                                max="100"
                                value="{{ old('proficiency', $skill->proficiency) }}"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: 85"
                            >
                            @error('proficiency')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Deskripsi / Catatan Tambahan
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Deskripsi singkat mengenai pengalaman atau penggunaan keahlian ini..."
                            >{{ old('description', $skill->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('skills.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                            >
                                Perbarui Keahlian
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
