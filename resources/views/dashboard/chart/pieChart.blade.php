<div
    class="tw-flex {{ is_null(Auth::user()) ? '' : (Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '') }}">
    <div class="tw-w-40 md:tw-w-56">
        <x-input.select id="chartType" onchange="dropdownChartData()">
            <option value="pekerjaan">Pekerjaan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
            <option value="tingkat_pendidikan" selected>Tingkat Pendidikan</option>
            <option value="agama">Agama</option>
            <option value="bansos">Bansos</option>
            <option value="usia">Usia</option>
        </x-input.select>
    </div>
    @if (is_null(Auth::user()) === false && Auth::user()->hasLevel['level_kode'] == 'RW')
        <div class="tw-w-28">
            <x-input.select class="tw-w-28" id="rtFilter" onchange="dropdownChartData(this.value)">
                <option value="ketua">Semua</option>
                @foreach ($semuaRT as $rt)
                    <option value="{{ $rt->keterangan }}">RT {{ str_pad( $rt->keterangan, 3, '0', STR_PAD_LEFT )}}</option>
                @endforeach
            </x-input.select>
        </div>
    @endif
</div>

<div class="tw-flex tw-items-center tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartPekerjaanContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartPekerjaanPie" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-flex tw-items-center tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartJenisKelaminContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartJenisKelaminPie" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-flex tw-items-center tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartAgamaContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartAgamaPie" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-flex tw-items-center tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartTingkatPendidikanContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartTingkatPendidikanPie" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-flex tw-items-center tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartPieBansosContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartBansosPie" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-flex tw-items-center tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartPieUsiaContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartUsiaPie" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<script>
    let pekerjaan;
    let jenis_kelamin;
    let agama;
    let tingkat_pendidikan;
    let usia;
    let bansos;
    document.addEventListener('DOMContentLoaded', function() {
        pekerjaan = chartPekerjaan();
        jenis_kelamin = chartJenisKelamin();
        agama = chartAgama();
        tingkat_pendidikan = chartTingkatPendidikan();
        usia = chartUsia();
        bansos = chartBansos();
        dropdownChartData();
    });

    function createChart(ctx, labels, data, label) {
        let combinedData = labels.map((label, index) => ({ label, data: data[index] }))
                        .sort((a, b) => b.data - a.data);

        let topFiveData = combinedData.slice(0, 5);
        let otherData = combinedData.slice(5);

        let topLabels = topFiveData.map(item => item.label);
        let topData = topFiveData.map(item => item.data);

        if (otherData.length > 0) {
            topLabels.push('Lainnya');
            topData.push(otherData.reduce((sum, item) => sum + item.data, 0));
        }
        return new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: topLabels,
                datasets: [{
                    label: label,
                    data: topData,
                    backgroundColor: ['#CCE4FF', '#A8D1FF', '#56A6FF', '#2C90FF', '#025CC0', '#01448E'],
                    borderColor: ['#CCE4FF', '#A8D1FF', '#56A6FF', '#2C90FF', '#025CC0', '#01448E'],
                    borderWidth: 1.5
                }]
            },
            options: {
                cutout: '0',
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
                                innerHtml += ' %</h3>';

                                let tableRoot = tooltipEl.querySelector('div');
                                // console.log(tableRoot);
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
                        position: 'right',
                        labels: {
                            boxWidth: 14,
                            boxHeight: 14,
                            useBorderRadius: true,
                            borderRadius: 100,
                            font: {
                                family: "Plus Jakarta Sans",
                                size: "14"
                            }
                        },
                    },
                    title: {
                        display: false,
                    }
                },
            }
        });

    }

    function chartAgama() {
        const ctx = document.getElementById('chartAgamaPie').getContext('2d');
        const dataAgama = @json($dataAgama);
        const agama = dataAgama.map(item => item.agama);
        const jmlWarga = dataAgama.map(item => item.persentase);
        return createChart(ctx, agama, jmlWarga, 'Persentase');
    }

    function chartTingkatPendidikan() {
        const ctx = document.getElementById('chartTingkatPendidikanPie').getContext('2d');
        const dataTingkatPendidikan = @json($dataTingkatPendidikan);
        const pendidikan = dataTingkatPendidikan.map(item => item.pendidikan);
        const jmlWarga = dataTingkatPendidikan.map(item => item.persentase);
        return createChart(ctx, pendidikan, jmlWarga, 'Persentase');
    }

    function chartPekerjaan() {
        const ctx = document.getElementById('chartPekerjaanPie').getContext('2d');
        const dataPekerjaan = @json($dataPekerjaan);
        const jenisPekerjaan = dataPekerjaan.map(item => item.jenis_pekerjaan);
        const jmlWarga = dataPekerjaan.map(item => item.persentase);
        return createChart(ctx, jenisPekerjaan, jmlWarga, 'Persentase');
    }

    function chartJenisKelamin() {
        const ctx = document.getElementById('chartJenisKelaminPie').getContext('2d');
        const dataJenisKelamin = @json($dataJenisKelamin);
        const jenisKelamin = dataJenisKelamin.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
        const jmlWarga = dataJenisKelamin.map(item => item.persentase);
        return createChart(ctx, jenisKelamin, jmlWarga, 'Persentase');
    }

    function chartBansos() {
        const ctx = document.getElementById('chartBansosPie').getContext('2d');
        const dataBansos = @json($dataBansos);
        const bulanTahun = dataBansos.map(item => `${item.bansos} (${item.kode})`);
        const jmlWarga = dataBansos.map(item => item.persentase);
        return createChart(ctx, bulanTahun, jmlWarga, 'Persetase');
    }

    function chartUsia() {
        const ctx = document.getElementById('chartUsiaPie').getContext('2d');
        const dataUsia = @json($dataUsia);
        const rentangUsia = dataUsia.map(item => `Usia ${item.rentang_usia}`);
        const jumlahPenduduk = dataUsia.map(item => item.persentase);
        return createChart(ctx, rentangUsia, jumlahPenduduk, 'Persentase');
    }

    function updateChart(chartInstance, newData, jenisData) {
        if (newData[jenisData] && newData[jenisData].length > 0) {
            // Combine labels and data into a single array of objects
            let combinedData = newData[jenisData].map(item => ({
                label: item[Object.keys(item)[0]],
                data: item.persentase
            })).sort((a, b) => b.data - a.data); // Sort in descending order

            // Select the top 5 items and combine the rest into "Other"
            let topFiveData = combinedData.slice(0, 5);
            let otherData = combinedData.slice(5);

            chartInstance.data.labels = topFiveData.map(item => item.label);
            chartInstance.data.datasets[0].data = topFiveData.map(item => item.data);

            if (otherData.length > 0) {
                chartInstance.data.labels.push('Other');
                chartInstance.data.datasets[0].data.push(otherData.reduce((sum, item) => sum + item.data, 0));
            }
        } else {
            chartInstance.data.labels = ['No Data'];
            chartInstance.data.datasets[0].data = [100];
        }

        chartInstance.update();
    }

    function dropdownChartData(selectedRT) {
        const selectedChart = document.getElementById('chartType').value;
        var selectedRTValue = "{{ is_null(Auth::user()) ? 'ketua' : Auth::user()->keterangan }}";
        // console.log(document.getElementById('rtFilter'));
        if (document.getElementById('rtFilter') != null) {
            selectedRTValue = document.getElementById('rtFilter').value;
        }
        const containers = {
            pekerjaan: 'chartPekerjaanContainer',
            jenis_kelamin: 'chartJenisKelaminContainer',
            agama: 'chartAgamaContainer',
            tingkat_pendidikan: 'chartTingkatPendidikanContainer',
            bansos: 'chartPieBansosContainer',
            usia: 'chartPieUsiaContainer'
        };

        for (const container in containers) {
            if (container === selectedChart) {
                // console.log($('#' + containers[container]).parent().attr('class'));
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
                selectedRT: selectedRTValue ? selectedRTValue : selectedRT,
                selectedChart: selectedChart,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                // console.log("selected rt =", selectedRTValue);
                // console.log("data array =", data);
                // console.log("chart obj = ", pekerjaan);
                switch (selectedChart) {
                    case 'pekerjaan':
                        updateChart(pekerjaan, data, 'dataPekerjaan');
                        break;
                    case 'jenis_kelamin':
                        updateChart(jenis_kelamin, data, 'dataJenisKelamin');
                        break;
                    case 'agama':
                        updateChart(agama, data, 'dataAgama');
                        break;
                    case 'tingkat_pendidikan':
                        updateChart(tingkat_pendidikan, data, 'dataTingkatPendidikan');
                        break;
                    case 'bansos':
                        updateChart(bansos, data, 'dataBansos');
                        break;
                    case 'usia':
                        console.log(data);
                        updateChart(usia, data, 'dataUsia');
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
