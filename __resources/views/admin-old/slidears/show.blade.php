@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.ShowSlidear')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('slidears.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllSlidears')</a></li>
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
                                    <label for="email">@lang('main.slidearImage')</label>
                                    @if ($slidear->getFirstMediaUrl('slidear_image','thumb'))
                                          @foreach($slidear->getMedia('slidear_image') as $key=> $val)
                                                 <?php $imageUrl=url('/storage/slidears/'.$val->id.'/'.$val->file_name);?>
                                                    <img class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}" id="image" style="width:100px;" src="{{ $imageUrl}}" alt="">
                                                        @include('admin.components.modal_photo', [
                                                            'image' => $imageUrl,
                                                            'id' => $key,
                                                        ])
                                        @endforeach
                                    @else
                                        <span> @lang('main.NoOfferImage')</span>
                                    @endif
                                </div>

                                <div class="form-group col-sm-10">
                                    <label> @lang('main.publisher')</label>
                                    <span>{{$slidear->admin?->name}}</span>
                                </div>
                                 <div class="form-group col-sm-10">
                                    <label> @lang('main.resturant')</label>
                                    <span>{{$slidear->restraunt?->name}}</span>
                                </div>
                              
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.title')</label>
                                    <span>{{$slidear->title}}</span>
                                </div>

                                          
                              
                                
                                
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
