@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.AddRole')</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllRoles') </a></li>
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
                                <form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-sm-10">
                                        <label for="name"> @lang('main.RoleName')</label><span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" id="name" placeholder="@lang('main.EnterRoleName')">
                                    </div>

                                    <div class="form-group col-sm-10">
                                        <label for="name"> @lang('main.Permissions')</label><span class="text-danger">*</span></br>
                                        <label><input type="checkbox" name="selectAll" id="selectAll">
                                            @lang('main.selectAll')
                                        </label>
                                        <div>
                                    
                                        @for($i = 0; $i < count(permissionArrayLoop()) ; $i++)
                                        <label>
                                        <input type="checkbox" id="cbx-select-group-{{permissionArrayLoop()[$i] }}" name="permi" value="{{permissionArrayLoop()[$i] }}" class="{{permissionArrayLoop()[$i] }} cbx-select-group">    

                                       
                                                {{ trans('permission.' . permissionArrayLoop()[$i]) }}</label>
                                        <div class="mr-4">
                                            @foreach ($permission as $value)
                                            @if(explode('-',$value->name)[0] == permissionArrayLoop()[$i])
                                                <label>
                                                <input type="checkbox" value="{{$value->id}}" id="cbx-group-{{permissionArrayLoop()[$i] }}" name="permission[]" class="cbx-group cbx-group-{{permissionArrayLoop()[$i] }}"  >   
                                                    {{ trans('permission.' . $value->name) }}</label>
                                                <br />
                                            @endif
                                            @endforeach
                                        </div>
                                        @endfor
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
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
@push('custom-js')
<script type="text/javascript">
    // selected checkbox data
    totalCheckboxes = $('.cbx-group').length;

    // select all
    $('#selectAll').on('click', function() {
    $('input[type=checkbox]').prop('checked', $(this).prop('checked')); 
    })

    // select group
    $('.cbx-select-group').on('click', function() {
    var selectedGroup = $(this).val();
    $('.cbx-group-'+selectedGroup).prop('checked', $(this).prop('checked'));
    checkAllState();
    })

    // select item
    $('[id^=cbx-group-]').on('click', function() {
    checkAllState();
    ifSelected()
    })

    // update select-all check state
    function checkAllState() {
    console.log('check all state')
    if ($('.cbx-group:checked').length == totalCheckboxes) {
        $('#selectAll').prop('checked', true)
    } else {
        $('#selectAll').prop('checked', false)
    }
    }

    function ifSelected(){
    $('[id^=cbx-select-group-]').each(function(){
    let group = $(this).val()
    totalGroupCheckbox = $('.cbx-group-'+group).length,
        totalGroupSelected = $('.cbx-group-'+group+':checked').length;
    if (totalGroupSelected == totalGroupCheckbox) {
        $('#cbx-select-group-'+group).prop('checked', true)
    } else {
        $('#cbx-select-group-'+group).prop('checked', false)
    }
    
    console.log(totalGroupCheckbox)
    console.log(group);
    })
    }
    checkAllState()
    ifSelected()
</script>
@endpush