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
                                    <h2 class="h6 text-gray-400 mb-0">Risk Items</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $riskItems['total'] }}</h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-500">{{ $riskItems['timeRange'] }}</small>
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
                        <h6 class="h6 text-gray-400 mb-0">Item per Category</h6>
                    </div>
                    <div class="card-body p-2 d-flex">
                        <div class="ct-pie-label-chart ct-golden-section" style="font-size: 0.8rem"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 px-2 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                        <div class="h6 text-gray-400 mb-0"> Item per Security Requirement</div>
                    </div>
                    <div class="card-body p-2">
                        <div class="ct-chart-rankingsss ct-golden-section ct-series-a"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">#</th>
                                <th class="border-0">Aset</th>
                                <th class="border-0">Kode</th>
                                <th class="border-0">Kerentanan</th>
                                <th class="border-0">Ancaman</th>
                                <th class="border-0">Pontential Cause</th>
                                <th class="border-0 rounded-end">Pontential Effects</th>
                                <th class="border-0 rounded-end">Severity</th>
                                <th class="border-0 rounded-end">Occurrence</th>
                                <th class="border-0 rounded-end">Detection</th>
                                <th class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($riskItems['risikos'] as $keying => $risiko)
                                @foreach ($risiko['risiko'] as $key => $risk)
                                    <tr>
                                        <td><a href="#" class="text-primary fw-bold">{{ $no }}</a></td>
                                        @if ($key == 0)
                                            <td rowspan="{{ count($risiko['risiko']) }}"
                                                clas="fw-bold d-flex align-items-center">
                                                {{ $risiko['aset'] }}
                                        @endif
                                        <td>
                                            {{ $risk['kode'] }}
                                        </td>
                                        <td class="overflow-scroll"
                                            style="max-width: 400px; overflow-y: hidden !important;">
                                            {{ $risk['kerentanan'] }}
                                        </td>
                                        <td class="overflow-scroll"
                                            style="max-width: 400px; overflow-y: hidden !important;">
                                            {{ $risk['ancaman'] }}
                                        </td>
                                        <td class="overflow-scroll"
                                            style="max-width: 400px; overflow-y: hidden !important;">
                                            {{ $risk['potensi_sebab'] }}
                                        </td>
                                        <td class="overflow-scroll"
                                            style="max-width: 400px; overflow-y: hidden !important;">
                                            {{ $risk['potensi_efek'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $risk['severity'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $risk['occurrence'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $risk['detection'] }}
                                        </td>
                                        <td class="text-center">
                                            {{-- <button class="btn btn-outline-gray-600">
                                                <p>This <a href="#" role="button"
                                                        class="btn btn-secondary popover-test" title="Popover title"
                                                        data-bs-content="Popover body content is set in this attribute.">button</a>
                                                    triggers a popover on click.</p>

                                                <i class="fa-solid fa-ellipsis-vertical fa-sm"></i>
                                            </button> --}}
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalPopovers">
                                                Launch demo modal
                                            </button>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            aa
                        </div>
                    </div>
                    <div class="modal fade show" id="exampleModalPopovers" tabindex="-1"
                        aria-labelledby="exampleModalPopoversLabel" aria-modal="true" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalPopoversLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Popover in a modal</h5>
                                    <p>This <a href="#" role="button" class="btn btn-secondary popover-test"
                                            title="" data-bs-content="Popover body content is set in this attribute."
                                            data-bs-container="#exampleModalPopovers"
                                            data-bs-original-title="Popover title">button</a> triggers a popover on click.
                                    </p>
                                    <hr>
                                    <h5>Tooltips in a modal</h5>
                                    <p><a href="#" class="tooltip-test" title=""
                                            data-bs-container="#exampleModalPopovers" data-bs-original-title="Tooltip">This
                                            link</a> and <a href="#" class="tooltip-test" title=""
                                            data-bs-container="#exampleModalPopovers"
                                            data-bs-original-title="Tooltip">that link</a> have tooltips on hover.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
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
        var risiko = <?php echo json_encode($riskItems['risikos']); ?>;
        console.log(risiko);

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
        var chart = new Chartist.Bar('.ct-chart-rankingsss', {
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
    </script>
@endpush
