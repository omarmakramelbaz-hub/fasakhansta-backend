@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.Showcoupon_wheel')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('coupon_wheels.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllcoupon_wheels')</a></li>
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
                                    <label for="email">@lang('main.coupon_wheelImage')</label>
                                    @if ($coupon_wheel->getFirstMediaUrl('coupon_wheel_image','thumb'))
                                                 <?php $imageUrl=$coupon_wheel->getFirstMediaUrl('coupon_wheel_image','thumb');?>
                                                    <img class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModal" id="image" style="width:100px;" src="{{ $imageUrl}}" alt="">
                                                        @include('admin.components.modal_photo', [
                                                            'image' => $imageUrl,
                                                            'id' => $coupon_wheel->id,
                                                        ])
                                        
                                    @else
                                        <span> @lang('main.NoOfferImage')</span>
                                    @endif
                                </div>

                                <div class="form-group col-sm-10">
                                    <label> @lang('main.publisher')</label>
                                    <span>{{$coupon_wheel->admin?->name}}</span>
                                </div>
                                 <div class="form-group col-sm-10">
                                    <label> @lang('main.resturant')</label>
                                    <span>
                                    @foreach($coupon_wheel->resturants as $x=>$restraunt)
                                     {{ $restraunt->resturant->name }} {{$x < $coupon_wheel->resturants->count()-1?'-':''}}
                                    @endforeach
                                    </span>
                                </div>
                              
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.wheel name')</label>
                                    <span>{{$coupon_wheel->name}}</span>
                                </div>
                                
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.wheel price')</label>
                                    <span>{{$coupon_wheel->price}}</span>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.wheel start_date')</label>
                                    <span>{{$coupon_wheel->start_date}}</span>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.wheel end_date')</label>
                                    <span>{{$coupon_wheel->end_date}}</span>
                                </div>
                                
                                <table class="table table-responsive table-bordered table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>@lang('main.user')</th>
                                    <th>@lang('main.user_coupon_code')</th>
                                    <th>@lang('main.grand_total')/@lang('main.orders_count')</th>
                                    <th>@lang('main.customer,email,mobile')</th>
                                    <th>@lang('main.status')</th>
                                </thead>
                                <tbody>
                                    @forelse ($coupon_wheel->subscripes()->orderBy('status','desc')->get() as $subscripe)
                                       @if($subscripe->user?->orders->where('coupon_wheel_id',$coupon_wheel->id)->sum('grand_total') >0)
                                        <tr class="{{$subscripe->status=='winner'?'bg-success':''}}">
                                            
                                            <td class="{{$subscripe->status=='winner'?'bg-success':''}}">{{ $loop->iteration }}</td>
                                            <td class="{{$subscripe->status=='winner'?'bg-success':''}}"><a href="{{url('/admin/users/'.$subscripe->user?->id.'/?account_type='.$subscripe->user?->account_type)}}">{{ $subscripe->user?->name }}</a></td>
                                            <td class="{{$subscripe->status=='winner'?'bg-success':''}}">{{ $subscripe->user_coupon_code }}</td>
                                            <td class="{{$subscripe->status=='winner'?'bg-success':''}}">
                                                <p >{{ $subscripe->user?->orders->where('coupon_wheel_id',$coupon_wheel->id)->sum('grand_total') }} @lang('main.egp')/{{ $subscripe->user?->orders->where('coupon_wheel_id',$coupon_wheel->id)->count() }} </p>

                                            </td>
                                            
                                            <td class="{{$subscripe->status=='winner'?'bg-success':''}}">
                                                @if($subscripe->user)
                                                <p>{{ $subscripe->user?->name }}</p>
                                                <p><a href="mailto:{{ $subscripe->user?->email }}">{{ $subscripe->user?->email }}</a></p>
                                                <p><a href="tel:{{ $subscripe->user?->mobile }}">{{ $subscripe->user?->mobile }}</a></p>
                                                @endif
                                            </td>
                                            <td class="{{$subscripe->status=='winner'?'bg-success':''}}"> @if($subscripe->status) @lang('main.'.$subscripe->status) @endif</td>
                                            
                                        </tr>
                                          @endif
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="8">
                                            {{ trans('main.Nosubscripes') }}
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>

                                          
                              
                                
                                
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
