@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.edit') @lang('main.advertising')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('advertisings.index') }}"
                                    class="btn btn-primary">@lang('main.showAll') @lang('main.advertisings') </a></li>
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
                        @include('admin.layouts.alerts')
                        <div class="card">
                            <div class="card-body">
                                <form class="from-prevent-multiple-submits" method="post" action="{{ route('advertisings.update', $advertising->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('admin.advertisings.form')
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
<script>
$('.del-image').on('click',function(){
            
            var id = $(this).attr('data-id');
            console.log(id);
            console.log(id);
            swal({
                title: `هل انت متاكد من حذف هذا العنصر ؟`,
                text: "أذا قمت بحذف هذا العنصر لن تتمكن من استرجاعه مره اخرى !",
                icon: "warning",
                buttons: ['لا', 'نعم'],
                dangerMode: true,
              }).then((result) => {
                  if (result) {
                      $.ajax({
                      url:"{{ url('/admin/advertisings/del/image')}}",
                      type:'delete',
                      data:{ _token:"{{ csrf_token() }}","id":id,"advertising_id":"{{$advertising->id}}" },
                      success:function(data){  
                        console.log(data);
                          swal({
                          position: 'center',
                          icon: 'success',
                          title: "@lang('messages.DeleteSuccessfully')",
                          showConfirmButton: false,
                          timer: 1500,
                          })
                          $(".delete-img"+id).remove();
                      },
                      error:function(data){
                        console.log(data);
                          swal({
                            title: `حصل خطأ`,
                            icon: "warning",
                          showConfirmButton: false,
                          timer: 1500,
                          })
                      
                      }
                  });
              }
            });
    });
</script>
@endpush