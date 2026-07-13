@props(['sub_title' => ''])

<header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200/80 bg-white/95 px-10 lg:px-16 xl:px-20 py-10 backdrop-blur-sm shadow-xs">
  <div class="flex items-center gap-4">
    <!-- Mobile Sidebar Toggle -->
    <button type="button" class="lg:hidden text-slate-500 hover:text-slate-900 transition-colors cursor-pointer" onclick="toggleSidebar()">
      <i class="ri-menu-2-line text-2xl"></i>
    </button>
    
    @if($sub_title)
      <h2 class="text-3xl font-satoshi-bold text-slate-900 truncate max-w-[200px] sm:max-w-md">{{ $sub_title }}</h2>
    @endif
  </div>

  <div class="flex items-center gap-4">
    <!-- Fullscreen Button -->
    <button type="button" id="btn-fullscreen" class="hidden sm:flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all cursor-pointer">
      <i class="ri-fullscreen-line text-xl"></i>
    </button>

    <!-- User Profile Dropdown -->
    <div class="relative" id="profile-dropdown-wrapper">
      <button type="button" id="btn-profile-dropdown" class="flex items-center gap-2.5 p-1 rounded-xl hover:bg-slate-50 transition-all cursor-pointer" onclick="toggleProfileDropdown()">
        @php
            $avatar = 'assets/img/avatar/avatar-1.jpg';

            if (
                Auth::user()->foto &&
                file_exists(public_path('assets/img/avatars/' . Auth::user()->foto))
            ) {
                $avatar = 'assets/img/avatars/' . Auth::user()->foto;
            }
        @endphp
        
        <div class="relative">
          <img
              src="{{ asset($avatar) }}"
              alt="{{ Auth::user()->name }}"
              class="h-12 w-12 rounded-full object-cover border border-slate-100 shadow-xs"
          >

          <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full bg-emerald-500 border-2 border-white"></span>
      </div>
      </button>

      <!-- Dropdown Card -->
      <div id="profile-dropdown" class="absolute right-0 mt-2 w-56 origin-top-right rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-200/50 transition-all scale-95 opacity-0 pointer-events-none z-50">
        <!-- User Info Header -->
        <div class="flex items-center gap-3 px-4 py-3 border-b border-slate-100">
            <img
                src="{{ asset($avatar) }}"
                alt="{{ Auth::user()->name }}"
                class="h-12 w-12 rounded-full object-cover border border-slate-200 shadow-sm flex-shrink-0"
            >

            <div class="min-w-0 flex-1">
                <h3 class="text-sm font-satoshi-bold text-slate-900 truncate">
                    {{ Auth::user()->name }}
                </h3>

                <p class="mt-0.5 text-xs font-satoshi-medium text-slate-500 truncate">
                    {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                </p>
            </div>
        </div>

        <!-- Links -->
        <a href="{{ route('acount.index') }}" class="flex items-center font-satoshi-medium gap-2.5 px-3 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
          <i class="ri-user-3-line text-lg text-slate-400"></i>
          <span>My Profile</span>
        </a>

        <div class="border-t border-slate-100 my-1"></div>

        <!-- Logout Button -->
        <button 
          type="button" 
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="w-full flex items-center font-satoshi-bold gap-2.5 px-3 py-2 rounded-xl text-sm bg-rose-600 text-white hover:bg-rose-700 transition-colors cursor-pointer text-left"
        >
          <i class="ri-logout-box-r-line text-lg text-white"></i>
          <span>Logout</span>
        </button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>
      </div>
    </div>
  </div>
</header>

@push('scripts')
<script>
  function toggleProfileDropdown() {
    const dropdown = document.getElementById('profile-dropdown');
    const isClosed = dropdown.classList.contains('pointer-events-none');
    
    if (isClosed) {
      dropdown.classList.remove('pointer-events-none', 'scale-95', 'opacity-0');
      dropdown.classList.add('scale-100', 'opacity-100');
    } else {
      dropdown.classList.add('pointer-events-none', 'scale-95', 'opacity-0');
      dropdown.classList.remove('scale-100', 'opacity-100');
    }
  }

  // Close dropdown on click outside
  window.addEventListener('click', function(e) {
    const wrapper = document.getElementById('profile-dropdown-wrapper');
    const dropdown = document.getElementById('profile-dropdown');
    if (wrapper && !wrapper.contains(e.target)) {
      dropdown.classList.add('pointer-events-none', 'scale-95', 'opacity-0');
      dropdown.classList.remove('scale-100', 'opacity-100');
    }
  });

  // Fullscreen support
  document.addEventListener("DOMContentLoaded", function () {
      const btnFullscreen = document.getElementById("btn-fullscreen");
      if (btnFullscreen) {
          btnFullscreen.addEventListener("click", function () {
              if (!document.fullscreenElement) {
                  document.documentElement.requestFullscreen().catch(err => {
                      console.error(`Error attempting to enable full-screen mode: ${err.message}`);
                  });
                  this.querySelector("i").classList.replace("ri-fullscreen-line", "ri-fullscreen-exit-line");
              } else {
                  document.exitFullscreen();
                  this.querySelector("i").classList.replace("ri-fullscreen-exit-line", "ri-fullscreen-line");
              }
          });
      }
  });
</script>
@endpush