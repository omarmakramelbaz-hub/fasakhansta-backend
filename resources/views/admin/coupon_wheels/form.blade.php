<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">

<div class="form-group col-sm-6">
    <label for="name"> @lang('main.wheel name') </label>
    <input type="text" name="name" value="{{ old('name', $coupon_wheel->name) }}"
        class="form-control @error('name') is-invalid @enderror" id="name" placeholder="@lang('main.Enter') @lang('main.wheel name')">
</div>

<div class="form-group col-sm-6">
    <label for="price"> @lang('main.wheel price')</label>
    <input type="number" min="1" step="0.01" name="price" value="{{ old('price', $coupon_wheel->price) }}"
        class="form-control @error('price') is-invalid @enderror" id="price" placeholder="@lang('main.Enter') @lang('main.wheel price')">
    <small class="text-muted">الحد الأدنى لقيمة الطلب المؤهل للمسابقة</small>
</div>

<div class="form-group col-sm-6">
    <label for="prize_amount">قيمة الجائزة</label>
    <input type="number" min="0" step="0.01" name="prize_amount" value="{{ old('prize_amount', $coupon_wheel->prize_amount) }}"
        class="form-control @error('prize_amount') is-invalid @enderror" id="prize_amount" placeholder="أدخل قيمة الجائزة">
</div>

<div class="form-group col-sm-6">
    <label for="start_date"> @lang('main.wheel start_date')</label>
    <input type="date" name="start_date" value="{{ old('start_date', $coupon_wheel->start_date) }}"
        class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="@lang('main.Enter') @lang('main.wheel start_date')">
</div>
<div class="form-group col-sm-6">
    <label for="end_date"> @lang('main.wheel end_date')</label>
    <input type="date" name="end_date" value="{{ old('end_date', $coupon_wheel->end_date) }}"
        class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="@lang('main.Enter') @lang('main.wheel end_date')">
</div>
<div class="form-group col-sm-6">
    <label for="name_en"> @lang('main.resturant')</label>
        <select name="restraunt_id[]" multiple class="form-control @error('restraunt_id') is-invalid @enderror">
            <option value="">@lang('main.choose') @lang('main.resturant')</option>
            @foreach(\App\Models\Resturant::get() as $restraunt)
              <option value="{{$restraunt->id}}"{{$coupon_wheel->resturants->count()>0 && $coupon_wheel->resturants()->pluck('resturant_id')->toArray() && in_array($restraunt->id,$coupon_wheel->resturants()->pluck('resturant_id')->toArray())?'selected':''}}>{{$restraunt->name}}</option>
            @endforeach
        </select>
</div>

<div class="form-group col-sm-6">
                  <label for="status"> @lang('main.wheel status')</label><span class="text-danger">*</span>
                  <select name="status" class="form-select">
                      <option value="show" @if($coupon_wheel->status == 'show') selected @endif>@lang('main.show')</option>
                      <option value="hide" @if($coupon_wheel->status == 'hide') selected @endif>@lang('main.hide')</option>
                  </select>
 </div>

<h5 class="name p-3">@lang('main.upload images') </h5>

<div class="upload-wrapper mb-4">
    <div class="upload__box">
      <div class="upload__btn-box row align-items-center">
          <div class="builder-option-name d-flex align-items-center">
              <div>
                  <label class="upload__btn d-inline-block">
                      <input type="file" accept="image/*" name="images"
                          data-max_length="20"
                          class="upload__inputfile">
                  </label>

              </div>
          </div>
      </div>
        <div class="upload__img-wrap">
                <div class="row">
                        @if ($coupon_wheel->getFirstMediaUrl('coupon_wheel_image','thumb') != null)
                                <?php $imageUrl=$coupon_wheel->getFirstMediaUrl('coupon_wheel_image','thumb');?>
                                    <div class=" col-2">
                                        <img class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModal" id="image" style="width:100px;" src="{{ $imageUrl}}" alt="">
                                            @include('admin.components.modal_photo', [
                                                'image' =>$imageUrl,
                                                'id' => $coupon_wheel->id,
                                            ])
                                    </div>

                        @endif
                </div>
        </div>
    </div>
</div>

</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success from-prevent-multiple-submits">@lang('main.save')</button>
</div>
