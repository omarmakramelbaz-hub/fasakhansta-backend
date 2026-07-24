
<div class=" col-sm-12 product">
    <label for="product_id"> @lang('main.product') <span class="text-danger">*</span></label>

    <select name="product_id" id="productid" required onChange="getfeatures(this.value);" class="form-select product">
        <option value="">@lang('main.choose')</option>
        @foreach($subcategory as $value)
            <option value="{{$value->id}}" @if(!$product) @if($value->id == old('product_id')) selected @endif @else @if($value->id == old('subcategory_id', $product->id)) selected @endif @endif >{{$value->name}}</option>
        @endforeach
    </select>
</div>

