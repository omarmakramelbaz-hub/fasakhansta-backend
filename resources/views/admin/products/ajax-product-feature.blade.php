@if($features->count() > 0 || ($product && $product->has_clean==1))
<div class="row">
    <p class="addons">@lang('main.addons'):</p>
    <small>(@lang('main.addon price note')) </small>
 @php $count=0; @endphp
 
 @if( ($product) && $product->has_clean==1 )
        @php $arr=[  'extra_clear' , 'extra_clean','extra_vacuim'];
        @endphp
        @foreach($arr as $ar)

        <div class=" col-sm-12">
            <label for="product_price{{$ar}}"> @lang('main.price_by') {{__('main.'.$ar)}}<span class="text-danger">*</span></label>
            <input type="number" min="0" required name="{{$ar}}"  value="{{$resturant_product ? json_decode($resturant_product->price)->$ar : 0}}"
                class="form-control @error('product_price') is-invalid @enderror" id="{{$ar}}" placeholder="@lang('main.enter') @lang('main.price_by') {{__('main.'.$ar)}}">
        </div>
       @endforeach
@endif

@foreach($features as $key => $value)


@if(($value->name == 'medium' || $value->name == 'large'))
        @php $arr=[  'extra_medium' , 'extra_large'];
        $ar='extra_'.$value->name;
        @endphp
    <div class=" col-sm-12">
        <label for="product_price{{$value->id}}"> @lang('main.price_by') {{__('main.'.$ar)}} <span class="text-danger">*</span></label>
        <input type="number" min="0" required name="{{$ar}}"value="{{$resturant_product!=null  ? json_decode($resturant_product->price)->$ar:0}}"  
            class="form-control @error('product_price') is-invalid @enderror" id="{{$ar}}" placeholder="@lang('main.enter') @lang('main.product_price')">
    </div>
        @php $count++;
        @endphp
@endif



@if($value->name == 'combo')
    <div class=" col-sm-12">
        <label for="product_price{{$value->id}}"> @lang('main.price_by') {{__('main.extra_combo')}}<span class="text-danger">*</span></label>
        <input type="number" min="0" required name="extra_combo" value="{{$resturant_product!=null   ? json_decode($resturant_product->price)->extra_combo:0}}"  
            class="form-control @error('product_price') is-invalid @enderror" id="extra_combo" placeholder="@lang('main.enter') @lang('main.product_price')">
    </div>
@endif

@endforeach
</div>
@endif

