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
                        <h1 class="m-0 text-dark">{{trans('main.vendor wallet')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            {{$data['balance']}} @lang('main.egp')
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
                    
                            <div class="table-responsive">
                                
                                        @forelse($wallet as $record)
                                            {{$record->type}}  {{$record->amount}}  {{$record->payment}}  {{$record->created_at->format('Y/m/d')}}
                                        @empty
                                                {{ trans('main.empty data') }}
                                        @endforelse
                            </div>
                    <div class="col-lg-12 col-md-12">
                        @include('admin.layouts.alerts')
                        <div class="card">
                            <div class="card-body" style="opacity: 1;">
                                <form method="post" action="{{ route('vendor.charging_wallet') }}">
                                    @csrf
                                    <div class="row">
                                        <input class="form-control" type="number" required value="{{request('amount')}}" name="amount" min="1" max="5000">
                                    <select class="form-select col-md-12" name="payment_method" required>
                                        <option value="">@lang('main.choose')</option>
                                        <option value="online">@lang('main.visa')</option>
                                        <option value="v_cash">@lang('main.v_cash')</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button type="submit" class="btn btn-success">@lang('main.save')</button>
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
