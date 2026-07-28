<?php

namespace App\Http\Controllers\Dashboard;
use App\Interfaces\ProductFeatureRepositoryInterface;
use App\Models\ProductFeature;
use App\Http\Requests\Dashboard\Product\ProductFeatureRequest;
use App\Http\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductFeatureController extends Controller
{
    use UploadImageTrait;
    private ProductFeatureRepositoryInterface $product_featureRepository;

    public function __construct(ProductFeatureRepositoryInterface $product_featureRepository) 
    {
        $this->middleware('permission:product-list', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy','delete_all']]);
        $this->product_featureRepository = $product_featureRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_features = $this->product_featureRepository->getAllProductFeatures($request);
        return view('admin.product_features.index', compact('product_features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_feature = new ProductFeature() ;
        return view('admin.product_features.create', compact('product_feature'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductFeatureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductFeatureRequest $request)
    {
        $product_featureDetails = $request->except('_token');

        $product_feature = $this->product_featureRepository->createProductFeature($product_featureDetails);
        
        return redirect('admin/product_features')->with('success',trans('messages.AddSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductFeature  $product_feature
     * @return \Illuminate\Http\Response
     */
    public function show(ProductFeature $product_feature)
    {
        return view('admin.product_features.show', compact('product_feature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductFeature  $product_feature
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductFeature $product_feature)
    {
        return view('admin.product_features.edit', compact('product_feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductFeatureRequest  $request
     * @param  \App\Models\ProductFeature  $product_feature
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductFeatureRequest $request, ProductFeature $product_feature)
    {
        $product_featureDetails = $request->except('_token','_method');
        $this->product_featureRepository->updateProductFeature($product_feature->id, $product_featureDetails);
    
        return redirect('admin/product_features')->with('success',trans('messages.UpdateSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductFeature  $product_feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductFeature $product_feature)
    {
        $this->product_featureRepository->deleteProductFeature($product_feature->id);
        return redirect('admin/product_features')->with('success',trans('messages.DeleteSuccessfully'));
    }
    public function deleteAll(Request $request)
    {  
        $ids = $request->ids;
        
        $this->product_featureRepository->deleteAllProductFeatures($ids);
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);

    }

}