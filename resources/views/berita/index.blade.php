<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 text-white py-20 overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                    BeritaKu
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">Portal Berita Terpercaya dan Terkini</p>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('berita.create') }}" class="inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm text-blue-600 hover:bg-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tulis Berita Baru
                    </a>
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if(session('success'))
                <div class="mb-8 bg-green-50/80 backdrop-blur-sm border border-green-200 text-green-800 p-4 rounded-xl shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($beritas->count() > 0)
                <!-- Featured Article -->
                @if($beritas->first())
                    <div class="mb-16">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Utama</h2>
                            <div class="w-24 h-1 bg-blue-500 mx-auto rounded-full"></div>
                        </div>
                        
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                            <div class="md:flex">
                                <div class="md:w-1/2">
                                    <img src="{{ Storage::url($beritas->first()->foto) }}" alt="{{ $beritas->first()->judul }}" class="w-full h-64 md:h-full object-cover">
                                </div>
                                <div class="md:w-1/2 p-8">
                                    <div class="flex items-center gap-4 mb-4">
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">TRENDING</span>
                                        <span class="text-gray-500 text-sm">{{ $beritas->first()->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4 leading-tight">{{ $beritas->first()->judul }}</h3>
                                    <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($beritas->first()->konten, 200) }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                                {{ substr($beritas->first()->penulis, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">{{ $beritas->first()->penulis }}</p>
                                                <p class="text-xs text-gray-500">Penulis</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('berita.show', $beritas->first()) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full transition duration-300 shadow-lg hover:shadow-xl">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Latest News Grid -->
                <div class="mb-12">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Terbaru</h2>
                        <div class="w-24 h-1 bg-blue-500 mx-auto rounded-full"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($beritas->skip(1) as $berita)
                            <article class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                                <div class="relative">
                                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-blue-600/90 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-semibold">NEWS</span>
                                    </div>
                                    @if(auth()->user()->isAdmin())
                                        <div class="absolute top-4 right-4 flex gap-2">
                                            <a href="{{ route('berita.edit', $berita) }}" class="bg-amber-500/90 backdrop-blur-sm hover:bg-amber-600 text-white p-2 rounded-full transition duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500/90 backdrop-blur-sm hover:bg-red-600 text-white p-2 rounded-full transition duration-300" onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3 text-sm text-gray-500">
                                        <span>{{ $berita->created_at->format('d M Y') }}</span>
                                        <span>•</span>
                                        <span>{{ $berita->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight hover:text-blue-600 transition duration-300">
                                        <a href="{{ route('berita.show', $berita) }}">{{ $berita->judul }}</a>
                                    </h3>
                                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">{{ Str::limit($berita->konten, 120) }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($berita->penulis, 0, 1) }}
                                            </div>
                                            <span class="text-sm text-gray-600">{{ $berita->penulis }}</span>
                                        </div>
                                        <a href="{{ route('berita.show', $berita) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition duration-300">
                                            Baca →
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $beritas->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Berita</h3>
                        <p class="text-gray-600 mb-8">Portal berita sedang dalam tahap pengembangan. Berita pertama akan segera hadir!</p>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('berita.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tulis Berita Pertama
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-3xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">BeritaKu</h3>
                        <p class="text-gray-300 mb-6 leading-relaxed">Portal berita terpercaya yang menyajikan informasi terkini dan akurat untuk masyarakat Indonesia.</p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-sky-500 hover:bg-sky-600 rounded-full flex items-center justify-center transition duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-500 hover:bg-pink-600 rounded-full flex items-center justify-center transition duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kategori</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Politik</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Ekonomi</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Olahraga</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Teknologi</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Kesehatan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Kontak</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Kebijakan Privasi</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                info@beritaku.com
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                +62 21 1234 5678
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Jakarta, Indonesia
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-300">&copy; {{ date('Y') }} BeritaKu. All rights reserved. Made with ❤️ in Indonesia</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>