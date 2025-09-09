@extends('admin.index')
@push('custom-css')
    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-auto">
                        <h1 class="m-0 text-dark">{{trans('main.add')}} {{__('main.'.request('account_type'))}}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('admin/users?account_type='.request('account_type')) }}"
                                    class="btn btn-primary">{{trans('main.showAll')}} {{__('main.'.request('account_type'))}}</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @include('admin.layouts.alerts')
                        <div class="card">
                            <div class="card-body" style="opacity: 1;">
                                <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.users.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom-js')
<script type="text/javascript">
   $(document).ready(function () {
             $(document).on('change','#category-dd',function(e){
                var idcategory = $(e.target).val();
                $("#gate-dd").html('');
                $.ajax({
                    url: "{{url('admin/user-fetch-gate')}}",
                    type: "POST",
                    data: {
                        category_id: idcategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $(".gates").html('');
                        $(".gates").html(data.options);
                    }
                });
            });
    });
</script>
@endpush