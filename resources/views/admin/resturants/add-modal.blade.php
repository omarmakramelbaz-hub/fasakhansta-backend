<!-- Button trigger modal -->

@push('custom-js')

<style>
    #copyMenue .modal-body{
        height:250px;
        overflow-y:scroll;
    }
</style>
@endpush
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{$resturant->parent_id!=null?'#chooseAddWay':'#addItem'}}" id="clickbtn">
  @lang('main.add new item')
</button>

<div class="modal fade addModal" id="chooseAddWay" tabindex="-1" aria-labelledby="chooseAddWayLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
                                    @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addItemLabel">  @lang('main.add new item')</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row text-center">
              <div class="col-2"></div>
              <div class="col-4"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#copyMenue">@lang('main.copy menue')</button></div>
              <div class="col-4">         
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">@lang('main.add new item')</button>
              </div>
                  
          </div>
         
      </div>
     
     
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade addModal" id="addItem" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
  <div class="modal-dialog  d-block   modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
    <form method="post" action="{{ route('resturant_products.store') }}" enctype="multipart/form-data" id="formAppendProducts">
                                    @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addItemLabel">  @lang('main.add new item')</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<input type="number" name="resturant_id" value="{{ $resturant->id }}" class="form-control" hidden>
<input type="number" name="added_by" value="{{ Auth::guard('admin')->user()->id }}" class="form-control" hidden>
<div class="row gy-2">

<div class=" col-sm-6">
    <label for="category_id"> @lang('main.category')</label><span class="text-danger">*</span>
    <select name="category_id" onChange="getproducts(this.value);" class="form-select category">
        <option value="">@lang('main.choose')</option>
        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $value)
            <option value="{{$value->id}}" @if($value->id == old('category_id')) selected @endif >{{$value->name}}</option>
        @endforeach
    </select>
</div>
<div class=" col-sm-6" id="div">
</div>

<div class=" col-sm-12" id="div1">
</div>

<div class=" col-sm-6">
    <label for="product_name"> @lang('main.product_name')</label><span class="text-danger">*</span>
    <input type="text" name="product_name" value="{{ old('product_name') }}"
        class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="@lang('main.enter') @lang('main.product_name')">
</div>
<div class=" col-sm-6">
    <label for="product_price"> @lang('main.product_price')</label><span class="text-danger">*</span>
    <input type="number" min="0" name="product_price" value="{{ old('product_price') }}"
        class="form-control @error('product_price') is-invalid @enderror" id="product_price" placeholder="@lang('main.enter') @lang('main.product_price')">
</div>

<div class=" col-sm-12" id="div2">
</div>

<div class=" col-sm-12">
    <label for="product_description"> @lang('main.product_description')</label>
    <input type="text" name="product_description" value="{{ old('product_description') }}"
        class="form-control @error('product_description') is-invalid @enderror" id="product_description" placeholder="@lang('main.enter') @lang('main.product_description')">
</div>

<div class="col-sm-12">
        <label for="product_image">@lang('main.product_image')</label>

        <div class="input-group mb-2">
            <input type="file" name="product_image" id="image" class="custom-file-input"
                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
            <label class="custom-file-label" for="image">{{ trans('main.UploadProfileImage') }}</label>
        </div>
        <div class="col-sm-6">
                <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                    style="height: 80px; width: 100px;">
        </div>
    </div>


</div>


        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
        <button type="submit" class="btn btn-primary">@lang('main.Save changes')</button>
      </div>
      </form>
    </div>
  </div>
</div>
@if($resturant->parent)
<div class="modal fade addModal" id="copyMenue" tabindex="-1" aria-labelledby="copyMenueLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" action="{{ url('admin/resturant/copy/items') }}" enctype="multipart/form-data" id="formAppendProducts">
                                    @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addItemLabel"> @lang('main.copy menue')</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <input type="number" name="resturant_id" value="{{ $resturant->id }}" class="form-control" hidden>
                
                <ul>
                    <li><input type="checkbox" id="master">@lang('main.selectAll')</li>
                    @foreach($resturant->parent->resturant_products as $product)
                    <li>
                        <input type="checkbox" name="restraunt_product[]" class="sub_chk" value="{{$product->id}}">
                        {{$product->product_name}}
                    </li>
                    @endforeach
                </ul>
           </div>
    
    
            
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('main.close')</button>
            <button type="submit" class="btn btn-primary">@lang('main.Save changes')</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endif
@push('custom-js')
<script type="text/javascript">
$('#div2').empty();
$('#div2').text();

// $('#clickbtn').click(function(){
    function callAjax(){
        var priceParent = $('#div');
        $.ajax({
            url: "{{url('admin/fetch-subcategory')}}",
            type: "POST",
            async: true,
            data: {
                category_id: idproduct, 
                product_id: product,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $(priceParent).html('');
                $(priceParent).html(data.options);
            },error:function(er){
                console.log(er);
            }
        });
    }

    if ($('select[name="category_id"]').val() != "0") {
        var idproduct = $('select[name="category_id"]').val();
        var product= $('.product_id').val();
        callAjax();
    }

    $(document).on('change', 'select[name="category_id"]' , function () {
        
        var idproduct = this.value;
        var priceParent = $('#div');
        var product= $('.product_id').val();
        console.log(product);
        $.ajax({
            url: "{{url('admin/fetch-subcategory')}}",
            type: "POST",
            async: true,
            data: {
                product_id: product,
                category_id: idproduct,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $(priceParent).html('');
                $(priceParent).html(data.options);
            },error:function(er){
                console.log(er);
            }
        });
    });   
    
    
    
    
    
    function callAjax1(){
        var priceParent1 = $('#div1');
        $.ajax({
            url: "{{url('admin/fetch-product')}}",
            type: "POST",
            async: true,
            data: {
                category_id: idsubproduct, 
                product_id: product,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $(priceParent1).html('');
                $(priceParent1).html(data.options);
            }
        });
    }

    if ($('select[name="subcategory_id"]').val() != "0") {
        var idproduct = $('select[name="subcategory_id"]').val();
        var product= $('.product_id').val();
        callAjax1();
    }
    
    // function getproducts(val){
    //     alert('fghbn')
    //     var idsubproduct = val;
    //     var priceParent1 = $('#div1');
    //     var product= $('.product_id').val();
    //     $.ajax({
    //         url: "{{url('admin/fetch-product')}}",
    //         type: "POST",
    //         async: true,
    //         data: {
    //             product_id: product,
    //             subcategory_id: idsubproduct,
    //             _token: '{{csrf_token()}}'
    //         },
    //         dataType: 'json',
    //         success: function (data) {
    //             $(priceParent1).html('');
    //             $(priceParent1).html(data.options);
    //         }
    //     });
    // }
        // function getfeatures(val){
        //         var idproduct = val;
        //         var priceParent2 = $('#div2');
        //         $.ajax({
        //             url: "{{url('admin/fetch-feature')}}",
        //             type: "POST",
        //             async: true,
        //             data: {
        //                 product_id: idproduct,
        //                 _token: '{{csrf_token()}}'
        //             },
        //             dataType: 'json',
        //             success: function (data) {
        //                 $(priceParent2).html('');
        //                 $(priceParent2).html(data.options);
        //             }
        //         });
        //     }
        
// });
</script>
@endpush