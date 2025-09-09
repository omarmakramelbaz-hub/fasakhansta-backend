<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">
<div class="form-group col-sm-6">
    <label for="title_ar"> @lang('main.title_ar')</label><span class="text-danger">*</span>
    <input type="text" name="title_ar" value="{{ old('title_ar', $banner->title_ar) }}"
        class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="">
</div>

<div class="form-group col-sm-6">
    <label for="title_en"> @lang('main.title_en')</label><span class="text-danger">*</span>
    <input type="text" name="title_en" value="{{ old('title_en', $banner->title_en) }}"
        class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="">
</div>

<div class="form-group col-sm-6">
        <label for="status"> @lang('main.status')</label><span class="text-danger">*</span>
        <select name="status" class="form-select">
            <option value="show" @if($banner->status == 'show') selected @endif>@lang('main.show')</option>
            <option value="hide" @if($banner->status == 'hide') selected @endif>@lang('main.hide')</option>
        </select>
    </div>

<div class="form-group col-sm-6">
        <label for="image">@lang('main.image')</label>

        <div class="input-group mb-2">
            <input type="file" name="image" id="image" class="custom-file-input"
                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
            <label class="custom-file-label" for="image">{{ trans('main.UploadProfileImage') }}</label>
        </div>
        <div class="col-sm-6">
            @if($banner->getFirstMediaUrl('image','thumb'))
                <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $banner->id }}"
                    id="image" src="{{$banner->getFirstMediaUrl('image','thumb')}}" style="width:70%;"
                    alt="@lang('main.NoImageUploaded')">
                @include('admin.components.modal_photo', [
                    'image' => $banner->getFirstMediaUrl('image','thumb'),
                    'id' => $banner->id,
                ])
            @else
                <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                    style="height: 80px; width: 100px;">
            @endif
        </div>
    </div>
</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success">@lang('main.save')</button>
</div>
