<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>

<div class="form-group col-sm-10">
    <label for="question_ar"> @lang('main.faqqAr')</label><span class="text-danger">*</span>
    <input type="text" name="question_ar" class="form-control @error('question_ar') is-invalid @enderror" id="question_ar" placeholder="@lang('main.faqqAr')" value="{{ old('question_ar', $question_answer->question_ar) }}">
</div>

<div class="form-group col-sm-10">
    <label for="answer_ar"> @lang('main.faqAr')</label><span class="text-danger">*</span>
    <textarea rows="10" type="text" name="answer_ar" class="form-control summernote @error('answer_ar') is-invalid @enderror" id="answer_ar" placeholder="@lang('main.faqAr')">{{ old('answer_ar', $question_answer->answer_ar) }}</textarea>
</div>
<div class="form-group col-sm-10">
    <label for="question_en"> @lang('main.faqqEn')</label><span class="text-danger">*</span>
    <input type="text" name="question_en" class="form-control @error('question_en') is-invalid @enderror" id="question_en" placeholder="@lang('main.faqqEn')" value="{{ old('question_en', $question_answer->question_en) }}">
</div>
<div class="form-group col-sm-10">
    <label for="answer_en"> @lang('main.faqEn')</label>
    <textarea rows="10" type="text" name="answer_en" class="form-control summernote @error('answer_en') is-invalid @enderror" id="answer_en" placeholder="@lang('main.faqEn')">{{ old('answer_en', $question_answer->answer_en) }}</textarea>
</div>

<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success">@lang('main.save')</button>
</div>
