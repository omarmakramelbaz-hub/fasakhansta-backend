<div class="row">
    <input type="hidden" name="parent_id" value="{{$parent}}"/>
    <input type="hidden" name="added_by" value="{{auth('admin')->user()->id}}"/>
<div class="form-group col-sm-6">
    <label for="title_ar"> @lang('main.title_ar')</label>
    <input type="text" name="title_ar" value="{{ old('title_ar', $area->title_ar) }}"
        class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="@lang('main.Enter') @lang('main.title_ar')">
</div>

<div class="form-group col-sm-6">
    <label for="title_en"> @lang('main.title_en')</label>
    <input type="text" name="title_en" value="{{ old('title_en', $area->title_en) }}"
        class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="@lang('main.Enter') @lang('main.title_en')">
</div>


</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success from-prevent-multiple-submits">@lang('main.save')</button>
</div>
