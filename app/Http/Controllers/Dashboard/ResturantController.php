<?php

namespace App\Http\Controllers\Dashboard;
use App\Interfaces\ResturantRepositoryInterface;
use App\Interfaces\ResturantProductRepositoryInterface;
use App\Models\Resturant;
use App\Models\Review;
use App\Models\ResturantProduct;
use App\Http\Requests\Dashboard\Resturant\StoreResturantRequest;
use App\Http\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ExportResturant;
use Excel;
use App\Http\Requests\Dashboard\Resturant\ResturantProductRequest;
class ResturantController extends Controller
{
    use UploadImageTrait;
    private resturantRepositoryInterface $resturantRepository;
    private resturantProductRepositoryInterface $resturantProductRepository;

    public function __construct(resturantRepositoryInterface $resturantRepository, resturantProductRepositoryInterface $resturantProductRepository) 
    {
        $this->middleware('permission:resturant-list', ['only' => ['index','show']]);
        $this->middleware('permission:resturant-create', ['only' => ['create','store']]);
        $this->middleware('permission:resturant-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:resturant-delete', ['only' => ['destroy','delete_all']]);
        $this->resturantRepository = $resturantRepository;
        $this->resturantProductRepository = $resturantProductRepository;
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resturants = $this->resturantRepository->getAllResturants($request);
        return view('admin.resturants.index', compact('resturants'));
    }

    public function resturantTypes()
    {
        return view('admin.resturants.types');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resturant = new Resturant() ;
        return view('admin.resturants.create', compact('resturant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResturantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResturantRequest $request)
    {
        $resturantDetails = $request->except('_token');
        $resturant = $this->resturantRepository->createResturant($resturantDetails);
        return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function show(Resturant $resturant)
    {
        return view('admin.resturants.show', compact('resturant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function edit(Resturant $resturant)
    {
        return view('admin.resturants.edit', compact('resturant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResturantRequest  $request
     * @param  \App\Models\Resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function update(StoreResturantRequest $request,Resturant $resturant)
    {

    $resturantDetails = $request->except('_token','_method');
        $this->resturantRepository->updateResturant($resturant->id, $resturantDetails);
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resturant $resturant)
    {
        $this->resturantRepository->deleteResturant($resturant->id);
       
        return redirect()->back()->with('success',trans('messages.DeleteSuccessfully'));
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        
        $this->resturantRepository->deleteAllResturants($ids);
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function exportResturants(Request $request){
        return Excel::download(new ExportResturant, 'Resturants-'.now().'.xlsx');
    }
    
    public function resturantProductsCreate(ResturantProductRequest $request){
        $this->resturantProductRepository->createResturantProduct($request->except('_token'));
        return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
    }
    
    public function resturantProductsUpdate(ResturantProductRequest $request){
        $this->resturantProductRepository->updateResturantProduct($request->id ,$request->except('_token'));
        return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
    }

    public function resturantProductsDelete(ResturantProduct $resturant){
        $this->resturantProductRepository->deleteResturantProduct($resturant->id);
        return redirect()->back()->with('success',trans('messages.DeleteSuccessfully'));
    }
    
    public function changeStatus(Resturant $Resturant){
        $is_featured = (request('is_featured') == 'on')? 'yes' : 'no';
        $Resturant->update(['is_featured' =>$is_featured]);      
        return redirect()->route('resturants.index',['page' => request('page')])->with('success',trans('messages.UpdateSuccessfully'));

    }
    
     
    public function update_sorting_is_featured(Resturant $Resturant){
        $sortby_is_featured = request('sortby_is_featured');
        $Resturant->update(['sortby_is_featured' =>$sortby_is_featured]);      
        return redirect()->route('resturants.index',['page' => request('page')])->with('success',trans('messages.UpdateSuccessfully'));

    }
public function updateStatus(Request $request, Resturant $resturant) {
    $up_Resturant = $this->resturantRepository->changeStatus($resturant->id,$request->status);
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
  }
    
    public function changeUnderContract(Resturant $Resturant){
        $under_contract = (request('under_contract') == 'on')? 'yes' : 'no';
        $Resturant->update(['under_contract' =>$under_contract]);      
        return redirect()->route('resturants.index')->with('success',trans('messages.UpdateSuccessfully'));

    }
    
    public function resturantReviewsDelete(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success',trans('messages.DeleteSuccessfully'));
    }
    
    public function resturantProductsUpdateStatus($id){
        $product=ResturantProduct::find($id);
        if($product){
            $product->update(['status'=>request()->status]);
        }
         return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }
     public function resturantProductsUpdateHighestRated($id){
        $product=ResturantProduct::find($id);
        if($product){
            $product->update(['highest_rated'=>request()->highest_rated]);
        }
         return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }
    
    
    
}
