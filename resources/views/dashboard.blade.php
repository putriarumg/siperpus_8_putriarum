<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat Datang, ".Auth()->user()->name." !") }}
                </div>
            </div>
        </div>
    </div>
   
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col lg:flex-row items-center">
                        <!-- Gambar -->
                        <!-- <div class="w-full lg:w-1/2 p-4">
                            <img src="storage/app/public/buku.jpg" alt="buku" class="rounded-lg shadow-lg">
                        </div> -->

                        <!-- Konten Teks -->
                        <div class="w-full lg:w-1/2 p-4">
                            <h3 class="text-2xl font-bold mb-4">Selamat Datang di Sistem Perpustakaan</h3>
                            <p class="text-lg leading-relaxed mb-4">
                                Sistem Perpustakaan ini dirancang untuk memudahkan pengelolaan data buku, peminjaman, dan pengembalian, 
                                serta memberikan pengalaman terbaik bagi pengguna dalam mengakses informasi terkait koleksi buku yang tersedia.
                            </p>
                            <p class="text-lg leading-relaxed mb-4">
                                Dengan antarmuka yang modern dan fitur yang lengkap, sistem ini mendukung efisiensi dalam mengelola 
                                perpustakaan baik untuk institusi pendidikan maupun umum.
                            </p>
                            <a href="/features" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition-all">
                                Lihat Fitur Lengkap
                            </a>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-2">Kenapa Memilih Sistem Kami?</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Pengelolaan data buku yang terstruktur.</li>
                            <li>Pencarian cepat dan akurat.</li>
                            <li>Antarmuka pengguna yang ramah dan mudah digunakan.</li>
                            <li>Integrasi dengan teknologi terkini.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
