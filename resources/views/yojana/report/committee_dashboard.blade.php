@section('title', 'समिति बिस्तृत रिपोर्ट')
@section('child_report', 'menu-open')
@section('report_comittee_dashboard', 'active')
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
                <h3 class="card-title">{{ __('समिति बिस्तृत :') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="my-2">
                <div class="row">
                    <div class="col-12">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['tole-bikas-samiti'])}}">{{ config('TYPE.1') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['upabhokta-samiti'])}}">{{ config('TYPE.2') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['sanstha-samiti'])}}">{{ config('TYPE.3') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['amanat'])}}">{{ config('TYPE.4') . __(' मार्फत') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
