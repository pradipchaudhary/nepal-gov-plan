@section('title', 'मलेप रिपोर्ट')
@section('child_report', 'menu-open')
@section('report_malepa', 'active')
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
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('मलेप रिपोर्ट :') }}</h3>
            </div>
            @dd($reports)
            <!-- /.card-header -->
            <div class="my-2">
                <table id="table" width="100%" class="table table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <td class="text-center font-weight-bold">{{ __('सि.नं') }}</td>
                            <td class="text-center font-weight-bold">{{ __('योजना दर्ता नं') }}</td>
                            <td class="text-center font-weight-bold">{{ __('उपभोक्ता समितिको नाम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('अदक्ष्यको नाम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कामको विवरण') }}</td>
                            <td class="text-center font-weight-bold">{{ __('लागत अनुमान') }}</td>
                            <td class="text-center font-weight-bold">{{ __('सम्झौता मिति') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न गर्नुपर्ने मिति') }}</td>
                            <td class="text-center font-weight-bold">{{ __('सम्झौता रकम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्यालयले व्योर्ने') }}</td>
                            <td class="text-center font-weight-bold">{{ __('उपभोक्ता समितिले व्योर्ने') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न गरेको मिति') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न रकम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्यलयले भुक्तानी गरेको') }}</td>
                            <td class="text-center font-weight-bold">{{ __('उपभोक्ताको जनश्रमदान') }}</td>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection



@section('scripts')
   
@endsection
