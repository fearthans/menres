@extends('layouts.dashboard-volt')

@section('styles')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-block">
                                    <h2 class="h6 text-gray-700 mb-0">Risk Items</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $riskItems['total'] }}</h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-700">{{ $riskItems['timeRange'] }}</small>
                                <div class="small d-flex mt-1">
                                    <span class="fw-bolder">{{ $riskItems['lastMonth'] }}</span>
                                    <div>&nbsp;Dari bulan Lalu</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-6 col-xl-4 px-2 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                        <h6 class="h6 text-gray-700 mb-0">Item per Category</h6>
                    </div>
                    <div class="card-body p-2 d-flex">
                        <div class="ct-pie-label-chart ct-golden-section" style="font-size: 0.8rem"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 px-2 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                        <div class="h6 text-gray-700 mb-0"> Item per Security Requirement</div>
                    </div>
                    <div class="card-body p-2">
                        <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                        <div class="h5 text-gray-700 mb-0">Jumlah Penilaian Risiko</div>
                        <div class="d-flex ms-auto gap-4">
                            <div class="text-primary d-flex align-items-center gap-2">
                                <svg fill="currentColor" className="icon icon-xs ms-2" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                </svg>
        {{-- // bar analisis risiko (- severity - occurrence - detection) --}}

                                <div class="m-0 h6 fw-bold">Severity</div>
                            </div>
                            <div class="text-secondary d-flex align-items-center gap-2">
                                <svg fill="currentColor" className="icon icon-xs ms-2" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                </svg>
                                <div class="m-0 h6 fw-bold">Occurrence</div>
                            </div>
                            <div class="text-success d-flex align-items-center gap-2">
                                <svg fill="currentColor" className="icon icon-xs ms-2" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                </svg>
                                <div class="m-0 h6 fw-bold">Detection</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="ct-chart-bar-risiko ct-golden-section ct-series-a"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var kategori = <?php echo json_encode($riskItems['asetCateogry']); ?>;
        var keamanan = <?php echo json_encode($riskItems['persyaratanKeamanan']); ?>;
        var assetRisks = <?php echo json_encode($riskItems['risikos']); ?>;
        console.log("risksGroupByAsset:", assetRisks);

        var kategoriAset = {
            series: kategori,
        };

        $label = new Chartist.Pie('.ct-pie-label-chart', kategoriAset, {
            labelInterpolationFnc: function(value, index) {
                return kategoriAset.series[index].value + ' ' + kategoriAset.series[index].name;
            },
            labelOffset: 10
        });
        // Kerahasiaan (Confidentiality)
        // Integritas (Integrity)
        // Ketersediaan Informasi (Availability)
        // bar chart tingkat keamanan data
        var chart = new Chartist.Bar('.ct-chart-ranking', {
            labels: ['Kerahasiaan (Confidentiality)', 'Integritas (Integrity)',
                'Ketersediaan Informasi (Availability)'
            ],
            series: [keamanan]
        }, {
            low: 0,
            plugins: [
                Chartist.plugins.tooltip()
            ],
            axisX: {
                // On the x-axis start means top and end means bottom
                position: 'end'
            },
            axisY: {
                // On the y-axis start means left and end means right
                offset: 10,
                labelOffset: {
                    x: 5,
                    y: 10
                },
            },
        });

        chart.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 2000 * data.index,
                        dur: 2000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height())
                            .stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });

        var labelsRiskCode = [];
        var seriesRiskSOD = [
            [],
            [],
            []
        ];

        for (const [key, assetRisk] of Object.entries(assetRisks)) {
            for (const [key2, risk] of Object.entries(assetRisk.risiko)) {
                labelsRiskCode.push(risk.kode);
                seriesRiskSOD[0].push(risk.severity);
                seriesRiskSOD[1].push(risk.occurrence);
                seriesRiskSOD[2].push(risk.detection);
            }
        }
        console.log("labelsRiskCode:", labelsRiskCode);
        console.log("seriesRiskSOD:", seriesRiskSOD);


        // bar analisis risiko (- severity - occurrence - detection)
        new Chartist.Bar('.ct-chart-bar-risiko', {
            labels: labelsRiskCode,
            series: seriesRiskSOD
        }, {
            plugins: [
                Chartist.plugins.tooltip()
            ],
            stackBars: true,
            axisX: {
                offset: 30,
                labelOffset: {
                    x: 0,
                    y: 10
                }
            },
            axisY: {
                labelInterpolationFnc: function(value) {
                    return value;
                },
            }
        }).on('draw', function(data) {
            if (data.type === 'bar') {
                data.element.attr({
                    style: 'stroke-width: 30px'
                });
            }
        });
    </script>
@endpush
