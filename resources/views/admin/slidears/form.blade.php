<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">

<div class="form-group col-sm-6">
    <label for="title"> @lang('main.title') (@lang('main.optional'))</label>
    <input type="text" name="title" value="{{ old('title', $slidear->title) }}"
        class="form-control @error('title') is-invalid @enderror" id="title" placeholder="@lang('main.Enter') @lang('main.slidearTitleAr')">
</div>

<div class="form-group col-sm-6">
    <label for="title_en"> @lang('main.resturant')</label>
        <select name="restraunt_id" class="form-control @error('restraunt_id') is-invalid @enderror">
            <option value="">@lang('main.choose') @lang('main.resturant')</option>
            @foreach(\App\Models\Resturant::get() as $restraunt)
              <option value="{{$restraunt->id}}"{{old('restraunt_id',$slidear->restraunt_id)==$restraunt->id?'selected':''}}>{{$restraunt->name}}</option>
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
                      <input type="file" accept="images/*" name="images[]"
                          multiple="" data-max_length="20" value="{{$slidear->images}}"
                          class="upload__inputfile">
                  </label>

              </div>
          </div>
      </div>
        <div class="upload__img-wrap">
                <div class="row">
                        @if ($slidear->getMedia('slidear_image') != null)
                            @foreach($slidear->getMedia('slidear_image') as $key=> $val)
                                <?php $imageUrl=url('/storage/slidears/'.$val->id.'/'.$val->file_name);?>
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
