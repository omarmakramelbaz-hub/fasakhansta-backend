@extends('admin.index')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">صورة هيدر التطبيق</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">صورة الهيدر الرئيسية في شاشة الموبايل</h5>
                    <p class="text-muted">ارفع صورة جديدة ليتم استخدامها مباشرة في هيدر الصفحة الرئيسية للتطبيق. هذه الصورة مستقلة عن سلايدر الصور.</p>

                    @if(!empty($settings->header_image))
                        <div class="mb-4">
                            <img src="{{ url('/storage/'.$settings->header_image) }}" alt="Header" style="max-width:100%;max-height:320px;border-radius:18px;object-fit:cover;">
                        </div>
                    @endif

                    <form method="post" action="{{ route('admin.headerImage.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="header_image">اختيار صورة الهيدر</label>
                            <input type="file" name="header_image" id="header_image" class="form-control" accept="image/*" required>
                            <small class="form-text text-muted">يفضل صورة أفقية عالية الجودة ومتوافقة مع عرض الموبايل.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ صورة الهيدر</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
