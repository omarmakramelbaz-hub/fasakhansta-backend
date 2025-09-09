@extends('admin.index')
@push('custom-css')
<style type="text/css">
    .price{
        position: relative;
        top: -30px;
        right: 89%;
        font-weight:bolder;
    }
    .clone-row .row:first-child .btn-del-select {
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
                <div class="row gy-3 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.edit') @lang('main.resturant')</h1>
                        
                    </div><!-- /.col -->
                    <div class="col-6">
                    
  @can('resturant-list')
          <li class="breadcrumb-item">
            <ol class="breadcrumb float-sm-left"><a href="{{ url('admin/resturants?resturant_id='.request('resturant_id'))}}" class="btn btn-primary">@lang('main.showAll') 
             @if( request('resturant_id'))
             @lang('main.branches')
             @else
            @lang('main.resturants')  @endif</a>                         </ol>
    </li>
    @endcan                    </div><!-- /.col -->
                    <div class="col">
                        <a class="btn btn-outline-warning" href="{{route('resturants.show',[$resturant->id])}}">@lang('main.you can add menu')</a>
                    </div> 
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @include('admin.layouts.alerts')
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('resturants.update', $resturant->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('admin.resturants.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom-js')
<script type="text/javascript">
    //   $(".btn-del-select").click(function(e) {
    //                 $(this).closest(".clone").remove();
    //                 e.preventDefault();
    //             });
    //  $(".add-select").click(function() {
    //                 // $(".copydiv .clone:last").clone(true).insertBefore(this);
    //                 const index = $(".clone").length;
    //                 console.log(index)
    //                 if(index === 1){
    //                 $(".clone-row").append($(".copydiv .clone:first").clone(true));
                        
    //                 }
    //                 $(".clone-row .clone:last select").removeAttr('disabled');
    //                 $(".clone-row .clone:last label.expected_delivery").text('@lang("main.expected_delivery")');
    //             });
    
    
    $(".add-select").click(function() {
        console.log('Adding new row');
        var clone = $(".copydiv").html(); // Get the HTML content of the template
        var $clone = $(clone); // Convert it to a jQuery object
        $(".clone-row").append($clone); // Append the cloned element to .clone-row
        $(".clone-row .clone:last select").removeAttr('disabled'); // Enable the select element in the new row
        $(".clone-row .clone:last label.expected_delivery").text('@lang("main.expected_delivery")'); // Update the label text
        $('.clone-row .areas').select2();
    });

    // Handle click event for deleting rows
    $(document).on('click', '.btn-del-select', function(e) {
        $(this).closest(".row").remove(); // Remove the closest .row.clone element
        e.preventDefault(); // Prevent default action
    });   
    </script>
@endpush