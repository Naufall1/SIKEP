<div
    class="tw-flex {{ is_null(Auth::user()) ? '' : (Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '') }}">
    <div class="tw-w-56">
        <x-input.select id="barChart" onchange="dropdownChartBar()">
            <option value="pekerjaan" selected>Pekerjaan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
            <option value="tingkat_pendidikan">Tingkat Pendidikan</option>
            <option value="agama">Agama</option>
            <option value="bansos">Bansos</option>
            <option value="usia">Usia</option>
        </x-input.select>
    </div>
    @if (is_null(Auth::user()) === false && Auth::user()->hasLevel['level_kode'] == 'RW')
        <div class="tw-w-28">
            <x-input.select class="tw-w-28" id="rtBar" onchange="dropdownChartBar()">
                <option value="ketua">Semua</option>
                @foreach ($semuaRT as $rt)
                    <option value="{{ $rt->keterangan }}">RT. {{ $rt->keterangan }}</option>
                @endforeach
            </x-input.select>
        </div>
    @endif
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartBarPekerjaanContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full ">
        <canvas id="chartPekerjaanBar" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartBarJenisKelaminContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full ">
        <canvas id="chartJenisKelaminBar" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartBarAgamaContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full ">
        <canvas id="chartAgamaBar" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartBarTingkatPendidikanContainer"
        class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full ">
        <canvas id="chartTingkatPendidikanBar" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartBarBansosContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full ">
        <canvas id="chartBansosBar" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartBarUsiaContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full ">
        <canvas id="chartUsiaBar" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<script>
    let pekerjaanBar;
    let jenis_kelaminBar;
    let agamaBar;
    let tingkat_pendidikanBar;
    let usiaBar;
    let bansosBar;

    document.addEventListener('DOMContentLoaded', function() {
        pekerjaanBar = barPekerjaan();
        jenis_kelaminBar = barJenisKelamin();
        agamaBar = barAgama();
        tingkat_pendidikanBar = barTingkatPendidikan();
        usiaBar = barUsia();
        bansosBar = barBansos();
        dropdownChartBar();
        // hiddenAllChart();
    });

    function createChartBar(ctx, labels, data, label) {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: '#C6C6C6',
                    hoverBackgroundColor: '#0284FF',
                    borderWidth: 0,
                    borderRadius: 8
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            callback: function(value) {
                                // truncate the value only in this axis
                                const lbl = this.getLabelForValue(value);
                                if (typeof lbl === 'string' && lbl.length > 6) {
                                    return `${lbl.substring(0, 6)}...`;
                                }
                                return lbl;
                            },
                            maxRotation: 10,
                            minRotation: 0,
                        }
                    },
                    y: {
                        ticks: {
                            stepSize: 1,
                        }
                    }
                },
                responsive: false,
                plugins: {
                    tooltip: {
                        enabled: false,
                        external: function(context) {
                            let tooltipEl = document.getElementById('chartjs-tooltip');
                            if (!tooltipEl) {
                                tooltipEl = document.createElement('div');
                                tooltipEl.id = 'chartjs-tooltip';
                                tooltipEl.innerHTML =
                                    '<div class="tw-flex tw-flex-col tw-gap-1 tw-p-2 tw-bg-n100 tw-border-[1.5px] tw-border-n300 tw-rounded-md"></div>';
                                document.body.appendChild(tooltipEl);
                            }
                            const tooltipModel = context.tooltip;
                            if (tooltipModel.opacity === 0) {
                                tooltipEl.style.opacity = 0;
                                return;
                            }
                            tooltipEl.classList.remove('above', 'below', 'no-transform');
                            if (tooltipModel.yAlign) {
                                tooltipEl.classList.add(tooltipModel.yAlign);
                            } else {
                                tooltipEl.classList.add('no-transform');
                            }

                            function getBody(bodyItem) {
                                return bodyItem.lines;
                            }
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
                            tooltipEl.style.opacity = 1;
                            tooltipEl.style.position = 'absolute';
                            tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel
                                .caretX + 'px';
                            tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY +
                                'px';
                            tooltipEl.style.font = bodyFont.string;
                            tooltipEl.style.padding = tooltipModel.padding + 'px ' + tooltipModel.padding +
                                'px';
                            tooltipEl.style.pointerEvents = 'none';
                        },
                        xAlign: 'center'
                    },
                    legend: false,
                    title: {
                        display: false,
                    }
                }
            }
        });
    }

    function barAgama() {
        const ctx = document.getElementById('chartAgamaBar').getContext('2d');
        const dataAgama = @json($dataAgama);
        const agama = dataAgama.map(item => item.agama);
        const jmlWarga = dataAgama.map(item => item.jumlah);
        return createChartBar(ctx, agama, jmlWarga, 'Jumlah');
    }

    function barTingkatPendidikan() {
        const ctx = document.getElementById('chartTingkatPendidikanBar').getContext('2d');
        const dataTingkatPendidikan = @json($dataTingkatPendidikan);
        const pendidikan = dataTingkatPendidikan.map(item => item.pendidikan);
        const jmlWarga = dataTingkatPendidikan.map(item => item.jumlah);
        return createChartBar(ctx, pendidikan, jmlWarga, 'Jumlah');
    }

    function barPekerjaan() {
        const ctx = document.getElementById('chartPekerjaanBar').getContext('2d');
        const dataPekerjaan = @json($dataPekerjaan);
        const jenisPekerjaan = dataPekerjaan.map(item => item.jenis_pekerjaan);
        const jmlWarga = dataPekerjaan.map(item => item.jumlah);
        return createChartBar(ctx, jenisPekerjaan, jmlWarga, 'Jumlah');
    }

    function barJenisKelamin() {
        const ctx = document.getElementById('chartJenisKelaminBar').getContext('2d');
        const dataJenisKelamin = @json($dataJenisKelamin);
        const jenisKelamin = dataJenisKelamin.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
        const jmlWarga = dataJenisKelamin.map(item => item.jumlah);
        return createChartBar(ctx, jenisKelamin, jmlWarga, 'Jumlah');
    }

    function barBansos() {
        const ctx = document.getElementById('chartBansosBar').getContext('2d');
        const dataBansos = @json($dataBansos);
        const bulanTahun = dataBansos.map(item => `${item.bansos} (${item.kode})`);
        const jmlWarga = dataBansos.map(item => item.jumlah);
        return createChartBar(ctx, bulanTahun, jmlWarga, 'Jumlah');
    }

    function barUsia() {
        const ctx = document.getElementById('chartUsiaBar').getContext('2d');
        const dataUsia = @json($dataUsia);
        const rentangUsia = dataUsia.map(item => `Usia ${item.rentang_usia}`);
        const jumlahPenduduk = dataUsia.map(item => item.jumlah_penduduk);
        return createChartBar(ctx, rentangUsia, jumlahPenduduk, 'Jumlah Penduduk');
    }

    function updateChartBar(chartInstance, newData, jenisData) {
        if (newData[jenisData] && newData[jenisData].length > 0) {
            chartInstance.data.datasets[0].data = newData[jenisData].map(item => item['jumlah'] !== undefined ? item[
                'jumlah'] : 0);
        } else {
            chartInstance.data.datasets[0].data = chartInstance.data.labels.map(() => 0);
        }
        chartInstance.update();
    }

    function dropdownChartBar() {
        const selectedChart = document.getElementById('barChart').value;
        const selectedRTValue = document.getElementById('rtBar') ? document.getElementById('rtBar').value :
            '{{ Auth::user()->keterangan ?? 'ketua' }}';

        const containers = {
            pekerjaan: 'chartBarPekerjaanContainer',
            jenis_kelamin: 'chartBarJenisKelaminContainer',
            agama: 'chartBarAgamaContainer',
            tingkat_pendidikan: 'chartBarTingkatPendidikanContainer',
            bansos: 'chartBarBansosContainer',
            usia: 'chartBarUsiaContainer'
        };

        for (const container in containers) {
            if (container === selectedChart) {
                // console.log($('#'+containers[container]).parent().attr('class'));
                $('#' + containers[container]).parent().removeClass('tw-hidden');
            } else {
                // console.log('false');
                $('#' + containers[container]).parent().removeClass('tw-hidden');
                $('#' + containers[container]).parent().addClass('tw-hidden');
            }
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
                switch (selectedChart) {
                    case 'pekerjaan':
                        updateChartBar(pekerjaanBar, data, 'dataPekerjaan');
                        break;
                    case 'jenis_kelamin':
                        updateChartBar(jenis_kelaminBar, data, 'dataJenisKelamin');
                        break;
                    case 'agama':
                        updateChartBar(agamaBar, data, 'dataAgama');
                        break;
                    case 'tingkat_pendidikan':
                        updateChartBar(tingkat_pendidikanBar, data, 'dataTingkatPendidikan');
                        break;
                    case 'bansos':
                        updateChartBar(bansosBar, data, 'dataBansos');
                        break;
                    case 'usia':
                        updateChartBar(usiaBar, data, 'dataUsia');
                        break;
                    default:
                        console.error('dropdownChartBar() error');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function hiddenAllChart() {
        const containers = {
            jenis_kelamin: 'chartBarJenisKelaminContainer',
            agama: 'chartBarAgamaContainer',
            tingkat_pendidikan: 'chartBarTingkatPendidikanContainer',
            bansos: 'chartBarBansosContainer',
            usia: 'chartBarUsiaContainer'
        };

        for (const container in containers) {
            $('#' + containers[container]).parent().addClass('tw-hidden');
        }
    }
</script>
