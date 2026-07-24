@extends('admin.index')
@push('custom-css')
@endpush
@section('content')
<style>
    .card-header::after{
        content: unset;
    }
    .card-header a{
        padding: 1rem;
        color: #fff;
        text-decoration: underline !important;
    }
    .owner img{
        border-radius: 50%;
    }
    .owner .info-box{
        gap: 0px
    }
    .owner .info-box .info-box-icon {
        width: 90px;
    }
    tr:has(td.wait) td{
        background:#ff853c8c
    }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row w-100 mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('main.dashboard')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @can('home-list')
      
      @if(auth('admin')->user()->roles->pluck("id")->first() == 11)
        <!-- Small boxes (Stat box) -->
        <div class="row gy-3 mb-3">
            @php $main_resturant = \App\Models\Resturant::where('id',1)->first(); @endphp
            @if($main_resturant)
            <div class="col-12 owner">
                <div class="info-box" style="text-align:start">
                    <a href="{{url('/')}}/admin/resturants/{{$main_resturant->id}}" class="link"></a>
                    <span class="info-box-icon bg-info">
                        @if($main_resturant->getFirstMediaUrl('logo','thumb'))
                            <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $main_resturant->id }}"
                                id="image" src="{{$main_resturant->getFirstMediaUrl('logo','thumb')}}" style="width:70%;"
                                alt="@lang('main.NoImageUploaded')">
                            @include('admin.components.modal_photo', [
                                'image' => $main_resturant->getFirstMediaUrl('logo','thumb'),
                                'id' => $main_resturant->id,
                            ])
                        @else
                            <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                style="height: 80px; width: 100px;">
                        @endif 
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b>{{$main_resturant->name}}</b></span>
                        <span class="info-box-number mt-2">الذهاب السريع لتفاصيل مطعمي</span>
                    </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            @endif
          <div class="col-lg-6 col-md-6 col-6">
            <div class="info-box">
                <a href="{{url('admin/resturant_map')}}" class="link"></a>
                <span class="info-box-icon bg-info">
                    <!--<i class="fas fa-user-cog"></i>-->
                    <i class="fas fa-map-marked-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.resturant_map click here')</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-6 col-md-6 col-6">
            <div class="info-box">
                <a href="{{url('admin/delegate_map')}}" class="link"></a>
                <span class="info-box-icon bg-info">
                    <!--<i class="fas fa-user-cog"></i>-->
                    <i class="fas fa-map-marked-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.delegate_map click here')</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/users?account_type=admin')}}" class="link"></a>
                <span class="info-box-icon bg-info">
                    <!--<i class="fas fa-user-cog"></i>-->
                    <i class="fas fa-user-shield"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.adminsCount')</span>
                    <span class="info-box-number mt-2">{{$adminsCount}}</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/roles')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                  <i class="fas fa-shield-alt"></i>
                </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.rolesCount')</span>
                <span class="info-box-number mt-2">{{$rolesCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/users?account_type=vendor')}}" class="link"></a>
                <span class="info-box-icon bg-info">
                    <i class="fas fa-user-tie"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.vendorsCount')</span>
                    <span class="info-box-number mt-2">{{$vendorsCount}}</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
         
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/categorys?parent=sub')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-warehouse"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.subcategorysCount')</span>
                <span class="info-box-number mt-2">{{$subcategorysCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/categorys?parent=parent')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-parking"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.categorysCount')</span>
                <span class="info-box-number mt-2">{{$categorysCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/orders')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-door-open"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.ordersCount')</span>
                <span class="info-box-number mt-2">{{$ordersCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/pending_vendors')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-braille"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.pending_vendorsCount')</span>
                <span class="info-box-number mt-2">{{$pending_vendorsCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/products')}}" class="link"></a> 
              <span class="info-box-icon bg-info"><i class="fas fa-ticket-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.productsCount')</span>
                <span class="info-box-number mt-2">{{$productsCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/users?account_type=delegate')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-car"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.usersDelegateTypeCatCount')</span>
                <span class="info-box-number mt-2">{{$usersDelegateTypeCatCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/users?account_type=user')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                 <i class="fas fa-id-badge"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.usersUserTypeCatCount')</span>
                <span class="info-box-number mt-2">{{$usersUserTypeCatCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/areas')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-map"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.areasCount')</span>
                <span class="info-box-number mt-2">{{$areasCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/banners')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-gem"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.bannersCount')</span>
                <span class="info-box-number mt-2">{{$bannersCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/resturants')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-question-circle"></i>

              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.resturantsCount')</span>
                <span class="info-box-number mt-2">{{$resturantsCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/question_answers')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-question-circle"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.faqsCount')</span>
                <span class="info-box-number mt-2">{{$faqsCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="{{url('admin/contacts')}}" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-envelope-open-text"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.contactsCount')</span>
                <span class="info-box-number mt-2">{{$contactsCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        
        
              <!-- Custom tabs (Charts with tabs)-->
            <div class="mb-3">
                <div class="card-header d-flex w-100 align-items-center justify-content-between border-0 p-0">
                    <h2 class="card-title p-3">
                        <i class="fas fa-chart-pie mr-1"></i>
                        @lang('main.delegates mostly ordered')
                    </h2>
                    <a href="{{route('users.index',['account_type' => 'delegate'])}}">
                    @lang('main.show all delegates')
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered table-hover">
                                <thead>                             
                                    <th>@lang('main.order_no')</th>
                                    <th>@lang('main.delegate')</th>
                                    <th>@lang('main.status')</th>
                                    <th>@lang('main.details')</th>

                                </thead>
                                <tbody>
                                    @forelse ($delegates_most_ordered as $key => $order)
                                        <tr id="td-{{$order->id}}">
                                            <td>
                                                {{ $order->order_no }}
                                            </td>
                                            <td>
                                                {{ $order->delegate?->name }}
                                            </td>
                                            <td>
                                                {{__('main.'.$order->status)}}
                                            </td>
                                            <td>
                                                <a target="_black" class="btn btn-outline-primary" href="{{route('orders.show',$order->id)}}">@lang('main.more details')</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="8">
                                            {{ trans('main.Noorders') }}
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>
                </div>
             </div>
              
            <div class="mb-3">
                <div class="card-header d-flex w-100 align-items-center justify-content-between border-0 p-0">
                    <h2 class="card-title p-3">
                      <i class="fas fa-chart-pie mr-1"></i>
                      @lang('main.latest orders')
                    </h2>
                    <a href="{{route('orders.index')}}">
                    @lang('main.orders')
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered table-hover">
                                <thead>                             
                                    <th>@lang('main.order_no')</th>
                                    <th>@lang('main.delegate')</th>
                                    <th>@lang('main.status')</th>
                                    <th>@lang('main.details')</th>

                                </thead>
                                <tbody>
                                    @forelse ($latest_orders as $key => $order)
                                        <tr id="td-{{$order->id}}">
                                            <td>
                                                {{ $order->order_no }}
                                            </td>
                                            
                                            @if($order->delegate_from_out == 'out_resturant')
                                            @if($order->status != 'cancelled')
                                            <td>
                                                <span>{{ $order->delegate?->name }}</span>
                                            </td>
                                            @elseif($order->status == 'another_delegate')
                                            <td class="wait" style="background:#ff853c8c">
                                               <span >@lang('main.order-pending')</span> 
                                              </td>
                                               @else
                                            <td>
                                                -
                                            </td>
                                            @endif
                                            
                                            
                                            @elseif($order->delegate_from_out == 'in_resturant')
                                            <td>
                                                @lang('main.in_resturant')
                                            </td>
                                            @else
                                            <td>
                                                -
                                            </td>
                                            @endif
                                            <td>
                                                {{__('main.'.$order->status)}}
                                            </td>
                                            <td>
                                                <a target="_black" class="btn btn-outline-primary" href="{{route('orders.show',$order->id)}}">@lang('main.more details')</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="8">
                                            {{ trans('main.Noorders') }}
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>
                </div>
              </div>

              <div class="mb-3">
                <div class="card-header d-flex w-100 align-items-center justify-content-between border-0 p-0">
                    <h2 class="card-title p-3">
                      <i class="fas fa-chart-pie mr-1"></i>
                      @lang('main.resturants mostly ordered')
                    </h2>
                    <a href="{{route('resturants.index')}}">
                    @lang('main.resturants')</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered table-hover">
                                <thead>                             
                                    <th>@lang('main.order_no')</th>
                                    <th>@lang('main.resturant')</th>
                                    <th>@lang('main.status')</th>
                                    <th>@lang('main.details')</th>

                                </thead>
                                <tbody>
                                    @forelse ($resturants_most_ordered as $key => $order)
                                        <tr id="td-{{$order->id}}">
                                            <td>
                                                {{ $order->order_no }}
                                            </td>
                                            <td>
                                                {{ $order->resturant?->name }}
                                            </td>
                                            <td>
                                                {{__('main.'.$order->status)}}
                                            </td>
                                            <td>
                                                <a target="_black" class="btn btn-outline-primary" href="{{route('orders.show',$order->id)}}">@lang('main.more details')</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="8">
                                            {{ trans('main.Noorders') }}
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>
                </div>
              </div>
        @else
        @if(auth('admin')->user()->base_resturant)
        
        @php $id_returant = Session::put('id_returant',auth('admin')->user()->base_resturant?->id); @endphp
        
        @if(auth('admin')->user()->base_resturant->status == 'disabled')
            <div class="alert alert-danger"><a href="{{route('vendor.get_wallet',['amount' =>auth('admin')->user()->min_wallet ])}}">@lang('main.disabled')</a>  {{auth('admin')->user()->min_wallet}}</div>
        @endif
        
            {{--<form method="post" action="{{route('resturants.updateStatus',auth('admin')->user()->base_resturant->id)}}">
                @csrf
                <select class="form-select col-md-12" name="status" onchange="this.form.submit()">
                    <option value="">@lang('main.choose')</option>
                    <option value="opened" @if(auth('admin')->user()->base_resturant->status == 'opened') selected @endif>@lang('main.opened kitchen')</option>
                    <option value="busy" @if(auth('admin')->user()->base_resturant->status == 'busy') selected @endif>@lang('main.busy kitchen')</option>
                    <option value="closed" @if(auth('admin')->user()->base_resturant->status == 'closed') selected @endif>@lang('main.closed kitchen')</option>
                </select>
            </form>--}}
            <h4 class="m-0 text-dark"> اختر حالة المطعم ({{auth('admin')->user()->base_resturant?->name}})</h4>
            <form method="post" action="{{route('resturants.updateStatus',auth('admin')->user()->base_resturant->id)}}" id="searchTypeToggle" class="my-3">
                @csrf
              <div></div>
              <label>
                <input type="radio" name="status" data-location="0" value="closed" @if(auth('admin')->user()->base_resturant->status == 'closed') checked @endif>
                <div>@lang('main.closed kitchen')</div>
              </label>
              <label>
                <input type="radio" name="status" data-location="calc(100% - 8px)" value="busy" @if(auth('admin')->user()->base_resturant->status == 'busy') checked  @endif>
                <div>@lang('main.busy kitchen')</div>
              </label>
              <label>
                <input type="radio" name="status" data-location="calc(200% - 12px)" value="opened" @if(auth('admin')->user()->base_resturant->status == 'opened') checked @endif>
                <div>@lang('main.opened kitchen')</div>
              </label>
            </form>
            
            <style>
                form {
                    width: 100%;
                    box-sizing: border-box;
                    box-shadow: 0px 1px 2px 1px rgba(0, 0, 0, 0.4);
                    text-align: center;
                    position: relative;
                    background: linear-gradient(41deg, var(--main) 0.31%, var(--main-light) 119.6%) !important;
                    ; border-radius: 3rem;
                    overflow: hidden;
                    color: #fff;
                    /*font-size: 18px;*/
                    /*font-weight: bold;*/
                    padding-inline: 6px; direction: ltr;
                }

                form > div {
                    color: white;
                    padding-top: 24px;
                    display: block;
                    position: absolute;
                    top: 4px;
                    left: 4px;
                    right: 4px;
                    bottom: 6px;
                    width: calc(33.33%);
                    background-color: #fff;
                    border-radius: 139px;
                    z-index: 1;
                    pointer-events: none;
                    transition: transform 0.3s;
                }

                form label {
                    float: left;
                    width: calc(33.333% - 1px);
                    position: relative;
                    padding: 24px 0px 24px;
                    overflow: hidden;
                    transition: color 0.3s;
                    cursor: pointer;
                    margin: 0;
                    -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
                }

                form label div {
                    z-index: 5;
                    position: absolute;
                    top: 50%;
                    right: 50%;
                    transform: translate(50%, -50%);
                    width: 100%;
                }

                form label input {
                    position: absolute;
                    top: -200%;
                }

                form label.selected {
                    color: var(--main);
                    font-weight: bold
                }
                
                @media (max-width: 576px) {
                    form {
                        font-size: 10px;
                        font-weight: lighter;
                        padding-inline: 14px;
                        direction: ltr;
                        text-overflow: ellipsis;
                    }
                    form label div {
                        text-wrap: pretty;
                    }
                }
            </style>
        @endif

        <div class="row gy-3 mb-3">
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a>
                <span class="info-box-icon bg-info">
                    <!--<i class="fas fa-user-cog"></i>-->
                    <i class="fas fa-user-shield"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.balance')</span>
                    <span class="info-box-number mt-2">{{auth('admin')->user()->balance}} @lang('main.egp')</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a>
                <span class="info-box-icon bg-info">
                    <!--<i class="fas fa-user-cog"></i>-->
                    <i class="fas fa-user-shield"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.all_orders')</span>
                    <span class="info-box-number mt-2">{{$all_orders->count()}}</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a> 
              <span class="info-box-icon bg-info">
                  <i class="fas fa-shield-alt"></i>
                </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.pending_orders')</span>
                <span class="info-box-number mt-2">{{$all_orders->where('status','pending')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a>
                <span class="info-box-icon bg-info">
                    <i class="fas fa-user-tie"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('main.accepted_orders')</span>
                    <span class="info-box-number mt-2">{{$all_orders->where('status','accepted')->count()}}</span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
         <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-door-open"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.another_delegate_orders')</span>
                <span class="info-box-number mt-2">{{$all_orders->where('status','another_delegate')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-warehouse"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.shipped_orders')</span>
                <span class="info-box-number mt-2">{{$all_orders->where('status','shipped')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-parking"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.completed_orders')</span>
                <span class="info-box-number mt-2">{{$all_orders->where('status','completed')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="info-box">
                <a href="" class="link"></a> 
              <span class="info-box-icon bg-info">
                <i class="fas fa-door-open"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('main.cancelled_orders')</span>
                <span class="info-box-number mt-2">{{$all_orders->where('status','cancelled')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

            <div class="col-lg-3 col-md-4 col-6">
                <div class="info-box">
                    <a href="" class="link"></a> 
                  <span class="info-box-icon bg-info">
                    <i class="fas fa-door-open"></i>
                  </span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">@lang('main.not_transfer_cash_orders')</span>
                    <span class="info-box-number mt-2">{{$not_transfer_cash_orders}} @lang('main.egp')</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="info-box">
                    <a href="" class="link"></a> 
                  <span class="info-box-icon bg-info">
                    <i class="fas fa-door-open"></i>
                  </span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">@lang('main.transfer_cash_orders')</span>
                    <span class="info-box-number mt-2">{{$transfer_cash_orders}} @lang('main.egp')</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="info-box">
                    <a href="" class="link"></a> 
                  <span class="info-box-icon bg-info">
                    <i class="fas fa-door-open"></i>
                  </span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">@lang('main.total_cash_order')</span>
                    <span class="info-box-number mt-2">{{$total_cash_order}} @lang('main.egp')</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="info-box">
                    <a href="" class="link"></a> 
                  <span class="info-box-icon bg-info">
                    <i class="fas fa-door-open"></i>
                  </span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">@lang('main.total_gain_from_app')</span>
                    <span class="info-box-number mt-2">{{$total_gain_from_app}} @lang('main.egp')</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="info-box">
                    <a href="" class="link"></a> 
                  <span class="info-box-icon bg-info">
                    <i class="fas fa-door-open"></i>
                  </span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">@lang('main.gain_cash')</span>
                    <span class="info-box-number mt-2">{{$gain_cash}} @lang('main.egp')</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="info-box">
                    <a href="" class="link"></a> 
                  <span class="info-box-icon bg-info">
                    <i class="fas fa-door-open"></i>
                  </span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">@lang('main.gain_online')</span>
                    <span class="info-box-number mt-2">{{$gain_online}} @lang('main.egp')</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
         
        </div>
        
        @endif
      @else
    <div style="height:666px">
      
    </div>
     @endcan

     </div>
    </section>
  <!-- /.content-wrapper -->
</div>
@endsection
@push('custom-js')
    @if(auth()->user()->roles->pluck("id")->first() == 11)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        {!! $users_monthlyChart->script() !!}
        {!! $users_yearlyChart->script() !!}
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentStatus = "{{ auth('admin')->user()->base_resturant?->status }}";
            let slider = document.querySelector('#searchTypeToggle > div');
            let labels = document.querySelectorAll('#searchTypeToggle label');
            let input = document.querySelector('input[name="status"]:checked');
            console.log(input)
            if (input) {
                slider.style.transform = `translateX(${input.dataset.location})`;
                labels.forEach(function(label){
                    if (label == input.parentElement) {
                        label.classList.add('selected');
                    } else {
                        label.classList.remove('selected');
                    }
                });
            }
        });

        document.querySelector('#searchTypeToggle').addEventListener('click', function(event){ 
            if (event.target.tagName.toLowerCase() == 'input') {
                
                let input = event.target;
                let slider = this.querySelector('div');
                let labels = this.querySelectorAll('label');
                
                // تحديث موقع السلايدر
                slider.style.transform = `translateX(${input.dataset.location})`;
                
                // إزالة وإضافة class="selected" وتحديد الـ input
                labels.forEach(function(label){
                    let labelInput = label.querySelector('input');
                    if (label == input.parentElement) {
                        label.classList.add('selected');
                        labelInput.checked = true; // تعيين checked للـ input
                    } else {
                        label.classList.remove('selected');
                        labelInput.checked = false; // إزالة checked من الـ input الآخر
                    }
                });
                // تقديم الفورم
                this.submit();
        
            }
        });


    </script>
@endpush