<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Edit Berita</h1>
                <p class="text-gray-600">Perbarui informasi berita</p>
                <div class="w-24 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Form Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Judul -->
                    <div class="space-y-2">
                        <label for="judul" class="block text-sm font-semibold text-gray-700">
                            Judul Berita
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-gray-50/50">
                        @error('judul')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Penulis -->
                    <div class="space-y-2">
                        <label for="penulis" class="block text-sm font-semibold text-gray-700">
                            Nama Penulis
                        </label>
                        <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $berita->penulis) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-gray-50/50">
                        @error('penulis')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Foto -->
                    <div class="space-y-2">
                        <label for="foto" class="block text-sm font-semibold text-gray-700">
                            Foto Berita
                        </label>
                        
                        @if($berita->foto)
                            <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                                <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                <img src="{{ Storage::url($berita->foto) }}" alt="Current photo" class="w-32 h-32 object-cover rounded-lg shadow-md">
                            </div>
                        @endif
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition duration-300 bg-gray-50/30">
                            <input type="file" name="foto" id="foto" class="hidden" accept="image/*" onchange="previewImage(this)">
                            <div id="upload-area" onclick="document.getElementById('foto').click()" class="cursor-pointer">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <p class="text-gray-600 mb-2 font-medium">Klik untuk upload foto baru</p>
                                <p class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah foto</p>
                            </div>
                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="max-w-full h-64 object-cover rounded-lg mx-auto">
                                <p class="text-sm text-gray-600 mt-2">Klik untuk mengganti foto</p>
                            </div>
                        </div>
                        @error('foto')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Konten -->
                    <div class="space-y-2">
                        <label for="konten" class="block text-sm font-semibold text-gray-700">
                            Konten Berita
                        </label>
                        <textarea name="konten" id="konten" rows="8" 
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-gray-50/50 resize-none">{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('berita.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition duration-200">
                            ← Kembali
                        </a>
                        <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-200 shadow-lg hover:shadow-xl">
                            Update Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('upload-area').classList.add('hidden');
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('preview-img').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
