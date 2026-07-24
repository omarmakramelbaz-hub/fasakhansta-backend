@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.show') @lang('main.question_answers')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            @can('question_answer-list')
                               <li class="breadcrumb-item"><a href="{{ url('admin/question_answers') }}" class="btn btn-primary">@lang('main.showAll')  @lang('main.question_answers')
                                    </a></li>  
                            @endcan                          
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
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.addedBy')</label>
                                    <span>{{ $question_answer->admin->name }}</span>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.faqqAr')</label>
                                    <span>{!! $question_answer->question_ar!!}</span>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label> @lang('main.faqAr')</label>
                                    <span>{!! $question_answer->answer_ar!!}</span>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label> @lang('main.faqqEn')</label>
                                    <span>{!! $question_answer->question_en!!}</span>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label> @lang('main.faqEn')</label>
                                    <span>{!! $question_answer->answer_en!!}</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
