@php
    use App\Helpers\MenuHelper;
@endphp

<!-- Tambahkan class 'group transition-all duration-300' di tag aside -->
<aside id="admin-sidebar" class="group fixed inset-y-0 left-0 z-40 flex w-72 flex-col border-r border-slate-200 bg-white/95 backdrop-blur-sm shadow-sm transition-all duration-300 ease-in-out lg:translate-x-0 -translate-x-full">
  
  <!-- Brand Header -->
  <div class="flex h-20 items-center justify-between px-5 border-b border-slate-100 group-[.sidebar-collapsed]:justify-center group-[.sidebar-collapsed]:px-0 transition-all duration-300">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden">
      <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain flex-shrink-0" onerror="this.style.display='none'">
      <!-- Span text otomatis sembunyi saat group memiliki class sidebar-collapsed -->
      <span class="text-2xl font-satoshi-bold tracking-tight text-slate-900 transition-all duration-300 group-[.sidebar-collapsed]:w-0 group-[.sidebar-collapsed]:opacity-0 truncate">Techarea</span>
    </a>
    
    <!-- BUTTON TOGGLE DESKTOP (Icon panah dinamis ganti-ganti) -->
    <button type="button" class="hidden lg:flex h-8 w-8 items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition-colors cursor-pointer group-[.sidebar-collapsed]:hidden" onclick="toggleSidebarMode()">
      <i class="ri-arrow-left-double-line text-xl"></i>
    </button>
  </div>

  <!-- Navigation Menu List -->
  <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6 overflow-x-hidden group-[.sidebar-collapsed]:px-2 transition-all duration-300">
    
    <!-- BUTTON TOGGLE SAAT COLLAPSED (Muncul di bawah logo ketika sidebar mengecil) -->
    <div class="hidden group-[.sidebar-collapsed]:flex justify-center mb-4">
      <button type="button" class="h-8 w-8 flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition-colors cursor-pointer" onclick="toggleSidebarMode()">
        <i class="ri-arrow-right-double-line text-xl"></i>
      </button>
    </div>

    <div>
      <ul class="mt-2 space-y-1">
        <li>
          <a href="{{ route('dashboard') }}" class="group/item flex items-center gap-3 px-3 py-2.5 rounded-xl text-base font-satoshi-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-slate-900 text-white shadow-md shadow-slate-900/15' : 'text-slate-600 hover:bg-slate-50/70 hover:text-slate-900' }} group-[.sidebar-collapsed]:justify-center group-[.sidebar-collapsed]:px-0">
            <i class="ri-dashboard-line text-xl w-5 text-center flex-shrink-0 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover/item:text-slate-600' }}"></i>
            <!-- Span teks menu otomatis hilang saat sidebar mengecil -->
            <span class="transition-all duration-300 group-[.sidebar-collapsed]:w-0 group-[.sidebar-collapsed]:opacity-0 overflow-hidden whitespace-nowrap">Dashboard</span>
          </a>
        </li>
        @foreach($menus as $menu)
          @php
              $permissionName = optional($menu->permissionGroup)->name . ' Access';
          @endphp

          @can($permissionName)
              @include('components.layout.admin.children', ['menu' => $menu])
          @endcan
        @endforeach
      </ul>
    </div>
  </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-xs transition-opacity duration-300 lg:hidden hidden" onclick="toggleSidebar()"></div>

@push('scripts')
<script>
  // Fungsi untuk mobile drawer (buka/tutup di layar hp)
  function toggleSidebar() {
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    if (sidebar && overlay) {
      const isHidden = sidebar.classList.contains('-translate-x-full');
      if (isHidden) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      } else {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      }
    }
  }

  // FUNGSI BARU: Untuk mengecilkan sidebar (Desktop)
  function toggleSidebarMode() {
    const sidebar = document.getElementById('admin-sidebar');
    const mainContainer = document.querySelector('.flex-1.flex.flex-col');
    
    if (sidebar) {
      // Toggle class 'w-72' (lebar penuh) dan 'w-20' (hanya icon)
      sidebar.classList.toggle('w-72');
      sidebar.classList.toggle('w-20');
      
      // Sembunyikan atau munculkan teks di dalam sidebar
      sidebar.classList.toggle('sidebar-collapsed');

      // Sesuaikan padding kiri pada container konten utama (Desktop)
      if (mainContainer) {
        mainContainer.classList.toggle('lg:pl-[280px]');
        mainContainer.classList.toggle('lg:pl-24');
      }
    }
  }
</script>
@endpush