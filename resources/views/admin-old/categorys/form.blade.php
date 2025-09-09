<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">
    <input type="hidden" name="parent" value="{{request('parent')}}">
@if(request('parent') == 'sub')
<div class="form-group col-sm-6">
    <label for="parent_id"> @lang('main.parent_id')</label><span class="text-danger">*</span>
    <select name="parent_id" class="form-select" required>
        <option value="">@lang('main.choose')</option>
        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $value)
            <option value="{{$value->id}}" @if($value->id == old('parent_id', $category->parent_id)) selected @endif >{{$value->name}}</option>
        @endforeach
    </select>
</div>
@endif
<div class="form-group col-sm-6">
    <label for="name_ar"> @lang('main.catname_ar') </label><span class="text-danger">*</span>
    <input type="text" name="name_ar" value="{{ old('name_ar', $category->name_ar) }}"
        class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('main.enter') @lang('main.name_ar')">
</div>


<div class="form-group col-sm-6">
    <label for="name_en"> @lang('main.catname_en') </label><span class="text-danger">*</span>
    <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}"
        class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('main.enter') @lang('main.name_en')">
</div>
<div class="form-group col-sm-6">
        <label for="status"> @lang('main.status')</label><span class="text-danger">*</span>
        <select name="status" class="form-select">
            <option value="show" @if($category->status == 'show') selected @endif>@lang('main.show')</option>
            <option value="hide" @if($category->status == 'hide') selected @endif>@lang('main.hide')</option>
        </select>
    </div>

</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success">@lang('main.save')</button>
</div>
