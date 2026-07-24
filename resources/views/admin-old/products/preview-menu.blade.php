@extends('admin.index')
@push('custom-css')
<style>
ul, #myUL {
  list-style-type: none;
}
.caret{
    font-weight:bold;
    font-size:1.3rem;
}


</style>
@endpush
@section('content')
    <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.general menu')
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                        @can('product-create')
                       <li class="breadcrumb-item"><a href="{{ url('admin/products/create') }}" class="btn btn-primary">@lang('main.add') @lang('main.products')  
                    </a></li>  
                    @endcan    
                        </ol>
                    </div><!-- /.col -->
                    
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2 card">
<div class="card-body">
    <div id="jstree">
<ul id="">
  @foreach($products->whereNull('parent_id') as $key => $category)
  <li><span class="caret">{{$category->name}}</span>
    <ul class="nested">
      @if($category->childs->count() > 0)
        @foreach($category->childs as $subcategory)
          @if($subcategory->subcategory_products->count() > 0)
          <li><span class="caret">{{$subcategory->name}}</span>
            <ul class="nested">
            @foreach($subcategory->subcategory_products as $product)
              <li>{{$product->name}}</li>
            @endforeach
            </ul>
          </li>  
          @else
          <li>{{$subcategory->name}}</li>
          @endif
          @endforeach
      @else
          @foreach($category->category_products as $product)
          <li>{{$product->name}}
          </li>  
          @endforeach
      @endif
    </ul>
  </li>
  @endforeach
</ul>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
@push('custom-js')
<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>
@endpush