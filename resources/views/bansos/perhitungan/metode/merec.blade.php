<div class="md:tw-w-full tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">

    <div class="tw-flex tw-w-full tw-justify-between tw-items-center tw-pb-2">
        <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">MEREC - Pembobotan</h1>
    </div>

    <div class="tw-flex tw-flex-col tw-gap-7">

        <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

            <div class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
                <h2 class="">Tahap 1 - Matriks Keputusan (X)</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-full tw-overflow-x-auto tw-pb-3 md:tw-pb-0 tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-table-fixed tw-w-[767px]" id="MEREC-MatriksKeputusan">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th>No</th>
                                    <th>Kepala Keluarga</th>
                                    <th>K1</th>
                                    <th>K2</th>
                                    <th>K3</th>
                                    <th>K4</th>
                                    <th>K5</th>
                                    <th>K6</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-n400">

                                {{-- DATA HERE --}}

                            </tbody>
                        </table>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                <h2 class="">Tahap 2 - Normalisasi Matriks Keputusan (N)</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-pb-3 md:tw-pb-0 tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-table-fixed tw-w-[767px]" id="MEREC-MatriksTernormalisasi">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th>No</th>
                                    <th>Kepala Keluarga</th>
                                    <th>K1</th>
                                    <th>K2</th> 
                                    <th>K3</th>
                                    <th>K4</th>
                                    <th>K5</th>
                                    <th>K6</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-n400">

                                {{-- DATA HERE --}}

                            </tbody>
                        </table>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">
                <h2 class="">Tahap 3 - Kinerja Keseluruhan dari Alternatif (S)</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-pb-3 md:tw-pb-0 tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-table-fixed tw-w-[767px]" id="MEREC-Nilai-Si">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th>No</th>
                                    <th>Kepala Keluarga</th>
                                    <th>S</th>
                                </tr> 
                            </thead>
                            <tbody class="tw-divide-n400">

                                {{-- DATA HERE --}}

                            </tbody>
                        </table>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[800ms]">
                <h2 class="">Tahap 4 - Kinerja Keseluruhan dari Alternatif dengan Penghapusan Kriteria (Sij)</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-pb-3 md:tw-pb-0 tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-table-fixed tw-w-[767px]" id="MEREC-MatriksSij">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th>No</th>
                                    <th>Kepala Keluarga</th>
                                    <th>K1</th>
                                    <th>K2</th>
                                    <th>K3</th>
                                    <th>K4</th>
                                    <th>K5</th>
                                    <th>K6</th>
                                </tr> 
                            </thead>
                            <tbody class="tw-divide-n400">

                                {{-- DATA HERE --}}

                            </tbody>
                        </table>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[1000ms]">
                <h2 class="">Tahap 5 - Penentuan Deviasi Absolut (Ej)</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-pb-3 md:tw-pb-0 tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-table-fixed tw-w-[767px]" id="MEREC-Nilai-Ei">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th>-</th>
                                    <th>K1</th>
                                    <th>K2</th>
                                    <th>K3</th> 
                                    <th>K4</th>
                                    <th>K5</th>
                                    <th>K6</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-n400">

                                {{-- DATA HERE --}}

                            </tbody>
                        </table>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[1200ms]">
                <h2 class="">Tahap 6 - Pembobotan Akhir Kriteria (Wj)</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-pb-3 md:tw-pb-0 tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-table-fixed tw-w-[767px]" id="MEREC-Bobot">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th>-</th>
                                    <th>K1</th>
                                    <th>K2</th>
                                    <th>K3</th> 
                                    <th>K4</th>
                                    <th>K5</th>
                                    <th>K6</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-n400">

                                {{-- DATA HERE --}}

                            </tbody>
                        </table>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

        </div>

    </div>

</div>
@push('js')
    <script>
        $(document).ready(function() {
            MERECMatriksKeputusan = $('#MEREC-MatriksKeputusan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('spk.merec.keputusan') }}",
                    "dataType": "json",
                    "type": "POST", 
                },
                dom: 'tp',
                lengthMenu: [10],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 tw-w-full hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                        <g clip-path="url(#a)">
                            <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                            <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                            <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                            <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                            <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                        </g>
                        <defs>
                            <clipPath id="a">
                            <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                            </clipPath>
                        </defs>
                        </svg>
                        <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                    `);
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                }, {
                    data: "kepala_keluarga",
                    className: "tw-grow tw-shrink",
                    orderable: false,
                }, {
                    data: "0",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "1",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "2",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "3",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "4",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "5",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }],
                columnDefs: [{
                    targets: [1],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });

            MERECMatriksTernormalisasi = $('#MEREC-MatriksTernormalisasi').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('spk.merec.normalisasi') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                dom: 'tp',
                lengthMenu: [10],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 tw-w-full hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                    <g clip-path="url(#a)">
                        <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                        <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                        <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                        <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                        <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                    </g>
                    <defs>
                        <clipPath id="a">
                        <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                        </clipPath>
                    </defs>
                    </svg>
                    <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                `);
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                }, {
                    data: "kepala_keluarga",
                    className: "tw-grow tw-shrink",
                    orderable: false,
                }, {
                    data: "0",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "1",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "2",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "3",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "4",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "5",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }],
                columnDefs: [{
                    targets: [1],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });

            MERECNilaiSi = $('#MEREC-Nilai-Si').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('spk.merec.nilaiSi') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                dom: 'tp',
                lengthMenu: [10],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                    <g clip-path="url(#a)">
                        <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                        <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                        <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                        <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                        <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                    </g>
                    <defs>
                        <clipPath id="a">
                        <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                        </clipPath>
                    </defs>
                    </svg>
                    <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                `);
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                }, {
                    data: "kepala_keluarga",
                    className: "tw-grow tw-shrink",
                    orderable: false,
                }, {
                    data: "0",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, ],
                columnDefs: [{
                    targets: [1],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });
            MERECNilaiSij = $('#MEREC-MatriksSij').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('spk.merec.nilaiSij') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                dom: 'tp',
                lengthMenu: [10],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                    <g clip-path="url(#a)">
                        <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                        <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                        <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                        <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                        <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                    </g>
                    <defs>
                        <clipPath id="a">
                        <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                        </clipPath>
                    </defs>
                    </svg>
                    <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                `);
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "tw-min-w-7 tw-max-w-7",
                    orderable: false,
                }, {
                    data: "kepala_keluarga",
                    className: "tw-grow tw-shrink",
                    orderable: false,
                }, {
                    data: "0",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "1",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "2",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "3",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "4",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }, {
                    data: "5",
                    className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                    orderable: false,
                    render: function(data, type, row) {
                        return data.toFixed(3);
                    }
                }],
                columnDefs: [{
                    targets: [1],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });

            MERECNilaiEi = $('#MEREC-Nilai-Ei').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('spk.merec.nilaiEi') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                dom: 't',
                lengthMenu: [10],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                        <g clip-path="url(#a)">
                            <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                            <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                            <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                            <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                            <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                        </g>
                        <defs>
                            <clipPath id="a">
                            <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                            </clipPath>
                        </defs>
                        </svg>
                        <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                    `);
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: "title",
                        className: "tw-grow tw-shrink",
                        orderable: false,
                    }, {
                        data: "0",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "1",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "2",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "3",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "4",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    },
                    {
                        data: "5",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    },
                    {
                        data: "total",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }
                ],
                columnDefs: [{
                    targets: [1],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });

            MERECBobot = $('#MEREC-Bobot').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ route('spk.merec.bobot') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                dom: 't',
                lengthMenu: [10],
                paging: true,
                language: {
                    paginate: {
                        previous: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.654 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72"/></svg></span>`,
                        next: `<span class='tw-stroke-n1000'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16"><path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72"/></svg></span>`,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("tw-h-16 hover:tw-bg-n300 tw-flex");
                },
                drawCallback: function() {
                    $('.pagination').addClass(
                        'tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg'
                    );
                    $('.paginate_button').addClass(
                        'tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300');
                    $('.paginate_button.active').addClass(
                        'tw-bg-n400');
                    $('.dataTables_filter').css('display', 'none');
                    $('.table.dataTable').css('border-collapse', 'collapse');
                    $('.dataTables_empty').html(`<svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none" viewBox="0 0 150 151">
                            <g clip-path="url(#a)">
                                <path fill="#E3E3E3" d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z"/>
                                <path fill="#fff" d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z"/>
                                <path fill="#0284FF" d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z"/>
                                <path fill="#fff" d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z"/>
                                <path fill="#CCE4FF" d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z"/>
                            </g>
                            <defs>
                                <clipPath id="a">
                                <rect width="150" height="150" y=".5" fill="#fff" rx="75"/>
                                </clipPath>
                            </defs>
                            </svg>
                            <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                        `);
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: "title",
                        className: "tw-grow tw-shrink",
                        orderable: false,
                    }, {
                        data: "0",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "1",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "2",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "3",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    }, {
                        data: "4",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    },
                    {
                        data: "5",
                        className: "tw-min-w-[50px] tw-max-w-[50px] tw-justify-end",
                        orderable: false,
                        render: function(data, type, row) {
                            return data.toFixed(3);
                        }
                    },
                ],
                columnDefs: [{
                    targets: [1],
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="tw-text-ellipsis tw-overflow-hidden tw-w-full">' +
                                data + '</div>';
                        }
                        return data;
                    }
                }]
            });
        });
    </script>
@endpush
