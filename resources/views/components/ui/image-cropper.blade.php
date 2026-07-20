@props([
    'name' => 'foto',
    'value' => '',
    'aspectRatio' => 1,
    'width' => 400,
    'height' => 400,
    'id' => 'image-cropper-' . uniqid()
])

<div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100" id="{{ $id }}-container">
    <!-- Image Preview -->
    <div class="relative group">
        <img src="{{ $value ?: asset('assets/img/avatar/avatar-1.jpg') }}"
             alt="avatar preview"
             class="w-24 h-24 rounded-2xl object-cover border border-slate-200 shadow-sm transition group-hover:opacity-90"
             id="{{ $id }}-preview" />
    </div>

    <!-- Buttons & Info -->
    <div class="flex flex-col items-center sm:items-start gap-2">
        <div class="flex items-center gap-3">
            <!-- Upload Button -->
            <label for="{{ $id }}-upload" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white hover:bg-slate-800 active:scale-[0.98] rounded-xl cursor-pointer transition text-sm font-satoshi-semibold shadow-sm">
                <i class="ri-upload-2-line text-base"></i>
                <span>Upload Photo</span>
                <input type="file" id="{{ $id }}-upload" class="hidden" accept="image/*" />
            </label>

            <!-- Reset Button -->
            <button type="button" 
                    id="{{ $id }}-reset-btn" 
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 active:scale-[0.98] rounded-xl cursor-pointer transition text-sm font-satoshi-semibold shadow-sm"
                    style="display: none;">
                <i class="ri-refresh-line text-base"></i>
                <span>Reset</span>
            </button>
        </div>
        <p class="text-xs text-slate-500 font-satoshi-medium">Allowed JPG, PNG. Max size 2 MB.</p>
    </div>

    <!-- Hidden Input for Form Submit -->
    <input type="file" name="{{ $name }}" id="{{ $id }}-cropped-input" class="hidden" />
</div>

<!-- Modal Cropper -->
<div id="{{ $id }}-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" onclick="window['closeModal_{{ str_replace('-', '_', $id) }}']()"></div>

    <!-- Modal Content -->
    <div class="relative w-full max-w-lg transform rounded-3xl bg-white p-6 shadow-2xl transition-all duration-300 translate-y-4">
        {{-- Close button --}}
        <button type="button" onclick="window['closeModal_{{ str_replace('-', '_', $id) }}']()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors">
            <i class="ri-close-line text-xl"></i>
        </button>

        {{-- Title --}}
        <h3 class="text-lg font-satoshi-bold text-slate-900 mb-4">Crop Photo (1:1)</h3>

        {{-- Cropper Body --}}
        <div class="flex items-center justify-center bg-slate-50 rounded-2xl overflow-hidden p-4 mb-6">
            <div class="max-h-[350px] w-full flex items-center justify-center">
                <img id="{{ $id }}-image-to-crop" src="" class="max-w-full max-h-[300px] object-contain" />
            </div>
        </div>

        {{-- Footer Buttons --}}
        <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
            <x-ui.button type="button" style="secondary" size="sm" onclick="window['closeModal_{{ str_replace('-', '_', $id) }}']()">
                Cancel
            </x-ui.button>
            <x-ui.button type="button" style="primary" size="sm" id="{{ $id }}-crop-save-btn">
                Crop & Save
            </x-ui.button>
        </div>
    </div>
</div>

@once
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"/>
    @endpush
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    @endpush
@endonce

@push('scripts')
<script>
(function() {
    let cropper = null;
    const initialImgSrc = "{{ $value ?: asset('assets/img/avatar/avatar-1.jpg') }}";
    
    const container = document.getElementById("{{ $id }}-container");
    const uploadInput = document.getElementById("{{ $id }}-upload");
    const previewImg = document.getElementById("{{ $id }}-preview");
    const resetBtn = document.getElementById("{{ $id }}-reset-btn");
    const croppedInput = document.getElementById("{{ $id }}-cropped-input");
    const modal = document.getElementById("{{ $id }}-modal");
    const modalBox = modal.querySelector(".relative");
    const imageToCrop = document.getElementById("{{ $id }}-image-to-crop");
    const cropSaveBtn = document.getElementById("{{ $id }}-crop-save-btn");

    function openModal() {
        modal.classList.remove("opacity-0", "pointer-events-none");
        modalBox.classList.remove("translate-y-4");
    }

    function closeModal() {
        modal.classList.add("opacity-0", "pointer-events-none");
        modalBox.classList.add("translate-y-4");
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    // Expose close modal function globally so click-away can trigger it
    window["closeModal_{{ str_replace('-', '_', $id) }}"] = closeModal;

    uploadInput.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = evt => {
            imageToCrop.src = evt.target.result;
            openModal();
            
            setTimeout(() => {
                if (cropper) cropper.destroy();
                cropper = new Cropper(imageToCrop, {
                    aspectRatio : {{ $aspectRatio }},
                    viewMode    : 1,
                    minContainerWidth : 300,
                    minContainerHeight: 300
                });
            }, 100);
        };
        reader.readAsDataURL(file);
    });

    cropSaveBtn.addEventListener('click', () => {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({ width: {{ $width }}, height: {{ $height }} });
        canvas.toBlob(blob => {
            // Update preview image
            previewImg.src = URL.createObjectURL(blob);

            // Assign cropped file to file input
            const file = new File([blob], 'cropped_avatar.jpg', { type: 'image/jpeg' });
            const dt = new DataTransfer();
            dt.items.add(file);
            croppedInput.files = dt.files;

            // Show reset button
            resetBtn.style.display = 'inline-flex';

            closeModal();
        }, 'image/jpeg', 0.9);
    });

    // Reset button clicked
    resetBtn.addEventListener('click', () => {
        // Revert image preview to the initial source
        previewImg.src = initialImgSrc;
        // Clear file inputs
        croppedInput.value = "";
        uploadInput.value = "";
        // Hide reset button
        resetBtn.style.display = 'none';
    });
})();
</script>
@endpush
