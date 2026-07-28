@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.showAll') @lang('main.wallets')
           
            <small class="countModule">( {{$wallets->count()}} ) </small>
                        </h1>
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
                           >@lang('main.Withdraw from Wallet')
                        @endpush
                        @include('admin.partials.card_header_in_index')
                            <div class="card-body">
                                <form method="post" action="{{ route('wallets.withdraw.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.wallets.withdraw_form')
                                </form>
                            </div>
                        <div class="card-body">
                            
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>#</th>
                                        <!--<th>@lang('main.to_user')</th>-->
                                        <th>@lang('main.from_user')</th>
                                        <th>@lang('main.amount')</th>
                                        <th>@lang('main.actions')</th>
    
                                    </thead>
                                    <tbody>
                                        @forelse ($wallets as $wallet)
                                            <tr>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <!--<td>-->
                                                <!--    @lang('main.wallets')-->
                                                <!--</td>-->
                                                <td>
                                                    {{$wallet->from?->name }}
                                                </td>
                                                <td>
                                                    {{$wallet->amount}} @lang('main.egp')
                                                </td>
                                                <td>
                                                    {{$wallet->created_at->diffForHumans()}}
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                {{ trans('main.Nowallets') }}
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
@push('custom-js')
<script>
$(".from_user").on('change',function(){
var max=$(this).find(':selected').data('balance');
$("#amount").attr('max',max);
})
</script>
@endpush

