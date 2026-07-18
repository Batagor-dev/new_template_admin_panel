@php
    // Mengambil seluruh jejak halaman (array of objects)
    $breadcrumbsData = Breadcrumbs::generate(); 
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
@endphp

@extends('layouts.backend.main')

@section('title', 'Dashboard')
@section('sub_title', $sub_title)

@section('breadcrumb')
    <x-layout.admin.breadcrumb :breadcrumbs="$breadcrumbsData" />
@endsection

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header Greeting -->
    <div>
        <h1 class="text-2xl font-satoshi-bold tracking-tight text-slate-900">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
        <p class="text-base text-slate-500 mt-1">Berikut ringkasan statistik, analitik, dan aktivitas terbaru pada sistem Anda hari ini.</p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-1">
        <!-- Recent Activities Card -->
        <x-ui.card class="lg:col-span-2 p-6 flex flex-col">
            <form action="" class="row g-1">
                <x-forms.horizontal.input name="name" label="Nama" placeholder="Nama" value="" />
                <x-forms.horizontal.input name="email" label="Email" placeholder="Email" value="" />
                <x-forms.horizontal.file name="attachment" label="Lampiran" placeholder="Pilih berkas..." />
                <x-forms.horizontal.textarea name="message" label="Pesan" placeholder="Tulis pesan Anda di sini..." value="" rows="4" />
                <x-forms.horizontal.switches name="is_active" label="Status Aktif" />
                <div class="mt-4 flex justify-end">
                    <x-ui.button type="submit">
                        Simpan
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>

    <!-- Quick Stats Grid (Mengikuti Gaya Visual Gambar 1) -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Stat Card 1 -->
        <x-ui.card class="p-6 flex flex-col justify-between min-h-[170px]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-black text-white border border-blue-100/30">
                        <i class="ri-article-line text-lg"></i>
                    </div>
                    <span class="text-sm font-satoshi-bold text-slate-900">Total Artikel</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-satoshi-bold tracking-tight text-slate-900">124</h3>
                    <span class="inline-flex items-center gap-0.5 text-xs font-satoshi-semibold text-emerald-600">
                        <i class="ri-arrow-up-line"></i> 12%
                    </span>
                </div>
                <p class="text-xs font-satoshi-medium text-slate-500 mt-1">Artikel aktif rilis minggu ini</p>
            </div>
        </x-ui.card>

        <!-- Stat Card 2 -->
        <x-ui.card class="p-6 flex flex-col justify-between min-h-[170px]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-black text-white border border-slate-100">
                        <i class="ri-folder-line text-lg"></i>
                    </div>
                    <span class="text-sm font-satoshi-bold text-slate-900">Kategori</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-satoshi-bold tracking-tight text-slate-900">18</h3>
                    <span class="inline-flex items-center gap-0.5 text-xs font-satoshi-semibold text-slate-500">
                        Stabil
                    </span>
                </div>
                <p class="text-xs font-satoshi-medium text-slate-500 mt-1">Kelompok kategori sistem</p>
            </div>
        </x-ui.card>

        <!-- Stat Card 3 -->
        <x-ui.card class="p-6 flex flex-col justify-between min-h-[170px]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-black text-white border border-blue-100/30">
                        <i class="ri-user-line text-lg"></i>
                    </div>
                    <span class="text-sm font-satoshi-bold text-slate-900">Total Pengguna</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-satoshi-bold tracking-tight text-slate-900">42</h3>
                    <span class="inline-flex items-center gap-0.5 text-xs font-satoshi-semibold text-emerald-600">
                        <i class="ri-arrow-up-line"></i> +4
                    </span>
                </div>
                <p class="text-xs font-satoshi-medium text-slate-500 mt-1">Akun terdaftar hari ini</p>
            </div>
        </x-ui.card>

        <!-- Stat Card 4 -->
        <x-ui.card class="p-6 flex flex-col justify-between min-h-[170px]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-black text-white border border-slate-100">
                        <i class="ri-eye-line text-lg"></i>
                    </div>
                    <span class="text-sm font-satoshi-bold text-slate-900">Kunjungan</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-satoshi-bold tracking-tight text-slate-900">3.8K</h3>
                    <span class="inline-flex items-center gap-0.5 text-xs font-satoshi-semibold text-rose-600">
                        <i class="ri-arrow-down-line"></i> -2%
                    </span>
                </div>
                <p class="text-xs font-satoshi-medium text-slate-500 mt-1">Pengunjung unik kemarin</p>
            </div>
        </x-ui.card>
    </div>

    <!-- Analytics & Performance Graphics -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Overview Chart Container -->
        <x-ui.card class="lg:col-span-2 p-6 flex flex-col justify-between">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <div>
                    <h3 class="font-satoshi-bold text-slate-900 text-base">Overview</h3>
                    <p class="text-xs text-slate-500">Statistik performa 12 bulan terakhir</p>
                </div>
                <div class="flex items-center gap-1.5 text-xs font-satoshi-semibold text-slate-500">
                    <span>Sort By:</span>
                    <button class="flex items-center gap-0.5 text-slate-900 font-satoshi-bold hover:underline">
                        Yearly <i class="ri-arrow-down-s-line"></i>
                    </button>
                </div>
            </div>

            <!-- Mockup Bar Chart Container -->
            <div class="relative w-full h-64 flex flex-col justify-between">
                <!-- Main Plot Area (Grid & Bars) -->
                <div class="relative flex-1 flex items-end">
                    <!-- Y-Axis Labels -->
                    <div class="absolute left-0 top-0 bottom-0 w-8 flex flex-col justify-between text-[10px] font-satoshi-semibold text-slate-400 z-10 bg-transparent">
                        <span>40</span>
                        <span>30</span>
                        <span>20</span>
                        <span>10</span>
                        <span>0</span>
                    </div>

                    <!-- Chart Grid Lines (Full-width spanning from left-8 to the right edge) -->
                    <div class="absolute left-8 right-0 top-1 bottom-0 flex flex-col justify-between pointer-events-none z-0">
                        <div class="w-full border-b border-slate-100"></div>
                        <div class="w-full border-b border-slate-100"></div>
                        <div class="w-full border-b border-slate-100"></div>
                        <div class="w-full border-b border-slate-100"></div>
                        <div class="w-full border-b border-slate-100"></div>
                    </div>

                    <!-- Bars Container (Placed on top of grid lines with z-10 and transparent background) -->
                    <div class="absolute left-8 right-0 top-0 bottom-0 flex items-end justify-between px-2 z-10 bg-transparent">
                        <!-- Jan -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 12%;"></div>
                        </div>
                        <!-- Feb -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 19%;"></div>
                        </div>
                        <!-- Mar -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 32%;"></div>
                        </div>
                        <!-- Apr -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 54%;"></div>
                        </div>
                        <!-- May -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 48%;"></div>
                        </div>
                        <!-- Jun -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 60%;"></div>
                        </div>
                        <!-- Jul -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 73%;"></div>
                        </div>
                        <!-- Aug -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 86%;"></div>
                        </div>
                        <!-- Sep -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-200 rounded-t-md transition-all duration-300 group-hover:bg-slate-100" style="height: 92%;"></div>
                        </div>
                        <!-- Oct (Highlighted dengan Slate-900 penuh) -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-900 rounded-t-md transition-all duration-300 group-hover:bg-slate-800" style="height: 80%;"></div>
                        </div>
                        <!-- Nov (Highlighted dengan Slate-900 penuh) -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-900 rounded-t-md transition-all duration-300 group-hover:bg-slate-800" style="height: 90%;"></div>
                        </div>
                        <!-- Dec (Highlighted dengan Slate-900 penuh) -->
                        <div class="flex flex-col justify-end h-full group cursor-pointer">
                            <div class="w-5 sm:w-7 bg-slate-900 rounded-t-md transition-all duration-300 group-hover:bg-slate-800" style="height: 96%;"></div>
                        </div>
                    </div>
                </div>

                <!-- X-Axis Labels (Aligned exactly with the bars) -->
                <div class="flex pl-8 mt-2.5">
                    <div class="flex-1 flex justify-between px-2 text-[10px] font-satoshi-medium text-slate-500">
                        <span class="w-5 sm:w-7 text-center">Jan</span>
                        <span class="w-5 sm:w-7 text-center">Feb</span>
                        <span class="w-5 sm:w-7 text-center">Mar</span>
                        <span class="w-5 sm:w-7 text-center">Apr</span>
                        <span class="w-5 sm:w-7 text-center">May</span>
                        <span class="w-5 sm:w-7 text-center">Jun</span>
                        <span class="w-5 sm:w-7 text-center">Jul</span>
                        <span class="w-5 sm:w-7 text-center">Aug</span>
                        <span class="w-5 sm:w-7 text-center">Sep</span>
                        <span class="w-5 sm:w-7 text-center">Oct</span>
                        <span class="w-5 sm:w-7 text-center">Nov</span>
                        <span class="w-5 sm:w-7 text-center">Dec</span>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Storage & System Status -->
        <x-ui.card class="p-6 flex flex-col justify-between">
            <div class="border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-satoshi-bold text-slate-900 text-base">Kapasitas Server</h3>
                <p class="text-xs text-slate-500">Penggunaan resource server hosting</p>
            </div>
            <div class="space-y-5">
                <!-- Disk Space -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-satoshi-medium text-slate-500">Penyimpanan SSD</span>
                        <span class="font-satoshi-bold text-slate-800">42.8 GB / 100 GB</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full w-[42%] bg-slate-900 rounded-full"></div>
                    </div>
                </div>
                <!-- Database Load -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-satoshi-medium text-slate-500">Beban Database</span>
                        <span class="font-satoshi-bold text-slate-800">18%</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full w-[18%] bg-slate-900/60 rounded-full"></div>
                    </div>
                </div>
                <!-- Memory Cache -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-satoshi-medium text-slate-500">Redis Cache RAM</span>
                        <span class="font-satoshi-bold text-slate-800">76%</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full w-[76%] bg-slate-900/80 rounded-full"></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 text-[11px] text-slate-500 border-t border-slate-50 flex items-center gap-1">
                <i class="ri-refresh-line animate-spin text-slate-300"></i> Disinkronkan otomatis 1 menit yang lalu.
            </div>
        </x-ui.card>
    </div>

    <!-- Quick Actions & Details Section -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-1">
        <!-- Recent Activities Card -->
        <x-ui.card class="lg:col-span-2 p-6 flex flex-col">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-satoshi-bold text-slate-900 text-base">Artikel Terbaru</h3>
                <a href="{{ route('article.index') }}" class="text-xs font-satoshi-semibold text-slate-500 hover:text-slate-900 hover:underline transition-all">Lihat Semua</a>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead>
                        <tr class="text-slate-900 font-satoshi-semibold border-b border-slate-100 text-xs uppercase">
                            <th class="py-3 pr-4">Judul Artikel</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 pl-4 text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 font-satoshi-medium text-slate-700">
                        <tr>
                            <td class="py-3.5 pr-4 text-slate-900">Tips Memulai Coding untuk Pemula</td>
                            <td class="py-3.5 px-4">
                                <x-ui.badge variant="neutral">
                                    Teknologi
                                </x-ui.badge>
                            </td>
                            <td class="py-3.5 px-4">
                                <x-ui.badge variant="success" icon="ri-checkbox-circle-line">
                                    Published
                                </x-ui.badge>
                            </td>
                            <td class="py-3.5 pl-4 text-right text-slate-500">13 Jul 2026</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 pr-4 text-slate-900">Membangun Web Impian dengan Tailwind v4</td>
                            <td class="py-3.5 px-4">
                                <x-ui.badge variant="neutral">
                                    Desain Web
                                </x-ui.badge>
                            </td>
                            <td class="py-3.5 px-4">
                                <x-ui.badge variant="success" icon="ri-checkbox-circle-line">
                                    Published
                                </x-ui.badge>
                            </td>
                            <td class="py-3.5 pl-4 text-right text-slate-500">12 Jul 2026</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 pr-4 text-slate-900">Framework PHP Terbaik di Tahun 2026</td>
                            <td class="py-3.5 px-4">
                                <x-ui.badge variant="neutral">
                                    Pemrograman
                                </x-ui.badge>
                            </td>
                            <td class="py-3.5 px-4">
                                <x-ui.badge variant="warning" icon="ri-error-warning-line">
                                    Draft
                                </x-ui.badge>
                            </td>
                            <td class="py-3.5 pl-4 text-right text-slate-500">10 Jul 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-ui.card>

    </div>

    <!-- User Contributors & Activity Logs -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Top Authors Widget (Mengikuti Gaya Visual Gambar 2) -->
        <x-ui.card class="p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                <div>
                    <h3 class="font-satoshi-bold text-slate-900 text-base">Penulis Teraktif</h3>
                    <p class="text-xs text-slate-500">Kontributor artikel bulan ini</p>
                </div>
                <button class="text-slate-300 hover:text-slate-500 transition-colors">
                    <i class="ri-more-fill text-lg"></i>
                </button>
            </div>
            
            <!-- List Author (Identik dengan format list di Gambar 2) -->
            <div class="divide-y divide-slate-100/60">
                <!-- User 1 -->
                <div class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0">
                    <div class="flex items-center gap-3">
                        <div class="relative p-0.5 rounded-full border border-slate-100">
                            <img src="{{ asset('assets/img/avatar/avatar-2.jpg') }}" alt="Putri" class="h-10 w-10 rounded-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-sm font-satoshi-bold text-slate-900 leading-tight">Putri Handayani</h4>
                            <p class="text-[11px] text-slate-500">putri@gmail.com</p>
                        </div>
                    </div>
                    <x-ui.badge variant="primary" icon="ri-bookmark-3-line">
                        42 Post
                    </x-ui.badge>
                </div>
                <!-- User 2 -->
                <div class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0">
                    <div class="flex items-center gap-3">
                        <div class="relative p-0.5 rounded-full border border-slate-100">
                            <img src="{{ asset('assets/img/avatar/avatar-1.jpg') }}" alt="Andi" class="h-10 w-10 rounded-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-sm font-satoshi-bold text-slate-900 leading-tight">Andi Wijaya</h4>
                            <p class="text-[11px] text-slate-500">andi@gmail.com</p>
                        </div>
                    </div>
                    <x-ui.badge variant="primary" icon="ri-bookmark-3-line">
                        28 Post
                    </x-ui.badge>
                </div>
                <!-- User 3 -->
                <div class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0">
                    <div class="flex items-center gap-3">
                        <div class="relative p-0.5 rounded-full border border-slate-100">
                            <img src="{{ asset('assets/img/avatar/avatar-3.jpg') }}" alt="Budi" class="h-10 w-10 rounded-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-sm font-satoshi-bold text-slate-900 leading-tight">Budi Santoso</h4>
                            <p class="text-[11px] text-slate-500">budi@gmail.com</p>
                        </div>
                    </div>
                    <x-ui.badge variant="primary" icon="ri-bookmark-3-line">
                        14 Post
                    </x-ui.badge>
                </div>
            </div>
        </x-ui.card>

        <!-- Latest System Logs Widget -->
        <x-ui.card class="lg:col-span-2 p-6">
            <div class="border-b border-slate-100 pb-4 mb-4">
                <h3 class="font-satoshi-bold text-slate-900 text-base">Log Aktivitas Sistem</h3>
                <p class="text-xs text-slate-500">Riwayat operasi krusial pada aplikasi</p>
            </div>
            <div class="space-y-4">
                <!-- Log 1 -->
                <div class="flex items-start gap-3 text-base">
                    <div class="mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-100/30">
                        <i class="ri-check-line text-base"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-satoshi-medium text-slate-900 text-sm">Backup otomatis database berhasil dijalankan.</p>
                        <span class="text-xs text-slate-500">Hari ini, 04:00 AM</span>
                    </div>
                </div>
                <!-- Log 2 -->
                <div class="flex items-start gap-3 text-base">
                    <div class="mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600 border border-blue-100/30">
                        <i class="ri-user-add-line text-base"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-satoshi-medium text-slate-900 text-sm">Pengguna baru <span class="font-satoshi-bold">Siti Rahma</span> mendaftar ke sistem.</p>
                        <span class="text-xs text-slate-500">Kemarin, 08:14 PM</span>
                    </div>
                </div>
                <!-- Log 3 -->
                <div class="flex items-start gap-3 text-base">
                    <div class="mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600 border border-amber-100/30">
                        <i class="ri-shield-flash-line text-base"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-satoshi-medium text-slate-900 text-sm">Percobaan login gagal terdeteksi dari IP 192.168.1.105 (3 kali salah).</p>
                        <span class="text-xs text-slate-500">11 Jul 2026, 11:22 AM</span>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection