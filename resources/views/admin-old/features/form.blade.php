<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">
<div class="form-group col-sm-6">
    <label for="title_ar"> @lang('main.title_ar')</label><span class="text-danger">*</span>
    <input type="text" name="title_ar" value="{{ old('title_ar', $feature->title_ar) }}"
        class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="">
</div>

<div class="form-group col-sm-6">
    <label for="title_en"> @lang('main.title_en')</label><span class="text-danger">*</span>
    <input type="text" name="title_en" value="{{ old('title_en', $feature->title_en) }}"
        class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="">
</div>
<div class="form-group col-sm-12">
    <label for="text_ar"> @lang('main.text_ar')</label><span class="text-danger">*</span>
    <textarea name="text_ar" 
        class="form-control @error('text_ar') is-invalid @enderror" id="text_ar" placeholder="">{{ old('text_ar', $feature->text_ar) }}</textarea>
</div>
<div class="form-group col-sm-12">
    <label for="text_en"> @lang('main.text_en')</label><span class="text-danger">*</span>
    <textarea name="text_en"
        class="form-control @error('text_en') is-invalid @enderror" id="text_en" placeholder="">{{ old('text_en', $feature->text_en) }}</textarea>
</div>

<div class="form-group col-sm-6">
        <label for="status"> @lang('main.status')</label><span class="text-danger">*</span>
        <select name="status" class="form-select">
            <option value="show" @if($feature->status == 'show') selected @endif>@lang('main.show')</option>
            <option value="hide" @if($feature->status == 'hide') selected @endif>@lang('main.hide')</option>
        </select>
    </div>

</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success">@lang('main.save')</button>
</div>
