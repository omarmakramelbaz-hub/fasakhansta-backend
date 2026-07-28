@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-auto">
                        <h1 class="m-0 text-dark">@lang('main.ShowAdmin') {{ $admin->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('admins.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllAdmins')</a></li>
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
                        <div class="card show-data">
                            <div class="card-body">
                                <div class="form-group col-sm-6">
                                    <label for="email">@lang('main.UserImage') </label>
                                    @if ($admin->getFirstMediaUrl('photo_profile','thumb'))
                                    <img src="{{ $admin->getFirstMediaUrl('photo_profile','thumb') }}" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $admin->id }}" width="10%">
                                    @include('admin.components.modal_photo', [
                                    'image' => $admin->getFirstMediaUrl('photo_profile','thumb'),
                                    'id' => $admin->id,
                                    ])
                                    @else
                                    <span> @lang('main.NoOfferImage')</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-10">
                                    <label for="name"> @lang('main.AdminName')</label>
                                    <span>{{ $admin->name }}</span>
                                </div>
                                <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="email">@lang('main.email')</label>
                                    <input type="email" name="email" value="{{ $admin->email }}" class="form-control"
                                        id="email" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="roles">@lang('main.AdminRole')</label>
                                    <input type="text" name="roles" class="form-control"
                                        value="{{ $admin->getRoleNames()->first() }}" readonly>
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
