@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        
        thead th , tbody tr td{
            vertical-align:middle !important;
            text-align:center !important;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.showAll') @lang('main.admin_wallet')  <small class="countModule">({{$wallets->total()}}) </small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="">
                    <div class="card">
                        @push('card_title')
                            @lang('main.admin_wallet')
                        @endpush
                        @include('admin.partials.card_header_in_index')

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>@lang('main.type')</th>
                                    <th>@lang('main.from_user')</th>
                                    <th>@lang('main.to_user')</th>
                                    <th>@lang('main.amount')</th>
                                    <th>@lang('main.payment')</th>
                                    <th>@lang('main.created_at')</th>
                                </thead>
                                <tbody>
                                    @forelse ($wallets as $record)
                                        <tr>
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ __('main.'.$record->type) }}</td>
                                            <td>@if($record->from_user != null) {{$record->from?->name}} @else @lang('main.application') @endif</td>
                                            <td>@if($record->to_user != null) {{$record->to?->name}} @else @lang('main.application') @endif</td>
                                            <td>
                                                {{ round($record->amount,2)}} @lang('main.egp')
                                            </td>
                                            <td>
                                                {{ __('main.'.$record->payment) }}
                                            </td>
                                            <td>
                                                {{ $record->created_at}}
                                            </td>
                                            {{-- @if(! $record->order)
                                            <td>
                                                -
                                            </td>
                                            @else
                                            <td>
                                                <a href="{{route('orders.show',$record->id)}}"><i class="info fa fa-info-circle"></i></a>
                                            </td>
                                            @endif --}}
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="2">
                                            {{ trans('main.NoTransfer') }}
                                        </td>
                                    @endforelse
                                    
                                 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $wallets->withQueryString()->links() }}
            </div>
        </section>
    </div>
@endsection
