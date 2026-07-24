@extends('admin.index')
@section('content')
    <style>
        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 4px !important;
        }
        .form-check-input,
        .accordion-button{
            box-shadow: none !important;
        }
        .form-check-input:checked {
            border-color: var(--main);
            background-color: var(--main);
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.EditRole') {{ $role->name }}</h1>
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
                                <form method="post" action="{{ route('roles.update', $role->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name"> @lang('main.RoleName')</label><span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ $role->name }}"
                                            class="form-control" id="name" placeholder="Enter name">
                                    </div>

                                    <!-- Accordion for Permissions -->
                                    <div class="accordion" id="permissionsAccordion">
                                        @for($i = 0; $i < count(permissionArrayLoop()); $i++)
                                            <div class="accordion-item mb-2 border-0">
                                                <h2 class="accordion-header bg-light px-3 d-flex align-items-center" id="heading-{{ $i }}">
                                                    <!-- Group Select Checkbox (No Label) -->
                                                    <input type="checkbox" id="cbx-select-group-{{ permissionArrayLoop()[$i] }}" name="permi" value="{{ permissionArrayLoop()[$i] }}" class="form-check-input position-relative m-0 {{ permissionArrayLoop()[$i] }} cbx-select-group" @if(in_array(permissionArrayLoop()[$i], $rolePermissions)) checked @endif>
                                                    <!-- Accordion Button -->
                                                    <button class="accordion-button collapsed bg-transparent pe-0 ps-2 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $i }}" aria-expanded="false" aria-controls="collapse-{{ $i }}">
                                                        <i class="fas fa-user-shield me-2"></i>
                                                        {{ trans('permission.' . permissionArrayLoop()[$i]) }}
                                                    </button>
                                                </h2>
                                                <div id="collapse-{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $i }}">
                                                    <div class="accordion-body">
                                                        <!-- Child Permissions -->
                                                            @foreach ($permission as $value)
                                                                @if(explode('-', $value->name)[0] == permissionArrayLoop()[$i])
                                                                    <div class="form-check">
                                                                        <input type="checkbox" value="{{ $value->id }}" id="cbx-group-{{ permissionArrayLoop()[$i] }}" name="permission[]" class="cbx-group cbx-group-{{ permissionArrayLoop()[$i] }}  form-check-input position-relative vendor cbx-select-group m-0" @if(in_array($value->id, $rolePermissions)) checked @endif>
                                                                        <label class="form-check-label ms-2">{{ trans('permission.' . $value->name) }}</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
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
    });

    // select group
    $('.cbx-select-group').on('click', function() {
        var selectedGroup = $(this).val();
        $('.cbx-group-' + selectedGroup).prop('checked', $(this).prop('checked'));
        checkAllState();
    });

    // select item
    $('[id^=cbx-group-]').on('click', function() {
        checkAllState();
        ifSelected();
    });

    // update select-all check state
    function checkAllState() {
        if ($('.cbx-group:checked').length == totalCheckboxes) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
    }

    function ifSelected() {
        $('[id^=cbx-select-group-]').each(function() {
            let group = $(this).val();
            totalGroupCheckbox = $('.cbx-group-' + group).length,
            totalGroupSelected = $('.cbx-group-' + group + ':checked').length;
            if (totalGroupSelected == totalGroupCheckbox) {
                $('#cbx-select-group-' + group).prop('checked', true);
            } else {
                $('#cbx-select-group-' + group).prop('checked', false);
            }
        });
    }

    checkAllState();
    ifSelected();

    // Open accordion if it contains checked checkboxes
    $(document).ready(function() {
        $('.accordion-item').each(function() {
            var groupId = $(this).find('input[type=checkbox]').val();
            if ($(this).find('input[type=checkbox]:checked').length > 0) {
                $(this).find('.accordion-collapse').collapse('show');
            }
        });
    });
</script>
@endpush