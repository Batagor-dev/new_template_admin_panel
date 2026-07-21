<!doctype html>
<html lang="en" class="h-full bg-[#f7f7f7]">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('code', 'Error') - @yield('title', 'An Error Occurred')</title>
    
    {{-- Remix Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" />

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="min-h-screen bg-[#f7f7f7] text-slate-900 font-satoshi antialiased selection:bg-slate-900 selection:text-white flex items-center justify-center relative overflow-hidden p-6">
    
    {{-- Background Giant Status Code Watermark --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none overflow-hidden z-0">
      <span class="text-[30vw] sm:text-[22rem] md:text-[26rem] lg:text-[30rem] font-satoshi-black text-slate-200/70 tracking-tighter leading-none opacity-80">
        @yield('code', '404')
      </span>
    </div>

    {{-- Foreground Content Container --}}
    <div class="relative z-10 w-full max-w-xl text-center flex flex-col items-center justify-center">
      
      {{-- Optional Icon (If specified) --}}
      @hasSection('icon')
        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/80 backdrop-blur-sm shadow-sm border border-slate-200/80 text-slate-700">
          <i class="@yield('icon') text-2xl"></i>
        </div>
      @endif

      {{-- Title --}}
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-satoshi-bold text-slate-900 tracking-tight leading-tight">
        @yield('title', 'An Error Occurred')
      </h1>

      {{-- Subtitle / Message --}}
      <p class="mt-3 sm:mt-4 text-base sm:text-lg text-slate-500 font-satoshi-regular leading-relaxed max-w-md">
        @yield('message', 'Sorry, an error occurred while processing your request.')
      </p>

      {{-- Action Buttons --}}
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <x-ui.button :href="url('/')" color="primary" size="md">
          <span>@yield('button_text', 'Back to Home')</span>
          <i class="ri-arrow-right-line text-lg m-1"></i>
        </x-ui.button>

        @hasSection('show_back_button')
          <x-ui.button type="button" onclick="window.history.back()" color="primary" size="md">
            <i class="ri-arrow-left-line text-lg"></i>
            <span>Go Back</span>
          </x-ui.button>
        @endif
      </div>

    </div>

  </body>
</html>
