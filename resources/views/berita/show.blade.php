<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <!-- Article Container -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Article Card -->
            <article class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                <!-- Article Header -->
                <div class="p-8 pb-6">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold">BERITA</span>
                        <span class="text-gray-500 text-sm">{{ $berita->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-6">{{ $berita->judul }}</h1>
                    
                    <!-- Author Info -->
                    <div class="flex items-center justify-between pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($berita->penulis, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $berita->penulis }}</p>
                                <p class="text-sm text-gray-500">{{ $berita->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <!-- Reading Time -->
                        <div class="flex items-center gap-2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm">{{ ceil(str_word_count($berita->konten) / 200) }} menit baca</span>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="px-8 mb-8">
                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                </div>

                <!-- Article Content -->
                <div class="px-8 pb-8">
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-800 leading-relaxed text-lg whitespace-pre-line">{{ $berita->konten }}</p>
                    </div>
                    
                    <!-- Share Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-700">Bagikan artikel ini:</span>
                            <div class="flex items-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center transition duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->url()) }}" target="_blank" class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Admin Actions -->
            @if(auth()->user()->isAdmin())
                <div class="mt-6 bg-amber-50/80 backdrop-blur-sm border border-amber-200 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-amber-800 font-semibold">Panel Admin</span>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('berita.edit', $berita) }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition duration-200">
                                Edit Berita
                            </a>
                            <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition duration-200" onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                    Hapus Berita
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Related Articles -->
            @php
                $relatedArticles = App\Models\Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();
            @endphp
            
            @if($relatedArticles->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Berita Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $related)
                            <article class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden hover:shadow-xl transition duration-300">
                                <img src="{{ Storage::url($related->foto) }}" alt="{{ $related->judul }}" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-2 leading-tight">
                                        <a href="{{ route('berita.show', $related) }}" class="hover:text-blue-600 transition duration-200">{{ Str::limit($related->judul, 60) }}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($related->konten, 80) }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">{{ $related->created_at->format('d M Y') }}</span>
                                        <a href="{{ route('berita.show', $related) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Baca →</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
