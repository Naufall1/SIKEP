<div class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '' }}">
    <div class="tw-w-56">
        <x-input.select id="lineChart" onchange="dropdownChartLine()">
            <option value="pekerjaan" selected>Pekerjaan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
            <option value="tingkat_pendidikan">Tingkat Pendidikan</option>
            <option value="agama">Agama</option>
            <option value="bansos">Bansos</option>
            <option value="usia">Usia</option>
        </x-input.select>
    </div>
    @if (Auth::user()->hasLevel['level_kode'] == 'RW')
        <div class="tw-w-28">
            <x-input.select class="tw-w-28" id="rt" onchange="dropdownChartLine()">
                <option value="all">Semua</option>
                @foreach ($semuaRT as $rt)
                    <option value="{{ $rt->rt }}">RT. {{ $rt->keterangan }}</option>
                @endforeach
            </x-input.select>
        </div>
    @endif
</div>

<div id="chartLinePekerjaanContainer" class="tw-flex tw-w-full">
    <canvas height="242" id="linePekerjaanLine" style="width: 100%;" class="tw-flex"></canvas>
</div>

<div id="chartLineJenisKelaminContainer" class="tw-flex tw-w-full" style="display: none">
    <canvas height="242" id="chartJenisKelaminLine" style="width: 590px;" class="tw-flex"></canvas>
</div>

<div id="chartLineAgamaContainer" class="tw-flex tw-w-full" style="display: none">
    <canvas height="242" id="chartAgamaLine" style="width: 590px;" class="tw-flex"></canvas>
</div>

<div id="chartLineTingkatPendidikanContainer" class="tw-flex tw-w-full" style="display: none">
    <canvas height="242" id="chartTingkatPendidikanLine" style="width: 590px;" class="tw-flex"></canvas>
</div>

<div id="chartLineBansosContainer" class="tw-flex tw-w-full" style="display: none">
    <canvas height="242" id="chartBansosLine" style="width: 590px;" class="tw-flex"></canvas>
</div>

<div id="chartLineUsiaContainer" class="tw-flex tw-w-full" style="display: none">
    <canvas height="242" id="chartUsiaLine" style="width: 590px;" class="tw-flex"></canvas>
</div>

<script>
    function dropdownChartLine() {
        const selectedChart = document.getElementById('lineChart').value;
        console.log(selectedChart);

        const containers = {
            pekerjaan: 'chartLinePekerjaanContainer',
            jenis_kelamin: 'chartLineJenisKelaminContainer',
            agama: 'chartLineAgamaContainer',
            tingkat_pendidikan: 'chartLineTingkatPendidikanContainer',
            bansos: 'chartLineBansosContainer',
            usia: 'chartLineUsiaContainer'
        };

        if (selectedChart in containers) {
            for (const container in containers) {
                const element = document.getElementById(containers[container]);
                if (element) {
                    element.style.display = (container === selectedChart) ? 'block' : 'none';
                } else {
                    console.error('Elemen dengan id ' + containers[container] + ' tidak ditemukan');
                }
            }
            window[selectedChart]();
        } else {
            console.error('error pada fungsi dropdownChartData()'); // tampil dek console inspect
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        linePekerjaan();
        lineJenisKelamin();
        lineAgama();
        lineTingkatPendidikan();
        lineUsia();
        lineBansos();
    });

    function createChartLine(ctx, labels, data, label) {
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(1, 'rgba(255,255,255,0)');
        gradient.addColorStop(0, 'rgba(2,92,192,0.1)');

        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    fill: true,
                    // fillColor = gradient,
                    // backgroundColor: '#2C90FF',
                    backgroundColor: gradient,
                    borderJoinStyle: 'miter',
                    borderColor: '#2C90FF',
                    borderWidth: 4,
                    hoverBorderColor: '#025CC0',
                    pointBorderWidth: 5,
                    pointHoverBorderWidth: 5
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                        }
                    }
                },
                responsive: false,
                plugins: {
                    tooltip: {
                        // Disable the on-canvas tooltip
                        enabled: false,

                        external: function(context) {
                            // Tooltip Element
                            let tooltipEl = document.getElementById('chartjs-tooltip');

                            // Create element on first render
                            if (!tooltipEl) {
                                tooltipEl = document.createElement('div');
                                tooltipEl.id = 'chartjs-tooltip';
                                tooltipEl.innerHTML =
                                    '<div class="tw-flex tw-flex-col tw-gap-1 tw-p-2 tw-bg-n100 tw-border-[1.5px] tw-border-n300 tw-rounded-md"></div>';
                                document.body.appendChild(tooltipEl);
                            }

                            // Hide if no tooltip
                            const tooltipModel = context.tooltip;
                            if (tooltipModel.opacity === 0) {
                                tooltipEl.style.opacity = 0;
                                return;
                            }

                            // Set caret Position
                            tooltipEl.classList.remove('above', 'below', 'no-transform');
                            if (tooltipModel.yAlign) {
                                tooltipEl.classList.add(tooltipModel.yAlign);
                            } else {
                                tooltipEl.classList.add('no-transform');
                            }

                            function getBody(bodyItem) {
                                return bodyItem.lines;
                            }

                            // Set Text
                            if (tooltipModel.body) {
                                const titleLines = tooltipModel.title || [];
                                const bodyLines = tooltipModel.body.map(getBody);

                                let innerHtml = '<h4 class="tw-placeholder tw-text-sm tw-text-n600">';

                                titleLines.forEach(function(title) {
                                    innerHtml += title;
                                });
                                innerHtml += '</h4>';

                                bodyLines.forEach(function(body) {
                                    const h2 = '<h3 class="tw-text-n1000">' + body;
                                    innerHtml += h2;
                                });

                                let tableRoot = tooltipEl.querySelector('div');
                                console.log(tableRoot);
                                tableRoot.innerHTML = innerHtml;
                            }

                            const position = context.chart.canvas.getBoundingClientRect();
                            const bodyFont = Chart.helpers.toFont(tooltipModel.options.bodyFont);

                            // Display, position, and set styles for font
                            tooltipEl.style.opacity = 1;
                            tooltipEl.style.position = 'absolute';
                            tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel
                                .caretX + 'px';
                            tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel
                                .caretY + 'px';
                            tooltipEl.style.font = bodyFont.string;
                            tooltipEl.style.padding = tooltipModel.padding + 'px ' + tooltipModel
                                .padding + 'px';
                            tooltipEl.style.pointerEvents = 'none';
                        }
                    },
                    legend: {
                        position: 'none'
                    },
                    title: {
                        display: false,
                    }
                },
            }
        });
    }

    function lineAgama() {
        const ctx = document.getElementById('chartAgamaLine').getContext('2d');
        const dataAgama = @json($dataAgama);
        const agama = dataAgama.map(item => item.agama);
        const jmlWarga = dataAgama.map(item => item.jumlah);
        createChartLine(ctx, agama, jmlWarga, 'Jumlah');
    }

    function lineTingkatPendidikan() {
        const ctx = document.getElementById('chartTingkatPendidikanLine').getContext('2d');
        const dataTingkatPendidikan = @json($dataTingkatPendidikan);
        const pendidikan = dataTingkatPendidikan.map(item => item.pendidikan);
        const jmlWarga = dataTingkatPendidikan.map(item => item.jumlah);
        createChartLine(ctx, pendidikan, jmlWarga, 'Jumlah');
    }

    function linePekerjaan() {
        const ctx = document.getElementById('linePekerjaanLine').getContext('2d');
        const dataPekerjaan = @json($dataPekerjaan);
        const jenisPekerjaan = dataPekerjaan.map(item => item.jenis_pekerjaan);
        const jmlWarga = dataPekerjaan.map(item => item.total);
        createChartLine(ctx, jenisPekerjaan, jmlWarga, 'Jumlah');
    }

    function lineJenisKelamin() {
        const ctx = document.getElementById('chartJenisKelaminLine').getContext('2d');
        const dataJenisKelamin = @json($dataJenisKelamin);
        const jenisKelamin = dataJenisKelamin.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
        const jmlWarga = dataJenisKelamin.map(item => item.jumlah);
        createChartLine(ctx, jenisKelamin, jmlWarga, 'Jumlah');
    }

    function lineBansos() {
        const ctx = document.getElementById('chartBansosLine').getContext('2d');
        const dataBansos = @json($dataBansosByMonth);
        const bulanTahun = dataBansos.map(item => `${item.bulan} (${item.tahun})`);
        const jmlWarga = dataBansos.map(item => item.jumlah);
        createChartLine(ctx, bulanTahun, jmlWarga, 'Jumlah');
    }

    function lineUsia() {
        const ctx = document.getElementById('chartUsiaLine').getContext('2d');
        const dataUsia = @json($dataUsia);
        const rentangUsia = dataUsia.map(item => `Usia ${item.rentang_usia}`);
        const jumlahPenduduk = dataUsia.map(item => item.jumlah_penduduk);
        createChartLine(ctx, rentangUsia, jumlahPenduduk, 'Jumlah Penduduk');
    }
</script>
