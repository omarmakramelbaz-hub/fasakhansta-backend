@if($category->count() > 0)
<div class=" col-sm-12 subcategory">
    <label for="subcategory_id"> @lang('main.subcategory') </label><span class="text-danger">*</span>

    <select name="subcategory_id" id="subcategoryid" onChange="getproducts(this.value);" class="form-select subcategory">
        <option value="">@lang('main.choose')</option>
        @foreach($category as $value)
            <option value="{{$value->id}}" @if(!$product) @if($value->id == old('subcategory_id')) selected @endif @else @if($value->id == old('subcategory_id', $product->subcategory_id)) selected @endif @endif >{{$value->name}}</option>
        @endforeach
    </select>
</div>
@endif