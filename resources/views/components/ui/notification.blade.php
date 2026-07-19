@php
    $type = null;
    $message = null;

    if (session()->has('success')) {
        $type = 'success';
        $message = session('success');
    } elseif (session()->has('error')) {
        $type = 'danger';
        $message = session('error');
    } elseif (session()->has('info')) {
        $type = 'info';
        $message = session('info');
    } elseif (session()->has('warning')) {
        $type = 'warning';
        $message = session('warning');
    }
@endphp

@if ($type && $message)
    <div 
        id="toast-notification"
        data-toast-duration="4000"
        class="fixed top-5 right-5 z-100 flex w-full max-w-md transform items-start gap-4 rounded-2xl border border-slate-100 bg-white p-4 shadow-xl shadow-slate-200/50 transition-all duration-300 translate-y-[-20px] opacity-0"
    >
        {{-- Icon --}}
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $type === 'success' ? 'bg-emerald-50 text-emerald-500 border border-emerald-100' : ($type === 'danger' ? 'bg-rose-50 text-rose-500 border border-rose-100' : ($type === 'warning' ? 'bg-amber-50 text-amber-500 border border-amber-100' : 'bg-blue-50 text-blue-500 border border-blue-100')) }}">
            @if ($type === 'success')
                <i class="ri-checkbox-circle-line text-xl"></i>
            @elseif ($type === 'danger')
                <i class="ri-error-warning-line text-xl"></i>
            @elseif ($type === 'warning')
                <i class="ri-alert-line text-xl"></i>
            @else
                <i class="ri-information-line text-xl"></i>
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-satoshi-bold text-slate-800 capitalize">
                {{ $type === 'danger' ? 'error' : $type }}
            </h4>
            <p class="text-sm font-satoshi-medium text-slate-500 leading-relaxed">
                {{ $message }}
            </p>
        </div>

        {{-- Close --}}
        <button 
            type="button" 
            onclick="closeToast()" 
            class="text-slate-400 hover:text-slate-600 transition-colors"
        >
            <i class="ri-close-line text-lg"></i>
        </button>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const toast = document.getElementById("toast-notification");
            if (toast) {
                // Animate entry
                setTimeout(() => {
                    toast.classList.remove("translate-y-[-20px]", "opacity-0");
                }, 100);

                // Auto dismiss
                const duration = parseInt(toast.getAttribute("data-toast-duration")) || 4000;
                setTimeout(() => {
                    closeToast();
                }, duration);
            }
        });

        function closeToast() {
            const toast = document.getElementById("toast-notification");
            if (toast) {
                toast.classList.add("translate-y-[-20px]", "opacity-0");
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }
    </script>
    @endpush
@endif
