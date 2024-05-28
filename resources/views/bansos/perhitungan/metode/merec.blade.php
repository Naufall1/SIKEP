<div class="md:tw-w-full">

    <div class="tw-flex tw-w-full tw-justify-between tw-items-center tw-pb-2">
        <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">MEREC - Pembobotan</h1>
    </div>

    <div class="tw-flex tw-flex-col tw-gap-7">

        <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

            <div class="tw-flex tw-flex-col tw-gap-2">
                <h2 class="">Tahap 1 - Matriks Keputusan</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-w-[768px] md:tw-w-full" id="dataBansos">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th class="tw-w-[58px]">No</th>
                                    <th class="tw-grow">Kepala Keluarga</th>
                                    <th class="tw-w-20 tw-justify-end">K1</th>
                                    <th class="tw-w-20 tw-justify-end">K2</th>
                                    <th class="tw-w-20 tw-justify-end">K3</th>
                                    <th class="tw-w-20 tw-justify-end">K4</th>
                                    <th class="tw-w-20 tw-justify-end">K5</th>
                                    <th class="tw-w-20 tw-justify-end">K6</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-y-2 tw-divide-n400">
                                
                                {{-- DATA HERE --}}
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-w-[58px]">1</td>
                                    <td class="tw-grow">Ahmad Budi Gunawan </td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-w-[58px]">2</td>
                                    <td class="tw-grow">Ahmad Budi Gunawan </td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>

                            </tbody>
                        </table>

                        <div>
                            {{-- pagination --}}
                            <div
                                class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                                        alt="<">
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                                    href="">
                                    1
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    2
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    ...
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                                        alt="<">
                                </a>
                            </div>
                        </div>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                <h2 class="">Tahap 2 - Normalisasi Matriks Keputusan</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-w-[768px] md:tw-w-full" id="dataBansos">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th class="tw-w-[58px]">No</th>
                                    <th class="tw-grow">Kepala Keluarga</th>
                                    <th class="tw-w-20 tw-justify-end">K1</th>
                                    <th class="tw-w-20 tw-justify-end">K2</th>
                                    <th class="tw-w-20 tw-justify-end">K3</th>
                                    <th class="tw-w-20 tw-justify-end">K4</th>
                                    <th class="tw-w-20 tw-justify-end">K5</th>
                                    <th class="tw-w-20 tw-justify-end">K6</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-y-2 tw-divide-n400">

                                {{-- DATA HERE --}}
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-w-[58px]">1</td>
                                    <td class="tw-grow">Ahmad Budi Gunawan </td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-w-[58px]">2</td>
                                    <td class="tw-grow">Ahmad Budi Gunawan </td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>

                            </tbody>
                        </table>

                        <div>
                            {{-- pagination --}}
                            <div
                                class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                                        alt="<">
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                                    href="">
                                    1
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    2
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    ...
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                                        alt="<">
                                </a>
                            </div>
                        </div>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                <h2 class="">Tahap 3 - Overall Performance by Removing Each Criterion</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-w-[768px] md:tw-w-full" id="dataBansos">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th class="tw-w-[58px]">No</th>
                                    <th class="tw-grow">Kepala Keluarga</th>
                                    <th class="tw-w-20 tw-justify-end">S</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-y-2 tw-divide-n400">

                                {{-- DATA HERE --}}
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-w-[58px]">1</td>
                                    <td class="tw-grow">Ahmad Budi Gunawan </td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-w-[58px]">2</td>
                                    <td class="tw-grow">Ahmad Budi Gunawan </td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>
                                

                            </tbody>
                        </table>

                        <div>
                            {{-- pagination --}}
                            <div
                                class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                                        alt="<">
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                                    href="">
                                    1
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    2
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    ...
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                                        alt="<">
                                </a>
                            </div>
                        </div>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                <h2 class="">Tahap 4 - Gatau namanya apa</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-w-[768px] md:tw-w-full" id="dataBansos">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th class="tw-grow">-</th>
                                    <th class="tw-w-20 tw-justify-end">K1</th>
                                    <th class="tw-w-20 tw-justify-end">K2</th>
                                    <th class="tw-w-20 tw-justify-end">K3</th>
                                    <th class="tw-w-20 tw-justify-end">K4</th>
                                    <th class="tw-w-20 tw-justify-end">K5</th>
                                    <th class="tw-w-20 tw-justify-end">K6</th>
                                    <th class="tw-w-20 tw-justify-end">Total</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-y-2 tw-divide-n400">

                                {{-- DATA HERE --}}
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-grow">Nilai E</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>

                            </tbody>
                        </table>

                        <div>
                            {{-- pagination --}}
                            <div
                                class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                                        alt="<">
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                                    href="">
                                    1
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    2
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    ...
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                                        alt="<">
                                </a>
                            </div>
                        </div>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                <h2 class="">Tahap 5 - Pembobotan</h2>
                <div class="tw-flex tw-flex-col tw-gap-3">
                    {{-- Start: Table HERE --}}
                    <div class="tw-w-vw tw-overflow-x-auto tw-flex tw-flex-col tw-gap-6">

                        <table class="tw-w-[768px] md:tw-w-full" id="dataBansos">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th class="tw-grow">-</th>
                                    <th class="tw-w-20 tw-justify-end">K1</th>
                                    <th class="tw-w-20 tw-justify-end">K2</th>
                                    <th class="tw-w-20 tw-justify-end">K3</th>
                                    <th class="tw-w-20 tw-justify-end">K4</th>
                                    <th class="tw-w-20 tw-justify-end">K5</th>
                                    <th class="tw-w-20 tw-justify-end">K6</th>
                                </tr>
                            </thead>
                            <tbody class="tw-divide-y-2 tw-divide-n400">

                                {{-- DATA HERE --}}
                                <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                    <td class="tw-grow">Bobot</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                    <td class="tw-w-20 tw-justify-end">0.231</td>
                                </tr>

                            </tbody>
                        </table>

                        <div>
                            {{-- pagination --}}
                            <div
                                class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                                        alt="<">
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                                    href="">
                                    1
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    2
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    ...
                                </a>
                                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300"
                                    href="">
                                    <img class="tw-h-5 tw-bg-cover"
                                        src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                                        alt="<">
                                </a>
                            </div>
                        </div>

                    </div>
                    {{-- End: Table HERE --}}
                </div>
            </div>

        </div>

    </div>

</div>