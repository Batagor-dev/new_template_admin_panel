$(function () {
    $(".table-responsive").each(function () {
        const $t = $(this);
        const ajax = $t.data("link");

        if (!ajax) {
            console.warn("Skip table karena ajax kosong");
            return;
        }

        // --- TAMBAHAN TAILWIND CSS: Spinner Element ---
        const $loadingBtn = $(`
            <div class="flex justify-center my-4">
                <button class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-600 hover:bg-indigo-500 transition ease-in-out duration-150 cursor-not-allowed" type="button" disabled>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Loading...</span>
                </button>
            </div>
        `).hide();

        $t.before($loadingBtn);
        $loadingBtn.show();

        // Ambil metadata kolom dulu
        $.ajax({
            url: ajax,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { draw: 1, start: 0, length: 1 },
            success: function (json) {
                console.log(json);

                $loadingBtn.remove();
                json.columns.push({
                    data: null,
                    defaultContent:
                        '<i data-feather="eye" class="cursor-pointer text-gray-600 hover:text-indigo-600"></i>',
                    title: "Detail",
                });

                if (!$.fn.DataTable.isDataTable($t)) {
                    let table = $t.DataTable({
                        autoWidth: false,
                        processing: true,
                        serverSide: true,
                        responsive: {
                            details: {
                                target: -1,
                                type: "column",
                                display: DataTable.Responsive.display.modal({
                                    header: function (row) {
                                        var data = row.data();
                                        return "Details";
                                    },
                                }),
                                renderer:
                                    DataTable.Responsive.renderer.tableAll(),
                            },
                        },
                        // --- TAMBAHAN TAILWIND CSS: Processing Overlay ---
                        language: {
                            processing: `
                                <div class="absolute inset-0 bg-white/50 backdrop-blur-sm flex items-center justify-center z-50">
                                    <button class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-600" type="button" disabled>
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Loading...</span>
                                    </button>
                                </div>
                            `,
                        },
                        ajax: {
                            url: ajax,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]',
                                ).attr("content"),
                            },
                        },
                        columnDefs: [
                            {
                                className:
                                    "dtr-control text-center align-middle",
                                orderable: false,
                                searchable: false,
                                targets: -1,
                            },
                        ],
                        columns: json.columns,
                        order: [[1, "asc"]],
                        fnDrawCallback: function (settings) {
                            feather.replace();
                            // Jika Anda menggunakan library tooltip vanilla/Flowbite, sesuaikan inisialisasinya di sini
                        },
                    });

                    // Event listener modal responsive (Menyesuaikan class modal responsive bawaan DataTables)
                    $(document).on(
                        "shown.bs.modal",
                        ".dtr-bs-modal",
                        function () {
                            feather.replace();
                        },
                    );
                }
            },
            error: function (xhr, error, thrown) {
                $loadingBtn.remove();
                let msg = "Gagal memuat data";
                console.error(xhr);
            },
        });
    });
});
