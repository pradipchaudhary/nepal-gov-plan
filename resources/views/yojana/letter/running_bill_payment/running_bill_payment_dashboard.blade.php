@section('title', 'पत्र')
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('पत्र') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                    <div class="col-12 mt-2">
                        <p class="mb-0 p-2 text-center bg-primary">{{ $plan->name }}</p>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.runningBillPaymentLetter', [$reg_no, 'runningBillPaymentLetterSubmit']) }}">{{ __('मुल्यांकनको आधारमा भुक्तानीको टिप्पणी') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.runningBillPaymentLetter', [$reg_no, 'accountPaymentLetterSubmit']) }}">{{ __('आर्थिक प्रशासन शाखा पत्र') }}</a>
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
