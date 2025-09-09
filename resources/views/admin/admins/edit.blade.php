@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-auto">
                        <h1 class="m-0 text-dark">@lang('main.EditAdmin') {{ $admin->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('admins.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllAdmins') </a></li>
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
                        @if (count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('admins.update', $admin->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="name"> @lang('main.AdminName')</label><span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ $admin->name }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name" placeholder="@lang('main.EnterAdminName')">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="email">@lang('main.email')</label><span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ $admin->email }}"
                                            class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('main.EnterEmail')">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="password">@lang('main.password')</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="@lang('main.enter password')">
                                        <button type="button" class="show-pass" toggle="#password">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                    </div>
                                    @if($admin->id != 1)
                                    <div class="form-group col-sm-6">
                                        <label for="roles_name">@lang('main.AdminRole')</label><span class="text-danger">*</span>
                                        <select name="roles_name[]" class="form-control @error('roles_name') is-invalid @enderror">
                                            <option value="">@lang('main.SelecteAdminRole')</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ $role->name == $adminRole ? 'selected' : '' }}>{{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <div class="form-group col-sm-6">
                                        <label for="photo_profile">@lang('main.ProfileImage')</label>

                                        <div class="input-group mb-2">
                                            <input type="file" name="photo_profile" id="photo_profile" class="custom-file-input"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            <label class="custom-file-label" for="photo_profile">{{ trans('main.UploadProfileImage') }}</label>
                                        </div>
                                        <div class="col-sm-6">
                                            @if($admin->getFirstMediaUrl('photo_profile','thumb'))
                                                <img class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $admin->id }}"
                                                    id="image" src="{{$admin->getFirstMediaUrl('photo_profile','thumb')}}" style="width:70%;"
                                                    alt="@lang('main.NoImageUploaded')">
                                                @include('admin.components.modal_photo', [
                                                    'image' => $admin->getFirstMediaUrl('photo_profile','thumb'),
                                                    'id' => $admin->id,
                                                ])
                                            @else
                                                <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                                    style="height: 80px; width: 100px;">
                                            @endif
                                        </div>
    </div>
                                    <div class="form-group col-sm-6">
                                        <button type="submit" class="btn btn-success">@lang('main.save')</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
