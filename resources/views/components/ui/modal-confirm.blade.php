<div 
    id="confirm-modal" 
    class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300"
>
    <!-- Backdrop -->
    <div 
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity"
        onclick="closeConfirmModal()"
    ></div>

    <!-- Modal Content -->
    <div 
        class="relative w-full max-w-md transform rounded-3xl bg-white p-6 shadow-2xl transition-all duration-300 translate-y-4"
    >
        {{-- Close button --}}
        <button 
            type="button"
            onclick="closeConfirmModal()"
            class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors"
        >
            <i class="ri-close-line text-xl"></i>
        </button>

        {{-- Icon & Header --}}
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-500 border border-red-100">
                <i class="ri-alert-line text-2xl"></i>
            </div>
            <div class="space-y-1">
                <h3 class="text-lg font-satoshi-bold text-slate-900" id="confirm-modal-title">
                    Are you sure?
                </h3>
                <p class="text-sm font-satoshi-medium text-slate-500 leading-relaxed" id="confirm-modal-message">
                    This action cannot be undone. Deleted or banned data will be disabled from the system.
                </p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
            <x-ui.button 
                type="button" 
                style="secondary" 
                size="sm" 
                onclick="closeConfirmModal()"
            >
                Cancel
            </x-ui.button>
            <x-ui.button 
                type="button" 
                style="danger" 
                size="sm" 
                id="confirm-modal-btn"
            >
                Yes, Confirm
            </x-ui.button>
        </div>
    </div>
</div>

@once
    @push('scripts')
    <script>
        let formToSubmit = null;

        document.addEventListener("DOMContentLoaded", () => {
            // Gunakan event delegation agar tombol delete di dalam Yajra DataTable tetap berfungsi
            document.addEventListener("click", (event) => {
                const btn = event.target.closest(".delete-btn");
                if (btn) {
                    event.preventDefault();
                    formToSubmit = btn.closest("form");
                    openConfirmModal();
                }
            });

            // Bind click event untuk konfirmasi
            const confirmBtn = document.getElementById("confirm-modal-btn");
            if (confirmBtn) {
                confirmBtn.addEventListener("click", () => {
                    if (formToSubmit) {
                        formToSubmit.submit();
                    }
                    closeConfirmModal();
                });
            }
        });

        function openConfirmModal() {
            const modal = document.getElementById("confirm-modal");
            const modalBox = modal.querySelector(".relative");
            
            modal.classList.remove("opacity-0", "pointer-events-none");
            modalBox.classList.remove("translate-y-4");
        }

        function closeConfirmModal() {
            const modal = document.getElementById("confirm-modal");
            const modalBox = modal.querySelector(".relative");
            
            modal.classList.add("opacity-0", "pointer-events-none");
            modalBox.classList.add("translate-y-4");
            formToSubmit = null;
        }
    </script>
    @endpush
@endonce
