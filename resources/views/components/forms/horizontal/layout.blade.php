<div class="grid grid-cols-1 gap-6 lg:grid-cols-1">
        <!-- Recent Activities Card -->
        <x-ui.card class="lg:col-span-2 p-6 flex flex-col">
            <form action="" class="row g-1">
                <x-forms.horizontal.input name="name" label="Nama" placeholder="Nama" value="" />
                <x-forms.horizontal.input name="email" label="Email" placeholder="Email" value="" />
                <x-forms.horizontal.file name="attachment" label="Lampiran" placeholder="Pilih berkas..." />
                <x-forms.horizontal.textarea name="message" label="Pesan" placeholder="Tulis pesan Anda di sini..." value="" rows="4" />
                <div class="mt-4 flex justify-end">
                    <x-ui.button type="submit">
                        Simpan
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>