<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row">

    @if(request()->route()->getName() == 'resturants.edit')
    <div class="form-group col-sm-6">
        <label for="user_id"> @lang('main.choose vendor')</label><span class="text-danger">*</span>
        <input type="hidden" name="user_id" class="form-control" value="{{$resturant->user_id}}">
        <input type="text" readonly class="form-control" value="{{$resturant->user?->name}}">
    </div>
    @else
        {{--@if(! request('resturant_id'))--}}
                <div class="form-group col-sm-6">
                    <label for="user_id"> @lang('main.choose vendor')</label><span class="text-danger">*</span>
                    <select class="form-select" name="user_id">
                    @foreach(\App\Models\User::has('user_resturants','=',0)->where('account_type','vendor')->get() as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                </div>
        {{--@endif--}}
    @endif
<div class="form-group col-sm-6">
    @if(request('resturant_id'))
    @php $parent_resturant = App\Models\Resturant::where('id',request('resturant_id'))->first(); @endphp
    <input type="hidden" name="parent_id" value="{{$parent_resturant->id}}">
    @endif
    <label for="name"> @lang('main.resturant_name') </label><span class="text-danger">*</span>
    <input type="text" name="name"  @if(request('resturant_id')) value="{{$parent_resturant->name}}" @else value="{{ old('name', $resturant->name) }}" @endif
        class="form-control @error('name') is-invalid @enderror" id="name" placeholder="">
</div>

<div class="form-group col-sm-6">
    <label for="delivery_time"> @lang('main.delivery_time') <small>(@lang('main.Approximate delivery time'))</small></label><span class="text-danger">*</span>
    <input type="text" name="delivery_time" value="{{ old('delivery_time', $resturant->delivery_time) }}"
        class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time" placeholder="">
</div>
 <div class="form-group col-sm-6">
    <label for="resturant_phone"> @lang('main.resturant_phone')</label><span class="text-danger">*</span>
    <input type="text" name="resturant_phone" value="{{ old('resturant_phone', $resturant->resturant_phone) }}"
        class="form-control @error('resturant_phone') is-invalid @enderror" id="resturant_phone" placeholder="">
</div>
 <div class="form-group col-sm-6">
    <label for="open_at"> @lang('main.open_at')</label><span class="text-danger">*</span>
    <input type="time" name="open_at" value="{{ old('open_at', $resturant->open_at) }}"
        class="form-control @error('open_at') is-invalid @enderror" id="open_at" placeholder="">
</div>
 <div class="form-group col-sm-6">
    <label for="close_at"> @lang('main.close_at')</label><span class="text-danger">*</span>
    <input type="time" name="close_at" value="{{ old('close_at', $resturant->close_at) }}"
        class="form-control @error('close_at') is-invalid @enderror" id="close_at" placeholder="">
</div>

 <div class="form-group col-sm-6">
    <label for="min_order_price"> @lang('main.min_order_price')</label><span class="text-danger">*</span>
        <div class="input-group mb-3">
     <span class="input-group-text" id="basic-addon1">@lang('main.egp')</span>

    <input type="number" name="min_order_price" value="{{ old('min_order_price', $resturant->min_order_price) }}"
        class="form-control @error('min_order_price') is-invalid @enderror" id="min_order_price" placeholder="">
        </div>
</div>
 <div class="form-group col-sm-6">
    <label for="km_price"> @lang('main.km_price')</label><span class="text-danger">*</span>
         <div class="input-group mb-3">
     <span class="input-group-text" id="basic-addon1">@lang('main.egp')</span>

    <input type="number" name="km_price" value="{{ old('km_price', $resturant->km_price) }}"
        class="form-control @error('km_price') is-invalid @enderror" id="km_price" placeholder="">
        </div>
</div>

 <div class="form-group col-sm-6">
         <label for="service_fees"> @lang('main.service_fees')</label><span class="text-danger">*</span>
     <div class="input-group mb-3">
     <span class="input-group-text" id="basic-addon1">%</span>
    <input type="number" name="service_fees" value="{{ old('service_fees', $resturant->service_fees) }}"
        class="form-control @error('service_fees') is-invalid @enderror" id="service_fees" placeholder="">
        </div>
</div>
<div class="form-group col-sm-6">
        <label for="status"> @lang('main.status of resturant')</label><span class="text-danger">*</span>
        <select name="status" class="form-select">
            <option value="opened" @if($resturant->status == 'opened') selected @endif>@lang('main.opened kitchen')</option>
            <option value="busy" @if($resturant->status == 'busy') selected @endif>@lang('main.busy kitchen')</option>
            <option value="closed" @if($resturant->status == 'closed') selected @endif>@lang('main.closed kitchen')</option>
        </select>
    </div>
    
<div class="form-group col-12"><hr></div>

<div class="form-group col-sm-6">
        <label for="logo">@lang('main.resturant logo')</label>

        <div class="input-group mb-2">
            <input type="file" name="logo" id="logo" class="form-control"
                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="col-sm-6">
            @if($resturant->getFirstMediaUrl('logo','thumb'))
                <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $resturant->id }}"
                    id="image" src="{{$resturant->getFirstMediaUrl('logo','thumb')}}" style="width:70%;"
                    alt="@lang('main.NoImageUploaded')">
                @include('admin.components.modal_photo', [
                    'image' => $resturant->getFirstMediaUrl('logo','thumb'),
                    'id' => $resturant->id,
                ])
            @else
                <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                    style="height: 80px; width: 100px;">
            @endif
        </div>
    </div>


<div class="form-group col-sm-6">
        <label for="bg_image">@lang('main.resturant bg_image')</label>

        <div class="input-group mb-2">
            <input type="file" name="bg_image" id="bg_image" class="form-control"
                onchange="document.getElementById('bg_image2').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="col-sm-6">
            @if($resturant->getFirstMediaUrl('bg_image','thumb'))
                <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $resturant->id }}"
                    id="bg_image2" src="{{$resturant->getFirstMediaUrl('bg_image','thumb')}}" style="width:70%;"
                    alt="@lang('main.NoImageUploaded')">
                @include('admin.components.modal_photo', [
                    'image' => $resturant->getFirstMediaUrl('bg_image','thumb'),
                    'id' => $resturant->id,
                ])
            @else
                <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                    style="height: 80px; width: 100px;">
            @endif
        </div>
    </div>
    
<div class="form-group col-12"><hr></div>
@if(auth()->user()->roles->pluck("id")->first() == 11)
<h5 class="my-2" style="font-weight: bolder;">*@lang('main.add zones to deliver')</h5>
<style>
    /*.copydiv .clone:first-child .btn-del-select{*/
    /*    display:none;*/
    /*}*/
</style>
    @if(\Route::currentRouteName() == 'resturants.create')
    <div class="col-sm-12">
        <div class="row-main create">
            <div class="row py-3 border-bottom position-relative">
                <div class="form-group col-sm-6">
                    <label for="area_id"> @lang('main.choose govern')</label><span class="text-danger">*</span>
                    <select class="form-select areas" name="area_id[]">
                        @foreach(\App\Models\Area::whereNotNull('parent_id')->get() as $area)
                        <option value="{{$area->id}}">{{$area->title}}</option>
                        @endforeach
                    </select>
                </div>
                @php $key = 0; @endphp
                <div class="form-group col-sm-6">
                    <label for="expected_delivery" class="expected_delivery">{{$key==0?__('main.expected_delivery_km'):__('main.expected_delivery')}}</label><span class="text-danger">*</span>
                    <input required type="text" name="expected_delivery[]"
                        class="form-control @error('expected_delivery') is-invalid @enderror" id="expected_delivery" placeholder="">
                </div>
            </div>
            <div class="clone-row"></div>
            <!-- Button to add new row -->
        </div>
    </div>
    @endif

    <!-- Template for cloning -->
    <template class="copydiv">
        <div class="row clone py-3 border-bottom position-relative">
            <div class="form-group col-sm-6">
                <label for="area_id"> @lang('main.choose govern')</label><span class="text-danger">*</span>
                <select class="form-select areas" name="area_id[]">
                    @foreach(\App\Models\Area::whereNotNull('parent_id')->get() as $area)
                    <option value="{{$area->id}}">{{$area->title}}</option>
                    @endforeach
                </select>
            </div>
            @php $key = 0; @endphp
            <div class="form-group col-sm-6">
                <label for="expected_delivery" class="expected_delivery">
                    {{$key==0?__('main.expected_delivery_km'):__('main.expected_delivery')}}
                </label><span class="text-danger">*</span>
                <input required type="text" name="expected_delivery[]"
                    class="form-control @error('expected_delivery') is-invalid @enderror" id="expected_delivery" placeholder="">
            </div>
            <span class="btn btn-danger pull-right btn-del-select py-2">
                <i class="fas fa-trash-alt"></i>
            </span>
        </div>
    </template>
    
    @if(\Route::currentRouteName() == 'resturants.edit')
    <div class="col-sm-12">
        <div class="row-main ">
            <div class="clone-row">
            @foreach($resturant->resturant_areas as $key => $val)
            <div class="row py-3 border-bottom position-relative">
                <div class="form-group col-sm-6">
                    <label for="area_id"> @lang('main.choose govern')</label><span class="text-danger">*</span>
                    <select class="form-select areas"  name="area_id[]">
                        @foreach(\App\Models\Area::whereNotNull('parent_id')->where('parent_id',$val->area?->parent_id)->get() as $area)
                        <option value="{{$area->id}}"  @if($val->area_id == $area->id) selected @endif>{{$area->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="expected_delivery" class="expected_delivery">{{$key==0?__('main.expected_delivery_km'):__('main.expected_delivery')}} </label><span class="text-danger">*</span>
                    <input required type="text"  name="expected_delivery[]" value="{{($val->expected_delivery) }}"
                    class="form-control @error('expected_delivery') is-invalid @enderror" id="expected_delivery" placeholder="">
                </div>
                <span class="btn btn-danger pull-right btn-del-select py-2">
                    <i class="fas fa-trash-alt"></i>
                </span>
            </div>
            @endforeach
            </div>
        </div>
    </div>
    @endif
    <span class="addTopic add-select btn btn-info mb-5 mt-3 col-md-6">
        <i class="fas fa-plus px-2"></i>
        <span>اضف منطقة اخرى</span>
    </span>
@endif
</div>
<div class="form-group col-sm-10">
    <button type="submit" class="btn btn-success">@lang('main.save')</button>
</div>

<style>
    .btn-del-select {
        line-height: normal;
        position: absolute;
        inset-inline-end: 0;
        top: 15px;
        /* transform: translate(-50%, -50%); */
        width: 25px;
        height: 25px;
        font-size: small;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
