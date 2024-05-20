<div class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '' }}">
    <div class="tw-w-56">
        <x-input.select id="lineChart" onchange="dropdownChartLine()">
            <option value="pekerjaan">Pekerjaan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
            <option value="tingkat_pendidikan">Tingkat Pendidikan</option>
            <option value="agama">Agama</option>
            <option value="bansos">Bansos</option>
            <option value="usia" selected>Usia</option>
        </x-input.select>
    </div>
    @if (Auth::user()->hasLevel['level_kode'] == 'RW')
        <div class="tw-w-28">
            <x-input.select class="tw-w-28" id="rtLine" onchange="dropdownChartLine(this.value)">
                <option value="ketua">Semua</option>
                @foreach ($semuaRT as $rt)
                    <option value="{{ $rt->keterangan }}">RT. {{ $rt->keterangan }}</option>
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
    let pekerjaanLine;
    let jenis_kelaminLine;
    let agamaLine;
    let tingkat_pendidikanLine;
    let usiaLine;
    let bansosLine;
    document.addEventListener('DOMContentLoaded', function() {
        dropdownChartLine();
        pekerjaanLine = linePekerjaan();
        jenis_kelaminLine = lineJenisKelamin();
        agamaLine = lineAgama();
        tingkat_pendidikanLine = lineTingkatPendidikan();
        usiaLine = lineUsia();
        bansosLine = lineBansos();
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
                    },
                    y: {
                        ticks: {
                            stepSize: 1 // setelan angka di bagian kiri ...
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
        return createChartLine(ctx, agama, jmlWarga, 'Jumlah');
    }

    function lineTingkatPendidikan() {
        const ctx = document.getElementById('chartTingkatPendidikanLine').getContext('2d');
        const dataTingkatPendidikan = @json($dataTingkatPendidikan);
        const pendidikan = dataTingkatPendidikan.map(item => item.pendidikan);
        const jmlWarga = dataTingkatPendidikan.map(item => item.jumlah);
        return createChartLine(ctx, pendidikan, jmlWarga, 'Jumlah');
    }

    function linePekerjaan() {
        const ctx = document.getElementById('linePekerjaanLine').getContext('2d');
        const dataPekerjaan = @json($dataPekerjaan);
        const jenisPekerjaan = dataPekerjaan.map(item => item.jenis_pekerjaan);
        const jmlWarga = dataPekerjaan.map(item => item.jumlah);
        return createChartLine(ctx, jenisPekerjaan, jmlWarga, 'Jumlah');
    }

    function lineJenisKelamin() {
        const ctx = document.getElementById('chartJenisKelaminLine').getContext('2d');
        const dataJenisKelamin = @json($dataJenisKelamin);
        const jenisKelamin = dataJenisKelamin.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
        const jmlWarga = dataJenisKelamin.map(item => item.jumlah);
        return createChartLine(ctx, jenisKelamin, jmlWarga, 'Jumlah');
    }

    function lineBansos() {
        const ctx = document.getElementById('chartBansosLine').getContext('2d');
        const dataBansos = @json($dataBansosByMonth);
        const bulanTahun = dataBansos.map(item => `${item.bulan} (${item.tahun})`);
        const jmlWarga = dataBansos.map(item => item.jumlah);
        return createChartLine(ctx, bulanTahun, jmlWarga, 'Jumlah');
    }

    function lineUsia() {
        const ctx = document.getElementById('chartUsiaLine').getContext('2d');
        const dataUsia = @json($dataUsia);
        const rentangUsia = dataUsia.map(item => `Usia ${item.rentang_usia}`);
        const jumlahPenduduk = dataUsia.map(item => item.jumlah_penduduk);
        return createChartLine(ctx, rentangUsia, jumlahPenduduk, 'Jumlah Penduduk');
    }

    function updateChartLine(chartInstance, newData, jenisData) {
        let datasets = chartInstance.data.datasets;
        let labels = chartInstance.data.labels;

        // Jika data baru ada dan tidak kosong, perbarui data chart
        if (newData[jenisData] && newData[jenisData].length > 0) {
            datasets[0].data = newData[jenisData].map((item, index) => {
                return item['jumlah'] !== undefined ? item['jumlah'] : 0;
            });
        } else {
            // Jika data kosong, set semua data pada chart ke 0
            datasets[0].data = labels.map(() => 0);
        }

    chartInstance.update();
}


    function dropdownChartLine(selectedRT) {
        const selectedChart = document.getElementById('lineChart').value;
        var selectedRTValue = '{{Auth::user()->keterangan}}';
        if (document.getElementById('rtLine') != null) {
            selectedRTValue = document.getElementById('rtLine').value;
        }

        const containers = {
            pekerjaan: 'chartLinePekerjaanContainer',
            jenis_kelamin: 'chartLineJenisKelaminContainer',
            agama: 'chartLineAgamaContainer',
            tingkat_pendidikan: 'chartLineTingkatPendidikanContainer',
            bansos: 'chartLineBansosContainer',
            usia: 'chartLineUsiaContainer'
        };

        for (const container in containers) {
            document.getElementById(containers[container]).style.display = (container === selectedChart || container === selectedRTValue) ? 'block' : 'none';
        }

        $.ajax({
            url: "{{ route('filter-data') }}",
            type: "POST",
            data: {
                selectedRT: selectedRTValue,
                selectedChart: selectedChart,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log("selected rt =", selectedRTValue);
                console.log("data array =", data);
                console.log("chart obj = ", pekerjaanLine);
                switch (selectedChart) {
                    case 'pekerjaan':
                        updateChartLine(pekerjaanLine, data, 'dataPekerjaan');
                        break;
                    case 'jenis_kelamin':
                        updateChartLine(jenis_kelaminLine, data, 'dataJenisKelamin');
                        break;
                    case 'agama':
                        updateChartLine(agamaLine, data, 'dataAgama');
                        break;
                    case 'tingkat_pendidikan':
                        updateChartLine(tingkat_pendidikanLine, data, 'dataTingkatPendidikan');
                        break;
                    case 'bansos':
                        updateChartLine(bansosLine, data, 'dataBansos');
                        break;
                    case 'usia':
                        console.log(selectedChart);
                        updateChartLine(usiaLine, data, 'dataUsia');
                        break;
                    default:
                        console.error('dropdownChartDataRT() error');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
</script>
