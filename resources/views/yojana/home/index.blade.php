@section('title', 'Dashboard')
@extends('layout.layout')
@section('sidebar')

    @if (session('active_app') == 'pis')
        @include('layout.pis_sidebar')
    @endif
    @if (session('active_app') == 'yojana')
        @include('layout.yojana_sidebar')
    @endif
    @if (session('active_app') == 'nagadi')
        @include('layout.yojana_sidebar')
    @endif
    @if (session('active_app') == 'byabasaye')
        @include('layout.byabasaye_sidebar')
    @endif
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid yojana-dashboard" id="vue_app">
        <div class="row">
            <!-- /.card-body -->
            <div class="col-md-6">
                <div class=" my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">योजनाको संख्या</h4>
                        </div>
                        <div class="card-body">
                            <div class="yojana-count">
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_plan_regs_count }} </h4>
                                        <span> {{ ' योजना संख्या ' }} </span>
                                    </div>
                                </div>
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_break_plan_count }} </h4>
                                        <span> {{ ' टुक्राएको योजना ' }} </span>
                                    </div>
                                </div>
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_plan_with_other_bibaran }} </h4>
                                        <span> {{ ' सम्झौता भएको योजना ' }} </span>
                                    </div>
                                </div>
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_break_plan_with_other_bibaran }} </h4>
                                        <span> {{ ' सम्झौता भएको टुक्राएको योजना ' }} </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class=" my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">कार्यक्रमको संख्या</h4>
                        </div>
                        <div class="card-body">
                            <div class="yojana-count">
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_program_regs_count }} </h4>
                                        <span> {{ ' दर्ता कार्यक्रम' }} </span>
                                    </div>
                                </div>
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_program_with_other_bibaran }} </h4>
                                        <span> {{ ' सम्झौता भएको कार्यक्रम' }} </span>
                                    </div>
                                </div>
                                {{-- item --}}
                                <div class="yojana-count-item">
                                    <div class="icon"> <i class="fa-solid fa-question"></i> </div>
                                    <div class="info">
                                        <h4 class="count">{{ $total_work_order_count }} </h4>
                                        <span> {{ ' सम्झौता भएको कार्यक्रम' }} </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <section class="col-lg-6 connectedSortable ui-sortable text-center">
                <div class="card">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fa-solid fa-chart-column mr-1"></i>
                            समग्र योजनाको मुख्य विवरण
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <select name="" id="ward" class="form-control form-control-sm"
                                        onchange="changeWard(event)">
                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                        @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                            @if (!$i)
                                                <option value="{{ $i }}">{{ config('constant.SITE_TYPE') }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}">{{ 'वडा नं ' . Nepali($i) }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="bar">
                            <canvas id="bar-chart" width="800" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable ui-sortable text-center">
                <div class="card">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fa-solid fa-chart-column mr-1"></i>
                            योजनाको अन्तर्गत बिकाशको रिपोर्ट
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    {{-- <select name="" id="ward" class="form-control form-control-sm"
                                        onchange="changeWard(event)">
                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                        @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                            @if (!$i)
                                                <option value="{{ $i }}">{{ config('constant.SITE_TYPE') }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}">{{ 'वडा नं ' . Nepali($i) }}</option>
                                            @endif
                                        @endfor
                                    </select> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center" id="ward_msg">
                                <span class="text-center font-weight-bold">योजनाको अन्तर्गत बिकाशको रिपोर्ट</span>
                            </div>
                        </div>
                        <div id="pie" style="position: relative; height:255px; width:300px; top:0; left:0">
                            <canvas id="pie-chart" style="    position: absolute; left: 5%; top: -75px;"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
    <script>
        let data = ["{{ English($total_plan_regs_count) }}",
            "{{ English($total_break_plan_count) }}",
            "{{ English($total_plan_with_other_bibaran) }}",
            "{{ English($total_work_order_count) }}",
            "{{ English($total_final_bill_payment_count) }}",
            "{{ English($total_running_bill_payment_count) }}"
        ];

        let pieCharts = @json($pie_chart_array);
        var result = Object.keys(pieCharts).map((key) => [Number(key), pieCharts[key]]);
        let topicsLabel = [];
        let pieChartData = [];
        window.onload = function() {
            Object.keys(pieCharts).forEach(key => {
                topicsLabel.push(key);
                pieChartData.push(pieCharts[key]);
            });
            drawPlanBarGraph(data, 'bar-chart');
            drawPieChart(topicsLabel, pieChartData);
        }

        function changeWard(event) {
            ward = event.target.value;
            axios.get("{{ route('plan.bar_graph') }}", {
                params: {
                    ward: ward
                }
            }).then(function(response) {
                $("#bar").html(response.data.html);
                drawPlanBarGraph(
                    [response.data.total_plan_regs_count,
                        response.data.total_break_plan_count,
                        response.data.total_plan_with_other_bibaran,
                        response.data.total_work_order_count,
                        response.data.total_final_bill_payment_count,
                        response.data.total_running_bill_payment_count
                    ], response.data.html_id);
                $("#ward_msg").html(response.data.ward_msg);
            }).catch(function(error) {
                console.log(error);
            });
        }

        function drawPlanBarGraph(params, id) {
            new Chart(document.getElementById(id), {
                type: 'bar',
                data: {
                    labels: ["जम्मा दर्ता", "टुक्रिएको योजना", "सम्झौता भएको योजना", "सम्झौता भएको टुक्राएको योजना",
                        "मु.आ भुक्तानी भएको योजना", "अन्तिम भुक्तानी भएको योजना"
                    ],
                    datasets: [{
                        label: "कुल योजना संख्या",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: params,
                        barThickness: 36
                    }]
                },
                options: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'कुल योजना संख्या'
                    }
                }
            });
        }

        function drawPieChart(label, data) {

            new Chart(document.getElementById("pie-chart"), {
                type: 'pie',
                data: {
                    labels: label,
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: data
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            align: 'center'
                        },
                        title: {
                            display: false,
                            text: 'Predicted world population (millions) in 2050'
                        }
                    }
                },
                // options: {
                //     legend: {
                //         display: true,
                //         position: 'right',
                //         align: 'start'
                //     },
                //     title: {
                //         display: true,
                //         text: 'Predicted world population (millions) in 2050'
                //     }

                // }
            });
        }
    </script>
@endsection
