@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.ShowRole') {{ $role->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllRoles')</a></li>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group col-sm-10">
                                    <label for="name"> @lang('main.RoleName')</label>
                                    <input type="text" name="name" value="{{ $role->name }}" class="form-control"
                                        id="name" readonly>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label for="roles">@lang('main.Permissions')</label>
                                    <br>
                                    @if (!empty($rolePermissions))
                                    <ol class="roles">
                                        @foreach ($rolePermissions as $v)
                                         <li class="label label-success">{{ trans('permission.' .$v->name) }}</li>
                                        @endforeach
                                    </ol>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
