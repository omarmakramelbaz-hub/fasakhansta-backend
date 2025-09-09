@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .count-sp{
            color: #e21818;
            font-weight: bolder;
        }
        .btnsuccess{
            background:#50d22c !important;
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
                        <h1 class="m-0 text-dark">{{trans('main.showAll')}} {{__('main.'.request('account_type'))}} <small class="countModule">( {{$users->total()}} )</small></h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            @if(request('account_type') != 'user')
                            @can(request('account_type').'-list')
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin/users/create?account_type='. request('account_type')) }}"
                                    class="btn btn-primary">{{trans('main.add')}} {{__('main.'.request('account_type'))}}</a>
                            </li>
                            @endcan
                            @endif
                        </ol>
                    </div><!-- /.col -->
                    @if(request('account_type') == 'delegate')
                    <div class="col-12">
                        <div class="info-box mt-3" style="text-align: start;margin-bottom: 0 !important;">
                            <a href="{{url('admin/delegate_map')}}" class="link"></a>
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <!--<i class="fas fa-user-cog"></i>-->
                                <i class="fas fa-map-marked-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.delegates on map')</span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                      </div>
                    @endif
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="">
                    <div class="card">
                        @push('card_title')  <span class="count-sp">( {{$users->count()}} )</span>
                        @endpush
                        @include('admin.partials.card_header_in_index')

                        <div class="card-body">
                            {{-- Buttons part --}}
                            @can(request('account_type').'-delete')
                            <div class="btn-group flex-wrap float-left mb-4">
                                @include('admin.partials.button_group', [
                                    'url' => url('admin/usersDeleteAll'),
                                ])
                            </div>
                            @endcan
                            {{-- search part --}}
                            
                            <div class="float-right mb-4">
                                @include('admin.partials.search_part', ['route' => url('admin/users?account_type='. request('account_type')) ])
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th width="50px"><input type="checkbox" id="master"></th>
                                        <th>#</th>
                                        @if(request('account_type') == 'user')
                                        <th>@lang('main.ProfileImage')</th>
                                        @endif
                                        @if(request('account_type') != 'user')
                                        <th>@lang('main.Name')</th>
                                        <th>@lang('main.email')</th>
                                        @endif
                                        <th>@lang('main.mobile')</th>
                                        @if(request('account_type') == 'vendor')
                                        <th>@lang('main.resturants details')</th>
                                        @endif
                                        <th>@lang('main.status of acc')</th>
                                        <th>@lang('main.created_at')</th>
                                        <th>@lang('main.actions')</th>
    
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                @if($user->id > 1)
                                                <td><input type="checkbox" class="sub_chk" data-id="{{ $user->id }}"></td>
                                                @else
                                                <td></td>
                                                @endif
                                                <td>{{ $loop->iteration }}</td>
                                                @if(request('account_type') == 'user')
                                                <td>
                                                    @if($user->gender == 'female')
                                                    <img id="image" src="{{ url('dashboard/dist/img/female_profile.svg') }}"
                                                        style="height: 80px; width: 100px;">
                                                    @elseif($user->gender == 'male')
                                                    <img id="image" src="{{ url('dashboard/dist/img/male_profile.svg') }}"
                                                        style="height: 80px; width: 100px;">
                                                    @endif
                                                </td>
                                                @endif
                                                @if(request('account_type') != 'user')
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                @endif
                                                <td>{{ $user->country_code }}{{ $user->mobile }}+</td>
                                                @if(request('account_type') == 'vendor')
                                                @if(count($user->user_resturants) > 1)
                                                <td> 
                                                    <a class="btn btn-outline-info" href="{{route('resturants.index',['resturant_id' => $user->user_resturants()->first()?->id])}}"> @lang('main.show resturants') </a>
                                                </td>
                                                @elseif(count($user->user_resturants) > 0)
                                                <td><a class="btn btn-outline-info" href="{{route('resturants.index',['resturant_id' => $user->user_resturants()->first()?->id])}}"> @lang('main.show resturant') </a></td>
                                                @else
                                                <td> @lang('main.Noresturants')</td>
                                                @endif
                                                @endif
                                                
                                                <td>
                                                    @if($user->status == 'pending')
                                                    <a href="{{route('users.change-status',[$user->id,'status' => 'accepted'])}}" class="btn btnsuccess">@lang('main.for accepted click here')</a>
                                                    @elseif($user->status == 'accepted')
                                                    <a href="{{route('users.change-status',[$user->id,'status' => 'pending'])}}" class="btn btn-danger">@lang('main.for pending click here')</a>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                                
                                                <td >
                                                    @can(request('account_type').'-list')
                                                        <a class="btn btn-info"
                                                            href="{{ route('users.show', ['account_type' =>request('account_type') , $user->id]) }}">@lang('main.show')</a>
                                                    @endcan
                                                    @can(request('account_type').'-edit')
                                                        <a class="btn btn-warning"
                                                            href="{{ url('admin/users/' . $user->id . '/edit?account_type='.request('account_type')) }}">@lang('main.edit')</a>
                                                    @endcan
                                                    @if($user->id > 1)
                                                    @can(request('account_type').'-delete')
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['users.destroy', 'account_type' => request('account_type'),$user->id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        <button type="submit"
                                                            class="btn btn-danger show_confirm">@lang('main.delete')</button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                {{ trans('main.NoUsers') }}
                                            </td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $users->withQueryString()->links() }}
            </div>
        </section>
    </div>
@endsection
