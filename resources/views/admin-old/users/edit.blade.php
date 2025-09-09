@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2  mb-2">
                    <div class="col-auto">
                        <h1 class="m-0 text-dark">@lang('main.edit') {{__('main.'.request('account_type'))}}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                           @can(request('account_type').'-list')
                            <li class="breadcrumb-item"><a
                                    href="{{ url('admin/users?account_type='.request('account_type'))}}"
                                    class="btn btn-primary">@lang('main.showAll') {{__('main.'.request('account_type'))}} </a></li>
                           @endcan
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
                            <div class="card-body" style="opacity: 1">
                                <form method="post" action="{{ route('users.update', ['account_type' => request('account_type'),$user->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('admin.users.form')
                                </form>
                                
                                
<!-- Modal -->
<div class="modal fade" id="changeMobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> @lang('main.change mobile')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('vendor.UpdatePhone')}}">
            @csrf
        <div class="col-md-12">
            <label for="mobile"> @lang('main.mobile')</label><span class="text-danger">*</span>
            <span class="country_code">20+</span>
            <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}" class="form-control @error('mobile') is-invalid @enderror"
                id="mobile" placeholder="@lang('main.enter') @lang('main.mobile')">
        </div>
        <div class="form-group col-sm-6">
            <label for="password"> @lang('main.current_password')</label><span class="text-danger">*</span>
            <input type="password" name="current_password" value=""
                class="form-control @error('password') is-invalid @enderror" id="password" required
                placeholder="@lang('main.EnterPassword')">
            <button type="button" class="show-pass" toggle="#password">
                <i class="fa fa-eye-slash"></i>
            </button>
        </div>
        
        <div class="form-group col-sm-6">
            <label for="password"> @lang('main.password_confirmation')</label><span class="text-danger">*</span>
            <input type="password" name="password_confirmation" value=""
                class="form-control @error('password') is-invalid @enderror" id="password" required
                placeholder="@lang('main.EnterPassword')">
            <button type="button" class="show-pass" toggle="#password">
                <i class="fa fa-eye-slash"></i>
            </button>
        </div>
            <button type="sumbit" class="btn btn-primary">@lang('main.Save changes')</button>
        </form>
      </div>
    </div>
  </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom-js')
<script>
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