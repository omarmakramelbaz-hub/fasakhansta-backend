<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">

<div class="form-group col-sm-6">
    <label for="from_date"> @lang('main.from_date')</label>
    <input type="datetime-local" name="from_date" value="{{ old('from_date', $advertising->from_date) }}"
        class="form-control @error('from_date') is-invalid @enderror" id="from_date">
</div>
<div class="form-group col-sm-6">
    <label for="to_date"> @lang('main.to_date')</label>
    <input type="datetime-local" name="to_date" value="{{ old('to_date', $advertising->to_date) }}"
        class="form-control @error('to_date') is-invalid @enderror" id="to_date">
</div>
<div class="form-group col-sm-6">
    <label for="title_en"> @lang('main.resturant')</label>
        <select name="resturant_id" class="form-control @error('resturant_id') is-invalid @enderror">
            <option disabled selected>@lang('main.choose') @lang('main.resturant')</option>
            @foreach(\App\Models\Resturant::get() as $restraunt)
              <option value="{{$restraunt->id}}"{{old('resturant_id',$advertising->resturant_id)==$restraunt->id?'selected':''}}>{{$restraunt->name}}</option>
            @endforeach
        </select>
</div>

<h5 class="title p-3">@lang('main.upload images') </h5>

<div class="upload-wrapper mb-4">
    <div class="upload__box">
      <div class="upload__btn-box row align-items-center">
          <div class="builder-option-name d-flex align-items-center">
              <div>
                  <label class="upload__btn d-inline-block">
                      <input type="file" accept="image/*" name="images[]"
                          data-max_length="20" value="{{$advertising->images}}" 
                          class="upload__inputfile">
                  </label>

              </div>
          </div>
      </div>
        <div class="upload__img-wrap">
                <div class="row">
                        @if ($advertising->getMedia('advertising_image') != null)
                            @foreach($advertising->getMedia('advertising_image') as $key=> $val)
                                <?php $imageUrl=url('/storage/advertisings/'.$val->id.'/'.$val->file_name);?>
                                    <div class="delete-img{{$val->id}} col-2">
                                        <div class="del-image" data-id="{{$val->id}}"><i class="fas fa-times"></i></div>
                                        <img class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}" id="image" style="width:100px;" src="{{ $imageUrl}}" alt="">
                                            @include('admin.components.modal_photo', [
                                                'image' =>$imageUrl,
                                                'id' => $key,
                                            ])
                                    </div>
                            @endforeach
                        @endif
                </div>
        </div>
    </div>
</div>


</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success from-prevent-multiple-submits">@lang('main.save')</button>
</div>
