@section('title', 'कार्यक्रम संचालन प्रक्रिया')
@section('operate_program', 'active')
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
                        <h3 class="card-title">{{ __('कार्यक्रम संचालन प्रक्रिया') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('program-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                    <div class="col-12 mt-2">
                        <p class="mb-0 p-2 text-center bg-primary">{{ $program->name }}</p>
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
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image"
                                        class="img-fluid" width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('work_order.index',$reg_no)}}">{{ __('कार्यक्रम संचालन विवरण') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/office-icon.png') }}" alt="User Image"
                                        class="img-fluid" width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('work_order.kul_lagat',$reg_no)}}">{{ __('कार्यक्रमको कुल लागत अनुमान') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/office-icon.png') }}" alt="User Image"
                                        class="img-fluid" width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('program.work_order.advance',$reg_no)}}">{{ __('पेश्की भुक्तानी') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/office-icon.png') }}" alt="User Image"
                                        class="img-fluid" width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('program.add_deadline',$reg_no)}}">{{ __('कार्यक्रमको म्याद थप') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image"
                                        class="img-fluid" width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('program.letter',$reg_no)}}">{{ __('पत्रहरु') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/office-icon.png') }}" alt="User Image"
                                        class="img-fluid" width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('program.final_bhuktani',$reg_no)}}">{{ __('अन्तिम भुक्तानी') }}</a>
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
    <script>
        $(function() {
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#table1_wrapper').css("width", "100%");
        });
    </script>
@endsection
