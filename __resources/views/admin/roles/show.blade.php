@extends('admin.index')
@section('content')

    <style>
        .permissions-tree {
            list-style-type: none;
            padding-left: 0;
        }
        
        .permissions-tree li {
            margin: 5px 0;
            position: relative;
        }
        
        .permissions-tree .parent {
            font-weight: bold;
            color: var(--main);
            padding-left: 20px;
            cursor: pointer;
            font-size: large;
        }
        
        .permissions-tree .child {
            color: #555;
            padding-left: 30px;
        }
        
        .permissions-tree li > ul {
            padding-left: 20px;
            margin-top: 5px;
            display: none; /* Hide children by default */
        }
        
        .permissions-tree .parent:before {
            content: "\25BC"; /* Down triangle (▼) */
            font-size: 14px;
            color: var(--main);
            margin-inline-end: 6px;
            cursor: pointer;
        }
        
        .permissions-tree .child:before {
            content: "-"; /* (-) */
            margin-inline-end:8px;
        }
        
        .permissions-tree .parent.open > ul {
            display: block; /* Show children when parent is clicked */
        }

    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.ShowRole') {{ $role->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllRoles')</a></li>
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
                                <div class="form-group">
                                    <label for="name"> @lang('main.RoleName')</label>
                                    <input type="text" name="name" value="{{ $role->name }}" class="form-control"
                                        id="name" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="roles">@lang('main.Permissions')</label>
                                    <br>
                                    @if (!empty($rolePermissions))
                                    <div class="permissions-tree">
                                        @php
                                            // إنشاء مصفوفة لتخزين الأبناء لكل أب
                                            $parentPermissions = [];
                                        @endphp

                                        @foreach ($rolePermissions as $v)
                                            @php
                                                // تقسيم اسم الإذن إلى parent و child
                                                $permissionParts = explode('-', $v->name);
                                                $parent = $permissionParts[0]; // الأب
                                                $child = $permissionParts[1] ?? null; // الابن (إذا كان موجودًا)
                                                
                                                // إضافة الإذن إلى المصفوفة بناءً على الأب
                                                if ($child) {
                                                    $parentPermissions[$parent][] = $v;
                                                } else {
                                                    $parentPermissions[$parent] = [];
                                                }
                                            @endphp
                                        @endforeach

                                        <!-- عرض الأذونات في شكل شجرة -->
                                        @foreach ($parentPermissions as $parent => $children)
                                            <ul class="my-3">
                                                <li class="parent open"><strong>{{ trans('permission.' . $parent) }}</strong></li>
                                                @if (!empty($children))
                                                    <ul class="ms-4">
                                                        @foreach ($children as $childPermission)
                                                            <li class="child">{{ trans('permission.' . $childPermission->name) }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </ul>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
