@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('sub_title', 'Dashboard')

@section('breadcrumb')
    <x-layout.admin.breadcrumb :items="[]" />
@endsection

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header Greeting -->
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
        <p class="text-sm text-slate-500 mt-1">Berikut ringkasan statistik, analitik, dan aktivitas terbaru pada sistem Anda hari ini.</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Stat Card 1 -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-100/50 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-sm font-medium text-slate-400">Total Artikel</span>
                <h3 class="text-3xl font-bold tracking-tight text-slate-900">124</h3>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600">
                    <i class="ri-arrow-up-line"></i> +12% minggu ini
                </span>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-700 border border-slate-100">
                <i class="ri-article-line text-xl"></i>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-sm font-medium text-slate-400">Kategori Artikel</span>
                <h3 class="text-3xl font-bold tracking-tight text-slate-900">18</h3>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-400">
                    Stabil
                </span>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-700 border border-slate-100">
                <i class="ri-folder-line text-xl"></i>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-sm font-medium text-slate-400">Total Pengguna</span>
                <h3 class="text-3xl font-bold tracking-tight text-slate-900">42</h3>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600">
                    <i class="ri-arrow-up-line"></i> +4 baru hari ini
                </span>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-700 border border-slate-100">
                <i class="ri-user-line text-xl"></i>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-sm font-medium text-slate-400">Kunjungan Web</span>
                <h3 class="text-3xl font-bold tracking-tight text-slate-900">3.8K</h3>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600">
                    <i class="ri-arrow-down-line"></i> -2% kemarin
                </span>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-700 border border-slate-100">
                <i class="ri-eye-line text-xl"></i>
            </div>
        </div>
    </div>

    <!-- NEW WIDGET SECTION: Analytics & Performance Graphics -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Analytics Chart Container -->
        <div class="lg:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <div>
                    <h3 class="font-bold text-slate-900">Tren Kunjungan Mingguan</h3>
                    <p class="text-xs text-slate-400">Statistik performa 7 hari terakhir</p>
                </div>
                <span class="rounded-xl bg-slate-50 border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600">7 Hari Terakhir</span>
            </div>
            <!-- Mockup Chart SVG -->
            <div class="relative w-full h-64 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200 p-4 flex items-end">
                <svg class="w-full h-full overflow-visible" viewBox="0 0 700 200" preserveAspectRatio="none">
                    <!-- Grid Lines -->
                    <line x1="0" y1="50" x2="700" y2="50" stroke="#f1f5f9" stroke-width="1" />
                    <line x1="0" y1="100" x2="700" y2="100" stroke="#f1f5f9" stroke-width="1" />
                    <line x1="0" y1="150" x2="700" y2="150" stroke="#f1f5f9" stroke-width="1" />
                    
                    <!-- Line Chart Path -->
                    <path d="M 0 160 Q 116 110 233 130 T 466 60 T 700 40" fill="none" stroke="url(#gradient-stroke)" stroke-width="4" stroke-linecap="round" />
                    <path d="M 0 160 Q 116 110 233 130 T 466 60 T 700 40 L 700 200 L 0 200 Z" fill="url(#gradient-area)" opacity="0.15" />
                    
                    <!-- Definitions for gradients -->
                    <defs>
                        <linearGradient id="gradient-stroke" x1="0" y1="0" x2="1" y2="0">
                            <stop offset="0%" stop-color="#3b82f6" />
                            <stop offset="100%" stop-color="#10b981" />
                        </linearGradient>
                        <linearGradient id="gradient-area" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#3b82f6" />
                            <stop offset="100%" stop-color="#ffffff" />
                        </linearGradient>
                    </defs>
                </svg>
                <!-- Labels Data -->
                <div class="absolute inset-x-0 bottom-2 px-4 flex justify-between text-[10px] font-bold text-slate-400">
                    <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
                </div>
            </div>
        </div>

        <!-- Storage & System Status -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50 flex flex-col justify-between">
            <div class="border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-bold text-slate-900">Kapasitas Server</h3>
                <p class="text-xs text-slate-400">Penggunaan resource server hosting</p>
            </div>
            <div class="space-y-5">
                <!-- Disk Space -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-medium text-slate-500">Penyimpanan SSD</span>
                        <span class="font-bold text-slate-800">42.8 GB / 100 GB</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full w-[42%] bg-blue-500 rounded-full"></div>
                    </div>
                </div>
                <!-- Database Load -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-medium text-slate-500">Beban Database</span>
                        <span class="font-bold text-slate-800">18%</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full w-[18%] bg-emerald-500 rounded-full"></div>
                    </div>
                </div>
                <!-- Memory Cache -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-medium text-slate-500">Redis Cache RAM</span>
                        <span class="font-bold text-slate-800">76%</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full w-[76%] bg-amber-500 rounded-full"></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 text-[11px] text-slate-400 border-t border-slate-50 flex items-center gap-1">
                <i class="ri-refresh-line animate-spin text-slate-300"></i> Disinkronkan otomatis 1 menit yang lalu.
            </div>
        </div>
    </div>

    <!-- Quick Actions & Details Section -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Recent Activities Card -->
        <div class="lg:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50 flex flex-col">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-bold text-slate-900">Artikel Terbaru</h3>
                <a href="{{ route('article.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900 hover:underline transition-all">Lihat Semua</a>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead>
                        <tr class="text-slate-400 font-semibold border-b border-slate-100 text-xs uppercase">
                            <th class="py-3 pr-4">Judul Artikel</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 pl-4 text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr>
                            <td class="py-3.5 pr-4 font-semibold text-slate-800">Tips Memulai Coding untuk Pemula</td>
                            <td class="py-3.5 px-4"><span class="inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">Teknologi</span></td>
                            <td class="py-3.5 px-4"><span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-700">Published</span></td>
                            <td class="py-3.5 pl-4 text-right text-slate-400">13 Jul 2026</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 pr-4 font-semibold text-slate-800">Membangun Web Impian dengan Tailwind v4</td>
                            <td class="py-3.5 px-4"><span class="inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">Desain Web</span></td>
                            <td class="py-3.5 px-4"><span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-700">Published</span></td>
                            <td class="py-3.5 pl-4 text-right text-slate-400">12 Jul 2026</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 pr-4 font-semibold text-slate-800">Framework PHP Terbaik di Tahun 2026</td>
                            <td class="py-3.5 px-4"><span class="inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">Pemrograman</span></td>
                            <td class="py-3.5 px-4"><span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-xs font-medium text-amber-700">Draft</span></td>
                            <td class="py-3.5 pl-4 text-right text-slate-400">10 Jul 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- App Info / Tips Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-4 mb-4">Informasi Sistem</h3>
                <div class="space-y-4 text-sm text-slate-600">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Framework</span>
                        <span class="font-semibold text-slate-800">Laravel 11</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Engine Style</span>
                        <span class="font-semibold text-slate-800">Tailwind CSS v4</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Tipe Database</span>
                        <span class="font-semibold text-slate-800">MySQL</span>
                    </div>
                </div>
            </div>
            <div class="mt-6 rounded-2xl bg-slate-50 p-4 border border-slate-100">
                <h4 class="text-xs font-semibold text-slate-950 flex items-center gap-1.5"><i class="ri-lightbulb-line text-amber-500"></i> Tips Keamanan</h4>
                <p class="text-xs text-slate-500 mt-1">Selalu pastikan password Anda diperbarui secara berkala dan gunakan Autentikasi 2-Faktor untuk akun administratif Anda.</p>
            </div>
        </div>
    </div>

    <!-- NEW WIDGET SECTION: User Contributors & Activity Logs -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Top Authors Widget -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50">
            <div class="border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-bold text-slate-900">Penulis Paling Aktif</h3>
                <p class="text-xs text-slate-400">Kontributor artikel terbanyak bulan ini</p>
            </div>
            <div class="space-y-4">
                <!-- User 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 border border-slate-200">R</div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">Rizky Amelia</h4>
                            <p class="text-xs text-slate-400">Editor Senior</p>
                        </div>
                    </div>
                    <span class="rounded-xl bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-600">42 Post</span>
                </div>
                <!-- User 2 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 border border-slate-200">A</div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">Andi Wijaya</h4>
                            <p class="text-xs text-slate-400">Content Writer</p>
                        </div>
                    </div>
                    <span class="rounded-xl bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-600">28 Post</span>
                </div>
                <!-- User 3 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 border border-slate-200">B</div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">Budi Santoso</h4>
                            <p class="text-xs text-slate-400">Contributor</p>
                        </div>
                    </div>
                    <span class="rounded-xl bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-600">14 Post</span>
                </div>
            </div>
        </div>

        <!-- Latest System Logs Widget -->
        <div class="lg:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100/50">
            <div class="border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-bold text-slate-900">Log Aktivitas Sistem</h3>
                <p class="text-xs text-slate-400">Riwayat operasi krusial pada aplikasi</p>
            </div>
            <div class="space-y-4">
                <!-- Log 1 -->
                <div class="flex items-start gap-3 text-sm">
                    <div class="mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-100">
                        <i class="ri-check-line text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-slate-800">Backup otomatis database berhasil dijalankan.</p>
                        <span class="text-xs text-slate-400">Hari ini, 04:00 AM</span>
                    </div>
                </div>
                <!-- Log 2 -->
                <div class="flex items-start gap-3 text-sm">
                    <div class="mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600 border border-blue-100">
                        <i class="ri-user-add-line text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-slate-800">Pengguna baru <span class="font-bold">Siti Rahma</span> mendaftar ke sistem.</p>
                        <span class="text-xs text-slate-400">Kemarin, 08:14 PM</span>
                    </div>
                </div>
                <!-- Log 3 -->
                <div class="flex items-start gap-3 text-sm">
                    <div class="mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600 border border-amber-100">
                        <i class="ri-shield-flash-line text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-slate-800">Percobaan login gagal terdeteksi dari IP 192.168.1.105 (3 kali salah).</p>
                        <span class="text-xs text-slate-400">11 Jul 2026, 11:22 AM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection